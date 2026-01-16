<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/confirmation_reports/save_confirmation_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/confirmation_reports/update_confirmation_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
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
                        <label for="inputName">Order Date 1</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->order_date_orders_1 : ''; ?>" id="order_date_orders_1" name="order_date_orders_1" class="form-control">
                    </div>

                    
                    <div class="form-group">
                        <label for="inputName">Order Report no 1</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->order_no_orders_1 : ''; ?>" id="order_no_orders_1" name="order_no_orders_1" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Order Date 2</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->order_date_orders_2 : ''; ?>" id="order_date_orders_2" name="order_date_orders_2" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Order Report no 2</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->order_no_orders_2 : ''; ?>" id="order_no_orders_2" name="order_no_orders_2" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Start of Service date</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->start_service_date : ''; ?>" id="start_service_date" name="start_service_date" class="form-control">
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
        let ajax_url = base_url + 'admin/confirmation_reports/get_employee_details_prefill';
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

                $('#report_title').val(report_title + '-Confirmation-Report');
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