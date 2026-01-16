<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/promotion_reports/save_promotion_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/promotion_reports/update_promotion_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
            <input type="hidden" name="report_id" value="<?= $report_id ?>">
        <?php endif; ?>

        <?php if ($operation != 'view') :  ?>




        <?php endif; ?>



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


                    <hr>


                    <div class="form-group">
                        <label for="inputName">Previous Employee Salutation </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="previous_employee_salutation" id="previous_employee_salutation" class="form-control" style="width:100%;">
                            <?php foreach ($salutation_enum as $salutation) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->previous_employee_salutation == $salutation['id']) ? 'selected' : ''; ?> value="<?= en_func($salutation['id'], 'e') ?>"><?= $salutation['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Previous Employee name</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="previous_employee_name" id="previous_employee_name" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($employeesList as $employees) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->previous_employee_name == $employees->employee_id) ? 'selected' : ''; ?> value="<?= en_func($employees->employee_id, 'e') ?>"><?= $employees->employee_name . ' - ' . $employees->employee_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Previous Employee designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="previous_employee_designation" id="previous_employee_designation" class="form-control" style="width:100%;">
                            <?php foreach ($designationsList as $designations) : ?>
                                <option data-id="<?= $designations->designation_name ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->previous_employee_designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name . ' - ' . $designations->designation_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Previous Employee department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="previous_employee_department" id="previous_employee_department" class="form-control" style="width:100%;">
                            <?php foreach ($departmentsList as $departments) : ?>
                                <option data-id="<?= $departments->department_name ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->previous_employee_department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name . ' - ' . $departments->department_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
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



                    <div class="form-group">
                        <label for="inputName">Promotion reason</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->promotion_reason : ''; ?>" id="promotion_reason" name="promotion_reason" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Vacancy reason</label>
                        <textarea <?= ($operation == 'view') ? 'disabled' : '' ?>  id="vacancy_text" name="vacancy_text" class="form-control">
                        <?= (!empty($reportsDetails)) ? $reportsDetails->vacancy_text : ''; ?>
                        </textarea>
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
                        <label for="inputName">Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="scale_of_pay" id="scale_of_pay" class="form-control" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option data-id="<?= $scale_of_pays->pay_range ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Present Pay</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->present_pay : ''; ?>" id="present_pay" name="present_pay" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Promotion date </label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->promotion_date : ''; ?>" id="promotion_date" name="promotion_date" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Previous Employee date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->previous_employee_date : ''; ?>" id="previous_employee_date" name="previous_employee_date" class="form-control">
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
                        <label for="inputName">Address</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->employee_address : ''; ?>" id="employee_address" name="employee_address" class="form-control">
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


                    <div class="form-group">
                        <label for="inputName">Vacancy due to higher category ?</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="vacancy_due_higher_category" id="vacancy_due_higher_category" class="form-control" style="width:100%;">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->vacancy_due_higher_category == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="director-orders">

                        <div class="form-group">
                            <label for="inputName">Director Order no</label>
                            <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->director_order_no : ''; ?>" id="director_order_no" name="director_order_no" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="inputName">Director Order date</label>
                            <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->diretor_order_date : ''; ?>" id="diretor_order_date" name="diretor_order_date" class="form-control">
                        </div>

                    </div>






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
                        <label for="inputName">Committe details</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->committee_details : ''; ?>" id="committee_details" name="committee_details" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Rank</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->rank : ''; ?>" id="rank" name="rank" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Rank details</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->rank_details : ''; ?>" id="rank_details" name="rank_details" class="form-control">
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
                        <label for="inputName">Promotion Order attached </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="promotion_order_attached" id="promotion_order_attached" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->promotion_order_attached == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
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
                        <label for="inputName">Promotion Order No</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->promotion_no : ''; ?>" id="promotion_no" name="promotion_no" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Promotion Date of Order</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->promotion_date_of_order : ''; ?>" id="promotion_date_of_order" name="promotion_date_of_order" class="form-control form-change">
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
                        <label for="inputName">Original Certificates list </label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->original_certificates_list : ''; ?>" id="original_certificates_list" name="original_certificates_list" class="form-control">

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
        let ajax_url = base_url + 'admin/probation_reports/get_employee_details_prefill';
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
</script>


<script>
    $('.select2').select2({
        closeOnSelect: true
    });
</script>