<?php
/**
 * Created by:
 * User: Francisco Moreira 
 * Date: 16-10-2013
 * Time: 16:23
 */

require "remoteServices/PublishingHouseServiceManager.php";
require "remoteServices/DEIPublishingHouseServiceClient.php";

class PublishingHouseServiceManagerFactory {

static function buildLivrariaServiceManager(){

    $publishingHouseServiceManager = new PublishingHouseServiceManager();

    //Import configuration
    $config = require("config/RemoteService.php");

    //Add DEIPublishingHouseServiceClient objects to PublishingHouseManager
    $deiConfig = $config["DEI"];
    foreach($deiConfig as $name => $path )
    {
    $publishingHouseServiceManager->addServiceClient(
        new DEIPublishingHouseServiceClient($name,$path)
    );
    }

    return $publishingHouseServiceManager;
}
}