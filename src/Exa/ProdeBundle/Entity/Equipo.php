<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Equipo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Exa\ProdeBundle\Entity\EquipoRepository")
 */
class Equipo
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
     * @ORM\ManyToOne(targetEntity="Liga", inversedBy="equipos")
     * @ORM\JoinColumn(name="liga_id", referencedColumnName="id")
     */
    private $liga;
    
    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="equipo")
     */
    private $usuarios;
    
    /**
     * @ORM\OneToMany(targetEntity="Partido", mappedBy="equipo1")
     */
    private $partidosLocal;
    
    /**
     * @ORM\OneToMany(targetEntity="Partido", mappedBy="equipo2")
     */
    private $partidosVisitante;
    
    public function __construct() {
        $this->usuarios = new ArrayCollection();
        $this->partidosLocal = new ArrayCollection();
        $this->partidosVisitante = new ArrayCollection();
    }
    
    public function __toString() {
        return sprintf("%s (%s)", $this->getName(), $this->getLiga()->getShortName());
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
     * @return Equipo
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
     * Set liga_id
     *
     * @param integer $ligaId
     * @return Equipo
     */
    public function setLigaId($ligaId)
    {
        $this->liga_id = $ligaId;
    
        return $this;
    }

    /**
     * Get liga_id
     *
     * @return integer 
     */
    public function getLigaId()
    {
        return $this->liga_id;
    }

    /**
     * Set liga
     *
     * @param \Exa\ProdeBundle\Entity\Liga $liga
     * @return Equipo
     */
    public function setLiga(\Exa\ProdeBundle\Entity\Liga $liga = null)
    {
        $this->liga = $liga;
    
        return $this;
    }

    /**
     * Get liga
     *
     * @return \Exa\ProdeBundle\Entity\Liga 
     */
    public function getLiga()
    {
        return $this->liga;
    }

    /**
     * Add usuarios
     *
     * @param \Exa\ProdeBundle\Entity\Usuario $usuarios
     * @return Equipo
     */
    public function addUsuario(\Exa\ProdeBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \Exa\ProdeBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\Exa\ProdeBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add partidosLocal
     *
     * @param \Exa\ProdeBundle\Entity\Partido $partidosLocal
     * @return Equipo
     */
    public function addPartidosLocal(\Exa\ProdeBundle\Entity\Partido $partidosLocal)
    {
        $this->partidosLocal[] = $partidosLocal;
    
        return $this;
    }

    /**
     * Remove partidosLocal
     *
     * @param \Exa\ProdeBundle\Entity\Partido $partidosLocal
     */
    public function removePartidosLocal(\Exa\ProdeBundle\Entity\Partido $partidosLocal)
    {
        $this->partidosLocal->removeElement($partidosLocal);
    }

    /**
     * Get partidosLocal
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartidosLocal()
    {
        return $this->partidosLocal;
    }

    /**
     * Add partidosVisitante
     *
     * @param \Exa\ProdeBundle\Entity\Partido $partidosVisitante
     * @return Equipo
     */
    public function addPartidosVisitante(\Exa\ProdeBundle\Entity\Partido $partidosVisitante)
    {
        $this->partidosVisitante[] = $partidosVisitante;
    
        return $this;
    }

    /**
     * Remove partidosVisitante
     *
     * @param \Exa\ProdeBundle\Entity\Partido $partidosVisitante
     */
    public function removePartidosVisitante(\Exa\ProdeBundle\Entity\Partido $partidosVisitante)
    {
        $this->partidosVisitante->removeElement($partidosVisitante);
    }

    /**
     * Get partidosVisitante
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartidosVisitante()
    {
        return $this->partidosVisitante;
    }
}