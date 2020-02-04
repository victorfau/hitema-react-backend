<?php
/**
 * editor : victor fau
 * contact : victorrfau@gmail.com
 * context : school
 */

namespace App\Controller;

use http\Client\Curl\User;
use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Assets\Response;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/users")
 */
class UsersController extends AbstractController {

    /**
     * @Route("/")
     * @param UsersRepository $usersRepo
     * @return Response
     */
    public function index(UsersRepository $usersRepo): Response{
        $users = $usersRepo->findAll();
        return new Response(0, $users);
    }

    /**
     * @Route("/view/{id}")
     * @param int             $id
     * @param UsersRepository $usersRepo
     * @return Response
     */
    public function view(int $id, UsersRepository $usersRepo): Response{
        $user = $usersRepo->find($id);
        return new Response(0, $user);
    }
}