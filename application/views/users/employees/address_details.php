<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('users/employees/save_address_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('users/employees/update_address_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="ea_id" value="<?= en_func($employeeDetails->ea_id, 'e')  ?>">
    <?php endif; ?>


    <div class="content-header">
        <div>
            <h2 class="content-title card-title"><a href="<?= base_url() ?>users/employees">Employee Details</a> / Address Details</h2>
            <p>Your details in this portal.</p>
            <span class="text-muted">3 out of 6</span>

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
                    <a href="<?= base_url() ?>users/employees/present_service" class="float-start">
                        <h5 class="text-white"><i class="fa fa-arrow-left mr-10"></i> Present Service details </h5>
                    </a>
                    <a href="<?= base_url() ?>users/employees/appoinment_details" class="float-end">
                        <h5 class="text-white"> Appoinment details <i class="fa fa-arrow-right ml-10"></i></h5>
                    </a>

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Present Address Details</h3>


                </div>


                <div class="card-body row">



                    <div class="form-group col-6">
                        <label for="inputName">House no and name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_house_no_name : ''; ?>" id="present_house_no_name" name="present_house_no_name" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Street</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_street : ''; ?>" id="present_street" name="present_street" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Place</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_place : ''; ?>" id="present_place" name="present_place" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">PIN</label>
                        <input data-validation="required|numeric|exact_length-6" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_pin : ''; ?>" id="present_pin" name="present_pin" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">State</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="present_state" id="present_state" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($states as $state) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->present_state == $state->id) ? 'selected' : ''; ?> value="<?= en_func($state->id, 'e') ?>"><?= $state->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">District</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="present_district" id="present_district" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($districts as $district) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->present_district == $district->id) ? 'selected' : ''; ?> value="<?= en_func($district->id, 'e') ?>"><?= $district->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Taluk</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_taluk : ''; ?>" id="present_taluk" name="present_taluk" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Village</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_village : ''; ?>" id="present_village" name="present_village" class="form-control">
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">Constituency</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_constituency : ''; ?>" id="present_constituency" name="present_constituency" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Phone</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->present_phone : ''; ?>" id="present_phone" name="present_phone" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>



                    <?php if ($operation != 'view' && $editable) :  ?>


                        <div class="form-group col-12">
                            <label for="inputName"></label> <br>
                            <input type="checkbox" class="btn-check copy-present-permanent" id="btn-check-outlined" autocomplete="off">
                            <label class="btn btn-outline-primary copy-address-label" for="btn-check-outlined">Click to autofill Present address details to Permanent Address</label><br>

                        </div>

                    <?php endif; ?>


                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->






            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Permanent Address Details</h3>


                </div>


                <div class="card-body row">



                    <div class="form-group col-6">
                        <label for="inputName">House no and name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_house_no_name : ''; ?>" id="permanent_house_no_name" name="permanent_house_no_name" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Street</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_street : ''; ?>" id="permanent_street" name="permanent_street" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Place</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_place : ''; ?>" id="permanent_place" name="permanent_place" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">PIN</label>
                        <input data-validation="required|numeric|exact_length-6" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_pin : ''; ?>" id="permanent_pin" name="permanent_pin" class="form-control permanent-address-fileds" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">State</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="permanent_state" id="permanent_state" class="form-control permanent-address-fileds">
                            <?php foreach ($states as $state) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->permanent_state == $state->id) ? 'selected' : ''; ?> value="<?= en_func($state->id, 'e') ?>"><?= $state->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">District</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="permanent_district" id="permanent_district" class="form-control permanent-address-fileds">
                            <?php foreach ($districts as $district) : ?>
                                <option <?= ((!empty($employeeDetails)) && $employeeDetails->permanent_district == $district->id) ? 'selected' : ''; ?> value="<?= en_func($district->id, 'e') ?>"><?= $district->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Taluk</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_taluk : ''; ?>" id="permanent_taluk" name="permanent_taluk" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Village</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_village : ''; ?>" id="permanent_village" name="permanent_village" class="form-control permanent-address-fileds">
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">Constituency</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_constituency : ''; ?>" id="permanent_constituency" name="permanent_constituency" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Phone</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->permanent_phone : ''; ?>" id="permanent_phone" name="permanent_phone" class="form-control permanent-address-fileds" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>



                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->




            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General Details</h3>


                </div>


                <div class="card-body row">



                    <div class="form-group col-6">
                        <label for="inputName">Hometown</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->home_town : ''; ?>" id="home_town" name="home_town" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Mobile Number</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->mobile_number : ''; ?>" id="mobile_number" name="mobile_number" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Email Address</label>
                        <input data-validation="required|valid_email" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($employeeDetails)) ? $employeeDetails->email_address : ''; ?>" id="email_address" name="email_address" class="form-control">
                    </div>





                </div>
            </div>



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

<script>
    $('.copy-present-permanent').on('click', function() {
        var status = (this.checked) ? true : false;
        var label_text = (this.checked) ? 'Click to clear details from Permanent Address' : 'Click to autofill Present address details to Permanent Address';
        if (status) {
            AlertandToast('warning', 'Permanent Address autofilled', false, true);
            $('.copy-address-label').text(label_text);
        } else {
            AlertandToast('warning', 'Permanent Address cleared', false, true);
            $('.copy-address-label').text(label_text);
        }

        if (!status) {
            $('.permanent-address-fileds').val('');
            return;
        }

        $('#permanent_house_no_name').val($('#present_house_no_name').val());
        $('#permanent_street').val($('#present_street').val());
        $('#permanent_place').val($('#present_place').val());
        $('#permanent_pin').val($('#present_pin').val());

        $('#permanent_taluk').val($('#present_taluk').val());
        $('#permanent_village').val($('#present_village').val());
        $('#permanent_constituency').val($('#present_constituency').val());

        $('#permanent_state')[0].selectedIndex = $('#present_state')[0].selectedIndex;
        $('#permanent_district')[0].selectedIndex = $('#present_district')[0].selectedIndex;


        $('#permanent_phone').val($('#present_phone').val());

    });
</script>