<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('..//databaseConnector.php');

        class personMapper {

            private static function create($line) {

                // Create new object
                $current = new personModel($line['cpr'], $line['first_name'], $line['last_name'], $line['address'], $line['e-mail'], $line['phone'], $line['partner_cpr']);

                // Return object
                return $current;
            }

            public static function select($cpr) {

                // Get database connection
                $db = databaseConnector::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("SELECT * FROM person WHERE cpr=:cpr;");

                    // Bind SQL values
                    $pstmt->bindValue(':cpr', $cpr, PDO::PARAM_INT);

                    // Execute SQL query
                    $pstmt->execute();

                    $array = array();

                    // Fetch all results
                    $pstmt = $pstmt->fetchAll();

                    // Loop all results as lines
                    foreach ($pstmt as $line) {

                        // Add current object to array
                        $array[$line['cpr']] = self::create($line);
                    }
                } catch (PDOException $e) {
                    
                }

                return $array;
            }

            /* -------------------------------------------------------------------------------------------------------------- */

            public static function updateDetails($persons) {

                // Get database connection
                $db = Database::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("UPDATE tax SET cpr=:cpr, first_name=:first_name, last_name=:last_name, address=:address, email=:email, phone=:phone WHERE cpr=:cpr;");

                    // Bind SQL values
                    $pstmt->bindValue(':cpr', $person->getCpr(), PDO::PARAM_INT);
                    $pstmt->bindValue(':first_name', $person->first_name(), PDO::PARAM_INT);
                    $pstmt->bindValue(':last_name', $person->last_name(), PDO::PARAM_STR);
                    $pstmt->bindValue(':address', $person->getAddress(), PDO::PARAM_STR);
                    $pstmt->bindValue(':email', $person->getEmail(), PDO::PARAM_STR);
                    $pstmt->bindValue(':phone', $person->getphone(), PDO::PARAM_STR);

                    // Execute SQL query
                    $pstmt->execute();



                    // Update the current session
                    if ($_SESSION['person']->getCpr() == $person->getCpr()) {
                        $_SESSION['person'] = $person;
                    }
                } catch (PDOException $e) {
                    echo '' . $e;
                }
            }

            /* -------------------------------------------------------------------------------------------------------------- */
        }
        ?>

    </body>
</html>
