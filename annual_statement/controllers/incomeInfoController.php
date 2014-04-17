<?php

require_once('../annual_statement/mappers/personMapper.php');
require_once('../annual_statement/models/personModel.php');
require_once('../annual_statement/controllers/personController.php');
require_once('../annual_statement/mappers/incomeInfoMapper.php');
require_once('../annual_statement/models/incomeInfoModel.php');
require_once('../annual_statement/controllers/incomeInfoController.php');

class incomeInfoController {

    public static function cache() {

        // Cache all annualStatements on construct
        self::getAllIncomeInfos();
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Cache
    private static $incomeInfos;

    /* -------------------------------------------------------------------------------------------------------------- */

    public static function getIncomeInfo($cpr) {

        // If all annualStatements are cached
        if (isset(self::$incomeInfos)) {

            // Return the specific annualStatements
            return self::$incomeInfos[$cpr];
        } else {

            // Get the selected annualStatements from the database
            $scenario = incomeInfoMapper::select($cpr);

            // Return the results
            return $scenario;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
}

?>