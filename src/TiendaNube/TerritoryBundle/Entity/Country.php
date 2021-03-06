<?php

namespace App\TiendaNube\TerritoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="territory_country")
 */
class Country extends Territory
{
    /**
     * The country acronym
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    protected $acronym;

    public function getType()
    {
        return $this::TYPE_COUNTRY;
    }

    /**
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * @param string $acronym
     *
     * @return this
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }
}