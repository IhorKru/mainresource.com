<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailTemplateDetails
 *
 * @ORM\Table(name="10_EmailTemplateDetails", uniqueConstraints={@ORM\UniqueConstraint(name="email_template_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmailTemplateDetailsRepository")
 */
class EmailTemplateDetails
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
     * @var int
     *
     * @ORM\Column(name="resourceid", type="smallint")
     */
    private $resourceid;

    /**
     * @var string
     *
     * @ORM\Column(name="templatename", type="string", length=255)
     */
    private $templatename;

    /**
     * @var string
     *
     * @ORM\Column(name="html", type="text")
     */
    private $html;

    /**
     * @var string
     *
     * @ORM\Column(name="sequence", type="string", length=20)
     */
    private $sequence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime")
     */
    private $datecreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodified", type="datetime")
     */
    private $datemodified;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return EmailTemplateDetails
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set resourceid
     *
     * @param integer $resourceid
     *
     * @return EmailTemplateDetails
     */
    public function setResourceid($resourceid)
    {
        $this->resourceid = $resourceid;

        return $this;
    }

    /**
     * Get resourceid
     *
     * @return int
     */
    public function getResourceid()
    {
        return $this->resourceid;
    }

    /**
     * Set templatename
     *
     * @param string $templatename
     *
     * @return EmailTemplateDetails
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
     * Set html
     *
     * @param string $html
     *
     * @return EmailTemplateDetails
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set sequence
     *
     * @param string $sequence
     *
     * @return EmailTemplateDetails
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get sequence
     *
     * @return string
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return EmailTemplateDetails
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
     * @return EmailTemplateDetails
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

}
