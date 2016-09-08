<?php
/**
 * @name        CrawlerLink
 * @package     BiberLtd\CrawlerBundle
 *
 * @author      Can Berkol
 *
 * @version     1.0.0
 * @date        05.05.2014
 *
 * @copyright   Biber Ltd. (http://www.biberltd.com)
 * @license     GPL v3.0
 *
 */

namespace BiberLtd\Bundle\CrawlerBundle\Entity;
use BiberLtd\Bundle\MemberManagementBundle\Entity\Member;
use BiberLtd\Bundle\SiteManagementBundle\Entity\Site;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="crawler_request",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     indexes={
 *         @ORM\Index(name="id", columns={"id"}),
 *         @ORM\Index(name="member", columns={"member"}),
 *         @ORM\Index(name="site", columns={"site"}),
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="id", columns={"id"}),
 *     }
 * )
 */
class CrawlerRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", nullable=false)
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\SiteManagementBundle\Entity\Site")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\CrawlerBundle\Entity\CrawlerLink")
     * @ORM\JoinColumn(name="crawler_link", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $crawler_link;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_started;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_failed;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_completed;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_added;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_updated;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_removed;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param mixed $member
     */
    public function setMember(Member $member)
    {
        $this->member = $member;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getCrawlerLink()
    {
        return $this->crawler_link;
    }

    /**
     * @param mixed $crawler_link
     */
    public function setCrawlerLink(CrawlerLink $crawler_link)
    {
        $this->crawler_link = $crawler_link;
    }

    /**
     * @return mixed
     */
    public function getDateStarted()
    {
        return $this->date_started;
    }

    /**
     * @param mixed $date_started
     */
    public function setDateStarted($date_started)
    {
        $this->date_started = $date_started;
    }

    /**
     * @return mixed
     */
    public function getDateFailed()
    {
        return $this->date_failed;
    }

    /**
     * @param mixed $date_failed
     */
    public function setDateFailed($date_failed)
    {
        $this->date_failed = $date_failed;
    }

    /**
     * @return mixed
     */
    public function getDateCompleted()
    {
        return $this->date_completed;
    }

    /**
     * @param mixed $date_completed
     */
    public function setDateCompleted($date_completed)
    {
        $this->date_completed = $date_completed;
    }

    /**
     * @return mixed
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }

    /**
     * @param mixed $date_added
     */
    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

    /**
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * @param mixed $date_updated
     */
    public function setDateUpdated($date_updated)
    {
        $this->date_updated = $date_updated;
    }

    /**
     * @return mixed
     */
    public function getDateRemoved()
    {
        return $this->date_removed;
    }

    /**
     * @param mixed $date_removed
     */
    public function setDateRemoved($date_removed)
    {
        $this->date_removed = $date_removed;
    }


}