<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Report</title>
</head>

<body>
	<h2 style="text-transform: uppercase;text-align: center;">Mar Athanasius College of Engineering, Kothamangalam, Kerala</h2>
	<h3 style="text-transform: uppercase;text-align: center;">Proceedings</h3>
	<p>Sub: Technical Education - Mar Athanasius College of Engineering, Kothamangalam - Salary Bill for Guest Faculties - reg:</p>
	<span>Ref:</span>
	<ol>
		<?php
		$orders = $teacherDetails[0]->report_orders;
		$orders_arr = explode("~", $orders);
		foreach ($orders_arr as $points) :
		?>
			<li><?= $points ?></li>

		<?php endforeach; ?>
	</ol>

	<table style="width: 100%;">
		<tr>
			<td align="left">
				No: <?= (!empty($teacherDetails)) ? $teacherDetails[0]->report_no : 'NULL'; ?>
			</td>
			<td align="right">
				Date: <?= (!empty($teacherDetails)) ? date('d/m/Y', strtotime($teacherDetails[0]->report_date)) : 'NULL'; ?>
			</td>
		</tr>
	</table>

	<br><br>

	<p style="text-indent: 50px;text-align: justify;">As per the Orders cited above, the appointment of Guest Asst. Professors,

	
		<?php
		$len = sizeof($teacherDetails);
		$i = 0;

		$dept_id = 1;

		foreach ($teacherDetails as $teachers) :

			if ($dept_id != $teachers->department) :
				$dept_id = $teachers->department;
				if ($i > 0) {
					echo " in " . $teacherDetails[$i - 1]->department_name . " Department, ";
				}

			endif;

			$i++;
			$salut = ($teachers->gender == 1) ? 'Smt. ' : 'Sri. ';
			$teacher_name = $salut . $teachers->teacher_name;
			echo ($len == $i) ? $teacher_name : $teacher_name . ', ';



		endforeach;

		echo " in " . $teacherDetails[$i - 1]->department_name . " Department, ";

		?>



		<?php
		$month = (!empty($teacherDetails)) ? $teacherDetails[0]->report_month : 1;
		$year = (!empty($teacherDetails)) ? $teacherDetails[0]->report_year : 1;
		// $year = (!empty($teacherDetails)) ? date('Y', strtotime($teacherDetails[0]->report_date)) : 2000;
		?>

		were approved by the Joint Director, RDTE, Kothamangalam.</p>



	<p style="text-indent: 50px;text-align: justify;">In the above circumstances, the salary for the
		month of <?= date('F', strtotime("2012-$month-01")); ?> <?= $year ?> of


		<?php
		$i = 0;
		foreach ($teacherDetails as $teachers) :
			$i++;
			echo ($len == $i) ? $teachers->teacher_name : $teachers->teacher_name . ', ';
		endforeach; ?>


		is hereby sactioned as detailed below.</p>
	<table border="1" style="border-collapse: collapse;border: 1px solid black;" align="center" cellpadding="6px" cellspacing="6px">
		<tr>
			<th>Sl.No</th>
			<th>Emp. Code</th>
			<th>Name</th>
			<th>Designation</th>
			<th>Days</th>
			<th>Amount</th>
			<th>Total Amount</th>
			<th>Head of Account</th>
			<th>IT/PT</th>
			<th>Net Amount</th>
		</tr>

		<?php $i = 1;
		foreach ($teacherDetails as $teachers) :
			$daily_wage = $teachers->daily_wage;
			$total_salary = $daily_wage * $teachers->days;
			$total_salary_with_tax = $total_salary - $teachers->income_tax;
		?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= $teachers->teacher_code ?></td>
				<td><?= $teachers->teacher_name ?></td>
				<td><?= $teachers->designation_name ?></td>
				<td><?= $teachers->days ?></td>
				<td><?= $teachers->daily_wage ?></td>
				<td><?= $total_salary ?></td>
				<td><?= $teachers->head_of_account ?></td>
				<td><?= $teachers->income_tax ?></td>
				<td><?= $total_salary_with_tax ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<div style="position: absolute;bottom:0;">
		<table style="width: 100%;margin-bottom:25%;">
			<tr>
				<td align="left" style="padding-left: 13%;">
					Seal
				</td>
				<td align="right" style="padding-right: 15%;">
					Head of the Institution
				</td>
			</tr>
		</table>
	</div>

</body>

</html>