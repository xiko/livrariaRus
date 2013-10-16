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

    $livrariaServiceManager = new PublishingHouseServiceManager();

    $livrariaServiceManager->addServiceClient(
        new DEIPublishingHouseServiceClient(
            "http://phpdev2.dei.isep.ipp.pt/~arqsi/trabalho1/editora1.php",
            "Editora 1"
        )
    );

    $livrariaServiceManager->addServiceClient(
        new DEIPublishingHouseServiceClient(
            "http://phpdev2.dei.isep.ipp.pt/~arqsi/trabalho1/editora2.php",
            "Editora 2"
        )
    );

    return $livrariaServiceManager;
}
}