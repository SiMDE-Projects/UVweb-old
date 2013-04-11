<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poll
 *
 * @ORM\Table(name="enquetes")
 * @ORM\Entity(repositoryClass="Uvweb\UvBundle\Entity\PollRepository")
 */
class Poll
{
    /**
     * @var string
     *
     * @ORM\Column(name="uv", type="string", length=4, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uvName;

    /**
     * @ORM\ManyToOne(targetEntity="Uvweb\UvBundle\Entity\Uv")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uv;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $semestre;

    /**
     * @var integer
     *
     * @ORM\Column(name="inscrits", type="smallint", nullable=true)
     */
    private $inscrits;

    /**
     * @var integer
     *
     * @ORM\Column(name="reponses", type="smallint", nullable=true)
     */
    private $reponses;

    /**
     * @var float
     *
     * @ORM\Column(name="p_reponses", type="float", nullable=true)
     */
    private $pReponses;

    /**
     * @var float
     *
     * @ORM\Column(name="reussite", type="float", nullable=true)
     */
    private $reussite;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_0", type="float", nullable=true)
     */
    private $q10;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_1", type="float", nullable=true)
     */
    private $q11;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_2", type="float", nullable=true)
     */
    private $q12;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_3", type="float", nullable=true)
     */
    private $q13;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_4", type="float", nullable=true)
     */
    private $q14;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_0", type="float", nullable=true)
     */
    private $q20;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_1", type="float", nullable=true)
     */
    private $q21;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_2", type="float", nullable=true)
     */
    private $q22;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_3", type="float", nullable=true)
     */
    private $q23;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_4", type="float", nullable=true)
     */
    private $q24;

    /**
     * @var float
     *
     * @ORM\Column(name="q3_0", type="float", nullable=true)
     */
    private $q30;

    /**
     * @var float
     *
     * @ORM\Column(name="q3_1", type="float", nullable=true)
     */
    private $q31;

    /**
     * @var float
     *
     * @ORM\Column(name="q3_2", type="float", nullable=true)
     */
    private $q32;

    /**
     * @var float
     *
     * @ORM\Column(name="q3_3", type="float", nullable=true)
     */
    private $q33;

    /**
     * @var float
     *
     * @ORM\Column(name="q3_4", type="float", nullable=true)
     */
    private $q34;

    /**
     * @var float
     *
     * @ORM\Column(name="q4_0", type="float", nullable=true)
     */
    private $q40;

    /**
     * @var float
     *
     * @ORM\Column(name="q4_1", type="float", nullable=true)
     */
    private $q41;

    /**
     * @var float
     *
     * @ORM\Column(name="q4_2", type="float", nullable=true)
     */
    private $q42;

    /**
     * @var float
     *
     * @ORM\Column(name="q4_3", type="float", nullable=true)
     */
    private $q43;

    /**
     * @var float
     *
     * @ORM\Column(name="q4_4", type="float", nullable=true)
     */
    private $q44;

    /**
     * @var float
     *
     * @ORM\Column(name="q5_0", type="float", nullable=true)
     */
    private $q50;

    /**
     * @var float
     *
     * @ORM\Column(name="q5_1", type="float", nullable=true)
     */
    private $q51;

    /**
     * @var float
     *
     * @ORM\Column(name="q5_2", type="float", nullable=true)
     */
    private $q52;

    /**
     * @var float
     *
     * @ORM\Column(name="q5_3", type="float", nullable=true)
     */
    private $q53;

    /**
     * @var float
     *
     * @ORM\Column(name="q5_4", type="float", nullable=true)
     */
    private $q54;

    /**
     * @var float
     *
     * @ORM\Column(name="q6_0", type="float", nullable=true)
     */
    private $q60;

    /**
     * @var float
     *
     * @ORM\Column(name="q6_1", type="float", nullable=true)
     */
    private $q61;

    /**
     * @var float
     *
     * @ORM\Column(name="q6_2", type="float", nullable=true)
     */
    private $q62;

    /**
     * @var float
     *
     * @ORM\Column(name="q6_3", type="float", nullable=true)
     */
    private $q63;

    /**
     * @var float
     *
     * @ORM\Column(name="q6_4", type="float", nullable=true)
     */
    private $q64;

    /**
     * @var float
     *
     * @ORM\Column(name="q7_0", type="float", nullable=true)
     */
    private $q70;

