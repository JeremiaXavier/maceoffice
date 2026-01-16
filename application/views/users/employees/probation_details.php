<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('users/employees/save_probation_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('users/employees/update_probation_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="epd_id" value="<?= en_func($employeeDetails->epd_id,'e') ?>">
    <?php endif; ?>


    <div class="content-header">
        <div>
            <h2 class="content-title card-title"><a href="<?= base_url() ?>users/employees">Employee Details</a> / Probation Details</h2>
            <p>Your details in this portal.</p>
            <span class="text-muted">6 out of 6</span>

            <?php if (empty($employeeDetails)) : ?>
                <span class="badge badge-soft-warning ml-10">InComplete <i class="fa fa-times ml-5"></i> </span>
            <?php else : ?>
                <span class="badge badge-soft-success ml-10">Completed <i class="fa fa-check ml-5"></i> </span>
            <?php endif; ?>

            <?php if (!empty($employeeDetails) && $employeeDetails->editable == 0) : ?>
                <span class="badge badge-soft-warning ml-10">Not Editable<i class="fa fa-times ml-5"></i> </span>
            <?php else : ?>
                <span class="badge badge-soft-success ml-10">Editable <i class="fa fa-check ml-5"></i> </span>
            <?php endif;  ?>
            
        </div>
    </div>


    
    <?php if ($editable) : ?>
        <div class="alert alert-primary" role="alert">
            You can edit your details !
        </div>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            You can no longer edit your details , <br>
            If there are any changes then contact administrator
        </div>
    <?php endif; ?>


    <div class="row">




        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-body">
                <a href="<?= base_url() ?>users/employees/qualification_details" class="float-start"> <h5  class="text-white"><i class="fa fa-arrow-left mr-10"></i> Qualifications details  </h5>  </a>
            </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Probation Details</h3>


                </div>


                <div class="card-body row">



                    <div class="form-group col-6">
                        <label for="inputName">Department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="department" id="department" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($department as $departments) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">District</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="district" id="district" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($districts as $district) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->district == $district->id) ? 'selected' : ''; ?> value="<?= en_func($district->id, 'e') ?>"><?= $district->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Office</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="office" id="office" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($offices as $office) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->office == $office->office_id) ? 'selected' : ''; ?> value="<?= en_func($office->office_id, 'e') ?>"><?= $office->office_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="designation" id="designation" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($designations as $designation) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->designation == $designation->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designation->designation_id, 'e') ?>"><?= $designation->designation_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">With Effect From</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->effect_from : ''; ?>" id="effect_from" name="effect_from" class="form-control form-change">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Order No</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->order_no : ''; ?>" id="order_no" name="order_no" class="form-control">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Order Date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->order_date : ''; ?>" id="order_date" name="order_date" class="form-control form-change">
                    </div>










                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->





            <?php if ($operation != 'view' && $editable) :  ?>


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

