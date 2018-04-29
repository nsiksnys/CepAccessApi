<?php

namespace App\TiendaNube\TerritoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="territory",indexes={@ORM\Index(name="idx_type_territory", columns={"type"})})
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "country"        = "Country",
 *     "state"          = "State",
 *     "city"           = "City"
 * })
 */
abstract class Territory
{
	const TYPE_COUNTRY = 'country';
    const TYPE_STATE = 'state';
    const TYPE_CITY = 'city';

	/**
	 * The territory id
	 *
	 * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

    /**
     * The territory name
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    protected $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Territory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Territory $parent
     *
     * @return this
     */
    public function setParent(Territory $parent)
    {
        $this->parent = $parent;

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
     * @return this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
