<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TarjetaApuestas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Exa\ProdeBundle\Entity\TarjetaApuestasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TarjetaApuestas
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
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="tarjetasApuesta")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Fecha", inversedBy="tarjetasApuesta")
     * @ORM\JoinColumn(name="fecha_id", referencedColumnName="id")
     */
    private $fecha;
    
    /**
     * @var integer
     * @ORM\Column(name="calculado", type="boolean", nullable=true)
     */
    private $calculado;
    
    /**
     * @var integer
     * @ORM\Column(name="aciertos", type="integer")
     */
    private $aciertos;
    
    /**
     *@ORM\OneToMany(targetEntity="Apuesta", mappedBy="tarjetaApuestas", cascade={"all"})
     */
    private $apuestas;
    
    public function __construct() {
        $this->apuestas = new ArrayCollection();
        $this->aciertos = 0;
    }
    
    public function __toString() {
        $res = isset($this->name) ? $this->getName() : "";
        return $res;
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
     * @return TarjetaApuestas
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
     * Set usuario_id
     *
     * @param integer $usuarioId
     * @return TarjetaApuestas
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuario_id = $usuarioId;
    
        return $this;
    }

    /**
     * Get usuario_id
     *
     * @return integer 
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * Set fecha_id
     *
     * @param integer $fechaId
     * @return TarjetaApuestas
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
     * Set usuario
     *
     * @param \Exa\ProdeBundle\Entity\Usuario $usuario
     * @return TarjetaApuestas
     */
    public function setUsuario(\Exa\ProdeBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Exa\ProdeBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fecha
     *
     * @param \Exa\ProdeBundle\Entity\Fecha $fecha
     * @return TarjetaApuestas
     */
    public function setFecha(\Exa\ProdeBundle\Entity\Fecha $fecha = null)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \Exa\ProdeBundle\Entity\Fecha 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set calculado
     *
     * @param boolean $calculado
     * @return TarjetaApuestas
     */
    public function setCalculado($calculado)
    {
        $this->calculado = $calculado;
    
        return $this;
    }

    /**
     * Get calculado
     *
     * @return boolean 
     */
    public function getCalculado()
    {
        return $this->calculado;
    }

    /**
     * Set aciertos
     *
     * @param integer $aciertos
     * @return TarjetaApuestas
     */
    public function setAciertos($aciertos)
    {
        $this->aciertos = $aciertos;
    
        return $this;
    }

    /**
     * Get aciertos
     *
     * @return integer 
     */
    public function getAciertos()
    {
        return $this->aciertos;
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function createNameFromData() {
        $this->setName(sprintf("%s, de %s", $this->getFecha()->getName(), $this->getUsuario()->getUsername()));
    }

    /**
     * Add apuestas
     *
     * @param \Exa\ProdeBundle\Entity\Apuesta $apuestas
     * @return TarjetaApuestas
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
    
    public function calcularResultado() {
        $res = 0;
        foreach($this->getApuestas() as $apuesta) {
            //var_dump($apuesta->acertoResultado()); exit;
            $res += $apuesta->acertoResultado() ? 1 : 0;
        }
        $this->setCalculado(true);
        $this->setAciertos($res);
    }
    
    public function hasApuestas() {
        return !$this->getApuestas()->isEmpty();
    }
}