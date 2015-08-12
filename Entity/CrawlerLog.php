<?php
/**
 * @name        CrawlerLog
 * @package		BiberLtd\CrawlerBundle
 *
 * @author		Can Berkol
 *
 * @version     1.0.1
 * @date        09.06.2014
 *
 * @copyright   Biber Ltd. (http://www.biberltd.com)
 * @license     GPL v3.0
 *
 */
namespace BiberLtd\Bundle\CrawlerBundle\Entity;
use BiberLtd\Bundle\CoreBundle\CoreEntity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="crawler_log",
 *     options={"collate":"utf8_turkish_ci","charset":"utf8","engine":"innodb"},
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="idxUCrawlerLogId", columns={"id"}),
 *         @ORM\UniqueConstraint(name="idxUCrawlerLog", columns={"link","rule","microtime"}),
 *         @ORM\UniqueConstraint(name="idxUCrawlerLogHash", columns={"hash"})
 *     }
 * )
 */
class CrawlerLog extends CoreEntity{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", length=15, options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $timestamp;

    /**
     * @ORM\Column(type="string", length=1, nullable=false, options={"default":"n"})
     */
    private $is_changed;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $hash;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="integer", unique=true, nullable=true)
     */
    private $microtime;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\CrawlerLink")
     * @ORM\JoinColumn(name="link", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\XpathRule")
     * @ORM\JoinColumn(name="rule", referencedColumnName="id", onDelete="CASCADE")
     */
    private $rule;

	/**
	 * @name        getContent ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @name        setContent ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $content
	 *
	 * @return      $this
	 */
	public function setContent($content) {
		if (!$this->setModified('content', $content)->isModified()) {
			return $this;
		}
		$this->content = $content;

		return $this;
	}

	/**
	 * @name        getHash ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * @name        setHash ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $hash
	 *
	 * @return      $this
	 */
	public function setHash($hash) {
		if (!$this->setModified('hash', $hash)->isModified()) {
			return $this;
		}
		$this->hash = $hash;

		return $this;
	}

	/**
	 * @name        getId ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @name        setId ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $id
	 *
	 * @return      $this
	 */
	public function setId($id) {
		if (!$this->setModified('id', $id)->isModified()) {
			return $this;
		}
		$this->id = $id;

		return $this;
	}

	/**
	 * @name        getIsChanged ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getIsChanged() {
		return $this->is_changed;
	}

	/**
	 * @name        setIsChanged ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $is_changed
	 *
	 * @return      $this
	 */
	public function setIsChanged($is_changed) {
		if (!$this->setModified('is_changed', $is_changed)->isModified()) {
			return $this;
		}
		$this->is_changed = $is_changed;

		return $this;
	}

	/**
	 * @name        getLink ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * @name        setLink ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $link
	 *
	 * @return      $this
	 */
	public function setLink($link) {
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
	 * @name        getStatus ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @name        setStatus ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $status
	 *
	 * @return      $this
	 */
	public function setStatus($status) {
		if (!$this->setModified('status', $status)->isModified()) {
			return $this;
		}
		$this->status = $status;

		return $this;
	}

	/**
	 * @name        getTimestamp ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * @name        setTimestamp ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $timestamp
	 *
	 * @return      $this
	 */
	public function setTimestamp($timestamp) {
		if (!$this->setModified('timestamp', $timestamp)->isModified()) {
			return $this;
		}
		$this->timestamp = $timestamp;

		return $this;
	}

	/**
	 * @name        getMicrotime ()
	 *
	 * @author      Said İmamoğlu
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getMicrotime()
	{
		return $this->microtime;
	}

	/**
	 * @name        setMicrotime ()
	 *
	 * @author      Said İmamoğlu
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $microtime
	 *
	 * @return      $this
	 */
	public function setMicrotime($microtime)
	{
		if (!$this->setModified('microtime', $microtime)->isModified()) {
			return $this;
		}
		$this->microtime = $microtime;
		return $this;
	}

}
/**
 * Change Log:
 * **************************************
 * v1.0.1					   09.06.2015
 * Can Berkol
 * **************************************
 * BF :: Wrong namespaces fixed.
 *
 * **************************************
 * v1.0.0					   05.05.2015
 * Can Berkol
 * **************************************
 * FR :: File created.
 */