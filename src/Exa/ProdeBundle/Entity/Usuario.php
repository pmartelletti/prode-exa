<?php

namespace Exa\ProdeBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Exa\ProdeBundle\Entity\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $name;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="usuarios");
     * @ORM\JoinColumn(name="equipo_id", referencedColumnName="id")
     * 
     * @Assert\NotBlank(message="Selecciona tu equipo.", groups={"Registration", "Profile"})
     * @Assert\Type(type="Exa\ProdeBundle\Entity\Equipo")
     */
    protected $equipo;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="TarjetaApuestas", mappedBy="usuario")
     */
    protected $tarjetasApuesta;
    
    public function __construct() {
        parent::__construct();
        // busco las tarjetas de apuestas
        $this->tarjetasApuesta = new ArrayCollection();
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
    
    public function getNameTeam() {
        return sprintf("%s (%s)", $this->getName(), $this->getEquipo()->getName());
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Usuario
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
     * Set equipo_id
     *
     * @param integer $equipoId
     * @return Usuario
     */
    public function setEquipoId($equipoId)
    {
        $this->equipo_id = $equipoId;
    
        return $this;
    }

    /**
     * Get equipo_id
     *
     * @return integer 
     */
    public function getEquipoId()
    {
        return $this->equipo_id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
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
     * Set equipo
     *
     * @param \Exa\ProdeBundle\Entity\Equipo $equipo
     * @return Usuario
     */
    public function setEquipo(\Exa\ProdeBundle\Entity\Equipo $equipo = null)
    {
        $this->equipo = $equipo;
    
        return $this;
    }

    /**
     * Get equipo
     *
     * @return \Exa\ProdeBundle\Entity\Equipo 
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Add tarjetasApuesta
     *
     * @param \Exa\ProdeBundle\Entity\TarjetaApuestas $tarjetasApuesta
     * @return Usuario
     */
    public function addTarjetasApuesta(\Exa\ProdeBundle\Entity\TarjetaApuestas $tarjetasApuesta)
    {
        $this->tarjetasApuesta[] = $tarjetasApuesta;
    
        return $this;
    }

    /**
     * Remove tarjetasApuesta
     *
     * @param \Exa\ProdeBundle\Entity\TarjetaApuestas $tarjetasApuesta
     */
    public function removeTarjetasApuesta(\Exa\ProdeBundle\Entity\TarjetaApuestas $tarjetasApuesta)
    {
        $this->tarjetasApuesta->removeElement($tarjetasApuesta);
    }

    /**
     * Get tarjetasApuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTarjetasApuesta()
    {
        return $this->tarjetasApuesta;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
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
}