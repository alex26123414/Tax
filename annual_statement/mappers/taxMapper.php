<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('..//databaseConnector.php');

        class taxMapper {

            private static function create($line) {

                // Create new object
                $current = new taxModel($line['idtax'], $line['value']);

                // Return object
                return $current;
            }

            public static function select($idtax) {

                // Get database connection
                $db = databaseConnector::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("SELECT * FROM tax WHERE idtax=:idtax;");

                    // Bind SQL values
                    $pstmt->bindValue(':idtax', $idtax, PDO::PARAM_INT);

                    // Execute SQL query
                    $pstmt->execute();

                    $array = array();

                    // Fetch all results
                    $pstmt = $pstmt->fetchAll();

                    // Loop all results as lines
                    foreach ($pstmt as $line) {

                        // Add current object to array
                        $array[$line['idtax']] = self::create($line);
                    }
                } catch (PDOException $e) {
                    
                }

                return $array;
            }

            /* -------------------------------------------------------------------------------------------------------------- */

            public static function updateDetails($tax) {

                // Get database connection
                $db = Database::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("UPDATE tax SET idtax=:idtax, `value`=:val WHERE idtax=:idtax;");

                    // Bind SQL values
                    $pstmt->bindValue(':idtax', $tax->getIdtax(), PDO::PARAM_INT);
                    $pstmt->bindValue(':val', $tax->getValue(), PDO::PARAM_INT);
                    // Execute SQL query
                    $pstmt->execute();



                    // Update the current session
                    if ($_SESSION['tax']->getIdtax() == $tax->getIdtax()) {
                        $_SESSION['tax'] = $tax;
                    }
                } catch (PDOException $e) {
                    echo ''.$e;
                }
            }

            /* -------------------------------------------------------------------------------------------------------------- */
        }
        ?>

    </body>
</html>
