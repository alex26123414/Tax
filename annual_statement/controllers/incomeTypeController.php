<?php

require_once('../annual_statement/mappers/incomeTypeMapper.php');
require_once('../annual_statement/models/incomeTypeModel.php');

class incomeTypeController {

    public static function getIncomeType($idincome_type) {

        // Get the selected annualStatements from the database
        $scenario = incomeTypeMapper::select($idincome_type);

        // Return the results
        return $scenario;
    }

}


?>