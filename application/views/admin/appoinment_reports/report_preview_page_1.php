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

$key = array_search($reportsDetails->old_employee_salutation, array_column($salutation_enum, 'id'));
$old_employee_salutation = $salutation_enum[$key]['value'];


// Previous Employee Name
$searchId = $reportsDetails->old_employee_name;
$filtered = array_filter($employeesList, function ($obj) use ($searchId) {
    return $obj->employee_id == $searchId;
});
$filtered = reset($filtered);
$employeeName = (!empty($filtered)) ? $filtered->employee_name_mal : 'NA';


// Previous Employee Designation
$searchId = $reportsDetails->new_designation;
$filtered = array_filter($designationsList, function ($obj) use ($searchId) {
    return $obj->designation_id == $searchId;
});
$filtered = reset($filtered);
$employeeDesignation = (!empty($filtered)) ? $filtered->designation_name_mal : 'NA';




?>


<br><br>
<h3 class="margin-0" style="text-align: center;">ഫോം 1</h3>
<h3 class="margin-0" style="text-align: center;">(അധ്യായം 8 ഭാഗം II എ 9 ഭാഗം III 6 എന്നീ സ്റ്റാറ്റ്യൂട്ടുകൾ കാണുക)
</h3>


<h3 style="text-align: center;"><u>നിയമന ഉത്തരവ് നമ്പർ ബി <?= $reportsDetails->report_no ?> (ഒ 13)</u></h3>

<!-- <hr class="margin-0"> -->
<table class="margin-0">
	<tr style="vertical-align: top;">
		<td style="vertical-align:top">വായന :-</td>
		<td style="vertical-align:top">
			<?php
			$i = 1;
			$ordersListStr = $reportsDetails->report_orders;
			$ordersList = explode("~", $ordersListStr);
			foreach ($ordersList as $orders) :
			?>
				<span class="font-bold">(<?= $i++ ?>)</span> <?= $orders ?>
				<br>
			<?php endforeach; ?>
		</td>
	</tr>
</table>


<p class="margin-0" style="text-indent: 15%;">
വായന (<?= $reportsDetails->reading_no_1 ?>) 
സ്റ്റാഫ് സെലക്ഷന്‍ കമ്മിറ്റി മിനിറ്റ്സില്‍, 
ലാസ്റ്റ് ഗ്രേഡ് തസ്തികയുടെ റാങ്ക് പട്ടികയില്‍, 
<?= $reportsDetails->any_department ?> വിഭാഗത്തില്‍ 
<?= $reportsDetails->any_department_rank ?>-ാമത് ആയി ഉള്‍പ്പെട്ടിട്ടുള്ള 
<?= $employee_salutation ?> <?= $reportsDetails->employee_name_mal ?><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>, 
<?= $reportsDetails->employee_housename ?>, 
<?= $reportsDetails->employee_postoffice ?>, 
<?= $reportsDetails->employee_city ?>, 
വായന (<?= $reportsDetails->reading_no_2 ?>) 
<?= $employeeDesignation ?> തസ്തികയിലേക്ക് തസ്തികമാറ്റ നിയമനം ലഭിച്ചിട്ടുള്ള 
<?= $old_employee_salutation ?> <?= $employeeName ?>, 
<?= $reportsDetails->designation_name_mal ?> ഒഴിവിലേക്ക്, 
വായന (<?= $reportsDetails->reading_no_3 ?>) 
ഒഴിവ് സ്ഥിരീകരണ റിപ്പോര്‍ട്ടിന്‍റെ അടിസ്ഥാനത്തില്‍ 
<?= date('d-m-Y', strtotime($reportsDetails->appoinment_date)) ?> പൂര്‍വ്വാഹ്നം മുതല്‍ പ്രാബല്യത്തില്‍ 

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
     രൂപ ശമ്പള സ്കെയിലില്‍ 
     <?= $reportsDetails->new_pay ?>/ രൂപ പ്രതിമാസ അടിസ്ഥാന ശമ്പളത്തില്‍ സ്ഥിരം തസ്തികയില്‍ നിയമനം നടത്തി ഉത്തരവാകുന്നു. ടി തസ്തികയില്‍ 
<?= $employee_salutation ?> <?= $reportsDetails->employee_name_mal ?>, 

<?= date('d-m-Y', strtotime($reportsDetails->appoinment_date)) ?> പൂര്‍വ്വാഹ്നം മുതല്‍ തുടര്‍ച്ചയായ 
<?= $reportsDetails->service_years ?> വര്‍ഷ സേവനത്തിനിടയില്‍ <?= $reportsDetails->monitoring_service_years ?> വര്‍ഷം നിരീക്ഷണ കാലത്തില്‍ ആയിരിക്കും.
</p>








<!-------------------------------------------------------------------------->
<pagebreak />
<!-------------------------------------------------------------------------->


<br><br>
<br><br>
<br><br>
<br>




<p class="margin-0" style="text-indent: 15%;">
<?= $employee_salutation ?> <?= $reportsDetails->employee_name_mal ?><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>, 
 <?= $reportsDetails->designation_name_mal ?>ന്റെ ഉദ്യോഗക്കയറ്റ നിയമനം ആക്ടിലേയും, സ്റ്റാറ്റ്യൂട്ടുകളിലേയും, ഓർഡിനൻസുകളിലെയും, റെഗുലേഷനുകളിലേയും, ചട്ടങ്ങളിലേയും, ഉത്തരവുകളിലെയും വ്യവസ്ഥകൾക്കും എ.പി.ജെ. അബ്ദുൾ കലാം ടെക്നോളജിക്കൽ സർവ്വകലാശാലയോ ഈ സ്റ്റാറ്റ്യൂട്ടുകൾ പ്രകാരം അത്തരം ചട്ടങ്ങൾ, ഉത്തരവുകൾ മുതലായവ പുറപ്പെടുവിക്കാൻ അധികാരമുള്ള അധികാരസ്ഥാ നമോ സമയാസമയങ്ങളിൽ പുറപ്പെടുവിക്കുന്ന അത്തരം ചട്ടങ്ങൾക്കും ഉത്തരവുകൾക്കും വിധേയമായിരിക്കുന്നതാണ്.

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