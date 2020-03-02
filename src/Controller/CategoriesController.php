<?php
/**
 * Copyright lesson
 * author: Victor FAU
 * contact: victrrfau@gmail.com
 */

/**
 * editor : victor fau
 * contact : victorrfau@gmail.com
 * context : school
 */

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Assets\Response;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/categories")
 */
class CategoriesController extends AbstractController {

    /**
     * @Route("/")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository): Response{
        $categories = $categoryRepository->findAll();
        return new Response(0, $categories);
    }

    /**
     * @Route("/view/{id}")
     * @param int               $id
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function view(int $id, CategoryRepository $categoryRepository): Response{
        $categoy = $categoryRepository->find($id);
        return new Response(0, $categoy);
    }
}