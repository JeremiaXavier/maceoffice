<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/guest_employees/save_guest_employees'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/guest_employees/update_guest_employees'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="teacher_id" value="<?= $teacher_id ?>">
    <?php endif; ?>


    <div class="row">


        <?php if ($operation != 'view') :  ?>


            <div class="col-12">
                <div class="content-header">
                    <div>
                        <button class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up close-offcanvas">Go back</button>
                        <button type="submit" id="submit-modal" class="btn btn-md submit-modal rounded font-sm hover-up btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </div>
            </div>

        <?php endif; ?>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Employee Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Teacher code</label>
                        <input data-validation="required|alpha_numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->teacher_code : ''; ?>" id="teacher_code" name="teacher_code" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Teacher name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->teacher_name : ''; ?>" id="teacher_name" name="teacher_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Start date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->start_date : ''; ?>" id="start_date" name="start_date" class="form-control form-change">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Last date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->last_date : ''; ?>" id="last_date" name="last_date" class="form-control form-change">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Daily wage</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->daily_wage : ''; ?>" id="daily_wage" name="daily_wage" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Gender</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="gender" id="gender" class="form-control">
                            <?php foreach ($gender as $genders) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->gender == $genders->gender_id) ? 'selected' : ''; ?> value="<?= en_func($genders->gender_id, 'e') ?>"><?= $genders->gender_title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="designation" id="designation" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($designation as $designations) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->designation == $designations->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designations->designation_id, 'e') ?>"><?= $designations->designation_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="department" id="department" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($department as $departments) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->




            <?php if ($operation != 'view') :  ?>


                <div class="col-12">
                    <div class="content-header">
                        <div>
                            <button class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up close-offcanvas">Go back</button>
                            <button type="submit" id="submit-modal" class="btn btn-md submit-modal rounded font-sm hover-up btn-block float-right">Add &nbsp; <i class="fas fa-sign-in-alt"></i></button>
                        </div>
                    </div>
                </div>

            <?php endif; ?>


        </div>

  








    </div>
    <?php echo form_close(); ?>


</section>

      
<script>
            $('.select2').select2({
                closeOnSelect: true
            });
        </script>
