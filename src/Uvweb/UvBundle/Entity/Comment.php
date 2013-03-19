<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\CommentRepository")
 */
class Comment
{
    public function __construct()
    {
      $this->date = new \Datetime();
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
     * @ORM\Column(name="author", type="string", length=50)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="semester", type="string", length=3)
     */
    private $semester;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="globalrate", type="integer")
     */
    private $globalrate;

    /**
     * @var string
     *
     * @ORM\Column(name="utility", type="string", length=50)
     */
    private $utility;

    /**
     * @var string
     *
     * @ORM\Column(name="workamount", type="string", length=50)
     */
    private $workamount;

    /**
     * @var string
     *
     * @ORM\Column(name="interest", type="string", length=50)
     */
    private $interest;

    /**
     * @var string
     *
     * @ORM\Column(name="pedagogy", type="string", length=50)
     */
    private $pedagogy;


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
     * Set author
     *
     * @param string $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set semester
     *
     * @param string $semester
     * @return Comment
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
     * Set date
     *
     * @param \DateTime $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set globalrate
     *
     * @param integer $globalrate
     * @return Comment
     */
    public function setGlobalrate($globalrate)
    {
        $this->globalrate = $globalrate;
    
        return $this;
    }

    /**
     * Get globalrate
     *
     * @return integer 
     */
    public function getGlobalrate()
    {
        return $this->globalrate;
    }

    /**
     * Set utility
     *
     * @param string $utility
     * @return Comment
     */
    public function setUtility($utility)
    {
        $this->utility = $utility;
    
        return $this;
    }

    /**
     * Get utility
     *
     * @return string 
     */
    public function getUtility()
    {
        return $this->utility;
    }

    /**
     * Set workamount
     *
     * @param string $workamount
     * @return Comment
     */
    public function setWorkamount($workamount)
    {
        $this->workamount = $workamount;
    
        return $this;
    }

    /**
     * Get workamount
     *
     * @return string 
     */
    public function getWorkamount()
    {
        return $this->workamount;
    }

    /**
     * Set interest
     *
     * @param string $interest
     * @return Comment
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
    
        return $this;
    }

    /**
     * Get interest
     *
     * @return string 
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * Set pedagogy
     *
     * @param string $pedagogy
     * @return Comment
     */
    public function setPedagogy($pedagogy)
    {
        $this->pedagogy = $pedagogy;
    
        return $this;
    }

    /**
     * Get pedagogy
     *
     * @return string 
     */
    public function getPedagogy()
    {
        return $this->pedagogy;
    }
}
