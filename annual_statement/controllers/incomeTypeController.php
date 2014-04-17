<?php

require_once('../annual_statement/mappers/incomeTypeMapper.php');
require_once('../annual_statement/models/incomeTypeModel.php');

class incomeTypeController {

    public static function cache() {

        // Cache all taxes on construct
        self::getAllIncomeTypes();
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Cache
    private static $incomeTypes;

    /* -------------------------------------------------------------------------------------------------------------- */

    public static function getIncomeType($idincome_type) {

        // If all taxes are cached
        if (isset(self::$incomeTypes)) {

            // Return the specific tax
            return self::$incomeTypes[$idincome_type];
        } else {

            // Get the selected annualStatements from the database
            $scenario = incomeTypeMapper::select($idincome_type);

            // Return the results
            return $scenario;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
}

?>