<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Provider\AddressProvider;

class AddressController extends Controller
{
    protected $containerInterface;
    protected $provider;

    public function __construct(ContainerInterface $containerInterface, AddressProvider $provider)
    {
        $this->containerInterface = $containerInterface;
        $this->provider = $provider;
    }

    /**
     * Returns the address to be auto-fill the checkout form
     *
     * Expected JSON:
     * {
     *     "address": "Avenida da França",
     *     "neighborhood": "Comércio",
     *     "city": "Salvador",
     *     "state": "BA"
     * }
     *
     * @Route("/address/{zipcode}", name="address_get")
     * @Method({"GET"})
     *
     * @param string $zipcode
     * @return ResponseInterface
     */
    public function addressAction(string $zipcode) {
        // filtering and sanitizing input
        $rawZipcode = preg_replace("/[^\d]/","",$zipcode);

        // getting address by zipcode
        $result = $this->provider->getBetaStoreAddressByZip($rawZipcode);

        // no result
        if (is_null($result) || count($result) == 0) {
          return new JsonResponse(["message" => "Not found"], Response::HTTP_NOT_FOUND);
        }

        $addresses = [];
        foreach ($result as $address) {
            $addresses[] = $address->toJson();
        }

        return $this->json($addresses);
    }
}
