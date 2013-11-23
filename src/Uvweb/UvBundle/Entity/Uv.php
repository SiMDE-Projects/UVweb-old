<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\UvRepository")
 */
class Uv
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @ORM\Column(name="name", type="string", length=4)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

   /**
     * @ORM\ManyToMany(targetEntity="Uvweb\UvBundle\Entity\Category", mappedBy="uvs", cascade={"persist"})
     */
    private $categories;

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
     * @return Uv
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
     * Get letter code
     *
     * @return string 
     */
    public function getLetterCode()
    {
        return substr($this->name, 0, 2);
    }

    /**
     * Get number code
     *
     * @return string 
     */
    public function getNumberCode()
    {
        return substr($this->name, 2, 4);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Uv
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     * @return Uv
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    
        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean 
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Add category
     *
     * @param \Uvweb\UvBundle\Entity\Category $category
     * @return Uv
     */
    public function addCategory(\Uvweb\UvBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Uvweb\UvBundle\Entity\Category $category
     */
    public function removeCategory(\Uvweb\UvBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
