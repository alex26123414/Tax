<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="annualStatement.css">
<?php
require_once('../annual_statement/mappers/annualStatementMapper.php');
require_once('../annual_statement/models/annualStatementModel.php');
require_once('../annual_statement/controllers/annualStatementController.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$annualStatements = annualStatementController::getAnnualStatement('1005891234'); //get this from the auth

foreach ($annualStatements as $annualStatementModel) {

    echo "Cpr from database:" . $annualStatementModel->getCpr() . " ";
    echo "Firstname from database:" . $annualStatementModel->getFirst_name() . " ";
    ?>

    <body>
        <div id="main_wraper_content">
            <div id="header">
                <div id="left_header">
                    <div id="logo"><img src="../img/tax_bw.png"/></div>
                    <div  id="year">2013</div>
                    <div id="person"> 
                        <?php echo $annualStatementModel->getFirst_name() . ' ' . $annualStatementModel->getLast_name(); ?> <br/>
                        <?php echo $annualStatementModel->getAddress(); ?>
                    </div>
                </div>
                <div id="info_header">
                    <table>
                        <tr>
                            <th colspan="2">Annual statement</th>
                        </tr>
                        <tr>
                            <td>Partner CPR <br/> 10 10 87-12 34</td>
                            <td>CPR <br/> 10 10 87-12 34</td>
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
                        <tr>
                            <td>Lønindkomst</td>
                            <td>11</td>
                            <td>67. 465</td>
                            <td>1. 965</td>
                            <td>65. 500</td>
                        </tr>
                    </table>
                </div>
                <div id="btns">
                    <button type="button" onclick="window.print();">Print</button>
                    <button type="button" onclick="alert('Not implementet yet!')">Change</button>
                </div>
            </div>
        </div>
    </body>

<?php } ?>
