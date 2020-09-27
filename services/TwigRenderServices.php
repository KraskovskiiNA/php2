<?php
namespace app\services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderServices implements RenderI
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader([dirname(__DIR__) . '/views/layouts', dirname(__DIR__) . '/views/']);
        $this->twig = new Environment($loader);
    }

    public function render($template, $params = [])
    {
        $template .= '.twig';
        return $this->twig->render($template, $params);
    }
}