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
class XpathRule extends CoreEntity
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
     * @ORM\Column(type="text", nullable=false)
     */
    private $parentRule;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\XpathRule")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;

    /**
     * @name        getId ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @return      mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @name        setId ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @param       mixed $id
     *
     * @return      $this
     */
    public function setId($id)
    {
        if (!$this->setModified('id', $id)->isModified()) {
            return $this;
        }
        $this->id = $id;
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
     * @name        getParent ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @return      mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @name        setParent ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @param       mixed $parent
     *
     * @return      $this
     */
    public function setParent($parent)
    {
        if (!$this->setModified('parent', $parent)->isModified()) {
            return $this;
        }
        $this->parent = $parent;
        return $this;
    }

    /**
     * @name        getParentRule ()
     *
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @return      mixed
     */
    public function getParentRule()
    {
        return $this->parentRule;
    }

    /**
     * @name        setParentRule ()
     * @author      Said İmamoğlu
     *
     * @since       1.0.0
     * @version     1.0.0
     *
     * @param       mixed $parentRule
     *
     * @return      $this
     */
    public function setParentRule($parentRule){
        if(!$this->setModified('parentRule', $parentRule)->isModified()){
            return $this;
        }
        $this->parentRule = $parentRule;

        return $this;
    }
    
}