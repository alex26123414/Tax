<meta charset="utf-8">
<?php
require_once('../annual_statement/annualStatementMapper.php');
require_once('../annual_statement/annualStatementModel.php');
require_once('../annual_statement/annualStatementController.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$annualStatements = annualStatementController::getAnnualStatement('1005891234');

    foreach($annualStatements as $annualStatementModel) {
				
	echo "Cpr from database:" .$annualStatementModel->getCpr()." ";
        echo "Firstname from database:" .$annualStatementModel->getFirst_name()." ";

}

?>

<div id="header">
    <div id="logo"><img src="../img/tax_bw.png"/></div>
    <div  id="year">2014</div>
    <div id="person">Constantin Alexandru Gheorghiasa 
        Augustagade 29, 3. tv. 
        2300 København S</div>
    <div id="info_header">
        TBA
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
            <table>
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
    </div>
</div>
