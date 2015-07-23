<?php
namespace BiberLtd\Bundle\CrawlerBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="xpath_rule",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     indexes={@ORM\Index(name="idxNXpathRules", columns={"rule"})}
 * )
 */
class XpathRule
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"default":10})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $rule;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\XpathRule")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;
}