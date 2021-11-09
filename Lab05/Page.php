<?php

class Page
{
    protected $page;
    protected $title;
    protected $year;
    protected $copyright;

    function __construct($title, $year, $copyright)
    {
        $this->page = "";
        $this->title = $title;
        $this->year = $year;
        $this->copyright = $copyright;
    }

    public function addContent($content)
    {
        $this->page = $this->page . $content;
    }

    private function addHeadder($header)
    {
        $this->title = $header;
    }

    private function addFooter($footer)
    {

    }

    public function get()
    {
        return
            "<!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title> $this->title</title>
            </head>
            <body>
            <header>
                <h1>{$this->title}</h1>
            </header>
                {$this->page}
            <footer>
                <p>{$this->copyright} © {$this->year} All rights reserved</p>
            </footer>
            </body>
            </html>";
    }
}