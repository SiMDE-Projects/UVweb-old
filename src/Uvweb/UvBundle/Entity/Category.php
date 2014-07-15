<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\CategoryRepository")
 */
class Category
{
    public function __construct()
    {
        $this->uvs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=6, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=30, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=30, nullable=true)
     */
    private $url;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Uvweb\UvBundle\Entity\Uv", inversedBy="categories", cascade={"persist"})
     * @ORM\JoinTable(name="classement",
     * joinColumns={@ORM\JoinColumn(name="id_categorie", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_uv", referencedColumnName="id")})
     */
    private $uvs;

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
     * Set url
     *
     * @param string $url
     * @return Category
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add uvs
     *
     * @param \Uvweb\UvBundle\Entity\Uv $uvs
     * @return Category
     */
    public function addUv(\Uvweb\UvBundle\Entity\Uv $uv)
    {
        $this->uvs[] = $uv;

        return $this;
    }

    /**
     * Remove uvs
     *
     * @param \Uvweb\UvBundle\Entity\Uv $uvs
     */
    public function removeUv(\Uvweb\UvBundle\Entity\Uv $uv)
    {
        $this->uvs->removeElement($uv);
    }

    /**
     * Get uvs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUvs()
    {
        return $this->uvs;
    }
}
