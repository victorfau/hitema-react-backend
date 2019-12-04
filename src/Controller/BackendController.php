<?php


namespace App\Controller;


use App\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackendController extends AbstractController {
    public function __construct (EventDispatcherInterface $dispatcher){
        $dispatcher->dispatch((object)Events::USER_CONNECTED);
    }
}