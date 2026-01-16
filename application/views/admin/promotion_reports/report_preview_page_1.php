<style type="text/css">
    body {
        margin: 40px;
        font-size: smaller;
        font-family: 'manjari-mal';
        text-align: justify;
    }

    .small-size {
        font-size: x-small;
    }

    .margin-0 {
        margin: 0px;
    }

    .font-bold {
        font-weight: bold;
    }
</style>

<br><br>
<br><br>
<br><br>
<br>


<?php

$key = array_search($reportsDetails->employee_salutation, array_column($salutation_enum, 'id'));
$employee_salutation = $salutation_enum[$key]['value'];

$key = array_search($reportsDetails->previous_employee_salutation, array_column($salutation_enum, 'id'));
$previous_employee_salutation = $salutation_enum[$key]['value'];


// Previous Employee Name
$searchId = $reportsDetails->previous_employee_name;
$filtered = array_filter($employeesList, function ($obj) use ($searchId) {
    return $obj->employee_id == $searchId;
});
$filtered = reset($filtered);
$employeeName = (!empty($filtered)) ? $filtered->employee_name_mal : 'NA';


// Previous Employee Designation
$searchId = $reportsDetails->previous_employee_designation;
$filtered = array_filter($designationsList, function ($obj) use ($searchId) {
    return $obj->designation_id == $searchId;
});
$filtered = reset($filtered);
$employeeDesignation = (!empty($filtered)) ? $filtered->designation_name_mal : 'NA';


// Previous Employee Department
$searchId = $reportsDetails->previous_employee_department;
$filtered = array_filter($departmentsList, function ($obj) use ($searchId) {
    return $obj->department_id == $searchId;
});
$filtered = reset($filtered);
$employeeDepartment = (!empty($filtered)) ? $filtered->department_name_mal : 'NA';

?>


<br><br>
<h3 class="margin-0" style="text-align: center;">ഫോം 1</h3>
<h3 class="margin-0" style="text-align: center;">(അധ്യായം 8 ഭാഗം II ഏ 9 ഭാഗം III 6 എന്നീ സ്റ്റാറ്റ്യൂട്ടുകൾ കാണുക)
</h3>


<h3 style="text-align: center;"><u>ഉദ്യോഗക്കയറ്റ ഉത്തരവ് നമ്പർ ബി <?= $reportsDetails->report_no ?> (എം)</u></h3>



<p class="margin-0" style="text-indent: 15%;">
    <?= $reportsDetails->department_name_mal ?> വിഭാഗം
    സീനയർ മോസ്റ്റ് <?= $reportsDetails->designation_name_mal ?>
    <?= $employee_salutation ?>
    <?= $reportsDetails->employee_name_mal ?><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>,
    <?= $reportsDetails->department_name_mal ?> വിഭാഗത്തിൽ നിന്നും
    <?= date('d-m-Y', strtotime($reportsDetails->previous_employee_date)) ?> അപരാഹ്നം സേവനത്തിൽ നിന്നും
    <?= ' '. $reportsDetails->promotion_reason  .' '?>
    <?= $previous_employee_salutation ?>
    <?= $employeeName ?>,
    <?= $employeeDesignation ?> ന്റെ ഒഴിവിലേക്ക് കോമൺ സീനിയോറിറ്റി പരിഗണിച്ച്
    <?= date('d-m-Y', strtotime($reportsDetails->promotion_date)) ?> പൂർവ്വാനം പ്രാബല്യത്തിൽ

    <?php
    $pay_ranges = explode("-", $reportsDetails->pay_range_full);
    $size = sizeof($pay_ranges);
    $i = 0;
    foreach ($pay_ranges as $pay_range) :
        echo $pay_range;
        if (($size - 1) > $i)
            echo " -";
        $i++;
    endforeach;
    ?>
    രൂപ ശമ്പളസ്കെയിലിൽ
    <?= $reportsDetails->present_pay ?>/- രൂപ അടിസ്ഥാന ശമ്പളത്തിൽ
    <?= $employeeDepartment ?> വിഭാഗത്തിൽ  
    <?= $reportsDetails->vacancy_text ?> തസ്തികയിൽ ഉദ്യോഗക്കയറ്റ നിയമനം അനുവദിച്ച് ഉത്തരവാകുന്നു.
</p>

<p class="margin-0" style="text-indent: 15%;">
    <?= $employee_salutation ?> <?= $reportsDetails->employee_name_mal ?>ന്റെ ഉദ്യോഗക്കയറ്റ നിയമനം ആക്ടിലേയും, സ്റ്റാറ്റ്യൂട്ടുകളിലേയും, ഓർഡിനൻസുകളിലെയും, റെഗുലേഷനുകളിലേയും, ചട്ടങ്ങളിലേയും, ഉത്തരവുകളിലെയും വ്യവസ്ഥകൾക്കും എ.പി.ജെ. അബ്ദുൾ കലാം ടെക്നോളജിക്കൽ സർവ്വകലാശാലയോ ഈ സ്റ്റാറ്റ്യൂട്ടുകൾ പ്രകാരം അത്തരം ചട്ടങ്ങൾ, ഉത്തരവുകൾ മുതലായവ പുറപ്പെടുവിക്കാൻ അധികാരമുള്ള അധികാരസ്ഥാ നമോ സമയാസമയങ്ങളിൽ പുറപ്പെടുവിക്കുന്ന അത്തരം ചട്ടങ്ങൾക്കും ഉത്തരവുകൾക്കും വിധേയമായിരിക്കുന്നതാണ്.

</p>

<br><br><br>

<div class="margin-0" style="width: 50%;float: right;">
    <p>
        സെക്രട്ടറി, മാര്‍ അത്തനേഷ്യസ്
        കോളേജ് അസോസിയേഷന്‍ &
        ചെയര്‍മാന്‍, ഗവേണിംഗ് ബോഡി,
        മാര്‍ അത്തനേഷ്യസ് കോളേജ്
        ഓഫ് എഞ്ചിനീയറിംഗ്.
    </p>
</div>

<p style="text-align: 'right';">( ഭരണ സമിതിയുടെ അല്ലെങ്കിൽ മാനേജിംഗ് കൗൺസിലിന്‍റെ മുദ്ര )</p>

<br>
<p> സ്വീകര്‍ത്താവ്</p>
<p class="margin-0" style="margin-left: 30px;"><?= $reportsDetails->employee_name_mal ?>,<br>
    <?= $reportsDetails->designation_name_mal ?>, <br>
    <?= $reportsDetails->department_name_mal ?> വിഭാഗം ,
    <br>മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എന്‍ജിനീയറിംഗ്,
    <br> കോതമംഗലം
</p>
<br>
<table class="margin-0">
    <tr style="vertical-align: top;">
        <td style="vertical-align: top">പകര്‍പ്പ്:-</td>
        <td>
            1. ജോയിന്‍റ് ഡയറക്ടര്‍, ആര്‍.ഡി.ടി.ഇ, കോതമംഗലം. <br>
            2. പ്രിന്‍സിപ്പല്‍, മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗ്. <br>
            3. അക്കൗണ്ട്സ് വിഭാഗം &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            4. ഹാജര്‍ വിഭാഗം &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            5. ഫയല്‍
        </td>
    </tr>
</table>
<br>
<table>
    <tr style="width: 50%;">
        <td>സ്ഥലം: </td>
        <td>കോതമംഗലം</td>
    </tr>
    <tr style="width: 50%;">
        <td>തീയതി: </td>
        <td><?= date('d/m/Y', strtotime($reportsDetails->report_date)) ?></td>
    </tr>
</table>