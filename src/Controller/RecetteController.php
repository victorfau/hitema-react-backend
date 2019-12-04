<?php


namespace App\Controller;

use App\Assets\Response;
use App\Entity\Recette;
use App\Repository\CategoryRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BackendController;

/**
 * @Route("/recette")
 */
class RecetteController extends BackendController {

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
	public function add(Request $request, RecetteRepository $recettes, EntityManagerInterface $em){

		$name = $request->get("name", null);
		$ingrediants = $request->get("ingrediants", null);
		$duree = $request->get("duree", null);
		$recette = $request->get("recette", null);
		$img = $request->get('img', null);

		if ($name == null OR $ingrediants == null OR $duree == null OR $recette == null){
			return new Response(8);
		}

		if($recettes->findBy(['name' => $name])){
			return new Response(10);
		}

		$newRecette = new Recette();

		$newRecette->setName($name);
		$newRecette->setIngediants($ingrediants);
		$newRecette->setDuree($duree);
		$newRecette->setRecette($recette);
		$newRecette->setImg($img);

        $em->persist($newRecette);
        $em->flush();

		return new Response(0);
	}

    /**
     * @Route("/delete/{id}")
     * @param RecetteRepository      $recetteRepository
     * @param EntityManagerInterface $em
     * @param                        $id
     * @return Response
     */
    public function delete (RecetteRepository $recetteRepository, EntityManagerInterface $em, $id){
        $recette = $recetteRepository->find($id);
        $em->remove($recette);
        $em->flush();
        return new Response(0);
	}

    /**
     * @Route("/edit/{id}")
     * @param                        $id
     * @param RecetteRepository      $recetteRepository
     * @param CategoryRepository     $categoryRepository
     * @param EntityManagerInterface $em
     * @param Request                $request
     * @return Response
     */
    public function edit ($id, RecetteRepository $recetteRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em, Request $request){

        if($request->getMethod() === 'POST'){
            $name       = $request->get('name', null);
            $duree      = $request->get('duree', null);
            $ingrediant = $request->get('ingrediant', null);
            $recette    = $request->get('recette', null);
            $img        = $request->get('img', null);

            if($name === null OR empty($name)){
                return new Response(8);
            }
            if(count($recetteRepository->findBy(['name' => $name])) > 0){
                return new Response(10);
            }


            $newRecette = $recetteRepository->find($id);
            $newRecette->setName($name);
            $newRecette->setDuree($duree);
            $newRecette->setIngediants($ingrediant);
            $newRecette->setRecette($recette);
            $newRecette->setImg($img);
            $em->persist($newRecette);
            $em->flush();

            return new Response(0);
        }

        $recette = $recetteRepository->find($id);
        $listCategory = $categoryRepository->findAll();

        $response = [
            'recette' => $recette,
            'listCategory' => $listCategory
        ];

        return new Response(0, $response);

	}
}
