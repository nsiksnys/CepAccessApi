<?php

namespace App\TiendaNube\AddressBundle\Repository;

use App\TiendaNube\AddressBundle\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Psr\Log\LoggerInterface;

class AddressRepository extends ServiceEntityRepository
{
    private $entityManager;
    private $logger;

    public function __construct(RegistryInterface $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Address::class);
        $this->logger = $logger;
    }

    /**
     * Get an address by its zipcode (CEP)
     *
     * @param string $zip
     * @return Collecion
     */
    public function getAddressByZip(string $zip)
    {
        $this->logger->debug('Getting address for the zipcode [' . $zip . '] from database');

        return $this->createQueryBuilder('a')
                    ->from('AddressBundle:Address', 'a')
                    ->where('a.zipcode = :zipcode')
                    ->setParameter('zipcode', $zip)
                    ->getQuery()
                    ->getResult();
    }
}
