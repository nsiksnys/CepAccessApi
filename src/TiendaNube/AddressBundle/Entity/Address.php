<?php

namespace App\TiendaNube\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

use App\TiendaNube\StoreBundle\Entity\Store;
use App\TiendaNube\TerritoryBundle\Entity\City;
use App\TiendaNube\TerritoryBundle\Entity\State;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Address
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * The address id
     *
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * The address altitude
     *
     * @var float
     * @ORM\Column(type="float", nullable=false)
     * @Assert\Type("float")
     */
    protected $altitude;

    /**
     * The address zipcode
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    protected $zip;

    /**
     * The address latitude
     *
     * @var float
     * @ORM\Column(type="float", nullable=false)
     * @Assert\Type("float")
     */
    protected $latitude;

    /**
     * The address longitude
     *
     * @var float
     * @ORM\Column(type="float", nullable=false)
     * @Assert\Type("float")
     */
    protected $longitude;

    /**
     * The address itself
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    protected $address;

    /**
     * The address neighborhood
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    protected $neighborhood;

    /**
     * The address city
     *
     * @var \App\TiendaNube\TerritoryBundle\Entity\City
     * @ORM\OneToOne(targetEntity="\App\TiendaNube\TerritoryBundle\Entity\City")
     */
    protected $city;

    /**
     * The address state
     *
     * @var \App\TiendaNube\TerritoryBundle\Entity\State
     * @ORM\OneToOne(targetEntity="\App\TiendaNube\TerritoryBundle\Entity\State")
     */
    protected $state;

    /**
     * The store this address belongs to
     *
     * @var Store
     * 
     * @ORM\OneToOne(targetEntity="App\TiendaNube\AddressBundle\Entity\Address")
     */
    protected $store;

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
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * @param string $neighborhood
     *
     * @return this
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * @return \App\TiendaNube\TerritoryBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param \App\TiendaNube\TerritoryBundle\Entity\City $city
     *
     * @return this
     */
    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return \App\TiendaNube\TerritoryBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param \App\TiendaNube\TerritoryBundle\Entity\State $state
     *
     * @return this
     */
    public function setState(State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return \App\TiendaNube\StoreBundle\Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param \App\TiendaNube\StoreBundle\Entity\Store $store
     *
     * @return this
     */
    public function setStore(Store $store)
    {
        $this->store = $store;

        return $this;
    }

    public function toJson()
    {
        return [
            "altitude" => $this->altitude,
            "zip" => $this->zip,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "address" => $this->address,
            "neighborhood" => $this->neighborhood,
            "city" => $this->city->toJson(),
            "state" => $this->state->toJson()
        ];
    }
}
