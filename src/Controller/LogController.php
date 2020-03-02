<?php
/**
 * Copyright lesson
 * author: Victor FAU
 * contact: victrrfau@gmail.com
 */

namespace App\Controller;

use ErrorException;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Assets\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class LogController
 * @package App\Controller
 * @Route("/")
 */
class LogController extends AbstractController {

    /**
     * @Route("/login", methods={"POST"})
     * @param Request         $request
     * @param UsersRepository $usersRepository
     * @return Response
     * @throws \Exception
     */
    public function login (Request $request, UsersRepository $usersRepository, SessionInterface $session): Response{
        $login = $request->request->get('login', null);
        $password = $request->request->get('password', null);
        if($login === null || $password === null){
            return new Response(8);
        }
        $user = $usersRepository->findBy(['email' => $login]);
        if(count($user) === 0){
            return new Response(2);
        }
        if(count($user) > 1){
            return new Response(49);
        }
        if($user[0]->getPassword() !== $password){
            return new Response(2);
        }
        $user[0]->setToken(rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '='));

        return new Response(0, $user[0]);
    }

    /**
     * @Route("/logout")
     * @param SessionInterface $session
     * @return Response
     */
    public function lougout (SessionInterface $session){
        $session->clear();
        return new Response(0);
    }

}