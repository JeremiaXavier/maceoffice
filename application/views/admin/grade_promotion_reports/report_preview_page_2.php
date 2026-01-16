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


<h3 class="margin-0" style="text-align: center;">മാര്‍ അത്തനേഷ്യസ് കോളേജ് ഓഫ് എഞ്ചിനീയറിംഗ്, കോതമംഗലം </h3>
<h3 class="margin-0 small-size" style="text-align: center;">ഹയര്‍ ഗ്രേഡ്/നോണ്‍ കേഡര്‍ പ്രമോഷന്‍ അനുവദിക്കുന്നതിനുള്ള നിര്‍ദ്ദേശം</h3>
<h3 class="margin-0 small-size" style="text-align: center;">(ഓരോ ഉദ്യോഗസ്ഥര്‍ക്കും പ്രത്യേകം സമര്‍പ്പിക്കണം)</h3>
<h3 class="margin-0 small-size" style="text-align: center;">(ഗസറ്റഡ് ഓഫീസര്‍ക്കായി ഡ്യൂപ്ലിക്കേറ്റായി സമര്‍പ്പിക്കണം)</h3>
</h3>


<br>


<table id="tb1" border=1 style="width: 100%;border-collapse: collapse;">
    <tr>
        <td style="width:6%;text-align:right;">1</td>
        <td style="width:50%;" class="small-size"> പേരും പെന്‍ നമ്പറും പദവിയും</td>
        <td class="small-size" style="width:70%;">
            <?= $reportsDetails->employee_name_mal . ' , ' ?>
            <?= $reportsDetails->pen_number  . ' , ' ?>
            <?= $reportsDetails->designation_name_mal  ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 2</td>
        <td class="small-size" style="width:40%;">യോഗ്യത
            (ആവശ്യമെങ്കില്‍ മാര്‍ക്കിന്‍റെ ശതമാനം സഹിതം)</td>
        <td class="small-size"><?= $reportsDetails->qualification . ' ' . $reportsDetails->marks_percentage ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;">3</td>
        <td class="small-size" style="width:40%;">എഞ്ചിനീയറിംഗില്‍ പി.ജി. ബിരുദം കരസ്ഥമാക്കിയ തീയതി
            (നോണ്‍ കേഡര്‍ ഉദ്യോഗക്കയറ്റ ത്തിന് മാത്രം)</td>
        <td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->date_of_pg)) ?></td>
    </tr>

    <?php
    // Designations
    $searchId = $reportsDetails->from_designation;
    $filtered = array_filter($designationsList, function ($obj) use ($searchId) {
        return $obj->designation_id == $searchId;
    });
    $filtered = reset($filtered);
    $fromDesignation = (!empty($filtered)) ? $filtered->designation_name_mal : 'NA';


    $searchId = $reportsDetails->to_designation;
    $filtered = array_filter($designationsList, function ($obj) use ($searchId) {
        return $obj->designation_id == $searchId;
    });
    $filtered = reset($filtered);
    $toDesignation = (!empty($filtered)) ? $filtered->designation_name_mal : 'NA';


    // Scale of Pays
    $searchId = $reportsDetails->from_scale_of_pay;
    $filtered = array_filter($payScalesList, function ($obj) use ($searchId) {
        return $obj->sop_id == $searchId;
    });
    $filtered = reset($filtered);
    $fromScaleofPay = (!empty($filtered)) ? $filtered->pay_range : 'NA';


    $searchId = $reportsDetails->to_scale_of_pay;
    $filtered = array_filter($payScalesList, function ($obj) use ($searchId) {
        return $obj->sop_id == $searchId;
    });
    $filtered = reset($filtered);
    $toScaleofPay = (!empty($filtered)) ? $filtered->pay_range : 'NA';


    ?>
    <tr>
        <td style="width:6%;text-align:right;"> 4</td>
        <td class="small-size" style="width:40%;">പ്രവേശന ഗ്രേഡ് </td>
        <td class="small-size"></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> a)</td>
        <td class="small-size" style="width:40%;">പദവി</td>
        <td class="small-size"><?= $fromDesignation ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> b)</td>
        <td class="small-size" style="width:40%;">ശമ്പള സ്കെയില്‍</td>
        <td class="small-size"><?= $fromScaleofPay ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> c)</td>
        <td class="small-size" style="width:40%;">സേവനം ആരംഭിച്ച തീയതി</td>
        <td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->from_date)) ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 5</td>
        <td class="small-size" style="width:40%;">ഉയര്‍ന്ന ഗ്രേഡ്/കേഡര്‍ ഇതര ഉദ്യോഗക്കയറ്റം അനുവദിക്കേ തസ്തിക</td>
        <td class="small-size"></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> a)</td>
        <td class="small-size" style="width:40%;">പദവി</td>
        <td class="small-size"><?= $toDesignation ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> b)</td>
        <td class="small-size" style="width:40%;">ശമ്പള സ്കെയില്‍</td>
        <td class="small-size"><?= $toScaleofPay ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> c)</td>
        <td class="small-size" style="width:40%;">സേവനം ആരംഭിച്ച തീയതി</td>
        <td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->to_date)) ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 6</td>
        <td class="small-size" style="width:40%;">കെഎസ്ആര്‍ പാര്‍ട്ട് 1 റൂള്‍ 33 ന് കീഴിലുള്ള
            സര്‍ക്കാര്‍ തീരുമാനം നമ്പര്‍ 2 അനുസരിച്ച്
            വാര്‍ഷിക വര്‍ദ്ധനവിനായി താല്‍ക്കാലിക സേവന
            കാലയളവിന്‍റെ വിശദാംശങ്ങള്‍</td>
        <td class="small-size"></td>
    </tr>
