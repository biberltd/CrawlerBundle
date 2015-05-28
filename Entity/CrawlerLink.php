<?php
/**
 * @name        CrawlerLink
 * @package		BiberLtd\CrawlerBundle
 *
 * @author		Can Berkol
 *
 * @version     1.0.0
 * @date        05.05.2014
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
 *     name="crawler_link",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="idxUCrawlerLinkId", columns={"id"}),
 *         @ORM\UniqueConstraint(name="idxUCrawlerLinkUrl", columns={"hash"})
 *     }
 * )
 */
class CrawlerLink extends CoreEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", length=15, options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $hash;

    /**
     * @ORM\Column(type="integer", length=3, nullable=false, options={"unsigned":true})
     */
    private $priority;

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
	 * @name        getPriority ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getPriority() {
		return $this->priority;
	}

	/**
	 * @name        setPriority ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $priority
	 *
	 * @return      $this
	 */
	public function setPriority($priority) {
		if (!$this->setModified('priority', $priority)->isModified()) {
			return $this;
		}
		$this->priority = $priority;

		return $this;
	}

	/**
	 * @name        getSection ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getSection() {
		return $this->section;
	}

	/**
	 * @name        setSection ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $section
	 *
	 * @return      $this
	 */
	public function setSection($section) {
		if (!$this->setModified('section', $section)->isModified()) {
			return $this;
		}
		$this->section = $section;

		return $this;
	}

	/**
	 * @name        getUrl ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @return      mixed
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @name        setUrl ()
	 *
	 * @author      Can Berkol
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 *
	 * @param       mixed $url
	 *
	 * @return      $this
	 */
	public function setUrl($url) {
		if (!$this->setModified('url', $url)->isModified()) {
			return $this;
		}
		$this->url = $url;

		return $this;
	}
}
/**
 * Change Log:
 * **************************************
 * v1.0.0					   05.05.2015
 * Can Berkol
 * **************************************
 * FR :: File created.
 */