<?php
include "./Page.php";
include "./RedPage.php";

$title = $_POST["title"];
$year = $_POST["year"];
$copyright = $_POST["copyright"];
$content = $_POST["content"];
$page_type = $_POST['page_type'];

switch ($page_type)
{
    case "Default":
        $page = new Page($title, $year, $copyright);
        break;
    case "Red":
        $page = new RedPage($title, $year, $copyright);
}

$page->addContent($content);

echo $page->get();