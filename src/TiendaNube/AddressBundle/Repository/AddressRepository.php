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
     * @param bool $isBeta
     * @return Collecion
     */
    public function getAddressByZip(string $zip, bool $isBeta = false)
    {
        $this->logger->debug('Getting address for the zipcode [' . $zip . '] from database');

        return $this->createQueryBuilder('a')
                    ->from('AddressBundle:Address', 'a')
                    ->join('StoreBundle:Store', 's')
                    ->where('a.zipcode = :zipcode', 's.betaTester = :is_beta')
                    ->setParameter('zipcode', $zip)
                    ->setParameter('is_beta', $isBeta)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * Get a beta store address by its zipcode (CEP)
     *
     * @param string $zip
     * @return Collecion
     */
    public function getBetaStoreAddressByZip(string $zip)
    {
        return $this->getAddressByZip($zip, true);
    }
}
