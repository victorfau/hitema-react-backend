<?php


namespace App\Controller;

use App\Assets\Response;
use App\Entity\Category;
use App\Entity\Recette;
use App\Repository\CategoryRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recette")
 */
class RecetteController extends AbstractController{

	/**
	 * @Route("/")
	 * @param RecetteRepository $recettes
	 * @return Response
	 */
	public function index(RecetteRepository $recettes){
		$recette = $recettes->findAll();

		return new Response(0, $recette);
	}

	/**
	 * @Route("/view/{id}")
	 * @param int $id
	 * @param RecetteRepository $recette
	 * @return Response
	 */
	public function view(int $id, RecetteRepository $recette){
		$recettes = $recette->find($id);

		if($recettes == null){
			return new Response(15);
		}

		return new Response(0, $recettes);
	}

	/**
	 * @Route("/add", methods={"POST"})
	 * @param Request $request
	 * @param RecetteRepository $recettes
	 * @return Response
	 */
	public function add(Request $request, RecetteRepository $recettes){

		$name = $request->get("name", null);
		$ingrediants = $request->get("ingrediants", null);
		$duree = $request->get("duree", null);
		$recette = $request->get("recette", null);

		if ($name == null OR $ingrediants == null OR $duree == null OR $recette == null){
			return new Response(8);
		}

		if($recettes->findBy(['name' => $name])){
			return new Response(10);
		}

		$newRecette = new Recette();

		$newRecette->setName($name);
		$newRecette->setIngediants($ingrediants);
		$newRecette->setIngediants($ingrediants);

		return new Response(0);
	}

	/**
     * @Route("/delete/{id}")
     */
    public function delete (RecetteRepository $recetteRepository, $id){
        $recette = $recetteRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($recette);
       // $em->flush();
        return new Response(0);
	}
}
