<?php

namespace App\TiendaNube\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

use App\TiendaNube\AddressBundle\Entity\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="store")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Store
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

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
     * The store name
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    protected $name;

    /**
     * The store owner e-mail address
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    protected $email;

    /**
     * The store beta tester status
     *
     * @var bool
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $betaTester = false;

    /**
     * The store addresses
     *
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="App\TiendaNube\AddressBundle\Entity\Address", mappedBy="store")
     */
    protected $addresses;

    /**
     * Get the current store ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the store's name
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the current store name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the store's e-mail address
     *
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the current store e-mail address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isBetaTester()
    {
        return $this->betaTester;
    }

    /**
     * @param bool $betaTester
     *
     * @return this
     */
    public function setBetaTester($betaTester)
    {
        $this->betaTester = $betaTester;

        return $this;
    }

    /**
     * Enables store beta testing
     */
    public function enableBetaTesting()
    {
        $this->setBetaTester(true);
    }

    /**
     * Disables store beta testing
     */
    public function disableBetaTesting()
    {
        $this->setBetaTester(false);
    }

    /**
     * Add address
     *
     * @param Address $addresses adds new addresses
     *
     * @return this
     */
    public function addAddress(Address $address)
    {
        $this->addresses->add($address);

        return $this;
    }

    /**
     * Set address
     *
     * @param mixed $address set new address collection
     *
     * @return this
     */
    public function setAddresses($addresses)
    {
        $this->addresses = new ArrayCollection($addresses);

        return $this;
    }

    /**
     * Remove address
     *
     * @param Address $addresses remove address
     *
     * @return this
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
