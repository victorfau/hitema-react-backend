<?php
/**
 * editor : victor fau
 * contact : victorrfau@gmail.com
 * context : school
 */

namespace App;

final class Events {

    /**
     * For the event naming conventions, see:
     * https://symfony.com/doc/current/components/event_dispatcher.html#naming-conventions.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    const USER_CONNECTED = 'user.isConnected';
}