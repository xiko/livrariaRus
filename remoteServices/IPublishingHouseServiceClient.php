<?php
/**
 * Created by JetBrains PhpStorm.
 * User: go
 * Date: 16-10-2013
 * Time: 15:47
 * To change this template use File | Settings | File Templates.
 */

interface IPublishingHouseServiceClient {

    function getCategories();
    function getBooks($limit);
    function getBooksbyCategory($category);

}