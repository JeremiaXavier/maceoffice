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
<h3 style="text-align: center;">ഉത്തരവ്</h3>
<p class="margin-0" style="text-indent: 15%;">
	കോതമംഗലം മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗ്,
	<?= $reportsDetails->department_name_mal ?> വിഭാഗം,
	<?= $reportsDetails->designation_name_mal ?> ആയ
	<?= $reportsDetails->employee_name_mal ?> <?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>,
	<?= date('d/m/Y', strtotime($reportsDetails->probation_date_1)) ?> അപരാഹ്നത്തില്‍ ടി തസ്തികയില്‍ 
	ഒരു വര്‍ഷത്തെ നിരീക്ഷണ കാലയളവ് തൃപ്തികരമായി പൂര്‍ത്തിയാക്കി.
</p>
<p class="margin-0" style="text-indent: 15%;">
	<?= $reportsDetails->employee_name_mal ?><?= '(പെന്‍ നമ്പര്‍-' . $reportsDetails->pen_number . ')' ?>,
	<?= $reportsDetails->designation_name_mal ?>,
	<?= date('d/m/Y', strtotime($reportsDetails->probation_date_2)) ?> പൂര്‍വ്വാഹ്നം മുതല്‍ പ്രാബല്യത്തോടെ
	<?= $reportsDetails->department_name_mal ?> വിഭാഗത്തിലെ
	<?= $reportsDetails->designation_name_mal ?> നിരീക്ഷണ കാലയളവ് പൂര്‍ത്തിയാക്കി ഉത്തരവാകുന്നു.
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


<br><br><br><br>
<p>സ്വീകര്‍ത്താവ്</p>
<p style="margin-left: 30px;"><?= $reportsDetails->employee_name_mal ?>,<br>
	<?= $reportsDetails->designation_name_mal ?>,
	<?= $reportsDetails->department_name_mal ?> വിഭാഗം,
	<br>മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എന്‍ജിനീയറിംഗ്,
	<br> കോതമംഗലം
</p>

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