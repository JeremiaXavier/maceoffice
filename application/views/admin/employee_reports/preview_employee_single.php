<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Data Sheet</title>
    <style type="text/css">
        body {
            margin: 40px;
            font-size: smaller;
        }

        #t1 {
            width: 50%;
            text-align: left;
        }

        #t1 td,
        #t1 th {
            width: 25%;
        }

        #t2 {
            width: 100%;
            text-align: left;
        }

        #t2 td,
        #t2 th {
            width: 25%;
        }

        #t4 {
            width: 100%;
        }

        #t4 th {
            background-color: lightgrey;
            text-align: left;
        }
    </style>
</head>

<body style="font-size:small">
    <hr>
    <h4 style="text-align: center;">Mar Athanasius College<br>of Engineering - Kothamangalam<br>Employee Data Sheet</h4>
    <hr>

    <table id="t1">
        <tr>
            <th>PEN : </th>
            <td><?= $employeeDetails->employee_number ?></td>
            <th>Name : </th>
            <td><?= strtoupper($employeeDetails->employee_name) ?></td>
        </tr>
    </table>
    <br><br>


    <div style="background-color: lightgrey;">
        <table>
            <tr>
                <th>
                    <h4>Personal Memoranda</h4>
                </th>

            </tr>
        </table>
    </div>
    <table id="t2">
        <tr>
            <th style="text-align: left;">Sex :</th>
            <td><?= $personalDetails->gender == 1 ? 'F' : 'M' ?></td>
            <th style="text-align: left;">Nationality :</th>
            <td><?= $personalDetails->country ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Date of birth :</th>
            <td><?= date('d/m/Y', strtotime($personalDetails->date_of_birth)) ?></td>
            <th style="text-align: left;">Date of superannuation :</th>
            <td><?= date('d/m/Y', strtotime($personalDetails->date_of_superannuation)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Religion :</th>
            <td><?= $religions[$personalDetails->religion]->name ?></td>
            <th style="text-align: left;">Caste :</th>
            <td><?= $personalDetails->caste ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Category(SC/ST/OBC/OC/GEN) :</th>
            <td><?= $personalDetails->caste_category_name ?></td>
            <th style="text-align: left;">Physically handicapped(Yes/No) :</th>
            <td><?= $personalDetails->handicapped  ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">PAN Number :</th>
            <td><?= $personalDetails->pan_number ?></td>
            <th style="text-align: left;">Marital Status :</th>
            <td><?= $personalDetails->marital_status ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Spouse's Name :</th>
            <td><?= $personalDetails->spouse_name ?></td>
            <th style="text-align: left;">Is Inter Religion / Caste(Yes/No) :</th>
            <td><?= $personalDetails->inter_caste ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Spouse's Religion :</th>
            <td><?= $religions[$personalDetails->spouse_religion]->name ?></td>

        </tr>
    </table>
    <br><br>

    <div style="background-color: lightgrey;">
        <table>
            <tr>
                <th>
                    <h4>Present Service Details</h4>
                </th>

            </tr>
        </table>
    </div>
    <table id="t2">
        <tr>
            <th style="text-align: left;">Department :</th>
            <td><?= $presentserviceDetails->department_name ?></td>
            <th style="text-align: left;">Date of joining in Gov. Service :</th>
            <td><?= date('d/m/Y', strtotime($presentserviceDetails->date_of_joining)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Scale of Pay :</th>
            <td><?= $presentserviceDetails->pay_range ?></td>
            <th style="text-align: left;">Present Pay :</th>
            <td><?= $presentserviceDetails->present_pay ?></td>
        </tr>


    </table>
    <br><br>

    <div style="background-color: lightgrey;">
        <table>
            <tr>
                <th>
                    <h4>Present Address</h4>
                </th>
                <th>
                    <h4>Permanent Address</h4>
                </th>
            </tr>
        </table>
    </div>
    <table id="t2">

        <tr>
            <th style="text-align: left;">House No and Name :</th>
            <td><?= $addressDetails->present_house_no_name ?></td>
            <th style="text-align: left;">House No and Name :</th>
            <td><?= $addressDetails->permanent_house_no_name ?></td>
        </tr>

        <tr>
            <th style="text-align: left;">Street Name :</th>
            <td><?= ucfirst(strtolower($addressDetails->present_street)) ?></td>
            <th style="text-align: left;">Street Name :</th>
            <td><?= ucfirst(strtolower($addressDetails->permanent_street)) ?></td>
        </tr>

        <tr>
            <th style="text-align: left;">Place :</th>
            <td><?= ucfirst(strtolower($addressDetails->present_place)) ?></td>
            <th style="text-align: left;">Place :</th>
            <td><?= ucfirst(strtolower($addressDetails->permanent_place)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Pin :</th>
            <td><?= $addressDetails->present_pin ?></td>
            <th style="text-align: left;">Pin :</th>
            <td><?= $addressDetails->permanent_pin ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">State :</th>
            <td><?= ucfirst(strtolower($states[$addressDetails->present_state]->name)) ?></td>
            <th style="text-align: left;">State :</th>
            <td><?= ucfirst(strtolower($states[$addressDetails->permanent_state]->name)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">District :</th>
            <td><?= ucfirst(strtolower($districts[$addressDetails->present_district]->name)) ?></td>
            <th style="text-align: left;">District :</th>
            <td><?= ucfirst(strtolower($districts[$addressDetails->permanent_district]->name)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Taluk :</th>
            <td><?= ucfirst(strtolower($addressDetails->present_taluk)) ?></td>
            <th style="text-align: left;">Taluk :</th>
            <td><?= ucfirst(strtolower($addressDetails->permanent_taluk)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Village :</th>
            <td><?= ucfirst(strtolower($addressDetails->present_village)) ?></td>
            <th style="text-align: left;">Village :</th>
            <td><?= ucfirst(strtolower($addressDetails->permanent_village)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Constituency :</th>
            <td><?= ucfirst(strtolower($addressDetails->present_constituency)) ?></td>
            <th style="text-align: left;">Constituency :</th>
            <td><?= ucfirst(strtolower($addressDetails->permanent_constituency)) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Phone Number :</th>
            <td><?= $addressDetails->present_phone ?></td>
            <th style="text-align: left;">Phone Number :</th>
            <td><?= $addressDetails->permanent_phone ?></td>
        </tr>
        <tr>
            <th style="text-align: left;">Home Town :</th>
            <td><?= ucfirst(strtolower($addressDetails->home_town)) ?></td>
            <th style="text-align: left;">Mobile Number :</th>
            <td><?= $addressDetails->mobile_number ?></td>
        </tr>

        <tr>
            <th style="text-align: left;">Email Address :</th>
            <td><?= $addressDetails->email_address ?></td>

        </tr>


    </table>
    <br><br>


    <table id="t4" style="table-layout: fixed;">
        <tr>
            <th colspan="8" style="background-color: transparent;text-align: left;">Appoinment Orders</th>
        </tr>
        <tr>
            <th style="display: inline-block;text-align: left;">Designation</th>
            <th style="display: inline-block;text-align: left;">With Effect <br> From </th>
            <th style="display: inline-block;text-align: left;">Appoinment Order No</th>
            <th style="display: inline-block;text-align: left;">Appoinment Order <br> Date</th>
            <th style="display: inline-block;text-align: left;">Approval Order No</th>
            <th style="display: inline-block;text-align: left;">Approval Order <br> Date</th>
        </tr>
        <?php foreach ($appoinmentDetails as $appoinmentDetail) : ?>
            <tr style="border: 1px solid red;">
                <td style="display: inline-block;text-align: left;"><?= $appoinmentDetail->designation_name ?></td>
                <td style="display: inline-block;text-align: left;"><?= date('d/m/Y', strtotime($appoinmentDetail->effect_from)) ?></td>
                <td style="display: inline-block;text-align: left;"><?= $appoinmentDetail->appoinment_order_no ?></td>
                <td style="display: inline-block;text-align: left;"><?= date('d/m/Y', strtotime($appoinmentDetail->appoinment_date)) ?></td>
                <td style="display: inline-block;text-align: left;"><?= $appoinmentDetail->approval_order_no ?></td>
                <td style="display: inline-block;text-align: left;"><?= date('d/m/Y', strtotime($appoinmentDetail->approval_order_date)) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br><br>


    <table id="t4" style="table-layout: fixed;">
        <tr>
            <th colspan="8" style="background-color: transparent;text-align: left;">Qualifications</th>
        </tr>
        <tr>
            <th style="display: inline-block;text-align: left;">Course Type </th>
            <th style="display: inline-block;text-align: left;">Course Name </th>
            <th style="display: inline-block;text-align: left;">Subject </th>
            <th style="display: inline-block;text-align: left;">University </th>
            <th style="display: inline-block;text-align: left;">Institution </th>
            <th style="display: inline-block;text-align: left;">Class Obtained </th>
            <th style="display: inline-block;text-align: left;">Reg No. </th>
            <th style="display: inline-block;text-align: left;">Year Of Pass </th>

        </tr>
        <?php foreach ($educationDetails as $educationDetail) : ?>
            <tr style="border: 1px solid red;">
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->course_type ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->course_name ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->subject ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->university ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->institution ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->class_obtained == 1 ? 'Passed' : 'Not Passed' ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->reg_no ?></td>
                <td style="display: inline-block;text-align: left;"><?= $educationDetail->year_of_pass ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br><br>

    <table id="t4" style="table-layout: fixed;">
        <tr>
            <th colspan="8" style="background-color: transparent;text-align: left;">Details of Declaration of Probation</th>
        </tr>
        <tr>
            <th style="display: inline-block;text-align: left;">Department</th>
            <th style="display: inline-block;text-align: left;">District</th>
            <th style="display: inline-block;text-align: left;">Office</th>
            <th style="display: inline-block;text-align: left;">Designation</th>
            <th style="display: inline-block;text-align: left;">With Effect <br> From </th>
            <th style="display: inline-block;text-align: left;">Probation <br> Order No</th>
            <th style="display: inline-block;text-align: left;">Probation <br> Order Date</th>
        </tr>
        <tr>
            <td style="display: inline-block;text-align: left;"><?= $probationDetails->department_name ?></td>
            <td style="display: inline-block;text-align: left;"><?= $probationDetails->district_name ?></td>
            <td style="display: inline-block;text-align: left;"><?= $probationDetails->office_name ?></td>
            <td style="display: inline-block;text-align: left;"><?= $probationDetails->designation_name ?></td>
            <td style="display: inline-block;text-align: left;"><?= date('d/m/Y', strtotime($probationDetails->effect_from)) ?></td>
            <td style="display: inline-block;text-align: left;"><?= $probationDetails->order_no ?></td>
            <td style="display: inline-block;text-align: left;"><?= $probationDetails->order_date ? date('d/m/Y', strtotime($probationDetails->order_date)) : ' ' ?></td>
        </tr>
    </table>

</body>

</html>