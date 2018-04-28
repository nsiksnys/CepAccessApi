<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\Store;
use App\Entity\City;
use App\Entity\State;

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
     * @var \App\Entity\City
     * @ORM\ManyToOne(targetEntity="\App\Entity\City")
     */
    protected $city;

    /**
     * The address state
     *
     * @var \App\Entity\State
     * @ORM\ManyToOne(targetEntity="\App\Entity\State")
     */
    protected $state;

    /**
     * The store this address belongs to
     *
     * @var Store
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Store", inversedBy="addresses")
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
     * @return float
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param float $altitude
     *
     * @return this
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     *
     * @return this
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return this
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
     * @return \App\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param \App\Entity\City $city
     *
     * @return this
     */
    public function setCity(\App\Entity\City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return \App\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param \App\Entity\State $state
     *
     * @return this
     */
    public function setState(\App\Entity\State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param Store $store
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
            "cep" => $this->zip,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "address" => $this->address,
            "neighborhood" => $this->neighborhood,
            "city" => $this->city->toJson(),
            "state" => $this->state->toJson()
        ];
    }
}
