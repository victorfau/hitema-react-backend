<?php

namespace App\Controller;

use App\Assets\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class CityController extends AbstractController {
	/**
	 * @Route("/", name="city_index", methods="GET")
	 */
	public function index(){
		return new Response(0, 'data');
	}

}
