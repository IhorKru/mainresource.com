<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubscriberADKCampaign
 *
 * @ORM\Table(name="06_SubscriberADKDetails", uniqueConstraints={@ORM\UniqueConstraint(name="subsc_adk_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriberADKCampaignRepository")
 */
class SubscriberADKCampaign
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * 
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="requestid", type="string", length=1000)
     */
    private $requestid;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mailingid", type="string", length=1000)
     */
    private $mailingid;
    
    /**
     * @var int
     *
     * @ORM\Column(name="mailingtypeid", type="smallint")
     */
    private $mailingtypeid;
    
    /**
     * @var int
     *
     * @ORM\Column(name="scheduleeventtypeid", type="smallint")
     */
    private $scheduleeventtypeid;
    
        
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="scheduledate", type="datetime", nullable=true)
     */
    private $scheduledate;
    
    /**
     * @var string
     * @ORM\Column(name="recipient", type="string", length=100)
     *
     */
    private $recipient;

    /**
     * @var int
     *
     * @ORM\Column(name="list", type="smallint")
     */
    private $list;
    
    /**
     * @var int
     *
     * @ORM\Column(name="cid", type="smallint")
     */
    private $cid;
    
    /**
     * @var int
     *
     * @ORM\Column(name="campaignrank", type="smallint")
     */
    private $campaignrank;
    
    /**
     * @var int
     *
     * @ORM\Column(name="categoryid", type="smallint", nullable=true)
     *
     */
    private $categoryid;
    
    /**
     * @var int
     *
     * @ORM\Column(name="templateid", type="smallint", nullable=true)
     */
    private $templateid;
    
    /**
     * @var string
     *
     * @ORM\Column(name="from_field", type="string", length=1000)
     */
    private $from_field;
    
    /**
     * @var string
     *
     * @ORM\Column(name="friendlyfrom", type="string", length=1000)
     */
    private $friendlyfrom;
    
    /**
     * @var int
     *
     * @ORM\Column(name="subjectid", type="smallint")
     */
    private $subjectid;
    
    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=1000)
     */
    private $subject;
    
    /**
     * @var int
     *
     * @ORM\Column(name="creativeid", type="smallint")
     */
    private $creativeid;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;
    
    /**
     * @var string
     *
     * @ORM\Column(name="clickurl", type="string", length=1000, nullable=true)
     */
    private $clickurl;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="textbody", type="text")
     */
    private $textbody;

    /**
     * @var string
     *
     * @ORM\Column(name="finalemail", type="text")
     */
    private $finalemail;

    /**
     * @var int
     *
     * @ORM\Column(name="htmlcreativelength", type="smallint")
     */
    private $htmlcreativelength;
    
    /**
     * @var int
     *
     * @ORM\Column(name="textcreativelength", type="smallint")
     */
    private $textcreativelength;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=true)
     */
    private $datecreated;

    /**
     * @var int
     *
     * @ORM\Column(name="batchnum", type="smallint")
     */
    private $batchnum;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return SubscriberADKCampaign
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set requestid
     *
     * @param string $requestid
     *
     * @return SubscriberADKCampaign
     */
    public function setRequestid($requestid)
    {
        $this->requestid = $requestid;

        return $this;
    }

    /**
     * Get requestid
     *
     * @return string
     */
    public function getRequestid()
    {
        return $this->requestid;
    }

    /**
     * Set mailingid
     *
     * @param string $mailingid
     *
     * @return SubscriberADKCampaign
     */
    public function setMailingid($mailingid)
    {
        $this->mailingid = $mailingid;

        return $this;
    }

    /**
     * Get mailingid
     *
     * @return string
     */
    public function getMailingid()
    {
        return $this->mailingid;
    }

    /**
     * Set mailingtypeid
     *
     * @param integer $mailingtypeid
     *
     * @return SubscriberADKCampaign
     */
    public function setMailingtypeid($mailingtypeid)
    {
        $this->mailingtypeid = $mailingtypeid;

        return $this;
    }

    /**
     * Get mailingtypeid
     *
     * @return integer
     */
    public function getMailingtypeid()
    {
        return $this->mailingtypeid;
    }

    /**
     * Set scheduleeventtypeid
     *
     * @param integer $scheduleeventtypeid
     *
     * @return SubscriberADKCampaign
     */
    public function setScheduleeventtypeid($scheduleeventtypeid)
    {
        $this->scheduleeventtypeid = $scheduleeventtypeid;

        return $this;
    }

    /**
     * Get scheduleeventtypeid
     *
     * @return integer
     */
    public function getScheduleeventtypeid()
    {
        return $this->scheduleeventtypeid;
    }

    /**
     * Set scheduledate
     *
     * @param \DateTime $scheduledate
     *
     * @return SubscriberADKCampaign
     */
    public function setScheduledate($scheduledate)
    {
        $this->scheduledate = (new \DateTime());

        return $this;
    }

    /**
     * Get scheduledate
     *
     * @return \DateTime
     */
    public function getScheduledate()
    {
        return $this->scheduledate;
    }

    /**
     * Set recipient
     *
     * @param string $recipient
     *
     * @return SubscriberADKCampaign
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set list
     *
     * @param integer $list
     *
     * @return SubscriberADKCampaign
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return integer
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set cid
     *
     * @param integer $cid
     *
     * @return SubscriberADKCampaign
     */
    public function setCid($cid)
    {
        $this->cid = $cid;

        return $this;
    }

    /**
     * Get cid
     *
     * @return integer
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Set campaignrank
     *
     * @param integer $campaignrank
     *
     * @return SubscriberADKCampaign
     */
    public function setCampaignrank($campaignrank)
    {
        $this->campaignrank = $campaignrank;

        return $this;
    }

    /**
     * Get campaignrank
     *
     * @return integer
     */
    public function getCampaignrank()
    {
        return $this->campaignrank;
    }

    /**
     * Set categoryid
     *
     * @param integer $categoryid
     *
     * @return SubscriberADKCampaign
     */
    public function setCategoryid($categoryid)
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    /**
     * Get categoryid
     *
     * @return integer
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * Set templateid
     *
     * @param integer $templateid
     *
     * @return SubscriberADKCampaign
     */
    public function setTemplateid($templateid)
    {
        $this->templateid = $templateid;

        return $this;
    }

    /**
     * Get templateid
     *
     * @return integer
     */
    public function getTemplateid()
    {
        return $this->templateid;
    }

    /**
     * Set fromField
     *
     * @param string $fromField
     *
     * @return SubscriberADKCampaign
     */
    public function setFromField($fromField)
    {
        $this->from_field = $fromField;

        return $this;
    }

    /**
     * Get fromField
     *
     * @return string
     */
    public function getFromField()
    {
        return $this->from_field;
    }

    /**
     * Set friendlyfrom
     *
     * @param string $friendlyfrom
     *
     * @return SubscriberADKCampaign
     */
    public function setFriendlyfrom($friendlyfrom)
    {
        $this->friendlyfrom = $friendlyfrom;

        return $this;
    }

    /**
     * Get friendlyfrom
     *
     * @return string
     */
    public function getFriendlyfrom()
    {
        return $this->friendlyfrom;
    }

    /**
     * Set subjectid
     *
     * @param integer $subjectid
     *
     * @return SubscriberADKCampaign
     */
    public function setSubjectid($subjectid)
    {
        $this->subjectid = $subjectid;

        return $this;
    }

    /**
     * Get subjectid
     *
     * @return integer
     */
    public function getSubjectid()
    {
        return $this->subjectid;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return SubscriberADKCampaign
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set creativeid
     *
     * @param integer $creativeid
     *
     * @return SubscriberADKCampaign
     */
    public function setCreativeid($creativeid)
    {
        $this->creativeid = $creativeid;

        return $this;
    }

    /**
     * Get creativeid
     *
     * @return integer
     */
    public function getCreativeid()
    {
        return $this->creativeid;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return SubscriberADKCampaign
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set clickurl
     *
     * @param string $clickurl
     *
     * @return SubscriberADKCampaign
     */
    public function setClickurl($clickurl)
    {
        $this->clickurl = $clickurl;

        return $this;
    }

    /**
     * Get clickurl
     *
     * @return string
     */
    public function getClickurl()
    {
        return $this->clickurl;
    }

    /**
     * Set textbody
     *
     * @param string $textbody
     *
     * @return SubscriberADKCampaign
     */
    public function setTextbody($textbody)
    {
        $this->textbody = $textbody;

        return $this;
    }

    /**
     * Get textbody
     *
     * @return string
     */
    public function getTextbody()
    {
        return $this->textbody;
    }

    /**
     * Set finalemail
     *
     * @param string $finalemail
     *
     * @return SubscriberADKCampaign
     */
    public function setFinalemail($finalemail)
    {
        $this->finalemail = $finalemail;

        return $this;
    }

    /**
     * Get finalemail
     *
     * @return string
     */
    public function getFinalemail()
    {
        return $this->finalemail;
    }

    /**
     * Set htmlcreativelength
     *
     * @param integer $htmlcreativelength
     *
     * @return SubscriberADKCampaign
     */
    public function setHtmlcreativelength($htmlcreativelength)
    {
        $this->htmlcreativelength = $htmlcreativelength;

        return $this;
    }

    /**
     * Get htmlcreativelength
     *
     * @return integer
     */
    public function getHtmlcreativelength()
    {
        return $this->htmlcreativelength;
    }

    /**
     * Set textcreativelength
     *
     * @param integer $textcreativelength
     *
     * @return SubscriberADKCampaign
     */
    public function setTextcreativelength($textcreativelength)
    {
        $this->textcreativelength = $textcreativelength;

        return $this;
    }

    /**
     * Get textcreativelength
     *
     * @return integer
     */
    public function getTextcreativelength()
    {
        return $this->textcreativelength;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return SubscriberADKCampaign
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set batchnum
     *
     * @param integer $batchnum
     *
     * @return SubscriberADKCampaign
     */
    public function setBatchnum($batchnum)
    {
        $this->batchnum = $batchnum;

        return $this;
    }

    /**
     * Get batchnum
     *
     * @return integer
     */
    public function getBatchnum()
    {
        return $this->batchnum;
    }
}
