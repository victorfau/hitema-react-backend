<?php


namespace App\Controller;


use App\Assets\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\Routing\Annotation\Route,
    App\Entity\Users,
    App\Repository\UsersRepository;

/**
 * Class LoginController
 * @package App\Controller
 * @Route("/test")
 */
class LoginController extends AbstractController {

    /**
     * @Route("/login", methods={"POST"})
     * @param Request          $request
     * @param SessionInterface $session
     * @param UsersRepository  $repository
     * @return Response
     */
    //todo faire le traitement du login mot de passe
    public function login (Request $request, SessionInterface $session, UsersRepository $repository): Response{
        $login    = $request->get('login', null);
        $password = $request->get('password', null);

        if($login === null || $password === null){
            return new Response(8);
        }

        $users = $repository->findBy(['email' => $login]);

        if(count($users) === 0){
            return new Response(1);
        }
        if(count($users) > 1){
            return new Response(49);
        }

        if(true){
            $session->start();
            $session->set('logged', true);
            $session->set('name', $users[0]->getName());
            $session->set('role', $users[0]->getRole());
            return new Response(0);
        }else{
            return new Response(2);
        }
    }

    /**
     * @Route("/logout")
     * @param SessionInterface $session
     * @return Response
     */
    public function logout (SessionInterface $session): Response{
        $session->clear();
        return new Response(0);
    }
}