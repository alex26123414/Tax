<?php

require_once('../annual_statement/mappers/taxMapper.php');
require_once('../annual_statement/models/taxModel.php');

class taxController {

    public static function getTax($idtax) {

        // Get the selected annualStatements from the database
        $scenario = taxMapper::select($idtax);

        // Return the results
        return $scenario;
    }

}

?>