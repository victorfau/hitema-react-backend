<?php /** @noinspection ALL */


namespace App\Controller;


use App\Assets\Response;
use App\Entity\Category;
use App\Entity\Recette;
use App\Repository\CategoryRepository;
use App\Repository\RecetteRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController {

	/**
	 * @Route("/")
	 * @param CategoryRepository $category
	 * @return Response
	 */
	public function index(CategoryRepository $category){
		$categories = $category->findAll();

		return new Response(0, $categories);
	}

    /**
     * @Route("/view/{id}")
     * @param $id
     */
    public function view ($id, CategoryRepository $category, RecetteRepository $recette){
        $categories = $category->find($id);
        $recettesTable = $categories->getRecettes();
        $recettes = $recettesTable->toArray();

        if($categories == null){
            return new Response(15);
        }

        $response = [
            'categories' => $categories,
            'recettes'   => $recettes
        ];

        return new Response(0, $response);
	}


	// todo fare gaffe quand il y aura les element.

    /**
     * @Route("/delete/{id}")
     */
    public function delete (CategoryRepository $categoryRepository, $id){
        $category = $categoryRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return new Response(0);
    }

    /**
     * @Route("/edit/{id}", methods="POST", name="category_edit")
     * @param CategoryRepository $categoryRepository
     * @param                    $id
     * @param Request            $request
     */
    public function edit (CategoryRepository $categoryRepository, $id, Request $request){
        //todo erreur

        $name = $request->get('name', null);

        if($name === null OR empty($name)){
            return new Response(8);
        }
        if(sizeof($categoryRepository->findBy(["name" => $name])) > 0){
            return new Response(10);
        };

        $category = $categoryRepository->find($id);
        $category->setName($name);
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();


        return new Response(0);
    }

	/**
	 * @Route("/add", methods={"POST"})
	 * @param CategoryRepository $categories
	 * @param Request $request
	 * @return Response
	 */
	public function add(CategoryRepository $categories, Request $request){

		$name = $request->get('name', null);

		if(sizeof($categories->findBy(["name" => $name])) > 0){
			return new Response(10);
		};

		$category = new Category();

		$category->setName($name);
		$em = $this->getDoctrine()->getManager();
		$em->persist($category);
		$em->flush();

		$response = $categories->findBy(["name" => $name]);

		return new Response(0, $response);
	}

	// todo supprimer une category

	/**
	 * @Route("/add/recette")
	 * @param CategoryRepository $category
	 * @param RecetteRepository $recette
	 * @param Request $request
	 * @return Response
	 */
	public function addRecette(CategoryRepository $category, RecetteRepository $recette, Request $request){
		$idCat = $request->get('category', null);
		$idRecette = $request->get('recette', null);

		if($recette->find($idRecette) == null OR $category->find($idCat) == null){
			return new Response(15);
		}
		$categorie = $category->find($idCat);
		$recettes = $recette->find($idRecette);

		$recettes->addRelation($categorie);
		$em = $this->getDoctrine()->getManager();
		$em->persist($recettes);
		$em->flush();
		return new Response(0);
	}
	/**
	 * @Route("/remove/recette")
	 * @param CategoryRepository $category
	 * @param RecetteRepository $recette
	 * @param Request $request
	 * @return Response
	 */
	public function removeRecette(CategoryRepository $category, RecetteRepository $recette, Request $request){
		$idCat = $request->get('category', null);
		$idRecette = $request->get('recette', null);

		if($recette->find($idRecette) == null OR $category->find($idCat) == null){
			return new Response(15);
		}
		$categorie = $category->find($idCat);
		$recettes = $recette->find($idRecette);

		$recettes->removeRelation($categorie);
		$em = $this->getDoctrine()->getManager();
		$em->persist($recettes);
		$em->flush();
		return new Response(0);
	}
}
