<?php

require_once('../annual_statement/annualStatementMapper.php');
require_once('../annual_statement/annualStatementModel.php');

class annualStatementController {

    public static function cache() {

        // Cache all annualStatements on construct
        self::getAllAnnualStatements();
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Cache
    private static $annualStatements;

    /* -------------------------------------------------------------------------------------------------------------- */

    public static function getAnnualStatement($cpr) {

        // If all annualStatements are cached
        if (isset(self::$annualStatements)) {

            // Return the specific annualStatements
            return self::$annualStatements[$cpr];
        } else {

            // Get the selected annualStatements from the database
            $scenario = annualStatementMapper::select($cpr);

            // Return the results
            return $scenario;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
}

?>