<?php

require_once('../annual_statement/mappers/incomeMapper.php');
require_once('../annual_statement/models/incomeModel.php');

class incomeController {

    public static function getIncome($idincome) {


        // Get the selected annualStatements from the database
        $scenario = incomeMapper::select($idincome);

        // Return the results
        return $scenario;
    }

}

?>