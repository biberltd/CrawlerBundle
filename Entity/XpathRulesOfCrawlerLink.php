<?php
namespace BiberLtd\Bundle\CrawlerBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="xpath_rules_of_crawler_link",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"}
 * )
 */
class XpathRulesOfCrawlerLink
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\CrawlerLink")
     * @ORM\JoinColumn(name="link", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $link;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\XpathRule")
     * @ORM\JoinColumn(name="rule", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $rule;
}