</table>
<table border=1 style="width: 100%;border-collapse: collapse;">

    <tr>
        <td class="small-size">തസ്തിക</td>
        <td class="small-size">ശമ്പള സ്കെയില്‍</td>
        <td class="small-size">തുടക്കം</td>
        <td class="small-size">ഒടുക്കം </td>
        <td class="small-size" colspan="3">കാലയളവ്</td>
    </tr>
    <tr>
        <td class="small-size">&nbsp;</td>
        <td class="small-size">&nbsp;</td>
        <td class="small-size">&nbsp;</td>
        <td class="small-size">&nbsp;</td>

        <td class="small-size">വര്‍ഷം</td>
        <td class="small-size">മാസം </td>
        <td class="small-size">ദിവസം</td>

    </tr>

    <?php if (empty($temporaryService)) : ?>
        <tr>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>

            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>

        </tr>
    <?php endif; ?>

    <?php foreach ($temporaryService as $services) : ?>
        <tr>
            <td class="small-size"><?= $services->temporary_post ?></td>
            <td class="small-size"><?= $services->temporary_scale_of_pay ?></td>
            <td class="small-size"><?= date('d/m/Y', strtotime($services->temporary_from_date)) ?></td>
            <td class="small-size"><?= date('d/m/Y', strtotime($services->temporary_to_date)) ?></td>

            <td class="small-size"><?= $services->temporary_years ?></td>
            <td class="small-size"><?= $services->temporary_months ?></td>
            <td class="small-size"><?= $services->temporary_days ?></td>

        </tr>
    <?php endforeach; ?>

</table>



<table border=1 style="width: 100%;border-collapse: collapse;table-layout: fixed;">
    <tr>
        <td style="width:6%;"> 7</td>
        <td class="small-size" style="width:40%;">സ്വകാര്യ എഞ്ചിനീയറിംഗ് കോളേജുകളിലെ /
            പോളിടെക്നിക്കിലെ സേവനത്തിന്‍റെ
            (അധ്യാപനം) വിശദാംശങ്ങള്‍</td>
        <td class="small-size"></td>
    </tr>
