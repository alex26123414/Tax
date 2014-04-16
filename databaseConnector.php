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
        $username = "root";
        $password = "";
        $hostname = "localhost";


        //connection to the database
        $dbhandle = mysql_connect($hostname, $username, $password)
                or die("Unable to connect to MySQL");
        echo "Connected to MySQL<br>";

        //select a database to work with
        $selected = mysql_select_db("skat", $dbhandle)
                or die("Could not select examples");

        //execute the SQL query and return records
        $result = mysql_query("SELECT * FROM tax");
        while ($row = mysql_fetch_array($result)) {
            echo "idtax: " . $row['idtax'] . " value: " . $row['value'];
            echo "<br>";
        }

        //close the connection
        mysql_close($dbhandle);
        ?>
    </body>
</html>
