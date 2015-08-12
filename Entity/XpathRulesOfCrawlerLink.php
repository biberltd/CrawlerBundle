<?php
/**
 * @name        XpathRulesOfCrawlerLink
 * @package		BiberLtd\CrawlerBundle
 *
 * @author		Can Berkol
 *
 * @version     1.0.1
 * @date        12.08.2015
 *
 * @copyright   Biber Ltd. (http://www.biberltd.com)
 * @license     GPL v3.0
 *
 */
namespace BiberLtd\Bundle\CrawlerBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="xpath_rules_of_crawler_link",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     uniqueConstraints={@ORM\UniqueConstraint(name="idxUTitleOfXpathRuleOfCrawlerLink", columns={"code"})}
 * )
 */
class XpathRulesOfCrawlerLink
{
    /**
     * @ORM\Column(type="string", unique=true, length=155, nullable=true)
     */
    private $code;
    /**
     * 
     */
    private $title;
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

    /**
     * @name        getTitle ()
     *
     * @author      Can Berkol
     *
     * @since       1.0.1
     * @version     1.0.1
     *
     * @return      mixed
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @name        setTitle ()
     *
     * @author      Can Berkol
     *
     * @since       1.0.1
     * @version     1.0.1
     *
     * @param       mixed $title
     *
     * @return      $this
     */
    public function setTitle($title){
        if(!$this->setModified('title', $title)->isModified()){
            return $this;
        }
        $this->title = $title;

        return $this;
    }
}
/**
 * Change Log:
 * **************************************
 * v1.0.0					   12.08.2015
 * Can Berkol
 * **************************************
 * FR :: title field added.
 */