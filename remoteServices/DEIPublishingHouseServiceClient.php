<?php
/**
 * User: Francisco Moreira
 * Date: 16-10-2013
 * Time: 15:48
 */
require_once "remoteServices/IPublishingHouseServiceClient.php";
require_once "model/Category.php";
require_once "model/Book.php";

class DEIPublishingHouseServiceClient implements IPublishingHouseServiceClient
{

    private $host;
    private $path;

    function __construct($name,$path)
    {
        $this->host = $path;
        $this->path = $name;
    }

    function getCategories()
    {
        $url =  $this->host . "?categoria=todas";

        try {
            $dom = $this->getDocumentFromUrl($url);
        } catch (Exception $e) {
            return array();
        }
        $categoryNodeList = $dom->getElementsByTagName('categoria');

        return $this->parseCategories($categoryNodeList);
    }

    function getBooks($limit)
    {
        //Build url

        $url = $this->host . "?numero=$limit";

        //Generate array of books from DOM Document
        try {
            $dom = $this->getDocumentFromUrl($url);
        } catch (Exception $e) {
            return array();
        }
        $bookNodeList = $dom->getElementsByTagName('book');

        //parse and return an array of books
        return $this->parseBooks($bookNodeList);
    }

    function getBooksbyCategory($category)
    {
        //Build url
        $url = $this->host . "?categoria=$category";

        //Generate array of books from DOM Document
        try {
            $dom = $this->getDocumentFromUrl($url);
        } catch (Exception $e) {
            return array();
        }
        $bookNodeList = $dom->getElementsByTagName('book');

        //parse and return an array of books
        return $this->parseBooks($bookNodeList);
    }

    private function parseCategories($categoryNodeList)
    {
        foreach ($categoryNodeList as $categoryElement) {
            $categoryArray[] = new Category($categoryElement->nodeValue);
        }
        return $categoryArray;
    }

    private function parseBooks($bookNodeList)
    {
        foreach ($bookNodeList as $bookElement) {
            $title = $bookElement->childNodes->item(0)->nodeValue;
            $author = $bookElement->childNodes->item(1)->nodeValue;
            $category = $bookElement->childNodes->item(2)->nodeValue;
            $isbn = $bookElement->childNodes->item(3)->nodeValue;
            $publicacao = $bookElement->childNodes->item(4)->nodeValue;
            $news = $bookElement->childNodes->item(5)->nodeValue;

            $bookArray[] = new Book($title, $author, $category, $isbn, $publicacao, $news, $this->path);
        }
        return $bookArray;
    }

    private function getDocumentFromUrl($url)
    {

        $XMLResponse = file_get_contents($url);
        if ($XMLResponse === FALSE) {
            throw new Exception('Error retriving content from remote api');
        }
        $dom = new DOMDocument();

        /*
         FIXME Temporary Fix for bug in api
         No root element and text encoding not in UTF-8
         Only when returning books
       */
        // echo $url . "\n" . $XMLResponse . "\n********************\n";
        $success = $dom->loadXML("<root>" . utf8_encode($XMLResponse) . "</root>");

        if (!$success) {
            throw new Exception('Error while loading XML from remote API');
        }

        return $dom;
    }


}