<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('..//databaseConnector.php');

        class annualStatementMapper {

            private static function create($line) {

                // Create new object
                $current = new annualStatementModel($line['cpr'], $line['first_name'], $line['last_name'], $line['address'], $line['e-mail'], $line['phone']);

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

            public static function updateDetails($annualStatement) {

                // Get database connection
                $db = Database::getConnection();

                // Create a new scenario


                try {

                    // Prepare SQL statement
                    $pstmt = $db->prepare("UPDATE tax SET cpr=:cpr, first_name=:first_name, last_name=:last_name, address=:address, email=:email, phone=:phone, date=:date, income_name=:income_name, income_value=:income_value, income_type_name=:income_type_name, income_type=:income_type, tax_value=:tax_value WHERE cpr=:cpr;");

                    // Bind SQL values
                    $pstmt->bindValue(':cpr', $annualStatement->getCpr(), PDO::PARAM_INT);
                    $pstmt->bindValue(':first_name', $annualStatement->first_name(), PDO::PARAM_INT);
                    $pstmt->bindValue(':last_name', $annualStatement->last_name(), PDO::PARAM_STR);
                    $pstmt->bindValue(':address', $annualStatement->getAddress(), PDO::PARAM_STR);
                    $pstmt->bindValue(':email', $annualStatement->getEmail(), PDO::PARAM_STR);
                    $pstmt->bindValue(':phone', $annualStatement->getphone(), PDO::PARAM_STR);
                    $pstmt->bindValue(':date', $annualStatement->getDate(), PDO::PARAM_STR);
                    $pstmt->bindValue(':income_name', $annualStatement->getEmail(), PDO::PARAM_STR);
                    $pstmt->bindValue(':income_value', $annualStatement->getEmail(), PDO::PARAM_INT);
                    $pstmt->bindValue(':income_type_name', $annualStatement->getIncome_type_name(), PDO::PARAM_STR);
                    $pstmt->bindValue(':income_type', $annualStatement->getIncome_type(), PDO::PARAM_STR);
                    $pstmt->bindValue(':tax_value', $annualStatement->getTax_value(), PDO::PARAM_INT);
                    // Execute SQL query
                    $pstmt->execute();



                    // Update the current session
                    if ($_SESSION['annualStatement']->getCpr() == $annualStatement->getCpr()) {
                        $_SESSION['annualStatement'] = $annualStatement;
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
