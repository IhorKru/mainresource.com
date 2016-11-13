<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferDetails
 *
 * @ORM\Table(name="08_OfferDetails", uniqueConstraints={@ORM\UniqueConstraint(name="offer_details_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferDetailsRepository")
 */
class OfferDetails
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
     * @ORM\Column(name="emailaddress", type="string", length=100, nullable=true)
     */
    private $emailaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="offername", type="string", length=255, nullable=true)
     */
    private $offername;
    
    /**
     * @var string
     *
     * @ORM\Column(name="offerdetails", type="text", nullable=true)
     */
    private $offerdetails;

    /**
     * @var int
     *
     * @ORM\Column(name="partnerid", type="smallint")
     */
    private $partnerid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=true)
     */
    private $datecreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodified", type="datetime", nullable=true)
     */
    private $datemodified;


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
     * Set offername
     *
     * @param string $offername
     *
     * @return OfferDetails
     */
    public function setOffername($offername)
    {
        $this->offername = $offername;

        return $this;
    }

    /**
     * Get offername
     *
     * @return string
     */
    public function getOffername()
    {
        return $this->offername;
    }

    /**
     * Set offerdetails
     *
     * @param string $offerdetails
     *
     * @return OfferDetails
     */
    public function setOfferdetails($offerdetails)
    {
        $this->offerdetails = $offerdetails;

        return $this;
    }

    /**
     * Get offerdetails
     *
     * @return string
     */
    public function getOfferdetails()
    {
        return $this->offerdetails;
    }

    /**
     * Set partnerid
     *
     * @param integer $partnerid
     *
     * @return OfferDetails
     */
    public function setPartnerid($partnerid)
    {
        $this->partnerid = $partnerid;

        return $this;
    }

    /**
     * Get partnerid
     *
     * @return int
     */
    public function getPartnerid()
    {
        return $this->partnerid;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return OfferDetails
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
     * Set datemodified
     *
     * @param \DateTime $datemodified
     *
     * @return OfferDetails
     */
    public function setDatemodified($datemodified)
    {
        $this->datemodified = $datemodified;

        return $this;
    }

    /**
     * Get datemodified
     *
     * @return \DateTime
     */
    public function getDatemodified()
    {
        return $this->datemodified;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return OfferDetails
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set emailaddress
     *
     * @param string $emailaddress
     *
     * @return OfferDetails
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;

        return $this;
    }

    /**
     * Get emailaddress
     *
     * @return string
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }
}
