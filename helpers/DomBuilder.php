<?php
/**
 * Created by:
 * User: Francisco Moreira 
 * Date: 16-10-2013
 * Time: 17:09
 */

class DomBuilder {

    public static function createCategoriesDocument(Array $categories){
        $dom = new DOMDocument('1.0');
        $dom->formatOutput = true;

        $root = $dom->createElement('categories');
        $root = $dom->appendChild($root);

        foreach($categories as $category){
            $categoryElement = $dom->createElement('category');
            $root->appendChild($categoryElement);
            $text = $dom->createTextNode($category->name);
            $text = $categoryElement->appendChild($text);
        }
        return $dom;
    }

    public static function createBooksDocument(Array $books){
        $dom = new DOMDocument('1.0');
        $dom->formatOutput = true;

        $root = $dom->createElement('books');
        $root = $dom->appendChild($root);

        foreach($books as $book){
            $bookElement = $dom->createElement('book');
            $root->appendChild($bookElement);

            $titleElement = $dom->createElement('title');
            $root->appendChild($titleElement);
            $text = $dom->createTextNode($book->title);
            $titleElement->appendChild($text);

            $authorElement = $dom->createElement('author');
            $root->appendChild($authorElement);
            $text = $dom->createTextNode($book->author);
            $authorElement->appendChild($text);

            $categoryElement = $dom->createElement('category');
            $root->appendChild($categoryElement);
            $text = $dom->createTextNode($book->category);
            $categoryElement->appendChild($text);

            $isbnElement = $dom->createElement('isbn');
            $root->appendChild($isbnElement);
            $text = $dom->createTextNode($book->isbn);
            $isbnElement->appendChild($text);

            $publicationElement = $dom->createElement('publication_year');
            $root->appendChild($publicationElement);
            $text = $dom->createTextNode($book->publicationYear);
            $publicationElement->appendChild($text);

            $newsElement = $dom->createElement('news');
            $root->appendChild($newsElement);
            $text = $dom->createTextNode($book->news);
            $newsElement->appendChild($text);

            $pbElement = $dom->createElement('publishing_house');
            $root->appendChild($pbElement);
            $text = $dom->createTextNode($book->publishingHouse);
            $pbElement->appendChild($text);
        }
        return $dom;
    }
}