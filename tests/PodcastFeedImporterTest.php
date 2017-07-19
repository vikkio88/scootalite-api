<?php


use App\Lib\Helpers\PodcastFeedImporter;
use App\Lib\Helpers\RadioFeedGateway;
use App\Models\Podcasts\Podcast;
use App\Models\Podcasts\Show;

class PodcastFeedImporterTest extends PHPUnit_Framework_TestCase
{
    const FEED_FILE_NAME = './tests/Files/testFeed.xml';

    /**
     * @param null $feedFile
     * @return PodcastFeedImporter
     */
    private function getTestImporter($feedFile = null)
    {
        $feedFile = empty($feedFile) ? self::FEED_FILE_NAME : $feedFile;
        $feedGateway = new RadioFeedGateway();
        $parsedFeedArray = $feedGateway->getFullPodcastArrayFromFeed($feedFile);
        return new PodcastFeedImporter($parsedFeedArray, $feedFile);
    }

    /**
     * @group Helpers
     * @group PodcastFeedImporter
     **/
    public function testItAcceptRightArrayFormat()
    {
        $importer = $this->getTestImporter();
        $this->assertNotEmpty($importer);
    }

    /**
     * @group Helpers
     * @group PodcastFeedImporter
     * @expectedException \App\Lib\Parsers\Exceptions\InvalidFeedFormatException
     **/
    public function testItThrowsIfFeedFormatIsWrong()
    {
        $importer = $this->getTestImporter('wrong_feed.xml');
    }

    /**
     * @group Helpers
     * @group PodcastFeedImporter
     * @group PodcastImporterShowInfo
     **/
    public function testConvertHeadIntoRadioShow()
    {
        $importer = $this->getTestImporter();
        $result = $importer->getShowInfo();
        $this->assertInstanceOf(Show::class, $result);
    }

    /**
     * @group Helpers
     * @group PodcastFeedImporter
     * @group PodcastImporterPodcasts
     **/
    public function testConvertItemsIntoPodcasts()
    {
        $importer = $this->getTestImporter();
        $podcasts = $importer->getPodcastsInfo();
        $this->assertNotEmpty($podcasts);
        foreach ($podcasts as $podcast) {
            $this->assertInstanceOf(Podcast::class, $podcast);
        }
    }
}
