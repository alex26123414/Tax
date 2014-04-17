<?php

require_once('../annual_statement/mappers/personMapper.php');
require_once('../annual_statement/models/personModel.php');
require_once('../annual_statement/controllers/personController.php');
require_once('../annual_statement/mappers/incomeInfoMapper.php');
require_once('../annual_statement/models/incomeInfoModel.php');
require_once('../annual_statement/controllers/incomeInfoController.php');

class personController {

    public static function cache() {

        // Cache all annualStatements on construct
        self::getAllPersons();
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Cache
    private static $persons;

    /* -------------------------------------------------------------------------------------------------------------- */

    public static function getPerson($cpr) {

        // If all annualStatements are cached
        if (isset(self::$persons)) {

            // Return the specific annualStatements
            return self::$persons[$cpr];
        } else {

            // Get the selected annualStatements from the database
            $scenario = personMapper::select($cpr);

            // Return the results
            return $scenario;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
}

?>