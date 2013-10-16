<?php

require_once "model/Category.php";
require_once "remoteServices/IPublishingHouseServiceClient.php";

class PublishingHouseServiceManager implements IPublishingHouseServiceClient{

    private $publishingHouseServiceClients;

    function getCategories(){
        $categories = array();
        foreach($this->publishingHouseServiceClients as $livrariaServiceClient){
           $tempCategories = $livrariaServiceClient->getCategories();
            $categories = array_merge($categories,$tempCategories);
        }
        return array_unique($categories);
    }

    function addServiceClient(IPublishingHouseServiceClient $livrariaServiceClient){
        $this->publishingHouseServiceClients[]=$livrariaServiceClient;
    }

    function getBooks($limit)
    {
        $books = array();
        foreach($this->publishingHouseServiceClients as $livrariaServiceClient){
            $tempBooks = $livrariaServiceClient->getBooks($limit);
            $books = array_merge($books,$tempBooks);
        }
        return $books;
    }

    function getBooksbyCategory($category)
    {
        $books = array();
        $tempBooks = array();
        foreach($this->publishingHouseServiceClients as $livrariaServiceClient){
            $tempBooks = $livrariaServiceClient->getBooksbyCategory($category);
            $books = array_merge($books,$tempBooks);
        }
        return $books;
    }


}