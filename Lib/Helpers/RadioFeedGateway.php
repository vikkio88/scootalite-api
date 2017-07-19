<?php


namespace App\Lib\Helpers;

use App\Lib\Parsers\DeepFeedParser;
use App\Lib\Parsers\Exceptions\InvalidFeedFormatException;
use Exception;
use SimpleXMLElement;


/**
 * Class RadioFeedGateway
 * @package App\Lib\Helpers
 */
class RadioFeedGateway
{
    /**
     * @var int
     */
    protected $maxPodcast = 15;


    /**
     * @param $url
     * @return string
     * @throws InvalidFeedFormatException
     */
    private function getRemoteFeedXml($url)
    {
        $feedContent = '';
        if (empty($url)) {
            throw new InvalidFeedFormatException();
        }

        try {
            $feedContent = file_get_contents($url);
        } catch (Exception $error) {
            throw new InvalidFeedFormatException();
        }

        return $feedContent;
    }

    /**
     * @param $xml
     * @return string
     */
    private function xmlToJson($xml)
    {
        $xml = simplexml_load_string($xml);
        return json_encode(new SimpleXMLElement($xml->asXML(), LIBXML_NOCDATA));
    }

    /**
     * @param $url
     * @return string
     * @internal param $args
     */
    public function getPodcastJsonFromFeed($url)
    {
        $feedXml = $this->getRemoteFeedXml($url);
        return $this->xmlToJson($feedXml);
    }

    /**
     * @param $url
     * @return string
     * @internal param $args
     */
    public function getSimplePodcastArrayFromFeed($url)
    {
        $feedXml = $this->getRemoteFeedXml($url);
        return $this->xmlToArray($feedXml);
    }

    public function getFullPodcastArrayFromFeed($url)
    {
        $feedXml = $this->getRemoteFeedXml($url);
        $parser = new DeepFeedParser();
        return $parser->xmlToArray($feedXml);
    }


    private function xmlToArray($feedXml)
    {
        $json = $this->xmlToJson($feedXml);
        return json_decode($json, true);
    }

}