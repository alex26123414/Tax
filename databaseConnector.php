<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        class databaseConnector {

            private static $db;

            public static function getConnection() {

                // Set login information and settings
                $username = "root";
                $password = "";
                $hostname = "localhost";
                $name = "skat";

                $char = 'utf8';

                // Create a connection if it has not yet been established
                if (!isset(self::$db)) {
                    try {

                        // Create settings
                        $settings = 'mysql:host=' . $hostname . ';dbname=' . $name . ';charset=' . $char;

                        // Create PDO connection
                        self::$db = new PDO($settings, $username, $password, /* Force: UTF-8 */ array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                        // Connection type: Persistent (keeps the connection alive)
                        self::$db->setAttribute(PDO::ATTR_PERSISTENT, TRUE);

                        // Error reporting: Throw exceptions
                        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Case: Leaves column names as returned by the database driver
                        self::$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
                    } catch (PDOException $e) {

                        // In case of connection fail
                        // Print error message
                        $message = $e->getMessage();
                        echo '<pre>' . $message . '</pre>';

                        // Stop everything (kill switch)
                        die();

                        // Return false because the connection failed
                        return FALSE;
                    }
                }

                // Return the connection
                return self::$db;
            }

            public static function closeConnection() {

                // Close the current connection
                self::$db = NULL;
            }

        }

//        $username = "root";
//        $password = "";
//        $hostname = "localhost";
//
//
//        //connection to the database
//        $dbhandle = mysql_connect($hostname, $username, $password)
//                or die("Unable to connect to MySQL");
//        echo "Connected to MySQL<br>";
//
//        //select a database to work with
//        $selected = mysql_select_db("skat", $dbhandle)
//                or die("Could not select examples");
//
//        //execute the SQL query and return records
//        $result = mysql_query("SELECT * FROM tax");
//        while ($row = mysql_fetch_array($result)) {
//            echo "idtax: " . $row['idtax'] . " value: " . $row['value'];
//            echo "<br>";
//        }
//
//        //close the connection
//        mysql_close($dbhandle);
        ?>
    </body>
</html>
