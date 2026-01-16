<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/appoinment_reports/save_appoinment_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/appoinment_reports/update_appoinment_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
            <input type="hidden" name="report_id" value="<?= $report_id ?>">
        <?php endif; ?>

        <?php if ($operation != 'view') :  ?>




        <?php endif; ?>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Report Orders</h3>
                </div>



                <div class="card-body">

                    <?php if ($operation == 'add') : ?>
                        <div class="points_div">
                            <?php
                            $i = 1;
                            foreach ($ordersList as $orders) :
                            ?>
                                <div class="input-group mb-10">
                                    <span class="input-group-text"><?= $i++ ?></span>
                                    <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= $orders->order_content ?>" id="points" name="points[]" class="form-control">
                                    <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="points_div">
                            <?php
                            $i = 1;
                            $ordersListStr = $reportsDetails->report_orders;
                            $ordersList = explode("~", $ordersListStr);
                            foreach ($ordersList as $orders) :
                            ?>
                                <div class="input-group mb-10">
                                    <span class="input-group-text"><?= $i++ ?></span>
                                    <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= $orders ?>" id="points" name="points[]" class="form-control">
                                    <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_points">Add new points <i class="fa fa-plus-circle"></i></a>

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Employee Details</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">Employee Salutation </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="employee_salutation" id="employee_salutation" class="form-control" style="width:100%;">
                            <?php foreach ($salutation_enum as $salutation) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->employee_salutation == $salutation['id']) ? 'selected' : ''; ?> value="<?= en_func($salutation['id'], 'e') ?>"><?= $salutation['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Employee name</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="employee_name" id="employee_name" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($employeesList as $employees) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->employee_name == $employees->employee_id) ? 'selected' : ''; ?> value="<?= en_func($employees->employee_id, 'e') ?>"><?= $employees->employee_name . ' - ' . $employees->employee_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Employee designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="employee_designation" id="employee_designation" class="form-control" style="width:100%;">
                            <?php foreach ($designationsList as $designations) : ?>
                                <option data-id="<?= $designations->designation_name ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->employee_designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name . ' - ' . $designations->designation_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Employee department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="employee_department" id="employee_department" class="form-control" style="width:100%;">
                            <?php foreach ($departmentsList as $departments) : ?>
                                <option data-id="<?= $departments->department_name ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->employee_department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name . ' - ' . $departments->department_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">PEN Number</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->pen_number : ''; ?>" id="pen_number" name="pen_number" class="form-control">
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Report Details</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">Report title</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->report_title : ''; ?>" id="report_title" name="report_title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Report no</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->report_no : ''; ?>" id="report_no" name="report_no" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Report date *(Date the report should be generated)</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->report_date : date('Y-m-d'); ?>" id="report_date" name="report_date" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Office</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="office" id="office" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($offices as $office) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->office == $office->office_id) ? 'selected' : ''; ?> value="<?= en_func($office->office_id, 'e') ?>"><?= $office->office_name . '-' .  $office->office_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Employee House Name</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_housename : ''; ?>" id="employee_housename" name="employee_housename" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Employee Post Office</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_postoffice : ''; ?>" id="employee_postoffice" name="employee_postoffice" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Employee City</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_city : ''; ?>" id="employee_city" name="employee_city" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Previous Employee Salutation </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="old_employee_salutation" id="old_employee_salutation" class="form-control" style="width:100%;">
                            <?php foreach ($salutation_enum as $salutation) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->old_employee_salutation == $salutation['id']) ? 'selected' : ''; ?> value="<?= en_func($salutation['id'], 'e') ?>"><?= $salutation['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Previous Employee name</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="old_employee_name" id="old_employee_name" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($employeesList as $employees) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->old_employee_name == $employees->employee_id) ? 'selected' : ''; ?> value="<?= en_func($employees->employee_id, 'e') ?>"><?= $employees->employee_name . ' - ' . $employees->employee_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Previous Employee's new designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="new_designation" id="new_designation" class="form-control" style="width:100%;">
                            <?php foreach ($designationsList as $designations) : ?>
                                <option data-id="<?= $designations->designation_name ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->new_designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name . ' - ' . $designations->designation_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Date of Appoinment</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->appoinment_date : ''; ?>" id="appoinment_date" name="appoinment_date" class="form-control form-change">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Service years</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->service_years : ''; ?>" id="service_years" name="service_years" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Monitoring Service years</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->monitoring_service_years : ''; ?>" id="monitoring_service_years" name="monitoring_service_years" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Reading no 1</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->reading_no_1 : ''; ?>" id="reading_no_1" name="reading_no_1" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="inputName">Reading no 2</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->reading_no_2 : ''; ?>" id="reading_no_2" name="reading_no_2" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="inputName">Reading no 3</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->reading_no_3 : ''; ?>" id="reading_no_3" name="reading_no_3" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Rank details</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->rank_details : ''; ?>" id="rank_details" name="rank_details" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Any department</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->any_department : ''; ?>" id="any_department" name="any_department" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Any department's rank</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->any_department_rank : ''; ?>" id="any_department_rank" name="any_department_rank" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Performa Details</h3>


                </div>


                <div class="card-body">




                    <div class="form-group col-6">
                        <label for="inputName">Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="scale_of_pay" id="scale_of_pay" class="form-control" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option data-id="<?= $scale_of_pays->pay_range ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">New Pay</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->new_pay : ''; ?>" id="new_pay" name="new_pay" class="form-control">
                    </div>







                    <div class="form-group">
                        <label for="inputName">Vacancy date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_vacancy : ''; ?>" id="date_of_vacancy" name="date_of_vacancy" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Vacancy Reason</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->vacancy_reason : ''; ?>" id="vacancy_reason" name="vacancy_reason" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Date of Birth </label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_birth : ''; ?>" id="date_of_birth" name="date_of_birth" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Date of Birth in text</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_birth_text : ''; ?>" id="date_of_birth_text" name="date_of_birth_text" class="form-control">
                    </div>





                    <div class="form-group">
                        <label for="inputName">Religion</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_religion : ''; ?>" id="employee_religion" name="employee_religion" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Caste</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_caste : ''; ?>" id="employee_caste" name="employee_caste" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Age Concession </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="age_concession" id="age_concession" class="form-control" style="width:100%;">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->age_concession == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <!-- <div class="director-orders"> -->

                    <div class="form-group">
                        <label for="inputName">Director Order no</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->director_order_no : ''; ?>" id="director_order_no" name="director_order_no" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Director Order date</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->director_order_date : ''; ?>" id="director_order_date" name="director_order_date" class="form-control">
                    </div>

                    <!-- </div> -->






                    <div class="form-group">
                        <label for="inputName">Vacancy Nature</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="vacancy_nature" id="vacancy_nature" class="form-control" style="width:100%;">
                            <?php foreach ($vacancy_nature as $vacancy_natures) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->vacancy_nature == $vacancy_natures->nature_id) ? 'selected' : ''; ?> value="<?= en_func($vacancy_natures->nature_id, 'e') ?>"><?= $vacancy_natures->nature . ' - ' . $vacancy_natures->nature_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">General Qualification</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->general_qualification : ''; ?>" id="general_qualification" name="general_qualification" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Technical Qualification</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->technical_qualification : ''; ?>" id="technical_qualification" name="technical_qualification" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Employee Experience</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_experience : ''; ?>" id="employee_experience" name="employee_experience" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Qualified for promotion </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="qualified_for_promotion" id="qualified_for_promotion" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->qualified_for_promotion == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Committee selected </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="committee_selected" id="committee_selected" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->committee_selected == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Rank</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->rank : ''; ?>" id="rank" name="rank" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Rank details</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->the_rank_details : ''; ?>" id="the_rank_details" name="the_rank_details" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Governing Order Atatched </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="governing_order_attached" id="governing_order_attached" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->governing_order_attached == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">University Order attached </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="university_order_attached" id="university_order_attached" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->university_order_attached == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Date of Joining </label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_joining : ''; ?>" id="date_of_joining" name="date_of_joining" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Date of joining Time </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="date_of_joining_time" id="date_of_joining_time" class="form-control">
                            <?php foreach ($fn_and_an_enum as $fn_and_an) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->date_of_joining_time == $fn_and_an['id']) ? 'selected' : ''; ?> value="<?= en_func($fn_and_an['id'], 'e') ?>"><?= $fn_and_an['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Original Certificates attached </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="original_certificates_attached" id="original_certificates_attached" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->original_certificates_attached == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Service Book attached </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="service_book_attached" id="service_book_attached" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->service_book_attached == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                </div>
            </div>
        </div>











        <div class="col-12">
            <div class="content-header">
                <div>
                    <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                    <button type="submit" id="submit-button" class="btn btn-md teachers-report rounded font-sm hover-up btn-block float-right">Add report&nbsp; <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>


    </div>


</section>
<script>
    $(document).on('change', '#employee_name', function(e) {
        e.preventDefault();
        let ajax_url = base_url + 'admin/appoinment_reports/get_employee_details_prefill';
        var parameters = {
            employee_id: $(this).val()
        }

        $.get(ajax_url, parameters, function(data, status) {
                var out = data.data;


                if (out.designation_name)
                    $('#employee_designation option').filter(function() {
                        return $(this).data('id') === out.designation_name;
                    }).prop('selected', true);


                if (out.department_name)
                    $('#employee_department option').filter(function() {
                        return $(this).data('id') === out.department_name;
                    }).prop('selected', true);

                if (out.pay_range)
                    $('#scale_of_pay option').filter(function() {
                        return $(this).data('id') === out.pay_range;
                    }).prop('selected', true);


                var report_title = ($("#employee_name")[0][$("#employee_name")[0].selectedIndex].text).split("-")[0];
                report_title = report_title.replace(" ", "-")
                report_title = report_title.toLowerCase();
                report_title = report_title.charAt(0).toUpperCase() + report_title.slice(1).toLowerCase();

                $('#report_title').val(report_title + '-Probation-Report');
                if (out.present_pay)
                    $('#present_pay').val(out.present_pay);
                if (out.date_of_joining)
                    $('#date_of_joining').val(out.date_of_joining);
                if (out.employee_number)
                    $('#pen_number').val(out.employee_number);

                AlertandToast('info', out.msg, false, true);

            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                AlertandToast('info', 'Something went wrong,Details couldnt be autofilled', false, true);
            });
    });

    $(document).on('click', '.remove_points', function() {
        $(this).parent().remove()
    });


    $(document).on('click', '.remove_row', function() {
        $(this).parent().parent().remove()
    });


    $('#add_new_points').click(function(event) {
        let point_html = `<div class="input-group mb-10">
                            <input  type="text" value="" id="points" name="points[]" class="form-control">
                            <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>
                        </div>`;

        $('.points_div').append(point_html);
    });
</script>


<script>
    $('.select2').select2({
        closeOnSelect: true
    });
</script>