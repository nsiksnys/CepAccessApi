<?php

namespace App\TiendaNube\AddressBundle\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

use App\TiendaNube\AddressBundle\Entity\Address;

class AddressProvider
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
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

        return $this->entityManager
                    ->createQueryBuilder()
                    ->select('a')
                    ->from('AddressBundle:Address', 'a')
                    ->join('StoreBundle:Store', 's')
                    ->where('a.zip = :zipcode', 's.betaTester = :is_beta')
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