    /**
     * @var float
     *
     * @ORM\Column(name="q7_1", type="float", nullable=true)
     */
    private $q71;

    /**
     * @var float
     *
     * @ORM\Column(name="q7_2", type="float", nullable=true)
     */
    private $q72;

    /**
     * @var float
     *
     * @ORM\Column(name="q7_3", type="float", nullable=true)
     */
    private $q73;

    /**
     * @var float
     *
     * @ORM\Column(name="q7_4", type="float", nullable=true)
     */
    private $q74;

    /**
     * @var float
     *
     * @ORM\Column(name="q8_0", type="float", nullable=true)
     */
    private $q80;

    /**
     * @var float
     *
     * @ORM\Column(name="q8_1", type="float", nullable=true)
     */
    private $q81;

    /**
     * @var float
     *
     * @ORM\Column(name="q8_2", type="float", nullable=true)
     */
    private $q82;

    /**
     * @var float
     *
     * @ORM\Column(name="q8_3", type="float", nullable=true)
     */
    private $q83;

    /**
     * @var float
     *
     * @ORM\Column(name="q8_4", type="float", nullable=true)
     */
    private $q84;

    /**
     * @var float
     *
     * @ORM\Column(name="q9_0", type="float", nullable=true)
     */
    private $q90;

    /**
     * @var float
     *
     * @ORM\Column(name="q9_1", type="float", nullable=true)
     */
    private $q91;

    /**
     * @var float
     *
     * @ORM\Column(name="q9_2", type="float", nullable=true)
     */
    private $q92;

    /**
     * @var float
     *
     * @ORM\Column(name="q9_3", type="float", nullable=true)
     */
    private $q93;

    /**
     * @var float
     *
     * @ORM\Column(name="q9_4", type="float", nullable=true)
     */
    private $q94;

    /**
     * Set semestre
     *
     * @param string $semestre
     * @return Poll
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    
        return $this;
    }

    /**
     * Get semestre
     *
     * @return string 
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set inscrits
     *
     * @param integer $inscrits
     * @return Poll
     */
    public function setInscrits($inscrits)
    {
        $this->inscrits = $inscrits;
    
        return $this;
    }

    /**
     * Get inscrits
     *
     * @return integer 
     */
    public function getInscrits()
    {
        return $this->inscrits;
    }

    /**
     * Set reponses
     *
     * @param integer $reponses
     * @return Poll
     */
    public function setReponses($reponses)
    {
        $this->reponses = $reponses;
    
        return $this;
    }

    /**
     * Get reponses
     *
     * @return integer 
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Set pReponses
     *
     * @param float $pReponses
     * @return Poll
     */
    public function setPReponses($pReponses)
    {
        $this->pReponses = $pReponses;
    
        return $this;
    }

    /**
     * Get pReponses
     *
     * @return float 
     */
    public function getPReponses()
    {
        return $this->pReponses;
    }

    /**
     * Set reussite
     *
     * @param float $reussite
     * @return Poll
     */
    public function setReussite($reussite)
    {
        $this->reussite = $reussite;
    
        return $this;
    }

    /**
     * Get reussite
     *
     * @return float 
     */
    public function getReussite()
    {
        return $this->reussite;
    }

    /**
     * Set q10
     *
     * @param float $q10
     * @return Poll
     */
    public function setQ10($q10)
    {
        $this->q10 = $q10;
    
        return $this;
    }

    /**
     * Get q10
     *
     * @return float 
     */
    public function getQ10()
    {
        return $this->q10;
    }

    /**
     * Set q11
     *
     * @param float $q11
     * @return Poll
     */
    public function setQ11($q11)
    {
        $this->q11 = $q11;
    
        return $this;
    }

    /**
     * Get q11
     *
     * @return float 
     */
    public function getQ11()
    {
        return $this->q11;
    }

    /**
     * Set q12
     *
     * @param float $q12
     * @return Poll
     */
    public function setQ12($q12)
    {
        $this->q12 = $q12;
    
        return $this;
    }

    /**
     * Get q12
     *
     * @return float 
     */
    public function getQ12()
    {
        return $this->q12;
    }

    /**
     * Set q13
     *
     * @param float $q13
     * @return Poll
     */
    public function setQ13($q13)
    {
        $this->q13 = $q13;
    
        return $this;
    }

