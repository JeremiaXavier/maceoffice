<style type="text/css">
    body {
        margin: 40px;
    }

    #tb1 td {
        width: 100px;
    }

    .small-size {
        font-size: small;
    }

    .margin-0 {
        margin: 0px;
    }
</style>

<p style="text-align: center;">പ്രൊഫോര്‍മ<br>പ്രൊബേഷന്‍ ഡിക്ലറേഷന്‍<br>(ട്രിപ്ലിക്കേറ്റായി സമര്‍പ്പിക്കണം)</p>
<br>


<table id="tb1" border=1 style="width: 100%;border-collapse: collapse;">
    <tr>
        <td class="small-size">സ്ഥാപനത്തിന്‍റെ പേര്</td>
        <td class="small-size" style="width:70%;"><?= $reportsDetails->office_name_mal ?></td>
    </tr>
    <tr>
        <td class="small-size" style="width:40%;">ജീവനക്കാരന്‍റെ പേര്/പെന്‍ നമ്പര്‍ </td>
        <td class="small-size"><?= $reportsDetails->employee_name_mal . '/' . $reportsDetails->pen_number ?></td>
    </tr>
    <tr>
        <td class="small-size" style="width:40%;">പദവി, ശമ്പളത്തിന്‍റെ സ്കെയില്‍ & അടിസ്ഥാന ശമ്പളം </td>
        <td class="small-size"><?= $reportsDetails->designation_name_mal . ' ,' . $reportsDetails->pay_range . ' ,' . $reportsDetails->present_pay ?></td>
    </tr>
    <tr>
        <td class="small-size" style="width:40%;">അപ്പോയിന്‍റ്മെന്‍റ്/പ്രമോഷന്‍/സര്‍ട്ടിഫിക്കേഷന്‍ റിപ്പോര്‍ട്ട് അംഗീകരിക്കുന്ന ഡിടിഇയുടെ ഉത്തരവിന്‍റെ നമ്പറും തീയതിയും </td>
        <td class="small-size">No. <?= $reportsDetails->edt_no ?> , Dtd. <?= date('d/m/Y', strtotime($reportsDetails->edt_date)) ?></td>
    </tr>
    <tr>
        <td class="small-size" style="width:40%;">ശമ്പളത്തിന് അര്‍ഹതയുള്ള ചാര്‍ജിന്‍റെ അനുമാന തീയതി (FN/AN). </td>
        <td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->assumption_of_charge)) ?></td>
    </tr>

    <?php

    $key = array_search($reportsDetails->test_required, array_column($have_and_not_enum, 'id'));
    $test_required = $have_and_not_enum[$key]['value'];


    ?>
    <tr>
        <td class="small-size" style="width:40%;">തസ്തികയ്ക്ക് ഏതെങ്കിലും ടെസ്റ്റ്/ പരിശീലനം നിര്‍ബന്ധമാക്കിയിട്ടുണ്ടോ, എങ്കില്‍ പരീക്ഷ/ പരിശീലനം വിജയിച്ചതിന്‍റെ തെളിവ്, പ്രാബല്യത്തില്‍ വരുന്ന തീയതിയോടെ സമര്‍പ്പിക്കുക. </td>
        <td class="small-size">
            <?= $test_required ?>
            <?= $reportsDetails->test_details ? ', ' . $reportsDetails->test_details : '' ?>
            <?= $reportsDetails->test_date != '0000-00-00' ? ', ' . date('d/m/Y', strtotime($reportsDetails->test_date)) : '' ?>

        </td>
    </tr>
    <tr>
        <td class="small-size" style="width:40%;">അവധിക്കാലത്തോടുകൂടിയ അവധി, അവധി, ഡെപ്യൂട്ടേഷന്‍, സസ്പെന്‍ഷന്‍ തുടങ്ങിയ അഭാവത്തിന്‍റെ വിശദാംശങ്ങള്‍ പ്രിഫിക്സ്/ സഫിക്സ് ചെയ്താല്‍ </td>
        <td class="small-size"></td>
    </tr>
