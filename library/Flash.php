<?php

namespace Library;

class Flash
{

    public static function set(string $type, string $message)
    {
        $session = Session::getInstance();
        $session->set('flash', ['type' => $type, 'message' => $message]);
    }

    public static function get(): array
    {
        $session = Session::getInstance();
        if ($session->get('flash')) {
            $flash = $session->get('flash');
            $session->delete('flash');
            return $flash;
        } else return [];
    }

    public static function cancel(): void
    {
        $session = Session::getInstance();
        $session->delete('flash');
    }
}
