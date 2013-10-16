<?php
require_once "remoteServices/PublishingHouseServiceManagerFactory.php";
require_once "helpers/DomBuilder.php";

if (isset($_GET["categoria"])) {
    $livrariaServiceManager = PublishingHouseServiceManagerFactory::buildLivrariaServiceManager();
    $category = $_GET["categoria"];
    if ($category === "todas") {

        //List Categories
        $categories = $livrariaServiceManager->getCategories();
        $dom = DomBuilder::createCategoriesDocument($categories);
        echo $dom->saveXML();
        exit(0);
    } else {

        //List Books in Category
        $books = $livrariaServiceManager->getBooksbyCategory($category);
        $dom = DomBuilder::createBooksDocument($books);
        echo $dom->saveXML();
        exit(0);
    }
}
if (isset($_GET["numero"])) {

    //List the first N Books in each Publishing House
    $livrariaServiceManager = PublishingHouseServiceManagerFactory::buildLivrariaServiceManager();
    $limit = $_GET["numero"];
    $books = $livrariaServiceManager->getBooks($limit);
    $dom = DomBuilder::createBooksDocument($books);
    echo $dom->saveXML();
    exit(0);
}

?>