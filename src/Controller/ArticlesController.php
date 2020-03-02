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

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Assets\Response;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/articles")
 */
class ArticlesController extends AbstractController {

    /**
     * @Route("/")
     * @param ArticleRepository $articlesRepo
     * @return Response
     */
    public function index(ArticleRepository $articlesRepo): Response{
        $articles = $articlesRepo->findAll();
        return new Response(0, $articles);
    }

    /**
     * @Route("/view/{id}")
     * @param int               $id
     * @param ArticleRepository $articlesRepo
     * @return Response
     */
    public function view(int $id, ArticleRepository $articlesRepo): Response{
        $article = $articlesRepo->find($id);
        return new Response(0, $article);
    }

    /**
     * @Route("/home")
     * @param ArticleRepository $articleRepo
     * @return Response
     */
    public function home (ArticleRepository $articleRepo): Response{
        $articles = $articleRepo->findBy([], ['clap' => 'DESC'], 5);
        return new Response(0, $articles);
    }
}