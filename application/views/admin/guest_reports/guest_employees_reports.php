<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>
    <style type="text/css">
        tr {
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    $month = (!empty($teacherDetails)) ? $teacherDetails[0]->report_month : 1;
    $year = (!empty($teacherDetails)) ? $teacherDetails[0]->report_year : 1;

    // $year = (!empty($teacherDetails)) ? date('Y', strtotime($teacherDetails[0]->report_date)) : 2000;
    ?>



    <h2 style="text-transform: uppercase;text-align: center;">Mar Athanasius College of Engineering, Kothamangalam, Kerala</h2>
    <h3 style="text-align: center;">Salary for Guest Lecturers for the month of
        <?= date('F', strtotime("2012-$month-01")); ?> <?= $year ?>
    </h3>

    <table border="1" style="border-collapse: collapse;border: 1px solid black;" align="center" cellpadding="6px" cellspacing="6px">
        <tr>
            <th rowspan="2">Sl.No</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Amount</th>
            <th colspan="2"><?= date('F', strtotime("2012-$month-01")); ?> <?= $year ?> </th>
        <tr>
            <th>Days</th>
            <th>Amount</th>
        </tr>
        </tr>

        <?php $i = 1;
        $total = 0;
        foreach ($teacherDetails as $teachers) :
            $daily_wage = $teachers->daily_wage;
			$total_salary = $daily_wage * $teachers->days;
            // $total_salary_with_tax = $total_salary - $teachers->income_tax;

            $total += $total_salary;
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td style="text-align: left;"><?= $teachers->teacher_name ?></td>
                <td><?= $teachers->daily_wage ?></td>
                <td><?= $teachers->days ?></td>
                <td><?= $total_salary ?></td>
            </tr>
        <?php endforeach; ?>


        <tr>
            <th colspan="4">TOTAL</th>
            <th><?= $total ?></th>
        </tr>
    </table>
</body>

</html>