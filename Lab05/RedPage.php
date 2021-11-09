<?php
require_once "./Page.php";

class RedPage extends Page
{
    public function addContent($content)
    {
        parent::addContent("<p style=\"color:red\">$content</p>\n");
    }
}