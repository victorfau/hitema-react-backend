<?php
/**
 * editor : victor fau
 * contact : victorrfau@gmail.com
 * context : school
 */

namespace App\EventSubscriber;

use App\Events;
use Symfony\Component\HttpFoundation\Request;
use App\Assets\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Controller\AdminController;
use App\Repository\UsersRepository;

class ControllerMountEvent implements EventSubscriberInterface {

    private $session;
    private $request;

    public function __construct (SessionInterface $session){
        $this->session = $session;
    }

    public static function getSubscribedEvents (): array{

        return array(KernelEvents::CONTROLLER => 'onCheckSession',);
    }

    /**
     * @param ControllerEvent $event
     */
    public function onCheckSession (ControllerEvent $event): void{
        $controller = $event->getController();
        $request = $request = Request::createFromGlobals();
        $token = $request->headers->get('Authorization');
        if(!is_array($controller)){
            return;
        }
        if($controller[0] instanceof AdminController){
            if(!isset($token) && ($_ENV['APP_ENV'] !== 'prod')){
                $event->setController(static function()
                {
                    return new Response(3);
                });
            }
        }
    }

}
