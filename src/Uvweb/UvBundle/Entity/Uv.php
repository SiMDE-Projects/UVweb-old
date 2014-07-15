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
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(name="name", type="string", length=7)
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
     * @var integer
     *
     * @ORM\Column(name="credits", type="smallint", nullable=true)
     */
    private $credits;

    /**
     * @var integer
     *
     * @ORM\Column(name="courseHours", type="smallint", nullable=true)
     */
    private $courseHours;

    /**
     * @var integer
     *
     * @ORM\Column(name="tdHours", type="smallint", nullable=true)
     */
    private $tdHours;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tp", type="boolean", nullable=true)
     */
    private $tp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="final", type="boolean", nullable=true)
     */
    private $final;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxStudent", type="smallint", nullable=true)
     */
    private $maxStudent;

    /**
     * @var string
     *
     * @ORM\Column(name="semester", type="string", length=2, nullable=true)
     */
    private $semester;

    /**
     * @var string
     *
     * @ORM\Column(name="teacher", type="string", length=60)
     */
    private $teacher;

    /**
     * @ORM\ManyToMany(targetEntity="Uvweb\UvBundle\Entity\Category", mappedBy="uvs", cascade={"persist"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Uvweb\UvBundle\Entity\Comment", mappedBy="uv")
     */
    private $comments;

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
        if(strlen($this->name) < 4)
            return $this->name;
        
        return substr($this->name, 0, -2);
    }

    /**
     * Get number code
     *
     * @return string 
     */
    public function getNumberCode()
    {
        if(strlen($this->name) >= 4)
            return substr($this->name, -2);
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

    /**
     * Set teacher
     *
     * @param string $teacher
     * @return Uv
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return string 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set credits
     *
     * @param integer $credits
     * @return Uv
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return integer 
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set courseHours
     *
     * @param integer $courseHours
     * @return Uv
     */
    public function setCourseHours($courseHours)
    {
        $this->courseHours = $courseHours;

        return $this;
    }

    /**
     * Get courseHours
     *
     * @return integer 
     */
    public function getCourseHours()
    {
        return $this->courseHours;
    }

    /**
     * Set tdHours
     *
     * @param integer $tdHours
     * @return Uv
     */
    public function setTdHours($tdHours)
    {
        $this->tdHours = $tdHours;

        return $this;
    }

    /**
     * Get tdHours
     *
     * @return integer 
     */
    public function getTdHours()
    {
        return $this->tdHours;
    }

    /**
     * Set tpHours
     *
     * @param integer $tpHours
     * @return Uv
     */
    public function setTpHours($tpHours)
    {
        $this->tpHours = $tpHours;

        return $this;
    }

    /**
     * Get tpHours
     *
     * @return integer 
     */
    public function getTpHours()
    {
        return $this->tpHours;
    }

    /**
     * Set final
     *
     * @param boolean $final
     * @return Uv
     */
    public function setFinal($final)
    {
        $this->final = $final;

        return $this;
    }

    /**
     * Get final
     *
     * @return boolean 
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * Set maxStudent
     *
     * @param integer $maxStudent
     * @return Uv
     */
    public function setMaxStudent($maxStudent)
    {
        $this->maxStudent = $maxStudent;

        return $this;
    }

    /**
     * Get maxStudent
     *
     * @return integer 
     */
    public function getMaxStudent()
    {
        return $this->maxStudent;
    }

    /**
     * Add comments
     *
     * @param \Uvweb\UvBundle\Entity\Comment $comments
     * @return Uv
     */
    public function addComment(\Uvweb\UvBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Uvweb\UvBundle\Entity\Comment $comments
     */
    public function removeComment(\Uvweb\UvBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set semester
     *
     * @param string $semester
     * @return Uv
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return string 
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Set tp
     *
     * @param boolean $tp
     * @return Uv
     */
    public function setTp($tp)
    {
        $this->tp = $tp;

        return $this;
    }

    /**
     * Get tp
     *
     * @return boolean 
     */
    public function getTp()
    {
        return $this->tp;
    }
}
