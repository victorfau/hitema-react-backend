<?php
/**
 * editor : victor fau
 * contact : victorrfau@gmail.com
 * context : school
 */

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Assets\Response;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/users")
 */
class UsersController extends AbstractController {

    /**
     * @Route("/listAll")
     * @param UsersRepository $usersRepo
     * @return Response
     */
    public function index(UsersRepository $usersRepo): Response{
        $users = $usersRepo->findAll();
        return new Response(0, $users);
    }
}