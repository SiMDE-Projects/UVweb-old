<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="utilisateurs")
 * @ORM\Entity
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


}
