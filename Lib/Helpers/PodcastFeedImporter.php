<?php


namespace App\Lib\Helpers;


use App\Lib\Parsers\Exceptions\InvalidFeedFormatException;
use App\Models\Podcasts\Podcast;
use App\Models\Podcasts\Show;
use Carbon\Carbon;

class PodcastFeedImporter
{
    /**
     * @var array
     */
    private $parsedResult;
    /**
     * @var null
     */
    private $feedUrl;

    private $radioShow = null;
    private $podcasts = [];

    /**
     * PodcastFeedImporter constructor.
     * @param array $parsedResult
     * @param null $feedUrl
     * @throws InvalidFeedFormatException
     */
    public function __construct(array $parsedResult, $feedUrl = null)
    {
        if (!$this->validate($parsedResult)) {
            throw new InvalidFeedFormatException();
        }
        $this->parsedResult = $parsedResult;
        $this->feedUrl = $feedUrl;
    }

    private function validate($parsedResult)
    {
        if (!isset($parsedResult['channel'])) {
            return false;
        }
        $channel = $parsedResult['channel'];
        if (
            !isset($channel['title'])
            ||
            !isset($channel['item'])
            ||
            empty($channel['item'])
        ) {
            return false;
        }
        return true;
    }

    /**
     * @return Show
     */
    public function getShowInfo()
    {
        if (empty($this->radioShow)) {
            $radioShow = new Show();
            $radioShow->name = strip_tags($this->getAttributeFromFeed('title'));
            $radioShow->description = strip_tags($this->getAttributeFromFeed('description'));
            $radioShow->author = $this->getAttributeFromFeed('itunes:author');
            $radioShow->website = $this->getAttributeFromFeed('link');
            $radioShow->explicit = strtolower($this->getAttributeFromFeed('itunes:explicit')) === "yes" ? true : false;
            $radioShow->slug = str_slug($radioShow->name);
            $image = $this->getAttributeFromFeed('itunes:image');
            $image = isset($image['@attributes']['href']) ? $image['@attributes']['href'] : null;
            $radioShow->logo_url = $image;
            $radioShow->feed_url = $this->feedUrl;
            $this->radioShow = $radioShow;
        }
        return $this->radioShow;
    }

    /**
     * @param string $attributeName
     * @return null|string
     */
    private function getAttributeFromFeed($attributeName)
    {
        $channel = $this->parsedResult['channel'];
        return $this->getOrNull($channel, $attributeName);
    }

    public function getPodcastsInfo($latestPodcast = null)
    {
        if (empty($this->podcasts)) {
            $items = $this->getAttributeFromFeed('item');
            foreach ($items as $item) {
                $podcast = $this->getPodcastFromFeedItem($item);
                $podcast->slug = str_slug($this->getAttributeFromFeed('title') . $podcast->date . '-' . str_random(5));
                if ($latestPodcast !== null && $podcast->file_url == $latestPodcast->file_url) {
                    $latestPodcast->fill($podcast->toArray());
                    $this->podcasts[] = $latestPodcast;
                    return $this->podcasts;
                }
                $this->podcasts[] = $podcast;
            }
        }

        return $this->podcasts;
    }

    private function getPodcastFromFeedItem(array $item)
    {
        $podcast = new Podcast();
        $podcast->name = strip_tags($this->getOrNull($item, 'title'));
        $podcast->description = strip_tags($this->getOrNull($item, 'description'));
        $podcast->duration = $this->getOrNull($item, 'itunes:duration');
        $podcast->file_url = $this->getAttrValFromTag($item, 'enclosure', 'url');
        $podcast->date = (new Carbon($this->getOrNull($item, 'pubDate')))->format('Y-m-d H:s');
        return $podcast;
    }

    private function getOrNull(array $array, $key)
    {
        if (!isset($array[$key])) {
            return null;
        }
        return $array[$key];
    }

    private function getAttrValFromTag($item, $tag, $attribute)
    {
        $element = $this->getOrNull($item, $tag);
        if (empty($element)
            || !array_key_exists('@attributes', $element)
            || !array_key_exists($attribute, $element['@attributes'])
        ) {
            return null;
        }

        return $element['@attributes'][$attribute];
    }

}