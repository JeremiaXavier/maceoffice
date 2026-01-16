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


<h3 class="margin-0" style="text-align: center;">രൂപരേഖ - എ </h3>
<h3 class="margin-0" style="text-align: center;">(ഡയറക്ട് പേമെന്‍റ് എഗ്രിമെന്‍റിന് കീഴില്‍ നേരിട്ടുള്ള നിയമനം വഴിയുള്ള നിയമനങ്ങളുടെ അംഗീകാരം/പ്രവേശനത്തിനുള്ള നിര്‍ദ്ദേശങ്ങള്‍ക്കൊപ്പം)
</h3>


<br>


<table id="tb1" border=1 style="width: 100%;border-collapse: collapse;">
    <tr>
        <td style="width:6%;text-align:right;">1. a)</td>
        <td style="width:50%;" class="small-size">ജീവനക്കാരന്‍റെ/ജീവനക്കാരിയുടെ പേരും പെന്‍ നമ്പറും ശമ്പള സ്കെയിലും</td>
        <td class="small-size" style="width:70%;">
            <?= $reportsDetails->employee_name_mal . ' , ' ?>
            <?= $reportsDetails->pen_number  . ' , ' ?>
            <?= $reportsDetails->pay_range  ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> b)</td>
        <td class="small-size" style="width:40%;">വിഭാഗവും ട്രേഡൂം</td>
        <td class="small-size"><?= $reportsDetails->department_name_mal ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;">2. a)</td>
        <td class="small-size" style="width:40%;">ഒഴിവ് വന്ന തീയതി</td>
        <td class="small-size"><?= date('d/m/Y', strtotime($reportsDetails->previous_employee_date)) ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> b)</td>
        <td class="small-size" style="width:40%;">പ്രസ്തുത ഒഴിവ് എങ്ങനെയാണ് ഉണ്ടായത് </td>
        <td class="small-size"><?= $reportsDetails->vacancy_reason ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> c)</td>
        <td class="small-size" style="width:40%;">ഉയര്‍ന്ന വിഭാഗത്തിലേക്ക് സ്ഥാനക്കയറ്റം ലഭിച്ചതിനാലാണ് ഒഴിവ് സംഭവിച്ചതെങ്കില്‍, ഡയറക്ട് പേമെന്‍റ് എഗ്രിമെന്‍റിന് കീഴില്‍ പ്രമോഷന്‍ അംഗീകരിച്ചതോ പ്രവേശനം നേടിയതോ ആയ ഡയറക്ടറുടെ ഉത്തരവിന്‍റെ നമ്പറും തീയതിയും നല്‍കുക.</td>
        <?php if ($reportsDetails->vacancy_due_higher_category == 'N') : ?>
            <td class="small-size">NA</td>
        <?php else : ?>
            <td class="small-size"><?= $reportsDetails->director_order_no . ' ' . date('d/m/Y', strtotime($reportsDetails->diretor_order_date)) ?></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> d)</td>
        <td class="small-size" style="width:40%;">പെന്‍ നമ്പര്‍</td>
        <td class="small-size"><?= $reportsDetails->pen_number ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 3</td>
        <td class="small-size" style="width:40%;">ഒഴിവുകളുടെ സ്വഭാവം (സ്ഥിരമോ താല്‍ക്കാലികമോ എന്ന് വ്യക്തമാക്കുക)</td>
        <td class="small-size"><?= $reportsDetails->nature_mal ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 4</td>
        <td class="small-size" style="width:40%;">ജീവനക്കാരന്‍റെ/ജീവനക്കാരിയുടെ പേര്</td>
        <td class="small-size"><?= $reportsDetails->employee_name_mal ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 5</td>
        <td class="small-size" style="width:40%;">സ്ഥിര വിലാസം</td>
        <td class="small-size"><?= $reportsDetails->employee_address ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 6</td>
        <td class="small-size" style="width:40%;">ക്രിസ്തുവര്‍ഷത്തിലെ ജനനത്തീയതി(അക്കങ്ങളിലും അക്ഷരങ്ങളിലും)</td>
        <td class="small-size"><?= date('d-m-Y', strtotime($reportsDetails->date_of_birth)) . ' ' . $reportsDetails->date_of_birth_text ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 7</td>
        <td class="small-size" style="width:40%;">ജാതിയും മതവും
            (ജീവനക്കാരന്‍/ജീവനക്കാരി എസ്.സി.യോ എസ്.ടി.യോ ഒ.ബി.സിയോ ആണോ എന്നും പ്രായത്തില്‍ ഇളവിന് അര്‍ഹതയുണ്ടോ എന്നും വ്യക്തമാക്കുക)
        </td>
        <?php
        $key = array_search($reportsDetails->age_concession, array_column($have_and_not_enum, 'id'));
        $age_concession = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $reportsDetails->employee_religion . ' <br> ' . $reportsDetails->employee_caste . '<br> ' ?>
            <?= $age_concession  ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;"> 8</td>
        <td class="small-size" style="width:40%;">ജീവനക്കാരന്/ജീവനക്കാരിക്ക് ഉള്ള യോഗ്യത</td>
        <td class="small-size"></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> a)</td>
        <td class="small-size" style="width:40%;">സാധാരണ</td>
        <td class="small-size"><?= $reportsDetails->general_qualification ?></td>
    </tr>
    <tr>
        <td style="width:6%;text-align:right;"> b)</td>
        <td class="small-size" style="width:40%;">സാങ്കേതികം</td>
        <td class="small-size"><?= $reportsDetails->technical_qualification ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 9</td>
        <td class="small-size" style="width:40%;">മുന്‍കാല പ്രവര്‍ത്തി പരിചയം (സാങ്കേതികം/അദ്ധ്യാപനം എന്തെങ്കിലും ഉണ്ടെങ്കില്‍)</td>
        <td class="small-size"><?= $reportsDetails->employee_experience ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 10</td>
        <td class="small-size" style="width:40%;">ഗവണ്‍മെന്‍റ്/യൂണിവേഴ്സിറ്റി നിര്‍ദ്ദേശിച്ചിട്ടുള്ള യോഗ്യതകളും പ്രായപരിധിയും അനുസരിച്ച് ജീവനക്കാരന്/ജീവനക്കാരിക്ക് പൂര്‍ണ്ണ യോഗ്യതയുണ്ടോ എന്ന്</td>
        <?php
        $key = array_search($reportsDetails->qualified_for_promotion, array_column($have_and_not_enum, 'id'));
        $qualified_for_promotion = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $qualified_for_promotion ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;"> 11</td>
        <td class="small-size" style="width:40%;">നിയമനത്തിനായി ജീവനക്കാരനെ/ജീവനക്കാരിയെ നിയമന കമ്മിറ്റി തിരഞ്ഞെടുത്തിട്ടുണ്ടോ. അങ്ങനെയെങ്കില്‍, പ്രിന്‍സിപ്പലിന്‍റെ കത്തിന്‍റെ നമ്പറും തീയതിയും ഉള്‍പ്പെടെ കമ്മിറ്റിയുടെ മിനിറ്റ്സ് സാങ്കേതിക വിദ്യാഭ്യാസ ഡയറക്ടര്‍ക്ക് കൈമാറിയിട്ടുണ്ടോ.</td>
        <?php
        $key = array_search($reportsDetails->committee_selected, array_column($have_and_not_enum, 'id'));
        $committee_selected = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $committee_selected . ' ' . $reportsDetails->committee_details ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;"> 12</td>
        <td class="small-size" style="width:40%;">തിരഞ്ഞെടുത്ത പട്ടികയിലെ ജീവനക്കാരന്‍റെ/ജീവനക്കാരിയുടെ റാങ്ക്. റാങ്കില്‍ ഒന്നാമനല്ലെങ്കില്‍ ഉയര്‍ന്ന റാങ്കിലുള്ളവര്‍ക്കെല്ലാം നിയമന ഉത്തരവ് നല്‍കിയിട്ടുണ്ടോ.</td>
        <td class="small-size"><?= $reportsDetails->rank . ' ' . $reportsDetails->rank_details ?></td>
    </tr>
    <tr>
        <td style="width:6%;"> 13</td>
        <td class="small-size" style="width:40%;">ഗവേണിംഗ് ബോഡി ചെയര്‍മാന്‍ നല്‍കിയ നിയമന ഉത്തരവിന്‍റെ പകര്‍പ്പ് ഇതോടൊപ്പം ചേര്‍ത്തിട്ടുണ്ടോ</td>
        <?php
        $key = array_search($reportsDetails->governing_order_attached, array_column($have_and_not_enum, 'id'));
        $governing_order_attached = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $governing_order_attached ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;"> 14</td>
        <td class="small-size" style="width:40%;">സേവനത്തില്‍ ചേരുന്ന തീയതി (പൂര്‍വ്വാഹ്നമോ അപരാഹ്നമോ എന്ന് വ്യക്തമാക്കുക)</td>
        <td class="small-size">
            <?= $reportsDetails->date_of_joining != '0000-00-00' ?  date('d/m/Y', strtotime($reportsDetails->date_of_joining)) : '' ?>
            <?= ' ' . $fn_and_an_enum[$reportsDetails->date_of_joining_time - 1]['value_mal'] ?></td>
    </tr>
    <tr>
        <td style="width:6%;">15 </td>
        <td class="small-size" style="width:40%;">നിയമനം അംഗീകരിച്ച സര്‍വകലാശാലയുടെ ഉത്തരവിന്‍റെ നമ്പറും തീയതിയും (എഞ്ചിനീയറിംഗ് കോളേജിലെ ടീച്ചിംഗ് സ്റ്റാഫിലെ അംഗങ്ങളുടെ കാര്യത്തില്‍ മാത്രം) ഉത്തരവിന്‍റെ പകര്‍പ്പ് ഇതോടൊപ്പം ചേര്‍ത്തിട്ടുണ്ടോ</td>
        <?php
        $key = array_search($reportsDetails->promotion_order_attached, array_column($have_and_not_enum, 'id'));
        $promotion_order_attached = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $promotion_order_attached ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;"> 16</td>
        <td class="small-size" style="width:40%;">ജനനത്തീയതി, യോഗ്യത, പ്രവര്‍ത്തി പരിചയം തുടങ്ങിയവ തെളിയിക്കുന്നതിനുള്ള അസ്സല്‍ സര്‍ട്ടിഫിക്കറ്റുകള്‍ ഇതോടൊപ്പം ചേര്‍ത്തിട്ടുണ്ടോ (ചേര്‍ത്തിട്ടുള്ള രേഖകളുടെ പേരുകള്‍ വ്യക്തമാക്കുക)</td>
        <?php
        $key = array_search($reportsDetails->original_certificates_attached, array_column($have_and_not_enum, 'id'));
        $original_certificates_attached = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $original_certificates_attached  ?>
            <?= $reportsDetails->original_certificates_list ? ',' . $reportsDetails->original_certificates_list : '' ?>
        </td>
    </tr>
    <tr>
        <td style="width:6%;"> 17</td>
        <td class="small-size" style="width:40%;">ജീവനക്കാരന്‍റെ/ജീവനക്കാരിയുടെ സേവന പുസ്തകം ചേര്‍ത്തിട്ടുണ്ടോ</td>
        <?php
        $key = array_search($reportsDetails->service_book_attached, array_column($have_and_not_enum, 'id'));
        $service_book_attached = $have_and_not_enum[$key]['value'];
        ?>
        <td class="small-size">
            <?= $service_book_attached ?>
        </td>
    </tr>

</table>


<p class="small-size" style="text-align: center;">മുകളില്‍ നല്‍കിയിരിക്കുന്ന വിശദാംശങ്ങള്‍ ശരിയാണെന്ന് സാക്ഷ്യപ്പെടുത്തി.</p>

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


<p class="small-size" style="text-align: center;">കുറിപ്പ്: ട്രേഡ് ഇന്‍സ്ട്രക്ടര്‍മാരുടെയും ട്രേഡ്സ്മാന്‍റെയും കാര്യത്തില്‍, ആ തസ്തികയുടെ കൃത്യമായ ട്രേഡ് ക്രമ നമ്പര്‍ 1 (ആ) ന് എതിരായി കാണിക്കണം, ബ്രാഞ്ച് മാത്രമല്ല</p>