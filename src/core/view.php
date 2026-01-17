<?php

namespace App\core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static $twig = null;

    public static function render(string $template, array $data = []): void
    {
        if (self::$twig === null) {
            $loader = new FilesystemLoader(__DIR__ . '/../../views');
            self::$twig = new Environment($loader);
        }

        echo self::$twig->render($template, $data);
    }
}