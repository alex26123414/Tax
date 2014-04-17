<?php

require_once('../mappers/taxMapper.php');
require_once('../models/taxModel.php');

class taxController {

    public static function cache() {

        // Cache all taxes on construct
        self::getAllTaxes();
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Cache
    private static $taxes;

    /* -------------------------------------------------------------------------------------------------------------- */

    public static function getTax($idtax) {

        // If all taxes are cached
        if (isset(self::$taxes)) {

            // Return the specific tax
            return self::$taxes[$idtax];
        } else {

            // Get the selected annualStatements from the database
            $scenario = taxMapper::select($idtax);

            // Return the results
            return $scenario;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
}

?>