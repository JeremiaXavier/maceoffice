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

	.right-left-alignment {
		width: 100%;
		border-collapse: collapse;
	}

	.full-width-row {
		display: flex;
		justify-content: space-between;
	}

	.left-aligned {
		text-align: left;
	}

	.right-aligned {
		text-align: right;
	}
</style>

<!--
<table style="width: 100%;display:none;">
	<tr>
		<td style="vertical-align:text-top;">
			<h2>MAR ATHANASIUS COLLEGE ASSOCIATION</h2>
			<p class="small-size">KOTHAMANGALAM COLLEGE P.O, KERALA, INDIA - 686 666</p>
			<p class="small-size">Phone: 0485-2822328, Telefax: 0485-2825017, 0485-2570255(Res.)</p>
			<p class="small-size">www.macollegeassociation.org &nbsp;&nbsp;&nbsp; Email:maca2955@gmail.com</p><br>

			<table>
				<tr style="vertical-align: text-top;">
					<td style="width: 20%;font-size:x-small;vertical-align:top">MANAGER</td>
					<td>
						<p class="small-size">Mar Athanasius College (Autonomous), Kothamangalam</p>
						<p class="small-size">Mar Athanasius College of Engineering, Kothamangalam</p>
						<p class="small-size">Mar Baselious College, Adimaly</p>
						<p class="small-size">Mar Athanasius College International School, Kothamangalam</p>
					</td>
				</tr>
			</table>
		</td>
		<td style="vertical-align:text-top;text-align: right;">
			<p class="small-size">DR. WINNY VARGHESE</p>
			<p class="small-size">SECRETARY</p>
		</td>
	</tr>
</table> -->



<?php

$key = array_search($reportsDetails->employee_salutation, array_column($salutation_enum, 'id'));
$employee_salutation = $salutation_enum[$key]['value'];


?>


<br><br>
<br><br>
<br><br>
<br>
<h3 class="margin-0" style="text-align: center;">സെക്രട്ടറി, മാര്‍ അത്തനേഷ്യസ് കോളേജ് അസോസിയേഷന്‍ & ചെയര്‍മാന്‍, ഗവേണിംഗ് ബോഡി, മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗ്, കോതമംഗലം - നടപടിക്രമങ്ങള്‍</h3>
<hr>
<p class="margin-0">മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എന്‍ജിനീയറിംഗ്, കോതമംഗലം - എസ്റ്റാബ്ലിഷ്മെന്‍റ് -
	<?= $reportsDetails->employee_name_mal ?> <?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>,
	<?= $reportsDetails->designation_name_mal ?> -
	<?= $reportsDetails->department_name_mal ?> വിഭാഗം -
	നിരീക്ഷണ കാല പൂര്‍ത്തീകരണം പ്രഖ്യാപിക്കുന്നത് - ഉത്തരവ് പുറപ്പെടുവിക്കുന്നത്</p>
<hr class="margin-0">
<table class="margin-0 right-left-alignment">
	<tr class="full-width-row">
		<td class="left-aligned">ഉത്തരവ് നം. ബി: <?= $reportsDetails->report_no ?></td>
		<td class="right-aligned"><?= date('d-m-Y', strtotime($reportsDetails->report_date)) ?>, കോതമംഗലം</td>
	</tr>
</table>

<hr class="margin-0">
<table class="margin-0">
	<tr style="vertical-align: top;">
		<td style="vertical-align:top">വായന :-</td>
		<td style="vertical-align:top">
			<span class="font-bold">1)</span> മാർ അത്തനേഷ്യസ് കോളേജ് അസ്സോസ്സിയേഷൻ സെക്രട്ടറിയുടെ 
			<?= date('d/m/Y', strtotime($reportsDetails->order_date_orders_1)) ?>
			തീയതിയിലെ <?= $reportsDetails->order_no_orders_1 ?> നമ്പർ ഉത്തരവ്
			<br>
			<span class="font-bold">2)</span> സാങ്കേതിക വിദ്യാഭ്യാസ വകുപ്പ് മേഖലാ കാര്യാലയം ജോയിന്റ് ഡയറക്ടറുടെ
			<?= date('d/m/Y', strtotime($reportsDetails->order_date_orders_2)) ?>
			 തീയതിയിലെ <?= $reportsDetails->order_no_orders_2 ?> നമ്പർ ഉത്തരവ്
			
		</td>
	</tr>
</table>
<h3 style="text-align: center;">ഉത്തരവ്</h3>
<p class="margin-0" style="text-indent: 15%;">
	കോതമംഗലം മാർ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗിൽ
	<?= date('d/m/Y', strtotime($reportsDetails->start_service_date)) ?>
	ൽ സേവനത്തിൽ പ്രവേശിച്ച
	<?= $employee_salutation ?>.
	<?= $reportsDetails->employee_name_mal ?><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>,
	<?= $reportsDetails->designation_name_mal ?>
	തസ്തികയിൽ
	നിരീക്ഷണകാലം തൃപ്തികരമായി പൂർത്തീകരിച്ച സാഹചര്യത്തിൽ നിയമനത്തീയതി മുതൽ സ്ഥിര
	പ്പെടുത്തി (സ്ഥിരം ഒഴിവിൽ) ഉത്തരവാകുന്നു.
	എപിജെ അബ്ദുൾ കലാം ടെക്നോളജിക്കൽ
	സർവ്വകലാശാല സ്റ്റാറ്റ്യൂട്ട് അദ്ധ്യായം 8 ഭാഗം 3 ക്ലാസ്സ് 20 ന്റെ
	അടിസ്ഥാനത്തിലും പട്ടികയിൽ വിവരിക്കും പ്രകാരമുള്ള നിയമനം പേരിന് നേർക്ക് ചേർത്തിട്ടുള്ള തസ്തികയിൽ
	മുൻകാല പ്രാബല്യത്തോടെ സ്ഥിരപ്പെടുത്തി ഉത്തരവാകുന്നു.
</p>

<br>

<table border=1 style="width: 100%;border-collapse: collapse;">

	<tr>
		<td class="small-size">ക്രമ <br>നമ്പർ</td>
		<td class="small-size">പേര്</td>
		<td class="small-size">തസ്തിക</td>
		<td class="small-size"> സ്ഥിരം ഒഴിവ് <br>
			നിലവിൽ വന്ന <br>
			തീയതി</td>
		<td class="small-size">നിയമന <br>
			ഉത്തരവ് നം. </td>
		<td class="small-size">അംഗീകാര <br>
			ഉത്തരവ് നം. </td>
		<td class="small-size">
			സ്ഥിരപ്പെടുത്തിയ<br>
			തീയതി</td>
	</tr>

	<tr>
		<td class="small-size">1)</td>
		<td class="small-size"><?= $reportsDetails->employee_name_mal ?></td>
		<td class="small-size"><?= $reportsDetails->designation_name_mal ?></td>
		<td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->start_service_date)) ?></td>
		<td class="small-size"><?= $reportsDetails->order_no_orders_1 ?> <br> <?= date('d/m/Y', strtotime($reportsDetails->order_date_orders_1)) ?></td>
		<td class="small-size"><?= $reportsDetails->order_no_orders_2 ?> <br> <?= date('d/m/Y', strtotime($reportsDetails->order_date_orders_2)) ?></td>
		<td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->start_service_date)) ?></td>
	</tr>

</table>


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


<br><br><br><br>
<p></p>


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