<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="utilisateurs")
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\UserRepository")
 */

class User
{
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
     * @ORM\Column(name="login", type="string", length=30, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=32, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sem_entree", type="string", length=10, nullable=true)
     */
    private $firstSemester;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_entree", type="string", length=4, nullable=true)
     */
    private $firstYear;

    /**
     * @var boolean
     *
     * @ORM\Column(name="admin", type="boolean", nullable=false)
     */
    private $isadmin;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=20, nullable=false)
     */
    private $origin;

    /**
     * @var string
     *
     * @ORM\Column(name="details_origine", type="string", length=50, nullable=true)
     */
    private $originDetails;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last", type="date", nullable=true)
     */
    private $last;

    /**
     * @var integer
     *
     * @ORM\Column(name="connections", type="smallint", nullable=false)
     */
    private $connections;

    /**
     * @var string
     *
     * @ORM\Column(name="branche", type="string", length=3, nullable=false)
     */
    private $branch;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere", type="string", length=10, nullable=false)
     */
    private $filiere;

    /**
     * @var boolean
     *
     * @ORM\Column(name="message", type="boolean", nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="identite", type="string", length=50, nullable=true)
     */
    private $identity;

    private $avatar;



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
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get UTC login
     *
     * @return string 
     */
    public function getUtcLogin()
    {
        return split("@", $this->email)[0];
    }

    /**
     * Set firstSemester
     *
     * @param string $firstSemester
     * @return User
     */
    public function setFirstSemester($firstSemester)
    {
        $this->firstSemester = $firstSemester;
    
        return $this;
    }

    /**
     * Get firstSemester
     *
     * @return string 
     */
    public function getFirstSemester()
    {
        return $this->firstSemester;
    }

    /**
     * Set firstYear
     *
     * @param string $firstYear
     * @return User
     */
    public function setFirstYear($firstYear)
    {
        $this->firstYear = $firstYear;
    
        return $this;
    }

    /**
     * Get firstYear
     *
     * @return string 
     */
    public function getFirstYear()
    {
        return $this->firstYear;
    }

    /**
     * Set isadmin
     *
     * @param boolean $isadmin
     * @return User
     */
    public function setIsadmin($isadmin)
    {
        $this->isadmin = $isadmin;
    
        return $this;
    }

    /**
     * Get isadmin
     *
     * @return boolean 
     */
    public function getIsadmin()
    {
        return $this->isadmin;
    }

    /**
     * Set origin
     *
     * @param string $origin
     * @return User
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    
        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set originDetails
     *
     * @param string $originDetails
     * @return User
     */
    public function setOriginDetails($originDetails)
    {
        $this->originDetails = $originDetails;
    
        return $this;
    }

    /**
     * Get originDetails
     *
     * @return string 
     */
    public function getOriginDetails()
    {
        return $this->originDetails;
    }

    /**
     * Set last
     *
     * @param \DateTime $last
     * @return User
     */
    public function setLast($last)
    {
        $this->last = $last;
    
        return $this;
    }

    /**
     * Get last
     *
     * @return \DateTime 
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * Set connections
     *
     * @param integer $connections
     * @return User
     */
    public function setConnections($connections)
    {
        $this->connections = $connections;
    
        return $this;
    }

    /**
     * Get connections
     *
     * @return integer 
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Set branch
     *
     * @param string $branch
     * @return User
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
    
        return $this;
    }

    /**
     * Get branch
     *
     * @return string 
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Set filiere
     *
     * @param string $filiere
     * @return User
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;
    
        return $this;
    }

    /**
     * Get filiere
     *
     * @return string 
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set message
     *
     * @param boolean $message
     * @return User
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return boolean 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set identity
     *
     * @param string $identity
     * @return User
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    
        return $this;
    }

    /**
     * Get identity
     *
     * @return string 
     */
    public function getIdentity()
    {
        return $this->identity;
    }
}