    /**
     * Get q13
     *
     * @return float 
     */
    public function getQ13()
    {
        return $this->q13;
    }

    /**
     * Set q14
     *
     * @param float $q14
     * @return Poll
     */
    public function setQ14($q14)
    {
        $this->q14 = $q14;
    
        return $this;
    }

    /**
     * Get q14
     *
     * @return float 
     */
    public function getQ14()
    {
        return $this->q14;
    }

    /**
     * Set q20
     *
     * @param float $q20
     * @return Poll
     */
    public function setQ20($q20)
    {
        $this->q20 = $q20;
    
        return $this;
    }

    /**
     * Get q20
     *
     * @return float 
     */
    public function getQ20()
    {
        return $this->q20;
    }

    /**
     * Set q21
     *
     * @param float $q21
     * @return Poll
     */
    public function setQ21($q21)
    {
        $this->q21 = $q21;
    
        return $this;
    }

    /**
     * Get q21
     *
     * @return float 
     */
    public function getQ21()
    {
        return $this->q21;
    }

    /**
     * Set q22
     *
     * @param float $q22
     * @return Poll
     */
    public function setQ22($q22)
    {
        $this->q22 = $q22;
    
        return $this;
    }

    /**
     * Get q22
     *
     * @return float 
     */
    public function getQ22()
    {
        return $this->q22;
    }

    /**
     * Set q23
     *
     * @param float $q23
     * @return Poll
     */
    public function setQ23($q23)
    {
        $this->q23 = $q23;
    
        return $this;
    }

    /**
     * Get q23
     *
     * @return float 
     */
    public function getQ23()
    {
        return $this->q23;
    }

    /**
     * Set q24
     *
     * @param float $q24
     * @return Poll
     */
    public function setQ24($q24)
    {
        $this->q24 = $q24;
    
        return $this;
    }

    /**
     * Get q24
     *
     * @return float 
     */
    public function getQ24()
    {
        return $this->q24;
    }

    /**
     * Set q30
     *
     * @param float $q30
     * @return Poll
     */
    public function setQ30($q30)
    {
        $this->q30 = $q30;
    
        return $this;
    }

    /**
     * Get q30
     *
     * @return float 
     */
    public function getQ30()
    {
        return $this->q30;
    }

    /**
     * Set q31
     *
     * @param float $q31
     * @return Poll
     */
    public function setQ31($q31)
    {
        $this->q31 = $q31;
    
        return $this;
    }

    /**
     * Get q31
     *
     * @return float 
     */
    public function getQ31()
    {
        return $this->q31;
    }

    /**
     * Set q32
     *
     * @param float $q32
     * @return Poll
     */
    public function setQ32($q32)
    {
        $this->q32 = $q32;
    
        return $this;
    }

    /**
     * Get q32
     *
     * @return float 
     */
    public function getQ32()
    {
        return $this->q32;
    }

    /**
     * Set q33
     *
     * @param float $q33
     * @return Poll
     */
    public function setQ33($q33)
    {
        $this->q33 = $q33;
    
        return $this;
    }

    /**
     * Get q33
     *
     * @return float 
     */
    public function getQ33()
    {
        return $this->q33;
    }

    /**
     * Set q34
     *
     * @param float $q34
     * @return Poll
     */
    public function setQ34($q34)
    {
        $this->q34 = $q34;
    
        return $this;
    }

    /**
     * Get q34
     *
     * @return float 
     */
    public function getQ34()
    {
        return $this->q34;
    }

    /**
     * Set q40
     *
     * @param float $q40
     * @return Poll
     */
    public function setQ40($q40)
    {
        $this->q40 = $q40;
    
        return $this;
    }

    /**
     * Get q40
     *
     * @return float 
     */
    public function getQ40()
    {
        return $this->q40;
    }

    /**
     * Set q41
     *
     * @param float $q41
     * @return Poll
     */
    public function setQ41($q41)
    {
        $this->q41 = $q41;
    
        return $this;
    }

    /**
     * Get q41
     *
     * @return float 
     */
    public function getQ41()
    {
        return $this->q41;
    }

    /**
     * Set q42
     *
     * @param float $q42
     * @return Poll
     */
    public function setQ42($q42)
    {
        $this->q42 = $q42;
    
        return $this;
    }

    /**
     * Get q42
     *
     * @return float 
     */
    public function getQ42()
    {
        return $this->q42;
    }

