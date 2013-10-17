<?php
/**
 * Created by:
 * User: Francisco Moreira
 * Date: 17-10-2013
 * Time: 16:30
 */
class Logger
{

    static function logRequest($method, $url, $ip, $userAgent)
    {

        $mysqlConfig=require("config/mysql.php");

        $conn = mysql_connect($mysqlConfig["host"], $mysqlConfig["user"], $mysqlConfig["pass"]);
        if (!$conn) {
            //Could not connect to database
            //TODO log to file or mail
            return;
        }

        if (!mysql_select_db($mysqlConfig["dbname"], $conn)) {
            //Could not connect to database
            //TODO log to file or mail
            mysql_close();
            return;
        }
        $tablename = $mysqlConfig["tablename"];


        $sql = "INSERT INTO $tablename ( Method, Url, Ip, User_agent )
        VALUES('$method','$url', '$ip', '$userAgent')";

        if (!mysql_query($sql, $conn)) {
            //Could not insert - maybe table is not created
            echo mysql_error();

            $createTable ="
            CREATE TABLE IF NOT EXISTS request_log (
            ID int(11) NOT NULL auto_increment,
            Method varchar(10) NOT NULL,
            Url varchar(100) NOT NULL,
            Ip varchar(15) NOT NULL,
            User_agent varchar(300) NOT NULL,
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (ID)
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
            ";

          if (!mysql_query($createTable, $conn)){
          //Could not create table
              mysql_close();
          return;
          }
          //Run insert again
          mysql_query($sql,$conn);
        }
        mysql_close();
    }
}