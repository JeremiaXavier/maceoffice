<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/employees/save_personal_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/employees/update_personal_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="ep_id" value="<?= en_func($employeeDetails->ep_id, 'e') ?>">
        <input type="hidden" name="employee_id" value="<?= $employee_id ?>">
    <?php endif; ?>


    <div class="content-header">
        <div>
            <h2 class="content-title card-title"> <a href="<?= base_url() ?>admin/employees/index/<?= $employee_id ?>">Employee Details</a> / Personal Details</h2>
            <p>Your details in this portal.</p>
            <span class="text-muted">1 out of 6</span>

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




    <div class="row">




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <a href="<?= base_url() ?>admin/employees/present_service/<?= $employee_id ?>" class="float-end">
                        <h5 class="text-white"> Present Service details <i class="fa fa-arrow-right ml-10"></i></h5>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Personal Details</h3>


                </div>


                <div class="card-body row">



                    <div class="form-group col-6">
                        <label for="inputName">Gender</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="gender" id="gender" class="form-control">
                            <?php foreach ($gender as $genders) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->gender == $genders->gender_id) ? 'selected' : ''; ?> value="<?= en_func($genders->gender_id, 'e') ?>"><?= $genders->gender_title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Nationality</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="nationality" id="nationality" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($countries as $country) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->nationality == $country->id) ? 'selected' : ''; ?> value="<?= en_func($country->id, 'e') ?>"><?= $country->sortname . ' - ' . $country->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Date of Birth</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->date_of_birth : ''; ?>" id="date_of_birth" name="date_of_birth" class="form-control form-change">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Date of Super Annuation</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($employeeDetails)) ? $employeeDetails->date_of_superannuation : ''; ?>" id="date_of_superannuation" name="date_of_superannuation" class="form-control form-change">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Religion</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="religion" id="religion" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($religions as $religion) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->religion == $religion->id) ? 'selected' : ''; ?> value="<?= en_func($religion->id, 'e') ?>"><?= $religion->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Caste</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->caste : ''; ?>" id="caste" name="caste" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Caste Category</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="caste_category" id="caste_category" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($caste_category as $caste_categories) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->caste_category == $caste_categories->id) ? 'selected' : ''; ?> value="<?= en_func($caste_categories->id, 'e') ?>"><?= $caste_categories->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Handicapped or not</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="handicapped" id="handicapped" class="form-control">
                            <?php foreach ($yes_and_no_enum as $yes_and_no) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->handicapped == $yes_and_no['id']) ? 'selected' : ''; ?> value="<?= en_func($yes_and_no['id'], 'e') ?>"><?= $yes_and_no['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">PAN Number</label>
                        <input data-validation="required|exact_length-10" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->pan_number : ''; ?>" id="pan_number" name="pan_number" class="form-control" oninput="this.value = this.value.toUpperCase()">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Marital status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="marital_status" id="marital_status" class="form-control">
                            <?php foreach ($marital_enum as $marital) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->marital_status == $marital['id']) ? 'selected' : ''; ?> value="<?= en_func($marital['id'], 'e') ?>"><?= $marital['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Spouse Name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->spouse_name : ''; ?>" id="spouse_name" name="spouse_name" class="form-control">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Is Intercaste or not</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="inter_caste" id="inter_caste" class="form-control">
                            <?php foreach ($yes_and_no_enum as $yes_and_no) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->inter_caste == $yes_and_no['id']) ? 'selected' : ''; ?> value="<?= en_func($yes_and_no['id'], 'e') ?>"><?= $yes_and_no['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Spouse religion</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="spouse_religion" id="spouse_religion" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($religions as $religion) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->spouse_religion == $religion->id) ? 'selected' : ''; ?> value="<?= en_func($religion->id, 'e') ?>"><?= $religion->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">Editable</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="editable" id="editable" class="form-control">
                            <option <?= ((!empty($employeeDetails)) && $employeeDetails->editable == 1) ? 'selected' : ''; ?> value="<?= en_func(1, 'e') ?>">Allow</option>
                            <option <?= ((!empty($employeeDetails)) && $employeeDetails->editable == 0) ? 'selected' : ''; ?> value="<?= en_func(0, 'e') ?>">Deny</option>
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
    function check_pan_no() {
        let panNo = $('#pan_number').val();
        if (panNo.length == 0)
            return false;


        if (/([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(panNo))
            return false;


        AlertandToast('error', 'Recheck these errors and resubmit', false, true);
        AlertandToast('error', '<p>PAN Number is not in valid format,Please check again</p>', true, false);
        return true;
    }
</script>