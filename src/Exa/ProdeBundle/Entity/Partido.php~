<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Partido
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Exa\ProdeBundle\Entity\PartidoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Partido
{
    
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Fecha", inversedBy="partidos")
     * @ORM\JoinColumn(name="fecha_id", referencedColumnName="id")
     */
    private $fecha;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="partidosLocal")
     * @ORM\JoinColumn(name="equipo1_id", referencedColumnName="id")
     */
    private $equipo1;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="partidosVisitante")
     * @ORM\JoinColumn(name="equipo2_id", referencedColumnName="id")
     */
    private $equipo2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jugado", type="boolean")
     */
    private $jugado;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=2, nullable=true)
     */
    private $resultado;
    
    /**
     *@ORM\OneToMany(targetEntity="Apuesta", mappedBy="Apuesta", cascade={"all"})
     */
    private $apuestas;
    
    public function __construct() {
        $this->apuestas = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->getName();
    }


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
     * @return Partido
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
     * Set fecha_id
     *
     * @param integer $fechaId
     * @return Partido
     */
    public function setFechaId($fechaId)
    {
        $this->fecha_id = $fechaId;
    
        return $this;
    }

    /**
     * Get fecha_id
     *
     * @return integer 
     */
    public function getFechaId()
    {
        return $this->fecha_id;
    }

    /**
     * Set equipo1_id
     *
     * @param integer $equipo1Id
     * @return Partido
     */
    public function setEquipo1Id($equipo1Id)
    {
        $this->equipo1_id = $equipo1Id;
    
        return $this;
    }

    /**
     * Get equipo1_id
     *
     * @return integer 
     */
    public function getEquipo1Id()
    {
        return $this->equipo1_id;
    }

    /**
     * Set equipo2_id
     *
     * @param integer $equipo2Id
     * @return Partido
     */
    public function setEquipo2Id($equipo2Id)
    {
        $this->equipo2_id = $equipo2Id;
    
        return $this;
    }

    /**
     * Get equipo2_id
     *
     * @return integer 
     */
    public function getEquipo2Id()
    {
        return $this->equipo2_id;
    }

    /**
     * Set jugado
     *
     * @param boolean $jugado
     * @return Partido
     */
    public function setJugado($jugado)
    {
        $this->jugado = $jugado;
    
        return $this;
    }

    /**
     * Get jugado
     *
     * @return boolean 
     */
    public function getJugado()
    {
        return $this->jugado;
    }

    /**
     * Set resultado
     *
     * @param string $resultado
     * @return Partido
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    
        return $this;
    }

    /**
     * Get resultado
     *
     * @return string 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set fecha
     *
     * @param \Exa\ProdeBundle\Entity\Fecha $fecha
     * @return Partido
     */
    public function setFecha(\Exa\ProdeBundle\Entity\Fecha $fecha = null)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \Exa\ProdeBundle\Entity\Category 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set equipo1
     *
     * @param \Exa\ProdeBundle\Entity\Equipo $equipo1
     * @return Partido
     */
    public function setEquipo1(\Exa\ProdeBundle\Entity\Equipo $equipo1 = null)
    {
        $this->equipo1 = $equipo1;
    
        return $this;
    }

    /**
     * Get equipo1
     *
     * @return \Exa\ProdeBundle\Entity\Equipo 
     */
    public function getEquipo1()
    {
        return $this->equipo1;
    }
    
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function createNameFromTeams() {
        $this->setName(sprintf("%s vs. %s", $this->getEquipo1()->getName(), $this->getEquipo2()->getName()));
    }

    /**
     * Set equipo2
     *
     * @param \Exa\ProdeBundle\Entity\Equipo $equipo2
     * @return Partido
     */
    public function setEquipo2(\Exa\ProdeBundle\Entity\Equipo $equipo2 = null)
    {
        $this->equipo2 = $equipo2;
    
        return $this;
    }

    /**
     * Get equipo2
     *
     * @return \Exa\ProdeBundle\Entity\Equipo 
     */
    public function getEquipo2()
    {
        return $this->equipo2;
    }

    /**
     * Add apuestas
     *
     * @param \Exa\ProdeBundle\Entity\Apuesta $apuestas
     * @return Partido
     */
    public function addApuesta(\Exa\ProdeBundle\Entity\Apuesta $apuestas)
    {
        $this->apuestas[] = $apuestas;
    
        return $this;
    }

    /**
     * Remove apuestas
     *
     * @param \Exa\ProdeBundle\Entity\Apuesta $apuestas
     */
    public function removeApuesta(\Exa\ProdeBundle\Entity\Apuesta $apuestas)
    {
        $this->apuestas->removeElement($apuestas);
    }

    /**
     * Get apuestas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApuestas()
    {
        return $this->apuestas;
    }
}