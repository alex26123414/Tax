<?php

require_once('../annual_statement/mappers/personMapper.php');
require_once('../annual_statement/models/personModel.php');
require_once('../annual_statement/controllers/personController.php');
require_once('../annual_statement/mappers/incomeInfoMapper.php');
require_once('../annual_statement/models/incomeInfoModel.php');
require_once('../annual_statement/controllers/incomeInfoController.php');

class incomeInfoController {

    public static function getIncomeInfo($cpr) {


        // Get the selected annualStatements from the database
        $scenario = incomeInfoMapper::select($cpr);

        // Return the results
        return $scenario;
    }

}

?>