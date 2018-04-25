<?php

namespace App\TiendaNube\TerritoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="territory_city")
 */
class City extends Territory
{
    /**
     * The city ddd
     * 
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Type("int")
     */
    protected $ddd;

    /**
     * The city ibge
     * 
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Type("int")
     */
    protected $ibge;

    /**
     * The city name
     * 
     * @var string
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Type("string")
     */
    protected $name;

    public function getType()
    {
        return $this::TYPE_CITY;
    }

    /**
     * @return int
     */
    public function getDdd()
    {
        return $this->ddd;
    }

    /**
     * @param int $ddd
     *
     * @return self
     */
    public function setDdd($ddd)
    {
        $this->ddd = $ddd;

        return $this;
    }

    /**
     * @return int
     */
    public function getIbge()
    {
        return $this->ibge;
    }

    /**
     * @param int $ibge
     *
     * @return self
     */
    public function setIbge($ibge)
    {
        $this->ibge = $ibge;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}