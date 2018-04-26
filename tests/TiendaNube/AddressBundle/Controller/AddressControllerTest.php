<?php

namespace App\Tests\TiendaNube\AddressBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AddressControllerTest extends WebTestCase
{
	private $entityManager;

	public function setUp()
	{
		$this->entityManager = static::createClient()->getContainer()->get('doctrine.orm.entity_manager');
	}

	public function testGetOk()
	{
		$store = $this->getRandomStoreItem(true);
		$cep = $store->getAddresses()->get(random_int(0, $store->getAddresses()->count()-1))->getZip();

        $client = static::createClient();
        $client->request('GET', "/address/$cep");
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
	}

	public function testGetFail()
	{
		$store = $this->getRandomStoreItem(false);
		$cep = $store->getAddresses()->get(random_int(0, $store->getAddresses()->count()-1))->getZip();

        $client = static::createClient();
        $client->request('GET', "/address/$cep");
        $this->assertEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());
	}

	/**
     * Retrieve one random item
     * 
     * @param boolean $isBeta
     * @return object
     */ 
    private function getRandomStoreItem($isBeta)
    {
        $query = $this->entityManager
                      ->createQueryBuilder()
                      ->select('s')
                      ->from('StoreBundle:Store', 's')
                      ->where('s.betaTester = :is_beta')
                      ->setParameter('is_beta', $isBeta)
                      ->getQuery();

        $result = new ArrayCollection($query->getResult());

        if ($result->count() == 0)
        {
            return null;
        }

        return $result->get(random_int(0, $result->count()-1));
    }
}