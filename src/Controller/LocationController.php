<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Province;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LocationController extends AbstractController
{

    private $serializer = null;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/locations-by-province/{provinceId}", name="location")
     */
    public function locations($provinceId): Response
    {
    	$province = $this->getDoctrine()
            ->getRepository(Province::class)
            ->find($provinceId);

        $locations = $province->getLocations();


        $jsonObject = $this->serializer->serialize($locations, 'json', [
		    'circular_reference_handler' => function ($object) {
		        return $object->getId();
		    }
		]);

		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}
