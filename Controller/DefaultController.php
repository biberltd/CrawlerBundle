<?php

namespace Ford\Bundle\CrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class DefaultController extends Controller
{
    public function indexAction(){
        $client = new Client();
        $crawler = $client->request('GET','http://www.ford.com.tr');
        echo $crawler->filterXPath('//*[@id=mainContent]')->html();die;

    }
    public function AnaSayfaSlaytAlani(){
        $rootDir = $this->get('kernel')->getRootDir();
        $currentDate = new \DateTime('now');
        $filePath = $rootDir.'/../data/page/anasayfa/'.$currentDate->format("dmY").'.html';
        $xPathRule = '//article//img[@role="presentation"]';
        if (!file_exists($filePath)) {
            $domain = 'http://www.ford.com.tr';
            $client = new Client();
            $crawler = $client->request('GET',$domain);
            file_put_contents($filePath,$crawler->html());
        }else{
            $crawler = new Crawler();
            $crawler->addContent(file_get_contents($filePath));
        }
        $crawler->filterXPath($xPathRule)->each(function ($node){
//            echo '<img src=\'http://ford.com.tr'.$node->extract(array('src'))[0].'\' />'.'<br>';
            echo $node->attr('src').'<br>';
        });

        die;


    }
    private function BinekAracFiyatListeleriBanner()
    {
        $client = new Client();
        $domain = 'http://www.ford.com.tr/SBE/fiyat-listeleri/binek-arac-fiyatlari';
        $crawler = $client->request('GET',$domain);

        $link = $crawler->filter('#masthead > img')->attr('src');
        echo '<pre>';
        var_dump($link);
        die;

    }
}
