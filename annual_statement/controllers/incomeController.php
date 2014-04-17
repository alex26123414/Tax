<?php

require_once('../mappers/incomeMapper.php');
require_once('../models/incomeModel.php');

class incomeController {

    public static function cache() {

        // Cache all taxes on construct
        self::getAllIncomes();
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Cache
    private static $incomes;

    /* -------------------------------------------------------------------------------------------------------------- */

    public static function getIncome($idincome) {

        // If all taxes are cached
        if (isset(self::$incomes)) {

            // Return the specific tax
            return self::$incomes[$idincome];
        } else {

            // Get the selected annualStatements from the database
            $scenario = incomeMapper::select($idincome);

            // Return the results
            return $scenario;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
}

?>