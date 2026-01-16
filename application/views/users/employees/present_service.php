<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('users/employees/save_present_service'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('users/employees/update_present_service'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="eps_id" value="<?= en_func($employeeDetails->eps_id, 'e') ?>">
    <?php endif; ?>


    <div class="content-header">
        <div>
            <h2 class="content-title card-title"><a href="<?= base_url() ?>users/employees">Employee Details</a> / Present Service Details</h2>
            <p>Your details in this portal.</p>
            <span class="text-muted">2 out of 6</span>

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
                    <a href="<?= base_url() ?>users/employees/personal_details" class="float-start">
                        <h5 class="text-white"><i class="fa fa-arrow-left mr-10"></i> Personal details </h5>
                    </a>
                    <a href="<?= base_url() ?>users/employees/address_details" class="float-end">
                        <h5 class="text-white"> Present / Permanent Address details <i class="fa fa-arrow-right ml-10"></i></h5>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Present Service Details</h3>


                </div>


                <div class="card-body row">



                    <div class="form-group col-6">
                        <label for="inputName">Department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="service_department" id="service_department" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($department as $departments) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->service_department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">Date of Joining Gov. Service</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->date_of_joining : ''; ?>" id="date_of_joining" name="date_of_joining" class="form-control form-change">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="scale_of_pay" id="scale_of_pay" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Present Pay</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_pay : ''; ?>" id="present_pay" name="present_pay" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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