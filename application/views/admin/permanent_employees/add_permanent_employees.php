<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/permanent_employees/save_permanent_employees'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/permanent_employees/update_permanent_employees'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="employee_id" value="<?= $employee_id  ?>">
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
                        <label for="inputName">Employee no</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->employee_number : ''; ?>" id="employee_number" name="employee_number" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Employee name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->employee_name : ''; ?>" id="employee_name" name="employee_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Employee name (Mal)</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->employee_name_mal : ''; ?>" id="employee_name_mal" name="employee_name_mal" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Password Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="password_status" id="editable" class="form-control">
                            <option selected value="<?= en_func(0, 'e') ?>">Current Password</option>
                            <option  value="<?= en_func(1, 'e') ?>">PEN as Password</option>
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