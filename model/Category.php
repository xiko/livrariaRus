<?php
/**
 * Created by JetBrains PhpStorm.
 * User: go
 * Date: 16-10-2013
 * Time: 15:49
 * To change this template use File | Settings | File Templates.
 */

class Category {

    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function __toString()
    {
     return $this->name;
    }


}