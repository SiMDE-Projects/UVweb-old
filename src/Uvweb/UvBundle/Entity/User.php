<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="utilisateurs")
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\UserRepository")
 */

class User implements UserInterface, \Serializable
{
    public function __construct()
    {
        $this->isadmin = 0;
        $this->displayAvatar = false;
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     */
    private $salt;

    /**
     */
    private $isActive;

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->identity;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        if($this->getIsAdmin())
            return array('ROLE_ADMIN');
        else
            return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

   /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * @ORM\Column(name="login", type="string", length=30, nullable=false, unique=true)
     */
    private $login;

    /**
     * This is the password used for the api (mobile apps)
     * @var string
     *
     * @ORM\Column(name="app_password", type="string", length=128, nullable=true)
     */
    private $password;

    /**
     * This is the password of UVweb 1 for people who had an account
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=32, nullable=true)
     */
    private $uvwebOriginalPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sem_entree", type="string", length=10, nullable=false)
     */
    private $firstSemester;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_entree", type="string", length=4, nullable=false)
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
     * @ORM\Column(name="filiere", type="string", length=10, nullable=true)
     */
    private $filiere;

    /**
     * @var boolean
     *
     * @ORM\Column(name="message", type="boolean", nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="identite", type="string", length=50, nullable=false, unique=false)
     */
    private $identity;

    private $avatar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="avatar_visible", type="boolean", nullable=false)
     */
    private $displayAvatar;

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
        $split = split("@", $this->email);
        return $split[0];
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

    //Required to use Symfony2 security, so that we can store entire user into session
    public function __toString()
    {
        return $this->identity;
    }

    /**
     * Set displayAvatar
     *
     * @param boolean $displayAvatar
     * @return User
     */
    public function setDisplayAvatar($displayAvatar)
    {
        $this->displayAvatar = $displayAvatar;

        return $this;
    }

    /**
     * Get displayAvatar
     *
     * @return boolean 
     */
    public function getDisplayAvatar()
    {
        return $this->displayAvatar;
    }

    /**
     * Set uvwebOriginalPassword
     *
     * @param string $uvwebOriginalPassword
     * @return User
     */
    public function setUvwebOriginalPassword($uvwebOriginalPassword)
    {
        $this->uvwebOriginalPassword = $uvwebOriginalPassword;

        return $this;
    }

    /**
     * Get uvwebOriginalPassword
     *
     * @return string 
     */
    public function getUvwebOriginalPassword()
    {
        return $this->uvwebOriginalPassword;
    }
}
