<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="critiques")
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
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="obtenue", type="string", length=15, nullable=false)
     */
    private $passed;

    /**
     * @var string
     *
     * @ORM\Column(name="interet", type="string", length=20, nullable=false)
     */
    private $interest;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Uvweb\UvBundle\Entity\Uv")
     * @ORM\Column(name="id_uv")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uv;

    /**
     * @var boolean
     *
     * @ORM\Column(name="note", type="boolean", nullable=true)
     */
    private $globalRate;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=10000, nullable=false)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="facile", type="string", length=30, nullable=false)
     */
    private $workAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="utilite", type="string", length=20, nullable=false)
     */
    private $utility;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="prof", type="string", length=20, nullable=false)
     */
    private $pedagogy;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre", type="string", length=3, nullable=false)
     */
    private $semester;

    /**
     * @var boolean
     *
     * @ORM\Column(name="modere", type="boolean", nullable=false)
     */
    private $moderated;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_auteur", type="smallint", nullable=false)
     */
    private $idAuteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_moderateur", type="smallint", nullable=true)
     */
    private $idModerateur;



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
     * Set passed
     *
     * @param string $passed
     * @return Comment
     */
    public function setPassed($passed)
    {
        $this->passed = $passed;
    
        return $this;
    }

    /**
     * Get passed
     *
     * @return string 
     */
    public function getPassed()
    {
        return $this->passed;
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
     * Set idUv
     *
     * @param integer $idUv
     * @return Comment
     */
    public function setIdUv($idUv)
    {
        $this->idUv = $idUv;
    
        return $this;
    }

    /**
     * Get idUv
     *
     * @return integer 
     */
    public function getIdUv()
    {
        return $this->idUv;
    }

    /**
     * Set globalRate
     *
     * @param boolean $globalRate
     * @return Comment
     */
    public function setGlobalRate($globalRate)
    {
        $this->globalRate = $globalRate;
    
        return $this;
    }

    /**
     * Get globalRate
     *
     * @return boolean 
     */
    public function getGlobalRate()
    {
        return $this->globalRate;
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
        return html_entity_decode($this->comment);
    }

    /**
     * Set workAmount
     *
     * @param string $workAmount
     * @return Comment
     */
    public function setWorkAmount($workAmount)
    {
        $this->workAmount = $workAmount;
    
        return $this;
    }

    /**
     * Get workAmount
     *
     * @return string 
     */
    public function getWorkAmount()
    {
        return $this->workAmount;
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
     * Set moderated
     *
     * @param boolean $moderated
     * @return Comment
     */
    public function setModerated($moderated)
    {
        $this->moderated = $moderated;
    
        return $this;
    }

    /**
     * Get moderated
     *
     * @return boolean 
     */
    public function getModerated()
    {
        return $this->moderated;
    }

    /**
     * Set idAuteur
     *
     * @param integer $idAuteur
     * @return Comment
     */
    public function setIdAuteur($idAuteur)
    {
        $this->idAuteur = $idAuteur;
    
        return $this;
    }

    /**
     * Get idAuteur
     *
     * @return integer 
     */
    public function getIdAuteur()
    {
        return $this->idAuteur;
    }

    /**
     * Set idModerateur
     *
     * @param integer $idModerateur
     * @return Comment
     */
    public function setIdModerateur($idModerateur)
    {
        $this->idModerateur = $idModerateur;
    
        return $this;
    }

    /**
     * Get idModerateur
     *
     * @return integer 
     */
    public function getIdModerateur()
    {
        return $this->idModerateur;
    }

    /**
     * Set uv
     *
     * @param \Uvweb\UvBundle\Entity\Uv $uv
     * @return Comment
     */
    public function setUv(\Uvweb\UvBundle\Entity\Uv $uv)
    {
        $this->uv = $uv;
    
        return $this;
    }

    /**
     * Get uv
     *
     * @return \Uvweb\UvBundle\Entity\Uv 
     */
    public function getUv()
    {
        return $this->uv;
    }
}