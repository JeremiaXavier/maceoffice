<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/probation_reports/save_probation_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/probation_reports/update_probation_reports'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
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
                        <label for="inputName">Probation date 1</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->probation_date_1 : ''; ?>" id="probation_date_1" name="probation_date_1" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Probation date 2</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->probation_date_2 : ''; ?>" id="probation_date_2" name="probation_date_2" class="form-control">
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


                    <div class="form-group col-6">
                        <label for="inputName">Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="scale_of_pay" id="scale_of_pay" class="form-control" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option data-id="<?= $scale_of_pays->pay_range ?>" <?= ((!empty($reportsDetails)) && $reportsDetails->scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Present Pay</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->present_pay : ''; ?>" id="present_pay" name="present_pay" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">Order No of EDT</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->edt_no : ''; ?>" id="edt_no" name="edt_no" class="form-control">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Date of EDT</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->edt_date : ''; ?>" id="edt_date" name="edt_date" class="form-control form-change">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Date of Assumption of charge</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->assumption_of_charge : ''; ?>" id="assumption_of_charge" name="assumption_of_charge" class="form-control form-change">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Date of Eligible for probation</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->eligible_for_probation : ''; ?>" id="eligible_for_probation" name="eligible_for_probation" class="form-control form-change">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Reason for delaying probation</label>
                        <textarea <?= ($operation == 'view') ? 'disabled' : '' ?> id="reason_for_delaying_probation" name="reason_for_delaying_probation" class="form-control">
                            <?= (!empty($reportsDetails)) ? $reportsDetails->reason_for_delaying_probation : ''; ?>
                        </textarea>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Test Required</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="test_required" id="test_required" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->test_required == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Test Details</label>
                        <textarea  <?= ($operation == 'view') ? 'disabled' : '' ?>  id="test_details" name="test_details" class="form-control">
                        <?= (!empty($reportsDetails)) ? $reportsDetails->test_details : ''; ?>
                        </textarea>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Date of test</label>
                        <input  <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->test_date : ''; ?>" id="test_date" name="test_date" class="form-control form-change">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Records enclosed </label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="records_enclosed" id="records_enclosed" class="form-control">
                            <?php foreach ($have_and_not_enum as $have_and_not) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->records_enclosed == $have_and_not['id']) ? 'selected' : ''; ?> value="<?= en_func($have_and_not['id'], 'e') ?>"><?= $have_and_not['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Confidential Report Details</h3>


                </div>


                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">First appoinment date</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_first_appoinment : ''; ?>" id="date_of_first_appoinment" name="date_of_first_appoinment" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">First designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="first_designation" id="first_designation" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($designationsList as $designations) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->first_designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name . ' - ' . $designations->designation_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Current appoinment date</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->date_of_current_appoinment : ''; ?>" id="date_of_current_appoinment" name="date_of_current_appoinment" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Efficiency in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="efficiency_in_work" id="efficiency_in_work" class="form-control">
                            <?php foreach ($performanceStatuses as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->efficiency_in_work == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Willingness shown in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="willingness_shown" id="willingness_shown" class="form-control">
                            <?php foreach ($performanceStatuses as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->willingness_shown == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Ability to get along with people in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="getalong_with_people" id="getalong_with_people" class="form-control">
                            <?php foreach ($performanceStatuses as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->getalong_with_people == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Loyalty in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="loyalty" id="loyalty" class="form-control">
                            <?php foreach ($performanceStatuses as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->loyalty == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Discipline in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="discipline" id="discipline" class="form-control">
                            <?php foreach ($performanceStatuses as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->discipline == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Sincerity,Dependability and Co-operation in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="sincerity_dependability_coperation" id="sincerity_dependability_coperation" class="form-control">
                            <?php foreach ($performanceStatuses as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->sincerity_dependability_coperation == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Satisfactory performance in work</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="satisfactory_performance" id="satisfactory_performance" class="form-control">
                            <?php foreach ($yes_and_no_enum_mal as $yes_and_no) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->satisfactory_performance == $yes_and_no['id']) ? 'selected' : ''; ?> value="<?= en_func($yes_and_no['id'], 'e') ?>"><?= $yes_and_no['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                </div>
            </div>
        </div>





        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Absence Time Details</h3>


                </div>


                <div class="card-body">

                    <div class="probation_absence_div row">


                        <?php if ($operation != 'add') :
                            foreach ($probationAbsence as $timings) : ?>
                                <input type="hidden" name="pa_id[]" id="pa_id" value="<?= en_func($timings->pa_id, 'e') ?>">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">From date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($timings)) ? $timings->probation_absence_from_date : ''; ?>" id="probation_absence_from_date" name="probation_absence_from_date[]" class="form-control from_date datechanger">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">To date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($timings)) ? $timings->probation_absence_to_date : ''; ?>" id="probation_absence_to_date" name="probation_absence_to_date[]" class="form-control to_date datechanger">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Months</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($timings)) ? $timings->probation_absence_months : '0'; ?>" id="probation_absence_months" name="probation_absence_months[]" class="form-control diff_months">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Days</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($timings)) ? $timings->probation_absence_days : '0'; ?>" id="probation_absence_days" name="probation_absence_days[]" class="form-control diff_days">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="inputName">Remarks</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($timings)) ? $timings->probation_absence_remarks : ''; ?>" id="probation_absence_remarks" name="probation_absence_remarks[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="inputName">Remove</label>
                                        <a href="<?= base_url() ?>admin/probation_reports/delete_absence/<?= en_func($timings->pa_id, 'e') ?>" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-warning text-black"> <i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_probation_absence_row">Add new row <i class="fa fa-plus-circle"></i></a>


                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Probation Service Time Details</h3>


                </div>


                <div class="card-body">

                    <div class="probation_service_div row">

                        <?php if ($operation != 'add') :
                            foreach ($probationService as $timings) : ?>
                                <input type="hidden" name="ps_id[]" id="ps_id" value="<?= en_func($timings->ps_id, 'e') ?>">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">From date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($timings)) ? $timings->probation_service_from_date : ''; ?>" id="probation_service_from_date" name="probation_service_from_date[]" class="form-control from_date datechanger">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName">To date</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($timings)) ? $timings->probation_service_to_date : ''; ?>" id="probation_service_to_date" name="probation_service_to_date[]" class="form-control to_date datechanger">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Months</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($timings)) ? $timings->probation_service_months : '0'; ?>" id="probation_service_months" name="probation_service_months[]" class="form-control diff_months">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputName">Days</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($timings)) ? $timings->probation_service_days : '0'; ?>" id="probation_service_days" name="probation_service_days[]" class="form-control diff_days">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="inputName">Remarks</label>
                                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($timings)) ? $timings->probation_service_remarks : ''; ?>" id="probation_service_remarks" name="probation_service_remarks[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="inputName">Remove</label>
                                        <a href="<?= base_url() ?>admin/probation_reports/delete_service/<?= en_func($timings->ps_id, 'e') ?>" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-warning text-black"> <i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_probation_service_row">Add new row <i class="fa fa-plus-circle"></i></a>


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

        const startDate = moment(from_date);
        const endDate = moment(to_date);

        const yearsDiff = endDate.diff(startDate, 'year');
        startDate.add(yearsDiff, 'years');

        const monthsDiff = endDate.diff(startDate, 'months');
        startDate.add(monthsDiff, 'months');

        const daysDiff = endDate.diff(startDate, 'days');

        const years = yearsDiff;
        const months = (years * 12) + monthsDiff;
        const days = daysDiff;

        diff_days.val('');
        diff_months.val('');

        if (isNaN(months) || isNaN(days))
            return;

        if (months < 0 || days < 0)
            return;

        diff_days.val(days);
        diff_months.val(months);
    });

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


    $('#add_new_probation_service_row').click(function(event) {
        let point_html = `
                        <div class="row">
                        
                        <hr>

                        <div class="form-group col-md-6">
                            <label for="inputName">From date</label>
                            <input  type="date" id="probation_service_from_date" name="probation_service_from_date[]" class="form-control from_date datechanger">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputName">To date</label>
                            <input  type="date" id="probation_service_to_date" name="probation_service_to_date[]" class="form-control to_date datechanger">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputName">Months</label>
                            <input  type="text" id="probation_service_months" value="0" name="probation_service_months[]" class="form-control diff_months">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputName">Days</label>
                            <input  type="text" id="probation_service_days" value="0" name="probation_service_days[]" class="form-control diff_days">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="inputName">Remarks</label>
                            <input  type="text" id="probation_service_remarks" name="probation_service_remarks[]" class="form-control">
                        </div>

                        <div class="form-group col-md-1">
                            <label for="inputName">Remove</label>
                            <span class="btn btn-warning text-black remove_row"> <i class="fa fa-trash"></i></span>
                        </div>

                        
                        </div>`;

        $('.probation_service_div').append(point_html);

    });


    $('#add_new_probation_absence_row').click(function(event) {
        let point_html = `
                        <div class="row">
                        
                        <hr>

                        <div class="form-group col-md-6">
                            <label for="inputName">From date</label>
                            <input  type="date" id="probation_absence_from_date" name="probation_absence_from_date[]" class="form-control from_date datechanger">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputName">To date</label>
                            <input  type="date" id="probation_absence_to_date" name="probation_absence_to_date[]" class="form-control to_date datechanger">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputName">Months</label>
                            <input  type="text" id="probation_absence_months" value="0" name="probation_absence_months[]" class="form-control diff_months">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputName">Days</label>
                            <input  type="text" id="probation_absence_days" value="0" name="probation_absence_days[]" class="form-control diff_days">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="inputName">Remarks</label>
                            <input  type="text" id="probation_absence_remarks" name="probation_absence_remarks[]" class="form-control">
                        </div>

                        <div class="form-group col-md-1">
                            <label for="inputName">Remove</label>
                            <span class="btn btn-warning text-black remove_row"> <i class="fa fa-trash"></i></span>
                        </div>


                        </div>`;

        $('.probation_absence_div').append(point_html);
    });
</script>


<script>
    $('.select2').select2({
        closeOnSelect: true
    });
</script>