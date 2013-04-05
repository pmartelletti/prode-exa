<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Liga
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Exa\ProdeBundle\Entity\LigaRepository")
 */
class Liga
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
     * @ORM\OneToMany(targetEntity="Equipo", mappedBy="liga")
     */
    private $equipos;
    
    /**
     * @ORM\OneToMany(targetEntity="Fecha", mappedBy="liga")
     */
    private $fechas;
    
    public function __construct() {
        $this->equipos = new ArrayCollection();
        $this->fechas = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->name;
    }
    
    public function getShortName() {
        $temp = explode(" -", $this->getName()); 
        return $temp[0];
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
     * @return Liga
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
     * Add equipos
     *
     * @param \Exa\ProdeBundle\Entity\Equipo $equipos
     * @return Liga
     */
    public function addEquipo(\Exa\ProdeBundle\Entity\Equipo $equipos)
    {
        $this->equipos[] = $equipos;
    
        return $this;
    }

    /**
     * Remove equipos
     *
     * @param \Exa\ProdeBundle\Entity\Equipo $equipos
     */
    public function removeEquipo(\Exa\ProdeBundle\Entity\Equipo $equipos)
    {
        $this->equipos->removeElement($equipos);
    }

    /**
     * Get equipos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipos()
    {
        return $this->equipos;
    }

    /**
     * Add fechas
     *
     * @param \Exa\ProdeBundle\Entity\Fecha $fechas
     * @return Liga
     */
    public function addFecha(\Exa\ProdeBundle\Entity\Fecha $fechas)
    {
        $this->fechas[] = $fechas;
    
        return $this;
    }

    /**
     * Remove fechas
     *
     * @param \Exa\ProdeBundle\Entity\Fecha $fechas
     */
    public function removeFecha(\Exa\ProdeBundle\Entity\Fecha $fechas)
    {
        $this->fechas->removeElement($fechas);
    }

    /**
     * Get fechas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFechas()
    {
        return $this->fechas;
    }
}