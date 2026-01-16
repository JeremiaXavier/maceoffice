<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/grade_promotion_reports/save_grade_promotion_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/grade_promotion_reports/update_grade_promotion_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
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


                    <hr>





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
                        <label for="inputName">Service Period</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->service_period : ''; ?>" id="service_period" name="service_period" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Higher Grade type</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->higher_grade_type : ''; ?>" id="higher_grade_type" name="higher_grade_type" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Promotion date </label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->promotion_date : ''; ?>" id="promotion_date" name="promotion_date" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">End of Service date</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->end_service_date : ''; ?>" id="end_service_date" name="end_service_date" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Qualification</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->qualification : ''; ?>" id="qualification" name="qualification" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Marks Scored (%)</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->marks_percentage : ''; ?>" id="marks_percentage" name="marks_percentage" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Date of aquiring PG</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_pg : ''; ?>" id="date_of_pg" name="date_of_pg" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">From designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="from_designation" id="from_designation" class="form-control" style="width:100%;">
                            <?php foreach ($designationsList as $designations) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->from_designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name . ' - ' . $designations->designation_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">From Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="from_scale_of_pay" id="from_scale_of_pay" class="form-control" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->from_scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Date of service ending</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->from_date : ''; ?>" id="from_date" name="from_date" class="form-control">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="inputName">Date of service promotion</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->to_date : ''; ?>" id="to_date" name="to_date" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">To Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="to_scale_of_pay" id="to_scale_of_pay" class="form-control" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->to_scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">To designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="to_designation" id="to_designation" class="form-control" style="width:100%;">
                            <?php foreach ($designationsList as $designations) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->to_designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name . ' - ' . $designations->designation_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>
        </div>





        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Temporary Service Details</h3>


                </div>


                <div class="card-body">

                    <div class="grade_promotion_temporary_div row">


                        <?php if ($operation != 'add') :
                            foreach ($temporaryService as $services) : ?>
                                <input type="hidden" name="pts_id[]" id="pts_id" value="<?= en_func($services->pts_id, 'e') ?>">
                                <div class="row">



                                    <div class="form-group col-md-6">
                                        <label for="inputName">Post</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->temporary_post : ''; ?>" id="temporary_post" name="temporary_post[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">Scale of Pay</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->temporary_scale_of_pay : ''; ?>" id="temporary_scale_of_pay" name="temporary_scale_of_pay[]" class="form-control">
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="inputName">From date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($services)) ? $services->temporary_from_date : ''; ?>" id="temporary_from_date" name="temporary_from_date[]" class="form-control from_date datechanger">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">To date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($services)) ? $services->temporary_to_date : ''; ?>" id="temporary_to_date" name="temporary_to_date[]" class="form-control to_date datechanger">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Years</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->temporary_years : '0'; ?>" id="temporary_years" name="temporary_years[]" class="form-control diff_years">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Months</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->temporary_months : '0'; ?>" id="temporary_months" name="temporary_months[]" class="form-control diff_months">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Days</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->temporary_days : '0'; ?>" id="temporary_days" name="temporary_days[]" class="form-control diff_days">
                                    </div>



                                    <div class="form-group col-md-1">
                                        <label for="inputName">Remove</label>
                                        <a href="<?= base_url() ?>admin/grade_promotion_reports/delete_temporary/<?= en_func($services->pts_id, 'e') ?>" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-warning text-black"> <i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_grade_promotion_temporary_service_row">Add new row <i class="fa fa-plus-circle"></i></a>


                </div>
            </div>
        </div>






        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> Service Details</h3>


                </div>


                <div class="card-body">

                    <div class="grade_promotion_service_div row">


                        <?php if ($operation != 'add') :
                            foreach ($serviceDetails as $services) : ?>
                                <input type="hidden" name="ps_id[]" id="ps_id" value="<?= en_func($services->ps_id, 'e') ?>">
                                <div class="row">




                                    <div class="form-group col-md-6">
                                        <label for="inputName">Post</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->service_post : ''; ?>" id="service_post" name="service_post[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">Scale of Pay</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->service_scale_of_pay : ''; ?>" id="service_scale_of_pay" name="service_scale_of_pay[]" class="form-control">
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="inputName">From date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($services)) ? $services->service_from_date : ''; ?>" id="service_from_date" name="service_from_date[]" class="form-control from_date datechanger">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">To date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($services)) ? $services->service_to_date : ''; ?>" id="service_to_date" name="service_to_date[]" class="form-control to_date datechanger">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Years</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->service_years : '0'; ?>" id="service_years" name="service_years[]" class="form-control diff_years">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Months</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->service_months : '0'; ?>" id="service_months" name="service_months[]" class="form-control diff_months">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Days</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($services)) ? $services->service_days : '0'; ?>" id="service_days" name="service_days[]" class="form-control diff_days">
                                    </div>



                                    <div class="form-group col-md-1">
                                        <label for="inputName">Remove</label>
                                        <a href="<?= base_url() ?>admin/grade_promotion_reports/delete_service/<?= en_func($services->ps_id, 'e') ?>" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-warning text-black"> <i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_grade_promotion_service_row">Add new row <i class="fa fa-plus-circle"></i></a>


                </div>
            </div>
        </div>




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Other Details</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">LWA granted</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->lwa_granted : ''; ?>" id="lwa_granted" name="lwa_granted" class="form-control">
                    </div>


                    
                    <div class="form-group">
                        <label for="inputName">Increment barred period</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->increment_barred_period : ''; ?>" id="increment_barred_period" name="increment_barred_period" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Higher post period</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->higher_post_period : ''; ?>" id="higher_post_period" name="higher_post_period" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Other period</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->other_period : ''; ?>" id="other_period" name="other_period" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Leave without allowance</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->leave_without_allowance : ''; ?>" id="leave_without_allowance" name="leave_without_allowance" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Next promotion post</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->next_promotion_post : ''; ?>" id="next_promotion_post" name="next_promotion_post" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Superior academic Qualification</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->superior_academic_qualification : ''; ?>" id="superior_academic_qualification" name="superior_academic_qualification" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Option enclosed</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->option_enclosed : ''; ?>" id="option_enclosed" name="option_enclosed" class="form-control">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).on('change', '.datechanger', function(e) {

        e.preventDefault();
        const from_date = $(this).parent().parent().find('.from_date').val();
        const to_date = $(this).parent().parent().find('.to_date').val();

        const diff_days = $(this).parent().parent().find('.diff_days');
        const diff_months = $(this).parent().parent().find('.diff_months');
        const diff_years = $(this).parent().parent().find('.diff_years');

        const startDate = moment(from_date);
        const endDate = moment(to_date);

        const yearsDiff = endDate.diff(startDate, 'year');
        startDate.add(yearsDiff, 'years');

        const monthsDiff = endDate.diff(startDate, 'months');
        startDate.add(monthsDiff, 'months');

        const daysDiff = endDate.diff(startDate, 'days');

        const years = yearsDiff;
        const months = monthsDiff;
        const days = daysDiff;

        diff_days.val('');
        diff_months.val('');
        diff_years.val('');

        if (isNaN(months) || isNaN(days))
            return;

        if (months < 0 || days < 0)
            return;

        diff_days.val(days);
        diff_months.val(months);
        diff_years.val(years);
    });

    $(document).on('change', '#employee_name', function(e) {
        e.preventDefault();
        let ajax_url = base_url + 'admin/grade_promotion_reports/get_employee_details_prefill';
        var parameters = {
            employee_id: $(this).val()
        }

        $.get(ajax_url, parameters, function(data, status) {
                var out = data.data;

                $('#employee_designation option').filter(function() {
                    return $(this).data('id') === out.designation_name;
                }).prop('selected', true);


                $('#employee_department option').filter(function() {
                    return $(this).data('id') === out.department_name;
                }).prop('selected', true);


                $('#scale_of_pay option').filter(function() {
                    return $(this).data('id') === out.pay_range;
                }).prop('selected', true);


                var report_title = ($("#employee_name")[0][$("#employee_name")[0].selectedIndex].text).split("-")[0];
                report_title = report_title.replace(" ", "-")
                report_title = report_title.toLowerCase();
                report_title = report_title.charAt(0).toUpperCase() + report_title.slice(1).toLowerCase();

                $('#report_title').val(report_title + '-Grade-Promotion-Report');
                $('#present_pay').val(out.present_pay);
                $('#date_of_joining').val(out.date_of_joining);

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


    $('#add_new_grade_promotion_service_row').click(function(event) {
        let point_html = `
                        <div class="row">
                        
                        <hr>

                        <div class="form-group col-md-6">
                                        <label for="inputName">Post</label>
                                        <input  type="text" value="" id="service_post" name="service_post[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">Scale of Pay</label>
                                        <input  type="text" value="" id="service_scale_of_pay" name="service_scale_of_pay[]" class="form-control">
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="inputName">From date</label>
                                        <input  type="date" value="" id="service_from_date" name="service_from_date[]" class="form-control from_date datechanger">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">To date</label>
                                        <input  type="date" value="" id="service_to_date" name="service_to_date[]" class="form-control to_date datechanger">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Years</label>
                                        <input  type="text" value="" id="service_years" name="service_years[]" class="form-control diff_years">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Months</label>
                                        <input  type="text" value="" id="service_months" name="service_months[]" class="form-control diff_months">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Days</label>
                                        <input  type="text" value="" id="service_days" name="service_days[]" class="form-control diff_days">
                                    </div>

                        <div class="form-group col-md-1">
                            <label for="inputName">Remove</label>
                            <span class="btn btn-warning text-black remove_row"> <i class="fa fa-trash"></i></span>
                        </div>

                        
                        </div>`;

        $('.grade_promotion_service_div').append(point_html);

    });


    $('#add_new_grade_promotion_temporary_service_row').click(function(event) {
        let point_html = `
                        <div class="row">
                        
                        <hr>

                        <div class="form-group col-md-6">
                                        <label for="inputName">Post</label>
                                        <input  type="text" value="" id="temporary_post" name="temporary_post[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">Scale of Pay</label>
                                        <input  type="text" value="" id="temporary_scale_of_pay" name="temporary_scale_of_pay[]" class="form-control">
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="inputName">From date</label>
                                        <input  type="date" value="" id="temporary_from_date" name="temporary_from_date[]" class="form-control from_date datechanger">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">To date</label>
                                        <input  type="date" value="" id="temporary_to_date" name="temporary_to_date[]" class="form-control to_date datechanger">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Years</label>
                                        <input  type="text" value="" id="temporary_years" name="temporary_years[]" class="form-control diff_years">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Months</label>
                                        <input  type="text" value="" id="temporary_months" name="temporary_months[]" class="form-control diff_months">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Days</label>
                                        <input  type="text" value="" id="temporary_days" name="temporary_days[]" class="form-control diff_days">
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="inputName">Remove</label>
                                        <span class="btn btn-warning text-black remove_row"> <i class="fa fa-trash"></i></span>
                                    </div>


                        </div>`;

        $('.grade_promotion_temporary_div').append(point_html);
    });
</script>


<script>
    $('.select2').select2({
        closeOnSelect: true
    });
</script>