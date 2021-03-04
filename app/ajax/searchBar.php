<?php
require("../models/Article.php");

$qArticle = new Article();

if (isset($_GET["q"])){
    $hint = $_GET["q"];
}

$qArticle->findAllArticlesWithHint($hint);

echo json_encode($qArticle);