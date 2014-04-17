<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('..//databaseConnector.php');

        class incomeTypeMapper {

            private static function create($line) {

                // Create new object
                $current = new incomeTypeModel($line['idincome_type'], $line['name']);

                // Return object
                return $current;
            }

            public static function select($idincome_type) {

                // Get database connection
                $db = databaseConnector::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("SELECT * FROM income_type WHERE idincome_type=:idincome_type;");

                    // Bind SQL values
                    $pstmt->bindValue(':idincome_type', $idincome_type, PDO::PARAM_INT);

                    // Execute SQL query
                    $pstmt->execute();

                    $array = array();

                    // Fetch all results
                    $pstmt = $pstmt->fetchAll();

                    // Loop all results as lines
                    foreach ($pstmt as $line) {

                        // Add current object to array
                        $array[$line['idincome_type']] = self::create($line);
                    }
                } catch (PDOException $e) {
                    
                }

                return $array;
            }

            /* -------------------------------------------------------------------------------------------------------------- */

            public static function updateDetails($income_type) {

                // Get database connection
                $db = Database::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("UPDATE income_type SET idincome_type=:idincome_type, `name`=:income_name WHERE idincome_type=:idincome_type;");

                    // Bind SQL values
                    $pstmt->bindValue(':idincome_type', $income_type->getIdincome_type(), PDO::PARAM_INT);
                    $pstmt->bindValue(':income_name', $income_type->getName(), PDO::PARAM_INT);
                    // Execute SQL query
                    $pstmt->execute();



                    // Update the current session
                    if ($_SESSION['income_type']->getIdincome_type() == $income_type->getIdincome_type()) {
                        $_SESSION['income_type'] = $income_type;
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
