<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * University
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\UniversityRepository")
 */
class University
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="locationCity", type="string", length=255)
     */
    private $locationCity;

    /**
     * @var string
     *
     * @ORM\Column(name="locationCountry", type="string", length=255)
     */
    private $locationCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="Uvweb\UvBundle\Entity\Uv", mappedBy="uni")
     */
    private $classes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", options={"default": false})
     */
    private $approved;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Uvweb\UvBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $addedBy;


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
     * Set name
     *
     * @param string $name
     * @return University
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set locationCity
     *
     * @param string $locationCity
     * @return University
     */
    public function setLocationCity($locationCity)
    {
        $this->locationCity = $locationCity;

        return $this;
    }

    /**
     * Get locationCity
     *
     * @return string 
     */
    public function getLocationCity()
    {
        return $this->locationCity;
    }

    /**
     * Set locationCountry
     *
     * @param string $locationCountry
     * @return University
     */
    public function setLocationCountry($locationCountry)
    {
        $this->locationCountry = $locationCountry;

        return $this;
    }

    /**
     * Get locationCountry
     *
     * @return string 
     */
    public function getLocationCountry()
    {
        return $this->locationCountry;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return University
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set approved
     *
     * @param boolean $app
     * @return University
     */
    public function setApproved($app)
    {
        $this->approved = $app;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set approved
     *
     * @param \Uvweb\UvBundle\Entity\User $app
     * @return University
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get addedBy
     *
     * @return \Uvweb\UvBundle\Entity\User 
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }
}
