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

    /**
     * @name        getLink ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @return      mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @name        setLink ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @param       mixed $link
     *
     * @return      $this
     */
    public function setLink($link)
    {
        if (!$this->setModified('link', $link)->isModified()) {
            return $this;
        }
        $this->link = $link;
        return $this;
    }

    /**
     * @name        getRule ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @return      mixed
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @name        setRule ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @param       mixed $rule
     *
     * @return      $this
     */
    public function setRule($rule)
    {
        if (!$this->setModified('rule', $rule)->isModified()) {
            return $this;
        }
        $this->rule = $rule;
        return $this;
    }

}