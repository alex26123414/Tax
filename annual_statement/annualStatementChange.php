<?php
require_once ('./autoLoader.php');
?>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="annualStatement.css">
</head>
<body>
    <?php
    $persons = personController::getPerson('1005891234'); //get this from the auth
    $incomesAll = incomeController::getAllIncome();
    //remove the paid tax income
    unset($incomesAll[999]);
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
                <form action="http://localhost/TaxChange/annual_statement/saveChanges.php" method="POST">
                    <div id="result">We can not show the result now.</div>
                    <div id="tax-info">
                        <?php include_once ('./infoFromTax.php'); ?>
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

                            //get the paid taxes income type
                            $paidTaxInfo;
                            foreach ($incomeInfos as $incomeInfoModel1) {
                                $idincome1 = $incomeInfoModel1->getIdincome();
                                if (intval($idincome1) === 999) {
                                    $paidTaxInfo = $incomeInfoModel1;
                                    unset($incomeInfos[$incomeInfoModel1->getIdincome_info()]);
                                    break;
                                }
                            }
                            $paidTaxIncome = incomeController::getIncome($paidTaxInfo->getIdincome());
                            //var_dump($paidTaxIncome);

                            $income_type_name_old = "";
                            $total = 0;
                            $total_type = 0;
                            $isFirst = 1;
                            //var_dump($incomeInfos);
                            foreach ($incomeInfos as $incomeInfoModel) {
                                $idincome = $incomeInfoModel->getIdincome();
                                $value = $incomeInfoModel->getValue();
                                $incomeName;
                                $idincome_type;
                                $idtax;
                                $tax_value;
                                $includes_AM;

                                //remove the income from the $incomesAll array
                                unset($incomesAll[$idincome]);

                                $incomes = incomeController::getIncome($idincome);

                                foreach ($incomes as $incomeModel) {
                                    $incomeName = $incomeModel->getName();
                                    $idincome_type = $incomeModel->getIdincome_type();
                                    $idtax = $incomeModel->getIdtax();

                                    $taxes = taxController::getTax($idtax);
                                    foreach ($taxes as $taxModel) {
                                        $includes_AM = $taxModel->getIncludes_AM();
                                    }
                                    // calc value
                                    if ($includes_AM) {
                                        $temp_value = ($value * 0.92);
                                    } else {
                                        $temp_value = ($value);
                                    }
                                    $total_type += $temp_value;
                                    $total += $temp_value;

                                    $incomeTypes = incomeTypeController::getIncomeType($idincome_type);
                                    foreach ($incomeTypes as $incomeTypeModel) {
                                        $income_type_name = $incomeTypeModel->getName();
                                    }
                                    //if income type new show income type
                                    //echo 'act = |'.$income_type_name.'| old = |'.$income_type_name_old.'| <br>';
                                    if (strcmp($income_type_name_old, $income_type_name) != 0) {
                                        if (!$isFirst) {
                                            $total_type -= $temp_value;
                                            echo '<tr style="border-bottom: 1px solid black;"><td colspan="4" style="text-align:left; font-weight: bolder;"> Total ' . $income_type_name_old . '</td><td style="border-bottom: 1px solid black;border-top: 1px solid black;">' . number_format($total_type, 0, ',', '. ') . '</td></tr>';
                                            echo '<tr><td colspan="5">&nbsp;</td></tr>';
                                            //echo $incomeName.$total_type;
                                            $total_type = $temp_value;
                                        }
                                        $isFirst = 0;
                                        echo '<tr><td colspan="5" style="text-align:left; font-size: 10px; font-weight: bolder;">' . $income_type_name . '</td></tr>';
                                        $income_type_name_old = $income_type_name;
                                        //echo 'here is income name old '.$income_type_name_old;
                                    }
                                }
                                ?>
                                <tr style="font-family: serif;">
                                    <td style="text-align: left;"><?php echo $incomeName; ?></td>
                                    <td style="border-bottom: 1px solid black;"><?php echo $idincome; ?></td>
                                    <td><?php echo number_format($value, 0, '.', '. '); ?> <input name="<?php echo $idincome; ?>" type="number" placeholder="<?php echo $value; ?>" style='text-align: right;'></td>
                                    <?php if ($includes_AM == 1) { ?>
                                        <td><?php echo number_format($value * 0.08, 0, '.', '. '); ?></td>
                                        <td><?php echo number_format($value * 0.92, 0, '.', '. '); ?></td>
                                    <?php } else { ?>
                                        <td>&nbsp;</td>
                                        <td><?php echo number_format($value, 0, '.', '. '); ?></td>
                                    <?php } ?>
                                </tr>
                                <?php
                                //echo '$incomeInfos = ' . $incomeInfoModel->getIdincome_info() . '<br>';
                                //echo 'end($incomes) = ' . end($incomeInfos)->getIdincome_info() . '<br><br>';
                                if ($incomeInfoModel == end($incomeInfos)) {
                                    echo '<tr style="border-bottom: 1px solid black;"><td colspan="4" style="text-align:left; font-weight: bolder;"> Total ' . $income_type_name . '</td><td style="border-bottom: 1px solid black;border-top: 1px solid black;">' . number_format($total_type, 0, ',', '. ') . '</td></tr>';
                                    echo '<tr><td colspan="5">&nbsp;</td></tr>';
                                    echo '<tr style="border-bottom: 1px solid black;"><td colspan="4" style="text-align:left; font-weight: bolder; font-style:italic;"> Total taxable income </td><td style="border-bottom: 1px solid black;border-top: 1px solid black;">' . number_format($total, 0, ',', '. ') . '</td></tr>';
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr>
                                <td id="add_income" colspan="5"><button type="button" onclick="addIncome()">Add</button></td>
                            </tr>
                        </table>

                    </div>
                    <div id="btns">
                        <button type="button" onclick="window.location.assign('annualStatementView.php')">Cancel</button>
                        <input type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</body>

<?php
//prepert select for js
$leftIncomes = '<select id="addSelection" >';
foreach ($incomesAll as $incomeModel) {
    $leftIncomes .= '<option value="' . $incomeModel->getIdincome() . '">' . $incomeModel->getName() . ' (' . $incomeModel->getIdincome() . ')</option>';
}
$leftIncomes .= '</select>';
$countLeft = count($incomesAll);
?>
<script>
    var idSelect = <?php echo $countLeft; ?>;

    function addIncome() {
        //alert(idSelect);
        var table = document.getElementById("income_results");

        var row = table.insertRow(table.rows.length - 1);
        var cell1 = row.insertCell(0);
        cell1.setAttribute("style", "text-align: left;");
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        cell1.innerHTML = '<?php echo $leftIncomes; ?>';
        cell2.innerHTML = 'Section';
        cell3.innerHTML = '<input type="number" id="input' + idSelect + '">';
        cell4.innerHTML = '&nbsp;';
        cell5.innerHTML = '&nbsp;';

        cell1.setAttribute('id', 'income_name');
        cell2.setAttribute('id', 'idincome' + idSelect);
        cell3.setAttribute('id', 'inserted_value');
        cell4.setAttribute('id', 'AM');
        cell5.setAttribute('id', 'after_AM');

        document.getElementById("addSelection").setAttribute('id', 'addSelection' + idSelect);
        //onchange="updateAddIncomeLine(getSelectedValue())" onfocus="updateAddIncomeLine(getSelectedValue())"
        document.getElementById('addSelection' + idSelect).setAttribute('onchange', 'updateAddIncomeLine(' + idSelect + ', getSelectedValue(' + idSelect + '))');
        document.getElementById('addSelection' + idSelect).setAttribute('onfocus', 'updateAddIncomeLine(' + idSelect + ', getSelectedValue(' + idSelect + '))');

        idSelect--;
        document.getElementById('addSelection' + (idSelect + 1)).focus();


    }

    function updateAddIncomeLine(idActSelect, id) {
        document.getElementById('idincome' + idActSelect).innerHTML = id;
        document.getElementById('input' + idActSelect).setAttribute('name', id);
        if (idSelect === 0) {
            document.getElementById('add_income').innerHTML = '<i>No more incomes to add</i>';
        }
    }

    function getSelectedValue(idActSelect) {
        var idActualSelect = 'addSelection' + idActSelect;
        var e = document.getElementById(idActualSelect);
        var strUser = e.options[e.selectedIndex].value;
        return strUser;
    }
</script>
