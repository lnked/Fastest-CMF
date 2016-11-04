<?php declare(strict_types = 1);

class Renderer
{
    protected $data = [];
    protected $template = null;
    protected $strip = true;
    protected $charset = 'utf-8';
    protected $template_dir = null;
}