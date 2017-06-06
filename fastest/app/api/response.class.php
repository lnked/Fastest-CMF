<?php declare(strict_types = 1);

class Response extends API
{
    use Singleton, Tools;

    public function __construct ()
    {
    }

    public function json ()
    {
        // header('Content-Type: application/json');
        return response('Hello World', 200)
                  ->header('Content-Type', 'text/plain');
        return response($content)
            ->header('Content-Type', $type)
            ->header('X-Header-One', 'Header Value')
            ->header('X-Header-Two', 'Header Value');

        return response($content)
                ->header('Content-Type', $type)
                ->cookie('name', 'value', $minutes);


        // raw content
        $response->content();

        // in case of json
        $response->json();

        // XML
        $response->xml();

    }

    public function xml ()
    {
    }

    public function array ()
    {
    }

    public function object ()
    {
    }

}