</table>
<table border=1 style="width: 100%;border-collapse: collapse;table-layout: fixed;">

    <tr>
        <td class="small-size">From</td>
        <td class="small-size">To</td>
        <td class="small-size">Months</td>
        <td class="small-size">Days</td>
        <td class="small-size">Remarks</td>
    </tr>

    <?php if (empty($probationAbsence)) : ?>
        <tr>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
        </tr>
    <?php endif; ?>

    <?php foreach ($probationAbsence as $timings) : ?>
        <tr>
            <td class="small-size"><?= date('d/m/Y', strtotime($timings->probation_absence_from_date)) ?></td>
            <td class="small-size"><?= date('d/m/Y', strtotime($timings->probation_absence_to_date)) ?></td>
            <td class="small-size"><?= $timings->probation_absence_months ?></td>
            <td class="small-size"><?= $timings->probation_absence_days ?></td>
            <td class="small-size"><?= $timings->probation_absence_remarks ?></td>

        </tr>
    <?php endforeach; ?>

</table>


<table border=1 style="width: 100%;border-collapse: collapse;table-layout: fixed;">
    <tr>
        <td class="small-size" style="width:40%;">പ്രൊബേഷനായി എടുത്ത സജീവ സേവന കാലയളവ് </td>
        <td class="small-size"></td>
    </tr>
</table>

<table border=1 style="width: 100%;border-collapse: collapse;table-layout: fixed;">

    <tr>
        <td class="small-size">From</td>
        <td class="small-size">To</td>
        <td class="small-size">Months</td>
        <td class="small-size">Days</td>
        <td class="small-size">Remarks</td>
    </tr>
    <?php if (empty($probationService)) : ?>
        <tr>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($probationService as $timings) : ?>
        <tr>
            <td class="small-size"><?= date('d/m/Y', strtotime($timings->probation_service_from_date)) ?></td>
            <td class="small-size"><?= date('d/m/Y', strtotime($timings->probation_service_to_date)) ?></td>
            <td class="small-size"><?= $timings->probation_service_months ?></td>
            <td class="small-size"><?= $timings->probation_service_days ?></td>
            <td class="small-size"><?= $timings->probation_service_remarks ?></td>

        </tr>
    <?php endforeach; ?>

</table>


<?php

$key = array_search($reportsDetails->records_enclosed, array_column($have_and_not_enum, 'id'));
$records_enclosed = $have_and_not_enum[$key]['value'];


?>

<table id="tb1" border=1 style="width: 100%;border-collapse: collapse;">
    <tr>
        <td class="small-size">പ്രൊബേഷന്‍ ഡിക്ലറേഷന് (FN/AN) അര്‍ഹതയുള്ള തീയതി മുതല്‍ മാനേജ്മെന്‍റ് പ്രൊബേഷന്‍ പ്രഖ്യാപിച്ച തീയതി, പ്രൊബേഷന്‍ നീട്ടുന്നതിനുള്ള കാരണങ്ങള്‍, എന്തെങ്കിലും ഉണ്ടെങ്കില്‍ </td>
        <td class="small-size" style="width:59%;">
            <?= date('d/m/Y', strtotime($reportsDetails->eligible_for_probation)) ?>
            <?= $reportsDetails->reason_for_delaying_probation ? ', ' . $reportsDetails->reason_for_delaying_probation : '' ?>
        </td>
    </tr>
    <tr>
        <td class="small-size" style="width:40%;">സര്‍വീസ് ബുക്കും മറ്റ് അവശ്യ രേഖകളും ചേര്‍ത്തിട്ടുണ്ടോ </td>
        <td class="small-size"><?= $records_enclosed ?></td>
    </tr>
</table>







<!------------------------------------------------------------------------->

<style>
    #content {
        page-break-inside: avoid;
    }
</style>

