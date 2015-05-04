<?php

namespace Ford\Bundle\CrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class DefaultController extends Controller
{
    public function indexAction(){
        return new Response('ok');
    }
}
