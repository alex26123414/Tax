<?php
/*
 * Why not just make an auto-loader?
 * why no views?
 */
require_once('../annual_statement/mappers/personMapper.php');
require_once('../annual_statement/models/personModel.php');
require_once('../annual_statement/controllers/personController.php');

require_once('../annual_statement/mappers/incomeInfoMapper.php');
require_once('../annual_statement/models/incomeInfoModel.php');
require_once('../annual_statement/controllers/incomeInfoController.php');

require_once('../annual_statement/mappers/taxMapper.php');
require_once('../annual_statement/models/taxModel.php');
require_once('../annual_statement/controllers/taxController.php');

require_once('../annual_statement/mappers/incomeMapper.php');
require_once('../annual_statement/models/incomeModel.php');
require_once('../annual_statement/controllers/incomeController.php');

require_once('../annual_statement/mappers/incomeTypeMapper.php');
require_once('../annual_statement/models/incomeTypeModel.php');
require_once('../annual_statement/controllers/incomeTypeController.php');
?>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="annualStatement.css">
</head>
<body>
    <?php
    $persons = personController::getPerson('1005891234'); //get this from the auth
    foreach ($persons as $personModel) {
        $cpr = $personModel->getCpr();
        $partner_cpr = $personModel->getPartner_cpr();

        $fname = $personModel->getFirst_name();
        $lname = $personModel->getLast_name();
        $address = $personModel->getAddress();
        ?>


        <div id="main_wraper_content">
            <div id="header">
                <div id="left_header">
                    <div id="logo"><img src="../img/tax_bw.png"/></div>
                    <div  id="year">2013</div>
                    <div id="person"> 
                        <?php echo $fname . ' ' . $lname; ?> <br/>
                        <?php echo $address; ?>
                    </div>
                </div>
                <div id="info_header">
                    <table>
                        <tr>
                            <th colspan="2">Annual statement</th>
                        </tr>
                        <tr>
                            <td>Partner CPR <br/> 
                                <?php echo $partner_cpr; ?>
                            </td>
                            <td>CPR <br/> 
                                <?php echo $cpr; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Municipality <br/> Copenhagen</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>Percentage <br/> &nbsp;</td>
                            <td>Health contributions <br/> 6,0 </td>
                            <td>Municipality <br/> 23,8 </td>
                            <td>Church <br/> 0,0 </td>
                            <td>AM-contributions <br/> 8,0 </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="main">
                <div id="result">Du skal have penge tilbage 17.747 kr</div>
                <div id="tax-info">
                    Orientering fra SKAT
                    De oplysninger, vi bruger til at opgøre din indkomst, får vi fra bl.a. arbejdsgivere og pengeinstitutter. I TastSelv
                    under "Personlige skatteoplysninger" kan du se, hvad der er indberettet til SKAT.
                    Fristen for at selvangive oplysninger er den 1. maj 2013.
                    Vi sender ikke din årsopgørelse eller eventuelle indbetalingskort til restskat med posten. Hvis du har en restskat, skal
                    du derfor selv finde indbetalingskortene i TastSelv under "Betaling".
                    Der kan senere ske ændringer, og du vil så modtage en ny årsopgørelse.
                    Efter skattekontrollovens § 16 har du pligt til inden 4 uger fra modtagelsen af denne årsopgørelse at underrette SKAT,
                    hvis ansættelsen af din indkomst eller ejendomsværdiskat er for lav. Undladelse heraf kan medføre strafansvar,
                    medmindre du er under den kriminelle lavalder. Fristen på 4 uger regnes dog tidligst fra udløbet af selvangivelsesfristen.
                </div>

                <div id="income">
                    <table id="income_results">
                        <tr>
                            <th>Income type</th>
                            <th>Section</th>
                            <th>Before AM-contribution</th>
                            <th>AM-contribution</th>
                            <th>After AM-contribution</th>
                        </tr>
                        <?php
                        $incomeInfos = incomeInfoController::getIncomeInfo($cpr);
                        $income_type_name_old = "";
                        foreach ($incomeInfos as $incomeInfoModel) {
                            $idincome = $incomeInfoModel->getIdincome();
                            $value = $incomeInfoModel->getValue();
                            $incomeName;
                            $idincome_type;
                            $idtax;
                            $tax_value;


                            $incomes = incomeController::getIncome($idincome);
                            foreach ($incomes as $incomeModel) {
                                $incomeName = $incomeModel->getName();
                                $idincome_type = $incomeModel->getIdincome_type();
                                $idtax = $incomeModel->getIdtax();

                                $incomeTypes = incomeTypeController::getIncomeType($idincome_type);
                                foreach ($incomeTypes as $incomeTypeModel) {
                                    $income_type_name = $incomeTypeModel->getName();
                                }
                                //if income type new show income type
                                //echo 'act = |'.$income_type_name.'| old = |'.$income_type_name_old.'| <br>';
                                if (strcmp($income_type_name_old, $income_type_name) != 0) {
                                    echo '<tr><td colspan="5" style="text-align:left; font-size: 10px; font-weight: bolder;">' . $income_type_name . '</td></tr>';
                                    $income_type_name_old = $income_type_name;
                                    //echo 'here is income name old '.$income_type_name_old;
                                }
                            }
                            ?>
                            <tr style="font-family: serif;">
                                <td style="text-align: left;"><?php echo $incomeName; ?></td>
                                <td style="border-bottom: 1px solid black;"><?php echo $idincome; ?></td>
                                <td><?php echo number_format($value, 0, '.', '. '); ?> <input type="text" placeholder="<?php echo $value; ?>" style='text-align: right;'></td>
                                <td><?php echo number_format($value * 0.08, 0, '.', '. '); ?></td>
                                <td><?php echo number_format($value * 0.92, 0, '.', '. '); ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td id="add_income" colspan="5"><button type="button" onclick="addIncome()">Add</button></td>
                        </tr>
                    </table>
                </div>
                <div id="btns">
                    <button type="button" onclick="window.location.assign('annualStatementView.php')">Cancel</button>
                    <button type="button" onclick="alert('Not implementet yet!')">Save</button>
                </div>
            </div>
        </div>
    <?php } ?>
</body>


<script>
            function addIncome()
            {
            var table = document.getElementById("income_results");
                    var row = table.insertRow(table.rows.length - 1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    cell1.innerHTML = '<select>  <option value="volvo">Volvo</option>  <option value="saab">Saab</option>  <option value="mercedes">Mercedes</option>  <option value="audi">Audi</option></select>';
                    cell2.innerHTML = "Section";
                    cell3.innerHTML = "Section";
                    cell4.innerHTML = "Section";
                    cell5.innerHTML = "Section";
            }
</script>