<div id="content">

    <p style="text-align:center;"><u><b>സര്‍ട്ടിഫിക്കറ്റ്</b></u></p>
    <p>എന്ന് സാക്ഷ്യപ്പെടുത്തി</p>
    <ol type="i">
        <li>ഞാന്‍ പരിപാലിക്കുന്ന സേവന രേഖകളുമായി ബന്ധപ്പെട്ട് മുകളില്‍ സൂചിപ്പിച്ച വസ്തുതകള്‍ ശരിയാണ്.</li>
        <li>പ്രൊബേഷന്‍ കാലയളവില്‍ ശ്രീ/ശ്രീമതി/ഡോ <u><b> <?= $reportsDetails->employee_name_mal ?></b><?= ' (പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?></u> (പേര്) ജോലിയും പെരുമാറ്റവും തൃപ്തികരമാണെന്ന് കണ്ടെത്തി, ഉദ്യോഗസ്ഥനെതിരെ പിഴ ചുമത്തിയിട്ടില്ല, ഉദ്യോഗസ്ഥ നെതിരെ ഒരു അച്ചടക്ക നടപടിയും നിലനില്‍ക്കുന്നില്ല</li>
        <li>ഈ കോളേജിലെ <u><b> <?= $reportsDetails->department_name_mal ?> </b></u> (ഡിപ്പാര്‍ട്ട്മെന്‍റ്) ശ്രീ/ശ്രീമതി/ഡോ <u><b> <?= $reportsDetails->employee_name_mal ?></b></u> (പേര്) വരെയുള്ള എല്ലാ സീനിയേഴ്സിന്‍റെയും പ്രൊബേഷന്‍ പ്രഖ്യാപിച്ചതായി സാക്ഷ്യപ്പെടുത്തി.</li>

    </ol>
    <br><br><br><br>


    <table class="right-left-alignment">
        <tr class="full-width-row">
            <td class="left-aligned small-size" style="width: 50%;">പ്രിന്‍സിപ്പല്‍</td>
            <td class="right-aligned small-size" style="width: 50%;">സെക്രട്ടറി, മാര്‍ അത്തനേഷ്യസ്
                കോളേജ് അസോസിയേഷന്‍ &
                ചെയര്‍മാന്‍, ഗവേണിംഗ് ബോഡി,
                മാര്‍ അത്തനേഷ്യസ് കോളേജ്
                ഓഫ് എഞ്ചിനീയറിംഗ്
                ചെയര്‍മാന്‍,
            </td>
        </tr>
    </table>



</div>


<!-------------------------------------------------------------------------->
<pagebreak />
<!-------------------------------------------------------------------------->




<!-- 
<br><br>
<hr> -->
<h4 style="text-align: center;">സാങ്കേതിക വിദ്യാഭ്യാസ മേഖലാ ഡയറക്ടറേറ്റിന്‍റെ ഓഫീസ്, കോതമംഗലം.</h4>
<h4 style="text-align: center;">ഓര്‍ഡര്‍</h4>
<table style="width: 100%;">
    <tr>
        <td class="small-size" style="width: 80%;">നം. </td>
        <td class="small-size">തീയതി: </td>
    </tr>
</table>
<p>ശ്രീ/ശ്രീമതി/ഡോ <u><b> <?= $reportsDetails->employee_name_mal ?> </b><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?></u> (പേര്) പ്രൊബേഷന്‍ തൃപ്തികരമായ പൂര്‍ത്തീകരണം,
    .....................FN/AN മുതല്‍ പ്രാബല്യത്തില്‍ വരുന്ന
    <u><b> <?= $reportsDetails->designation_name_mal ?> </b></u> (പദവി) തസ്തികയില്‍ നേരിട്ടുള്ള പണമടയ്ക്കലിന് വിധേയമാണ്.
</p>

<br><br><br>
<div class="margin-0" style="width: 50%;float: right;">
    <p>
        ജോയിന്‍റ് ഡയറക്ടര്‍ <br>
        സാങ്കേതിക വിദ്യാഭ്യാസ മേഖലാ ഡയറക്ടറേറ്റ്, <br>
        കോതമംഗലം.
    </p>
</div>