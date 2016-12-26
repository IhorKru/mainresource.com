<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaignInputDetails
 *
 * @ORM\Table(name="09_CampaignInputDetails", uniqueConstraints={@ORM\UniqueConstraint(name="camp_input_details_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CampaignInputDetailsRepository")
 */
class CampaignInputDetails
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
     * @ORM\Column(name="partnername", type="string", length=255)
     */
    private $partnername;

    /**
     * @var string
     *
     * @ORM\Column(name="resourcename", type="string", length=255)
     */
    private $resourcename;

    /**
     * @var string
     *
     * @ORM\Column(name="templatename", type="string", length=255)
     */
    private $templatename;

    /**
     * @var int
     *
     * @ORM\Column(name="numemails", type="integer")
     */
    private $numemails;
    
    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=255)
     */
    private $timezone;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetosend", type="datetime", length=255)
     */
    private $datetosend;
    
    /**
     * @var int
     *
     * @ORM\Column(name="delay", type="smallint")
     */
    private $delay;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set partnername
     *
     * @param string $partnername
     *
     * @return CampaignInputDetails
     */
    public function setPartnername($partnername)
    {
        $this->partnername = $partnername;

        return $this;
    }

    /**
     * Get partnername
     *
     * @return string
     */
    public function getPartnername()
    {
        return $this->partnername;
    }

    /**
     * Set numemails
     *
     * @param integer $numemails
     *
     * @return CampaignInputDetails
     */
    public function setNumemails($numemails)
    {
        $this->numemails = $numemails;

        return $this;
    }

    /**
     * Get numemails
     *
     * @return int
     */
    public function getNumemails()
    {
        return $this->numemails;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return CampaignInputDetails
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set resourcename
     *
     * @param string $resourcename
     *
     * @return CampaignInputDetails
     */
    public function setResourcename($resourcename)
    {
        $this->resourcename = $resourcename;

        return $this;
    }

    /**
     * Get resourcename
     *
     * @return string
     */
    public function getResourcename()
    {
        return $this->resourcename;
    }

    /**
     * Set templatename
     *
     * @param string $templatename
     *
     * @return CampaignInputDetails
     */
    public function setTemplatename($templatename)
    {
        $this->templatename = $templatename;

        return $this;
    }

    /**
     * Get templatename
     *
     * @return string
     */
    public function getTemplatename()
    {
        return $this->templatename;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return CampaignInputDetails
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set datetosend
     *
     * @param \DateTime $datetosend
     *
     * @return CampaignInputDetails
     */
    public function setDatetosend($datetosend)
    {
        $this->datetosend = $datetosend;

        return $this;
    }

    /**
     * Get datetosend
     *
     * @return \DateTime
     */
    public function getDatetosend()
    {
        return $this->datetosend;
    }

    /**
     * Set delay
     *
     * @param integer $delay
     *
     * @return CampaignInputDetails
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * Get delay
     *
     * @return integer
     */
    public function getDelay()
    {
        return $this->delay;
    }
}
