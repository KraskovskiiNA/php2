<?php
namespace app\services;

class RenderServices implements RenderI
{
    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        $title = 'My shop';
        if (!empty($params['title'])) {
            $title = $params[$title];
        }
        return $this->renderTmpl('layouts/main', ['content' => $content, 'title' => $title]);
    }

    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}