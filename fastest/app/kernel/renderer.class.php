<?php declare(strict_types = 1);

class Renderer
{
    protected $data = [];
    protected $strip = true;
    protected $template = null;
    protected $charset = 'utf-8';
    protected $extension = '.html';
    protected $template_dir = null;
}