    /**
     * Set q43
     *
     * @param float $q43
     * @return Poll
     */
    public function setQ43($q43)
    {
        $this->q43 = $q43;
    
        return $this;
    }

    /**
     * Get q43
     *
     * @return float 
     */
    public function getQ43()
    {
        return $this->q43;
    }

    /**
     * Set q44
     *
     * @param float $q44
     * @return Poll
     */
    public function setQ44($q44)
    {
        $this->q44 = $q44;
    
        return $this;
    }

    /**
     * Get q44
     *
     * @return float 
     */
    public function getQ44()
    {
        return $this->q44;
    }

    /**
     * Set q50
     *
     * @param float $q50
     * @return Poll
     */
    public function setQ50($q50)
    {
        $this->q50 = $q50;
    
        return $this;
    }

    /**
     * Get q50
     *
     * @return float 
     */
    public function getQ50()
    {
        return $this->q50;
    }

    /**
     * Set q51
     *
     * @param float $q51
     * @return Poll
     */
    public function setQ51($q51)
    {
        $this->q51 = $q51;
    
        return $this;
    }

    /**
     * Get q51
     *
     * @return float 
     */
    public function getQ51()
    {
        return $this->q51;
    }

    /**
     * Set q52
     *
     * @param float $q52
     * @return Poll
     */
    public function setQ52($q52)
    {
        $this->q52 = $q52;
    
        return $this;
    }

    /**
     * Get q52
     *
     * @return float 
     */
    public function getQ52()
    {
        return $this->q52;
    }

    /**
     * Set q53
     *
     * @param float $q53
     * @return Poll
     */
    public function setQ53($q53)
    {
        $this->q53 = $q53;
    
        return $this;
    }

    /**
     * Get q53
     *
     * @return float 
     */
    public function getQ53()
    {
        return $this->q53;
    }

    /**
     * Set q54
     *
     * @param float $q54
     * @return Poll
     */
    public function setQ54($q54)
    {
        $this->q54 = $q54;
    
        return $this;
    }

    /**
     * Get q54
     *
     * @return float 
     */
    public function getQ54()
    {
        return $this->q54;
    }

    /**
     * Set q60
     *
     * @param float $q60
     * @return Poll
     */
    public function setQ60($q60)
    {
        $this->q60 = $q60;
    
        return $this;
    }

    /**
     * Get q60
     *
     * @return float 
     */
    public function getQ60()
    {
        return $this->q60;
    }

    /**
     * Set q61
     *
     * @param float $q61
     * @return Poll
     */
    public function setQ61($q61)
    {
        $this->q61 = $q61;
    
        return $this;
    }

    /**
     * Get q61
     *
     * @return float 
     */
    public function getQ61()
    {
        return $this->q61;
    }

    /**
     * Set q62
     *
     * @param float $q62
     * @return Poll
     */
    public function setQ62($q62)
    {
        $this->q62 = $q62;
    
        return $this;
    }

    /**
     * Get q62
     *
     * @return float 
     */
    public function getQ62()
    {
        return $this->q62;
    }

    /**
     * Set q63
     *
     * @param float $q63
     * @return Poll
     */
    public function setQ63($q63)
    {
        $this->q63 = $q63;
    
        return $this;
    }

    /**
     * Get q63
     *
     * @return float 
     */
    public function getQ63()
    {
        return $this->q63;
    }

    /**
     * Set q64
     *
     * @param float $q64
     * @return Poll
     */
    public function setQ64($q64)
    {
        $this->q64 = $q64;
    
        return $this;
    }

    /**
     * Get q64
     *
     * @return float 
     */
    public function getQ64()
    {
        return $this->q64;
    }

    /**
     * Set q70
     *
     * @param float $q70
     * @return Poll
     */
    public function setQ70($q70)
    {
        $this->q70 = $q70;
    
        return $this;
    }

    /**
     * Get q70
     *
     * @return float 
     */
    public function getQ70()
    {
        return $this->q70;
    }

    /**
     * Set q71
     *
     * @param float $q71
     * @return Poll
     */
    public function setQ71($q71)
    {
        $this->q71 = $q71;
    
        return $this;
    }

    /**
     * Get q71
     *
     * @return float 
     */
    public function getQ71()
    {
        return $this->q71;
    }

