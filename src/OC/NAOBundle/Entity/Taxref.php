<?php

namespace OC\NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taxref
 *
 * @ORM\Table(name="taxref")
 * @ORM\Entity(repositoryClass="OC\NAOBundle\Repository\TaxrefRepository")
 */
class Taxref
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="REGNE", type="string", length=8, precision=0, scale=0, nullable=true, unique=false)
     */
    private $regne;

    /**
     * @var string
     *
     * @ORM\Column(name="PHYLUM", type="string", length=8, precision=0, scale=0, nullable=true, unique=false)
     */
    private $phylum;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASSE", type="string", length=4, precision=0, scale=0, nullable=true, unique=false)
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="string", length=19, precision=0, scale=0, nullable=true, unique=false)
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="FAMILLE", type="string", length=17, precision=0, scale=0, nullable=true, unique=false)
     */
    private $famille;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_NOM", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cdNom;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_TAXSUP", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cdTaxsup;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_REF", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cdRef;

    /**
     * @var string
     *
     * @ORM\Column(name="RANG", type="string", length=4, precision=0, scale=0, nullable=true, unique=false)
     */
    private $rang;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_NOM", type="string", length=47, precision=0, scale=0, nullable=true, unique=false)
     */
    private $lbNom;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_AUTEUR", type="string", length=51, precision=0, scale=0, nullable=true, unique=false)
     */
    private $lbAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_COMPLET", type="string", length=83, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nomComplet;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VALIDE", type="string", length=83, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nomValide;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN", type="string", length=101, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nomVern;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN_ENG", type="string", length=122, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nomVernEng;

    /**
     * @var integer
     *
     * @ORM\Column(name="HABITAT", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $habitat;

    /**
     * @var string
     *
     * @ORM\Column(name="FR", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fr;

    /**
     * @var string
     *
     * @ORM\Column(name="GF", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $gf;

    /**
     * @var string
     *
     * @ORM\Column(name="MAR", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $mar;

    /**
     * @var string
     *
     * @ORM\Column(name="GUA", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $gua;

    /**
     * @var string
     *
     * @ORM\Column(name="SM", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sm;

    /**
     * @var string
     *
     * @ORM\Column(name="SB", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sb;

    /**
     * @var string
     *
     * @ORM\Column(name="SPM", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $spm;

    /**
     * @var string
     *
     * @ORM\Column(name="MAY", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $may;

    /**
     * @var string
     *
     * @ORM\Column(name="EPA", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $epa;

    /**
     * @var string
     *
     * @ORM\Column(name="REU", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $reu;

    /**
     * @var string
     *
     * @ORM\Column(name="SA", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sa;

    /**
     * @var string
     *
     * @ORM\Column(name="TA", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $ta;

    /**
     * @var string
     *
     * @ORM\Column(name="TAAF", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $taaf;

    /**
     * @var string
     *
     * @ORM\Column(name="NC", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nc;

    /**
     * @var string
     *
     * @ORM\Column(name="WF", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $wf;

    /**
     * @var string
     *
     * @ORM\Column(name="PF", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $pf;

    /**
     * @var string
     *
     * @ORM\Column(name="CLI", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $cli;



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
     * Set regne
     *
     * @param string $regne
     *
     * @return Taxref
     */
    public function setRegne($regne)
    {
        $this->regne = $regne;

        return $this;
    }

    /**
     * Get regne
     *
     * @return string
     */
    public function getRegne()
    {
        return $this->regne;
    }

    /**
     * Set phylum
     *
     * @param string $phylum
     *
     * @return Taxref
     */
    public function setPhylum($phylum)
    {
        $this->phylum = $phylum;

        return $this;
    }

    /**
     * Get phylum
     *
     * @return string
     */
    public function getPhylum()
    {
        return $this->phylum;
    }

    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return Taxref
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set ordre
     *
     * @param string $ordre
     *
     * @return Taxref
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return string
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set famille
     *
     * @param string $famille
     *
     * @return Taxref
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set cdNom
     *
     * @param integer $cdNom
     *
     * @return Taxref
     */
    public function setCdNom($cdNom)
    {
        $this->cdNom = $cdNom;

        return $this;
    }

    /**
     * Get cdNom
     *
     * @return integer
     */
    public function getCdNom()
    {
        return $this->cdNom;
    }

    /**
     * Set cdTaxsup
     *
     * @param integer $cdTaxsup
     *
     * @return Taxref
     */
    public function setCdTaxsup($cdTaxsup)
    {
        $this->cdTaxsup = $cdTaxsup;

        return $this;
    }

    /**
     * Get cdTaxsup
     *
     * @return integer
     */
    public function getCdTaxsup()
    {
        return $this->cdTaxsup;
    }

    /**
     * Set cdRef
     *
     * @param integer $cdRef
     *
     * @return Taxref
     */
    public function setCdRef($cdRef)
    {
        $this->cdRef = $cdRef;

        return $this;
    }

    /**
     * Get cdRef
     *
     * @return integer
     */
    public function getCdRef()
    {
        return $this->cdRef;
    }

    /**
     * Set rang
     *
     * @param string $rang
     *
     * @return Taxref
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return string
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Set lbNom
     *
     * @param string $lbNom
     *
     * @return Taxref
     */
    public function setLbNom($lbNom)
    {
        $this->lbNom = $lbNom;

        return $this;
    }

    /**
     * Get lbNom
     *
     * @return string
     */
    public function getLbNom()
    {
        return $this->lbNom;
    }

    /**
     * Set lbAuteur
     *
     * @param string $lbAuteur
     *
     * @return Taxref
     */
    public function setLbAuteur($lbAuteur)
    {
        $this->lbAuteur = $lbAuteur;

        return $this;
    }

    /**
     * Get lbAuteur
     *
     * @return string
     */
    public function getLbAuteur()
    {
        return $this->lbAuteur;
    }

    /**
     * Set nomComplet
     *
     * @param string $nomComplet
     *
     * @return Taxref
     */
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    /**
     * Get nomComplet
     *
     * @return string
     */
    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    /**
     * Set nomValide
     *
     * @param string $nomValide
     *
     * @return Taxref
     */
    public function setNomValide($nomValide)
    {
        $this->nomValide = $nomValide;

        return $this;
    }

    /**
     * Get nomValide
     *
     * @return string
     */
    public function getNomValide()
    {
        return $this->nomValide;
    }

    /**
     * Set nomVern
     *
     * @param string $nomVern
     *
     * @return Taxref
     */
    public function setNomVern($nomVern)
    {
        $this->nomVern = $nomVern;

        return $this;
    }

    /**
     * Get nomVern
     *
     * @return string
     */
    public function getNomVern()
    {
        return $this->nomVern;
    }

    /**
     * Set nomVernEng
     *
     * @param string $nomVernEng
     *
     * @return Taxref
     */
    public function setNomVernEng($nomVernEng)
    {
        $this->nomVernEng = $nomVernEng;

        return $this;
    }

    /**
     * Get nomVernEng
     *
     * @return string
     */
    public function getNomVernEng()
    {
        return $this->nomVernEng;
    }

    /**
     * Set habitat
     *
     * @param integer $habitat
     *
     * @return Taxref
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get habitat
     *
     * @return integer
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set fr
     *
     * @param string $fr
     *
     * @return Taxref
     */
    public function setFr($fr)
    {
        $this->fr = $fr;

        return $this;
    }

    /**
     * Get fr
     *
     * @return string
     */
    public function getFr()
    {
        return $this->fr;
    }

    /**
     * Set gf
     *
     * @param string $gf
     *
     * @return Taxref
     */
    public function setGf($gf)
    {
        $this->gf = $gf;

        return $this;
    }

    /**
     * Get gf
     *
     * @return string
     */
    public function getGf()
    {
        return $this->gf;
    }

    /**
     * Set mar
     *
     * @param string $mar
     *
     * @return Taxref
     */
    public function setMar($mar)
    {
        $this->mar = $mar;

        return $this;
    }

    /**
     * Get mar
     *
     * @return string
     */
    public function getMar()
    {
        return $this->mar;
    }

    /**
     * Set gua
     *
     * @param string $gua
     *
     * @return Taxref
     */
    public function setGua($gua)
    {
        $this->gua = $gua;

        return $this;
    }

    /**
     * Get gua
     *
     * @return string
     */
    public function getGua()
    {
        return $this->gua;
    }

    /**
     * Set sm
     *
     * @param string $sm
     *
     * @return Taxref
     */
    public function setSm($sm)
    {
        $this->sm = $sm;

        return $this;
    }

    /**
     * Get sm
     *
     * @return string
     */
    public function getSm()
    {
        return $this->sm;
    }

    /**
     * Set sb
     *
     * @param string $sb
     *
     * @return Taxref
     */
    public function setSb($sb)
    {
        $this->sb = $sb;

        return $this;
    }

    /**
     * Get sb
     *
     * @return string
     */
    public function getSb()
    {
        return $this->sb;
    }

    /**
     * Set spm
     *
     * @param string $spm
     *
     * @return Taxref
     */
    public function setSpm($spm)
    {
        $this->spm = $spm;

        return $this;
    }

    /**
     * Get spm
     *
     * @return string
     */
    public function getSpm()
    {
        return $this->spm;
    }

    /**
     * Set may
     *
     * @param string $may
     *
     * @return Taxref
     */
    public function setMay($may)
    {
        $this->may = $may;

        return $this;
    }

    /**
     * Get may
     *
     * @return string
     */
    public function getMay()
    {
        return $this->may;
    }

    /**
     * Set epa
     *
     * @param string $epa
     *
     * @return Taxref
     */
    public function setEpa($epa)
    {
        $this->epa = $epa;

        return $this;
    }

    /**
     * Get epa
     *
     * @return string
     */
    public function getEpa()
    {
        return $this->epa;
    }

    /**
     * Set reu
     *
     * @param string $reu
     *
     * @return Taxref
     */
    public function setReu($reu)
    {
        $this->reu = $reu;

        return $this;
    }

    /**
     * Get reu
     *
     * @return string
     */
    public function getReu()
    {
        return $this->reu;
    }

    /**
     * Set sa
     *
     * @param string $sa
     *
     * @return Taxref
     */
    public function setSa($sa)
    {
        $this->sa = $sa;

        return $this;
    }

    /**
     * Get sa
     *
     * @return string
     */
    public function getSa()
    {
        return $this->sa;
    }

    /**
     * Set ta
     *
     * @param string $ta
     *
     * @return Taxref
     */
    public function setTa($ta)
    {
        $this->ta = $ta;

        return $this;
    }

    /**
     * Get ta
     *
     * @return string
     */
    public function getTa()
    {
        return $this->ta;
    }

    /**
     * Set taaf
     *
     * @param string $taaf
     *
     * @return Taxref
     */
    public function setTaaf($taaf)
    {
        $this->taaf = $taaf;

        return $this;
    }

    /**
     * Get taaf
     *
     * @return string
     */
    public function getTaaf()
    {
        return $this->taaf;
    }

    /**
     * Set nc
     *
     * @param string $nc
     *
     * @return Taxref
     */
    public function setNc($nc)
    {
        $this->nc = $nc;

        return $this;
    }

    /**
     * Get nc
     *
     * @return string
     */
    public function getNc()
    {
        return $this->nc;
    }

    /**
     * Set wf
     *
     * @param string $wf
     *
     * @return Taxref
     */
    public function setWf($wf)
    {
        $this->wf = $wf;

        return $this;
    }

    /**
     * Get wf
     *
     * @return string
     */
    public function getWf()
    {
        return $this->wf;
    }

    /**
     * Set pf
     *
     * @param string $pf
     *
     * @return Taxref
     */
    public function setPf($pf)
    {
        $this->pf = $pf;

        return $this;
    }

    /**
     * Get pf
     *
     * @return string
     */
    public function getPf()
    {
        return $this->pf;
    }

    /**
     * Set cli
     *
     * @param string $cli
     *
     * @return Taxref
     */
    public function setCli($cli)
    {
        $this->cli = $cli;

        return $this;
    }

    /**
     * Get cli
     *
     * @return string
     */
    public function getCli()
    {
        return $this->cli;
    }
}
