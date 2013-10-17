<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "remoteServices/PublishingHouseServiceManagerFactory.php";
require_once "helpers/DomBuilder.php";
require_once "helpers/Logger.php";

$method = mysql_real_escape_string($_SERVER['REQUEST_METHOD']);
$ip =mysql_real_escape_string($_SERVER["REMOTE_ADDR"]);
$uri = mysql_real_escape_string($_SERVER['REQUEST_URI']);
$userAgent= mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']);

Logger::logRequest($method,$uri,$ip,$userAgent);

switch ($method) {
    case 'GET':
        handleGetRequest($_GET);
        break;
    default:
        //ERROR;
        break;
}

function handleGetRequest($request)
{
    if (isset($request["categoria"]) && $request["categoria"]!="") {
        $livrariaServiceManager = PublishingHouseServiceManagerFactory::buildLivrariaServiceManager();
        $category = $request["categoria"];
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

    if (isset($request["numero"]) && ctype_digit($request["numero"])&& $request["numero"] > 0 ) {
        $limit = $request["numero"];
        //List the first N Books in each Publishing House
        $livrariaServiceManager = PublishingHouseServiceManagerFactory::buildLivrariaServiceManager();
        $books = $livrariaServiceManager->getBooks($limit);
        $dom = DomBuilder::createBooksDocument($books);
        echo $dom->saveXML();
        exit(0);
    }
}

?>