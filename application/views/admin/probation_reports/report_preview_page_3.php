<style type="text/css">
    body {
        margin: 40px;
    }
</style>
<?php

// Previous Designation
$searchId = $reportsDetails->first_designation;
$filtered = array_filter($designationsList, function ($obj) use ($searchId) {
    return $obj->designation_id == $searchId;
});
$filtered = reset($filtered);
$firstDesignation = (!empty($filtered)) ? $filtered->designation_name_mal : 'NA';


// Current Designation
$searchId = $reportsDetails->employee_designation;
$filtered = array_filter($designationsList, function ($obj) use ($searchId) {
    return $obj->designation_id == $searchId;
});
$filtered = reset($filtered);
$currentDesignation = (!empty($filtered)) ? $filtered->designation_name_mal : 'NA';


?>

<h3 style="text-align: center;">മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗ്, കോതമംഗലം</h3>
<h3 style="text-align: center;"> <u> <b> <?= date('Y', strtotime($reportsDetails->report_date)) ?> </b> </u> വര്‍ഷത്തെ രഹസ്യ റിപ്പോര്‍ട്ട്</h3>
<br>
<table border="1" style="border-collapse: collapse;width: 100%;">
    <tr>
        <td style="width:4%">1.</td>
        <td>ജീവനക്കാരന്‍റെ പേര്/പെന്‍ നമ്പര്‍ </td>
        <td style="width: 40%;"><?= $reportsDetails->employee_name_mal . '/' . $reportsDetails->pen_number ?></td>
    </tr>
    <tr>
        <td style="width:4%">2.</td>
        <td>ആദ്യ അപ്പോയിന്‍റ്മെന്‍റിന്‍റെയും പദവിയുടെയും തീയതി</td>
        <td style="width: 40%;"><?= date('d/m/Y', strtotime($reportsDetails->date_of_first_appoinment)) . ' , ' . $firstDesignation  ?></td>
    </tr>
    <tr>
        <td style="width:4%">3.</td>
        <td>നിലവിലെ പോസ്റ്റില്‍ സ്ഥാനവും തീയതിയും അവതരിപ്പിക്കുക</td>
        <td style="width: 40%;"><?= date('d/m/Y', strtotime($reportsDetails->date_of_current_appoinment)) . ' , ' . $currentDesignation  ?></td>
    </tr>
    <tr>
        <td style="width:4%">4.</td>
        <td>വകുപ്പ്</td>
        <td style="width: 40%;"><?= $reportsDetails->department_name_mal ?></td>
    </tr>
    <tr>
        <td style="width:4%">5.</td>
        <td>നിലവിലെ ജോലി നിര്‍വഹിക്കുന്നതില്‍ കാണിക്കുന്ന കാര്യക്ഷമത</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($performanceStatuses) - 1;
            foreach ($performanceStatuses as $performanceStatus) : ?>
                <?= $performanceStatus->status_name  ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach; ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">6.</td>
        <td>ഉത്തരവാദിത്തങ്ങള്‍ ഏറ്റെടുക്കാനുള്ള സന്നദ്ധത</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($performanceStatuses) - 1;
            foreach ($performanceStatuses as $performanceStatus) : ?>
                <?= $performanceStatus->status_name  ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach; ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">7.</td>
        <td>ആളുകളുമായി ഇടപഴകാനുള്ള കഴിവ്</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($performanceStatuses) - 1;
            foreach ($performanceStatuses as $performanceStatus) : ?>
                <?= $performanceStatus->status_name  ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach; ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">8.</td>
        <td>സ്ഥാപനത്തോടുള്ള വിശ്വസ്തത</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($performanceStatuses) - 1;
            foreach ($performanceStatuses as $performanceStatus) : ?>
                <?= $performanceStatus->status_name  ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach; ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">9.</td>
        <td>കോളേജിലും പുറത്തുമുള്ള അച്ചടക്കത്തിന്‍റെയും മാന്യതയുടെയും നിലവാരം</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($performanceStatuses) - 1;
            foreach ($performanceStatuses as $performanceStatus) : ?>
                <?= $performanceStatus->status_name  ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach; ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">10.</td>
        <td>ആത്മാര്‍ത്ഥത, ആശ്രയത്വം, സഹകരണം എന്നിവയുടെ നില</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($performanceStatuses) - 1;
            foreach ($performanceStatuses as $performanceStatus) : ?>
                <?= $performanceStatus->status_name  ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach; ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">11.</td>
        <td>കോളേജിലെ ഉയര്‍ന്ന ഉത്തരവാദിത്തങ്ങള്‍ വഹിക്കാന്‍ അവനെ/അവളെ യോഗ്യനാക്കുന്നതിന് നിലവിലെ പ്രകടനം തൃപ്തികരമാണോ?</td>
        <td style="width: 40%;">
            <?php
            $i = 0;
            $size = sizeof($yes_and_no_enum_mal) - 1;
            foreach ($yes_and_no_enum_mal as $yes_and_no) : ?>
                <?= $yes_and_no['value']   ?>
                <?= ($i < $size) ? '/' : ''; ?>
            <?php $i++;
            endforeach;
            ?>
        </td>
    </tr>
    <tr>
        <td style="width:4%">12.</td>
        <td>ഡിപ്പാര്‍ട്ട്മെന്‍റ് മേധാവിയുടെ അധിക പരാമര്‍ശങ്ങള്‍, എന്തെങ്കിലും ഉണ്ടെങ്കില്‍, ഒപ്പ്</td>
        <td style="width: 40%;"> <br><br><br><br><br><br></td>
    </tr>
    <tr>
        <td style="width:4%">13.</td>
        <td>ഒപ്പോടുകൂടിയ പ്രിന്‍സിപ്പലിന്‍റെ വിലയിരുത്തല്‍</td>
        <td style="width: 40%;"><br><br><br><br><br><br></td>
    </tr>
    <tr>
        <td style="width:4%">14.</td>
        <td>സെക്രട്ടറിയുടെ ഉത്തരവ്</td>
        <td style="width: 40%;"><br><br><br><br><br><br></td>
    </tr>
</table>
<p>വകുപ്പ് മേധാവികളും വകുപ്പ് തലവന്മാരില്‍ റിപ്പോര്‍ട്ട് ചെയ്യുമ്പോള്‍ പ്രിന്‍സിപ്പലും പൂരിപ്പിക്കേണ്ട കോളം 1 മുതല്‍ 12 വരെ.</p>