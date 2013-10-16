<?php
/**
 * Created by:
 * User: Francisco Moreira 
 * Date: 16-10-2013
 * Time: 17:31
 */

class Book {

    public $title;
    public $author;
    public $category;
    public $isbn;
    public $publicationYear;
    public $news;
    public $publishingHouse;

    function __construct($title , $author, $category, $isbn,$publicationYear, $news,$publishingHouse)
    {
        $this->publicationYear = $publicationYear;
        $this->author = $author;
        $this->category = $category;
        $this->isbn = $isbn;
        $this->news = $news;
        $this->title = $title;
        $this->publishingHouse = $publishingHouse;
    }

    function __toString()
    {
     return $this->title." ".$this->author." ".$this->category." ".
            $this->isbn." ".$this->news;
    }


}