</table>
<table border=1 style="width: 100%;border-collapse: collapse;">

    <tr>
        <td class="small-size">തസ്തിക</td>
        <td class="small-size">ശമ്പള സ്കെയില്‍</td>
        <td class="small-size">തുടക്കം</td>
        <td class="small-size">ഒടുക്കം </td>
        <td class="small-size" colspan="3">കാലയളവ്</td>
    </tr>
    <tr>
        <td class="small-size">&nbsp;</td>
        <td class="small-size">&nbsp;</td>
        <td class="small-size">&nbsp;</td>
        <td class="small-size">&nbsp;</td>

        <td class="small-size">വര്‍ഷം</td>
        <td class="small-size">മാസം </td>
        <td class="small-size">ദിവസം</td>

    </tr>

    <?php if (empty($serviceDetails)) : ?>
        <tr>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>

            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>
            <td class="small-size">&nbsp;</td>

        </tr>
    <?php endif; ?>

    <?php foreach ($serviceDetails as $services) : ?>
        <tr>

            <td class="small-size"><?= $services->service_post ?></td>
            <td class="small-size"><?= $services->service_scale_of_pay ?></td>
            <td class="small-size"><?= date('d/m/Y', strtotime($services->service_from_date)) ?></td>
            <td class="small-size"><?= date('d/m/Y', strtotime($services->service_to_date)) ?></td>

            <td class="small-size"><?= $services->service_years ?></td>
            <td class="small-size"><?= $services->service_months ?></td>
            <td class="small-size"><?= $services->service_days ?></td>

        </tr>
    <?php endforeach; ?>

</table>


