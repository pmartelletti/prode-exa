<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apuesta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Exa\ProdeBundle\Entity\ApuestaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Apuesta
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
     * @ORM\ManyToOne(targetEntity="TarjetaApuestas", inversedBy="apuestas")
     * @ORM\JoinColumn(name="tarjetaApuestas_id", referencedColumnName="id")
     */
    private $tarjetaApuestas;

    /**
     * @var string
     *
     * @ORM\Column(name="prediccion", type="string", length=1, nullable=true)
     */
    private $prediccion;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Partido", inversedBy="apuestas")
     * @ORM\JoinColumn(name="partido_id", referencedColumnName="id")
     */
    private $partido;


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
     * @return Apuesta
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
     * Set prediccion
     *
     * @param string $prediccion
     * @return Apuesta
     */
    public function setPrediccion($prediccion)
    {
        $this->prediccion = $prediccion;
    
        return $this;
    }

    /**
     * Get prediccion
     *
     * @return string 
     */
    public function getPrediccion()
    {
        return $this->prediccion;
    }

    /**
     * Set partido_id
     *
     * @param integer $partidoId
     * @return Apuesta
     */
    public function setPartidoId($partidoId)
    {
        $this->partido_id = $partidoId;
    
        return $this;
    }

    /**
     * Get partido_id
     *
     * @return integer 
     */
    public function getPartidoId()
    {
        return $this->partido_id;
    }

    /**
     * Set tarjetaApuestas
     *
     * @param \Exa\ProdeBundle\Entity\TarjetaApuestas $tarjetaApuestas
     * @return Apuesta
     */
    public function setTarjetaApuestas(\Exa\ProdeBundle\Entity\TarjetaApuestas $tarjetaApuestas = null)
    {
        $this->tarjetaApuestas = $tarjetaApuestas;
        $this->tarjetaApuestas->addApuesta($this);
    
        return $this;
    }

    /**
     * Get tarjetaApuestas
     *
     * @return \Exa\ProdeBundle\Entity\TarjetaApuestas 
     */
    public function getTarjetaApuestas()
    {
        return $this->tarjetaApuestas;
    }

    /**
     * Set partido
     *
     * @param \Exa\ProdeBundle\Entity\Partido $partido
     * @return Apuesta
     */
    public function setPartido(\Exa\ProdeBundle\Entity\Partido $partido = null)
    {
        $this->partido = $partido;
    
        return $this;
    }

    /**
     * Get partido
     *
     * @return \Exa\ProdeBundle\Entity\Partido 
     */
    public function getPartido()
    {
        return $this->partido;
    }
    
     /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function createNameFromData() {
        $this->setName(sprintf("%s (%s)", $this->getPartido(), $this->getPrediccion()) );
    }
    
    public function acertoResultado() {
        return $this->getPrediccion() == $this->getPartido()->getResultado();
    }
}