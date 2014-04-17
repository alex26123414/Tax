<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('..//databaseConnector.php');

        class incomeMapper {

            private static function create($line) {

                // Create new object
                $current = new incomeModel($line['idincome'], $line['name'], $line['idincome_type'], $line['idtax']);

                // Return object
                return $current;
            }

            public static function select($idincome) {

                // Get database connection
                $db = databaseConnector::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("SELECT * FROM income WHERE idincome=:idincome;");

                    // Bind SQL values
                    $pstmt->bindValue(':idincome', $idincome, PDO::PARAM_INT);

                    // Execute SQL query
                    $pstmt->execute();

                    $array = array();

                    // Fetch all results
                    $pstmt = $pstmt->fetchAll();

                    // Loop all results as lines
                    foreach ($pstmt as $line) {

                        // Add current object to array
                        $array[$line['idincome']] = self::create($line);
                    }
                } catch (PDOException $e) {
                    
                }

                return $array;
            }

            /* -------------------------------------------------------------------------------------------------------------- */

            public static function updateDetails($income) {

                // Get database connection
                $db = Database::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("UPDATE income SET idincome=:idincome, `name`=:income_name, idincome_type=:idincome_type, idtax=:idtax WHERE idincome=:idincome_type;");

                    // Bind SQL values
                    $pstmt->bindValue(':idincome_type', $income->getIdincome(), PDO::PARAM_INT);
                    $pstmt->bindValue(':income_name', $income->getName(), PDO::PARAM_INT);
                    $pstmt->bindValue(':idincome_type', $income->getIdincome_type(), PDO::PARAM_INT);
                    $pstmt->bindValue(':idtax', $income->getIdtax(), PDO::PARAM_INT);
                    // Execute SQL query
                    $pstmt->execute();



                    // Update the current session
                    if ($_SESSION['income']->getIdincome() == $income->getIdincome()) {
                        $_SESSION['income'] = $income;
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