    /**
     * Set q72
     *
     * @param float $q72
     * @return Poll
     */
    public function setQ72($q72)
    {
        $this->q72 = $q72;
    
        return $this;
    }

    /**
     * Get q72
     *
     * @return float 
     */
    public function getQ72()
    {
        return $this->q72;
    }

    /**
     * Set q73
     *
     * @param float $q73
     * @return Poll
     */
    public function setQ73($q73)
    {
        $this->q73 = $q73;
    
        return $this;
    }

    /**
     * Get q73
     *
     * @return float 
     */
    public function getQ73()
    {
        return $this->q73;
    }

    /**
     * Set q74
     *
     * @param float $q74
     * @return Poll
     */
    public function setQ74($q74)
    {
        $this->q74 = $q74;
    
        return $this;
    }

    /**
     * Get q74
     *
     * @return float 
     */
    public function getQ74()
    {
        return $this->q74;
    }

    /**
     * Set q80
     *
     * @param float $q80
     * @return Poll
     */
    public function setQ80($q80)
    {
        $this->q80 = $q80;
    
        return $this;
    }

    /**
     * Get q80
     *
     * @return float 
     */
    public function getQ80()
    {
        return $this->q80;
    }

    /**
     * Set q81
     *
     * @param float $q81
     * @return Poll
     */
    public function setQ81($q81)
    {
        $this->q81 = $q81;
    
        return $this;
    }

    /**
     * Get q81
     *
     * @return float 
     */
    public function getQ81()
    {
        return $this->q81;
    }

    /**
     * Set q82
     *
     * @param float $q82
     * @return Poll
     */
    public function setQ82($q82)
    {
        $this->q82 = $q82;
    
        return $this;
    }

    /**
     * Get q82
     *
     * @return float 
     */
    public function getQ82()
    {
        return $this->q82;
    }

    /**
     * Set q83
     *
     * @param float $q83
     * @return Poll
     */
    public function setQ83($q83)
    {
        $this->q83 = $q83;
    
        return $this;
    }

    /**
     * Get q83
     *
     * @return float 
     */
    public function getQ83()
    {
        return $this->q83;
    }

    /**
     * Set q84
     *
     * @param float $q84
     * @return Poll
     */
    public function setQ84($q84)
    {
        $this->q84 = $q84;
    
        return $this;
    }

    /**
     * Get q84
     *
     * @return float 
     */
    public function getQ84()
    {
        return $this->q84;
    }

    /**
     * Set q90
     *
     * @param float $q90
     * @return Poll
     */
    public function setQ90($q90)
    {
        $this->q90 = $q90;
    
        return $this;
    }

    /**
     * Get q90
     *
     * @return float 
     */
    public function getQ90()
    {
        return $this->q90;
    }

    /**
     * Set q91
     *
     * @param float $q91
     * @return Poll
     */
    public function setQ91($q91)
    {
        $this->q91 = $q91;
    
        return $this;
    }

    /**
     * Get q91
     *
     * @return float 
     */
    public function getQ91()
    {
        return $this->q91;
    }

    /**
     * Set q92
     *
     * @param float $q92
     * @return Poll
     */
    public function setQ92($q92)
    {
        $this->q92 = $q92;
    
        return $this;
    }

    /**
     * Get q92
     *
     * @return float 
     */
    public function getQ92()
    {
        return $this->q92;
    }

    /**
     * Set q93
     *
     * @param float $q93
     * @return Poll
     */
    public function setQ93($q93)
    {
        $this->q93 = $q93;
    
        return $this;
    }

    /**
     * Get q93
     *
     * @return float 
     */
    public function getQ93()
    {
        return $this->q93;
    }

    /**
     * Set q94
     *
     * @param float $q94
     * @return Poll
     */
    public function setQ94($q94)
    {
        $this->q94 = $q94;
    
        return $this;
    }

    /**
     * Get q94
     *
     * @return float 
     */
    public function getQ94()
    {
        return $this->q94;
    }

    /**
     * Set uvName
     *
     * @param string $uvName
     * @return Poll
     */
    public function setUvName($uvName)
    {
        $this->uvName = $uvName;
    
        return $this;
    }

    /**
     * Get uvName
     *
     * @return string 
     */
    public function getUvName()
    {
        return $this->uvName;
    }

    /**
     * Set uv
     *
     * @param \Uvweb\UvBundle\Entity\Uv $uv
     * @return Poll
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