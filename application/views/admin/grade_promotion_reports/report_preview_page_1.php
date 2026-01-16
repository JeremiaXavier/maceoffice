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


?>


<br><br>
<h3 class="margin-0" style="text-align: center;">ഫോം 1</h3>
<h3 class="margin-0" style="text-align: center;">((നിയമങ്ങൾ അധ്യായം 8 ഭാഗം II ക്ലോസ് എ ഭാഗം III 6))
</h3>


<h3 style="text-align: center;"><u>ഹയർ ഗ്രേഡ് പ്രൊമോഷൻ ഉത്തരവ് നമ്പർ ബി <?= $reportsDetails->report_no ?></u></h3>
<p style="text-align: center;" class="small-size">സൂചന:- പേ-റിവിഷൻ ഉത്തരവ് സ.ഉ.(പി)നമ്പർ 27/2021/ഫിൻ, തീയതി 10/02/2021</p>


<p class="margin-0" style="text-indent: 15%;">
    <?= $employee_salutation ?>.
    <?= $reportsDetails->employee_name_mal ?><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>,
    <?= $reportsDetails->designation_name_mal ?>,
    <?= $reportsDetails->department_name_mal ?> വിഭാഗം,
    മാർ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗ്, കോതമംഗലം മുകളിൽ സൂചിപ്പിച്ച സർക്കാർ ഉത്തരവ് അനുസരിച്ച്,
    <?= date('d-m-Y', strtotime($reportsDetails->end_service_date)) ?> അപരാഹ്നത്തിൽ
    <?= $reportsDetails->service_period ?> വർഷത്തെ സേവനം പൂർത്തിയാക്കിയിട്ടുള്ളതിനാൽ
    <?= date('d-m-Y', strtotime($reportsDetails->promotion_date)) ?> പൂർവാഹ്നം മുതൽ
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
    ശമ്പള സ്കെയിലിൽ
    <?= $reportsDetails->higher_grade_type ?>
    പ്രൊമോഷൻ അനുവദിച്ച് ഉത്തരവാകുന്നു.




</p>

<p class="margin-0" style="text-indent: 15%;">
    <?= $employee_salutation ?> <?= $reportsDetails->employee_name_mal ?>ന്റെ  നിയമനം ആക്ടിലേയും, സ്റ്റാറ്റ്യൂട്ടുകളിലേയും, ഓർഡിനൻസു കളിലേയും, റെഗുലേഷനുകളിലേയും, ചട്ടങ്ങളിലേയും, ഉത്തരവുകളിലേയും വ്യവസ്ഥകൾക്കും എ.പി.ജെ. അബ്ദുൾ കലാം ടെക്നോളജിക്കൽ സർവ്വകലാശാലയോ ഈ സ്റ്റാറ്റ്യൂട്ടുകൾ പ്രകാരം അത്തരം ചട്ടങ്ങൾ, ഉത്തരവുകൾ മുതലായവ പുറപ്പെടുവിക്കാൻ അധികാരമുള്ള അധികാരസ്ഥാ നമോ സമയാസമയങ്ങളിൽ പുറപ്പെടുവിക്കുന്ന അത്തരം ചട്ടങ്ങൾക്കും ഉത്തരവുകൾക്കും വിധേയമായിരിക്കുന്നതാണ്.

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
    <?= $reportsDetails->department_name_mal ?> വകുപ്പ് ,
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