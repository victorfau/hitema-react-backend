<?php
/**
 * Copyright lesson
 * author: Victor FAU
 * contact: victrrfau@gmail.com
 */

namespace App\Controller;

use App\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController {
    public function __construct (EventDispatcherInterface $dispatcher){
        $dispatcher->dispatch((object)Events::USER_CONNECTED);
    }
}