<table border=1 style="width: 100%;border-collapse: collapse;">

    <tr>
        <td style="width:6%;text-align:right;"> 8</td>
        <td class="small-size" style="width:40%;">ഉയര്‍ന്ന ഗ്രേഡ് / നോണ്‍-കേഡര്‍
            എന്നിവയ്ക്കായി കണക്കാക്കുന്നില്ലെങ്കില്‍
            സേവനം എന്തങ്കിലും ഉണ്ടെങ്കിൽ കാലയളവ് </td>
        <td class="small-size"></td>
    </tr>

    <tr>
        <td style="width:6%;text-align:right;"> a)</td>
        <td class="small-size" style="width:40%;">സര്‍ക്കാര്‍ സേവനത്തിന് പുറത്തുള്ള ജോലിക്ക്
            അനുവദിച്ച ശൂന്യവേതനാവധിയും വിദേശത്തുള്ള
            ഭര്‍ത്താക്കന്മാരെ അനുഗമിക്കുന്നതിന് വനിതാ
            ഓഫീസര്‍മാര്‍ക്ക് അനുവദിച്ച ശൂന്യവേത
            നാവധിയും </td>
        <td class="small-size"><?= $reportsDetails->lwa_granted ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> b)</td>
        <td class="small-size" style="width:40%;">
            സഞ്ചിത പ്രഭാവേത്താടെ ഇന്‍ക്രിമെന്‍റ് തടഞ്ഞ
            കാലയളവ്
        </td>
        <td class="small-size"><?= $reportsDetails->increment_barred_period ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> c)</td>
        <td class="small-size" style="width:40%;">ഉദ്യോഗസ്ഥന്‍ ഉദ്യോഗക്കയറ്റത്തില്‍ ഉയര്‍ന്ന
            പദവി വഹിക്കുന്ന കാലയളവ് </td>
        <td class="small-size"><?= $reportsDetails->higher_post_period ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> d)</td>
        <td class="small-size" style="width:40%;">മറ്റ് കാലയളവുകള്‍, ഉയര്‍ന്ന ഗ്രേഡിനായി
            കണക്കാക്കാത്ത എന്തെങ്കിലും ഉണ്ടെങ്കിൽ </td>
        <td class="small-size"><?= $reportsDetails->other_period ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 9</td>
        <td class="small-size" style="width:40%;">പഠന ആവശ്യത്തിനോ മറ്റ് ആവശ്യത്തിനോ
            എടുത്ത ശൂന്യവേതനാവധി
            (നോണ്‍ കേഡര്‍ പ്രമോഷന് മാത്രം)
        </td>
        <td class="small-size"><?= $reportsDetails->leave_without_allowance ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 10</td>
        <td class="small-size" style="width:40%;">അടുത്ത ഉദ്യോഗക്കയറ്റ തസ്തിക
            (ശമ്പള സ്കെയിലിനൊപ്പം) </td>
        <td class="small-size"><?= $reportsDetails->next_promotion_post ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 11</td>
        <td class="small-size" style="width:40%;">ഉദ്യോഗക്കയറ്റത്തിന് നിര്‍ദ്ദേശിച്ചിട്ടുള്ള ഉയര്‍ന്ന
            അക്കാദമിക് യോഗ്യതകള്‍ എന്തെങ്കിലും
            ഉണ്ടെങ്കിൽ ഓഫീസര്‍ പ്രോസസ്സ് ചെയ്യുന്നുാേ </td>
        <td class="small-size"><?= $reportsDetails->superior_academic_qualification ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 12</td>
        <td class="small-size" style="width:40%;">ഉദ്യോഗസ്ഥന് അര്‍ഹതയുള്ള ഉയര്‍ന്ന ഗ്രേഡ് </td>
        <td class="small-size"><?= $toDesignation ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 13</td>
        <td class="small-size" style="width:40%;">ഉയര്‍ന്ന ഗ്രേഡ് / നോണ്‍-കേഡര്‍ ഉദ്യോഗക്കയറ്റം
            ശുപാര്‍ശ ചെയ്യുന്ന തസ്തികയിലെ യോഗ്യതാ
            സേവനത്തിന്‍റെ വര്‍ഷങ്ങള്‍ പൂര്‍ത്തിയാക്കിയ
            തീയതി </td>
        <td class="small-size"><?= date('d-m-Y', strtotime($reportsDetails->end_service_date)) ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 14</td>
        <td class="small-size" style="width:40%;">ഉയര്‍ന്ന ഗ്രേഡ് തിരഞ്ഞെടുത്ത തീയതി
            (നോണ്‍-കേഡര്‍ ഉദ്യോഗക്കയറ്റത്തിന് ബാധകമല്ല) </td>
        <td class="small-size"><?= date('d-m-Y', strtotime($reportsDetails->promotion_date)) ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 15</td>
        <td class="small-size" style="width:40%;">ഓപ്ഷന്‍ ഉൾപെടുത്തിയിട്ടുണ്ടോ
            (നോണ്‍-കേഡര്‍ ഉദ്യോഗക്കയറ്റത്തിന് ബാധകമല്ല) </td>
        <td class="small-size"><?= $reportsDetails->option_enclosed ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 16</td>
        <td class="small-size" style="width:40%;">ഉയര്‍ന്ന ഗ്രേഡ്/നോണ്‍-കേഡര്‍ ഉദ്യോഗക്കയറ്റം
            ശുപാര്‍ശ ചെയ്യുന്ന തീയതി </td>
        <td class="small-size"><?= date('d-m-Y', strtotime($reportsDetails->promotion_date)) ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 17</td>
        <td class="small-size" style="width:40%;">ഇനം 16-ലെ തീയതി മുതല്‍ പ്രവര്‍ ത്തിച്ച
            സ്ഥാപനങ്ങള്‍
            (ഓരോ സ്ഥാപനത്തിലെയും കാലയളവ്
            വ്യക്തമാക്കുക </td>
        <td class="small-size"><?= $reportsDetails->office_name_mal ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> 18</td>
        <td class="small-size" style="width:40%;">പരാമര്‍ശങ്ങള്‍ </td>
        <td class="small-size"></td>
    </tr>

</table>


<p class="small-size" style="text-align: center;">മുകളില്‍ നല്‍കിയിരിക്കുന്ന വിശദാംശങ്ങള്‍ പ്രസക്തമായ രേഖകള്‍ ഉപയോഗിച്ച് പരിശോധിച്ച് ശരിയാണെന്ന് സാക്ഷ്യെപ്പടുത്തി.</p>

<div class="small-size margin-0" style="width: 50%;float: right;">
    ഒപ്പ് : <br>
    പേര് : <br>
    സ്ഥാപന മേധാവിയുടെ പദവി : <br>
</div>

<br>
<br><br>
<table>
    <tr style="width: 50%;">
        <td class="small-size">സ്ഥലം: </td>
        <td class="small-size">കോതമംഗലം</td>
    </tr>
    <tr style="width: 50%;">
        <td class="small-size">തീയതി: </td>
        <td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->report_date)) ?></td>
    </tr>
</table>