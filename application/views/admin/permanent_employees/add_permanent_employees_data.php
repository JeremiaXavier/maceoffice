<section class="content-main">

   

    <div class="row">



        <div class="col-md-12"> <span role="button" data-collapse="personalDetails" class="badge bg-warning mb-15 click-collapse plus"> 1. Personal Details</span> </div>

        <div class="col-md-12">


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title click-collapse plus" role="button" data-collapse="personalDetails">Personal Details </h3> 
                    <?= empty($personalDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>




                <div class="card-body row collapse" id="personalDetails">



                    <div class="form-group col-6">
                        <label for="inputName">Gender</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="gender" id="gender" class="form-control">
                            <?php foreach ($gender as $genders) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->gender == $genders->gender_id) ? 'selected' : ''; ?> value="<?= en_func($genders->gender_id, 'e') ?>"><?= $genders->gender_title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Nationality</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="nationality" id="nationality" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($countries as $country) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->nationality == $country->id) ? 'selected' : ''; ?> value="<?= en_func($country->id, 'e') ?>"><?= $country->sortname . ' - ' . $country->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Date of Birth</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($personalDetails)) ? $personalDetails->date_of_birth : ''; ?>" id="date_of_birth" name="date_of_birth" class="form-control form-change">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Date of Super Annuation</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($personalDetails)) ? $personalDetails->date_of_superannuation : ''; ?>" id="date_of_superannuation" name="date_of_superannuation" class="form-control form-change">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Religion</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="religion" id="religion" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($religions as $religion) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->religion == $religion->id) ? 'selected' : ''; ?> value="<?= en_func($religion->id, 'e') ?>"><?= $religion->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Caste</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($personalDetails)) ? $personalDetails->caste : ''; ?>" id="caste" name="caste" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Caste Category</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="caste_category" id="caste_category" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($caste_category as $caste_categories) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->caste_category == $caste_categories->id) ? 'selected' : ''; ?> value="<?= en_func($caste_categories->id, 'e') ?>"><?= $caste_categories->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Handicapped or not</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="handicapped" id="handicapped" class="form-control">
                            <?php foreach ($yes_and_no_enum as $yes_and_no) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->handicapped == $yes_and_no['id']) ? 'selected' : ''; ?> value="<?= en_func($yes_and_no['id'], 'e') ?>"><?= $yes_and_no['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">PAN Number</label>
                        <input data-validation="required|exact_length-10" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($personalDetails)) ? $personalDetails->pan_number : ''; ?>" id="pan_number" name="pan_number" class="form-control" oninput="this.value = this.value.toUpperCase()">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Marital status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="marital_status" id="marital_status" class="form-control">
                            <?php foreach ($marital_enum as $marital) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->marital_status == $marital['id']) ? 'selected' : ''; ?> value="<?= en_func($marital['id'], 'e') ?>"><?= $marital['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Spouse Name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($personalDetails)) ? $personalDetails->spouse_name : ''; ?>" id="spouse_name" name="spouse_name" class="form-control">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Is Intercaste or not</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="inter_caste" id="inter_caste" class="form-control">
                            <?php foreach ($yes_and_no_enum as $yes_and_no) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->inter_caste == $yes_and_no['id']) ? 'selected' : ''; ?> value="<?= en_func($yes_and_no['id'], 'e') ?>"><?= $yes_and_no['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Spouse religion</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="spouse_religion" id="spouse_religion" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($religions as $religion) : ?>
                                <option <?= ((!empty($personalDetails)) && $personalDetails->spouse_religion == $religion->id) ? 'selected' : ''; ?> value="<?= en_func($religion->id, 'e') ?>"><?= $religion->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>






                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->

        </div>



        <!----->

        <hr>


        <div class="col-md-12"> <span role="button" data-collapse="presentserviceDetails" class="badge bg-warning mb-15 click-collapse plus">2. Present Service Details</span></div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title click-collapse plus" role="button" data-collapse="presentserviceDetails">Present Service Details</h3>
                    <?= empty($presentserviceDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>


                <div class="card-body row collapse" id="presentserviceDetails">



                    <div class="form-group col-6">
                        <label for="inputName">Department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="service_department" id="service_department" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($department as $departments) : ?>
                                <option <?= ((!empty($presentserviceDetails)) && $presentserviceDetails->service_department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">Date of Joining Gov. Service</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($presentserviceDetails)) ? $presentserviceDetails->date_of_joining : ''; ?>" id="date_of_joining" name="date_of_joining" class="form-control form-change">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Scale of Pay</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="scale_of_pay" id="scale_of_pay" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($scale_of_pay as $scale_of_pays) : ?>
                                <option <?= ((!empty($presentserviceDetails)) && $presentserviceDetails->scale_of_pay == $scale_of_pays->sop_id) ? 'selected' : ''; ?> value="<?= en_func($scale_of_pays->sop_id, 'e') ?>"><?= $scale_of_pays->pay_range ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Present Pay</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($presentserviceDetails)) ? $presentserviceDetails->present_pay : ''; ?>" id="present_pay" name="present_pay" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>






                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->

        </div>



        <!------>
        <hr>

        <div class="col-md-12"> <span  role="button" data-collapse="addressDetails"  class="badge bg-warning mb-15 click-collapse plus">3. Present/Permanent Address Details</span></div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  role="button" data-collapse="presentAddressDetails" class="card-title click-collapse plus">Present Address Details</h3>
                    <?= empty($addressDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>



                <div class="card-body row collapse" id="presentAddressDetails">



                    <div class="form-group col-6">
                        <label for="inputName">House no and name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_house_no_name : ''; ?>" id="present_house_no_name" name="present_house_no_name" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Street</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_street : ''; ?>" id="present_street" name="present_street" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Place</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_place : ''; ?>" id="present_place" name="present_place" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">PIN</label>
                        <input data-validation="required|numeric|exact_length-6" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_pin : ''; ?>" id="present_pin" name="present_pin" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">State</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="present_state" id="present_state" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($states as $state) : ?>
                                <option <?= ((!empty($addressDetails)) && $addressDetails->present_state == $state->id) ? 'selected' : ''; ?> value="<?= en_func($state->id, 'e') ?>"><?= $state->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">District</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="present_district" id="present_district" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($districts as $district) : ?>
                                <option <?= ((!empty($addressDetails)) && $addressDetails->present_district == $district->id) ? 'selected' : ''; ?> value="<?= en_func($district->id, 'e') ?>"><?= $district->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Taluk</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_taluk : ''; ?>" id="present_taluk" name="present_taluk" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Village</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_village : ''; ?>" id="present_village" name="present_village" class="form-control">
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">Constituency</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_constituency : ''; ?>" id="present_constituency" name="present_constituency" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Phone</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->present_phone : ''; ?>" id="present_phone" name="present_phone" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>



                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->

        </div>


        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3  role="button" data-collapse="generalAddressDetails" class="card-title click-collapse plus">General Details</h3>
                    <?= empty($addressDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>


                <div class="card-body row collapse" id="generalAddressDetails">



                    <div class="form-group col-6">
                        <label for="inputName">Hometown</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->home_town : ''; ?>" id="home_town" name="home_town" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Mobile Number</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->mobile_number : ''; ?>" id="mobile_number" name="mobile_number" class="form-control">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Email Address</label>
                        <input data-validation="required|valid_email" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->email_address : ''; ?>" id="email_address" name="email_address" class="form-control">
                    </div>





                </div>
            </div>




            <div class="card card-primary">
                <div class="card-header">
                    <h3 role="button" data-collapse="permanentAddressDetails" class="card-title click-collapse plus">Permanent Address Details</h3>
                    <?= empty($addressDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>


                <div class="card-body row collapse" id="permanentAddressDetails">



                    <div class="form-group col-6">
                        <label for="inputName">House no and name</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_house_no_name : ''; ?>" id="permanent_house_no_name" name="permanent_house_no_name" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Street</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_street : ''; ?>" id="permanent_street" name="permanent_street" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Place</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_place : ''; ?>" id="permanent_place" name="permanent_place" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">PIN</label>
                        <input data-validation="required|numeric|exact_length-6" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_pin : ''; ?>" id="permanent_pin" name="permanent_pin" class="form-control permanent-address-fileds" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">State</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="permanent_state" id="permanent_state" class="form-control permanent-address-fileds">
                            <?php foreach ($states as $state) : ?>
                                <option <?= ((!empty($addressDetails)) && $addressDetails->permanent_state == $state->id) ? 'selected' : ''; ?> value="<?= en_func($state->id, 'e') ?>"><?= $state->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">District</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="permanent_district" id="permanent_district" class="form-control permanent-address-fileds">
                            <?php foreach ($districts as $district) : ?>
                                <option <?= ((!empty($addressDetails)) && $addressDetails->permanent_district == $district->id) ? 'selected' : ''; ?> value="<?= en_func($district->id, 'e') ?>"><?= $district->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Taluk</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_taluk : ''; ?>" id="permanent_taluk" name="permanent_taluk" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Village</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_village : ''; ?>" id="permanent_village" name="permanent_village" class="form-control permanent-address-fileds">
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">Constituency</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_constituency : ''; ?>" id="permanent_constituency" name="permanent_constituency" class="form-control permanent-address-fileds">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Phone</label>
                        <input data-validation="required|numeric" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($addressDetails)) ? $addressDetails->permanent_phone : ''; ?>" id="permanent_phone" name="permanent_phone" class="form-control permanent-address-fileds" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>



                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->

        </div>

        <!---->
        <hr>


        <div class="col-md-12"> <span role="button" data-collapse="appoinmentDetails"  class="badge bg-warning mb-15 click-collapse plus">4. Appoinment Details</span></div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  role="button" data-collapse="appoinmentDetails" class="card-title click-collapse plus">Appoinment Details</h3>
                    <?= empty($appoinmentDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>


                <div class="card-body row collapse" id="appoinmentDetails">

                    <?php $i = 0;
                    foreach ($appoinmentDetails as $appoinmentDetail) :  $i++; ?>

                        <div class="form-group">
                            <span class="badge bg-primary"><?= $i ?> - Appoinment</span>
                        </div>

                        <div class="form-group">
                            <label for="inputName">Appoinment Order No</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($appoinmentDetail)) ? $appoinmentDetail->appoinment_order_no : ''; ?>" id="appoinment_order_no" name="appoinment_order_no" class="form-control">
                        </div>



                        <div class="form-group">
                            <label for="inputName">Appoinment date</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($appoinmentDetail)) ? $appoinmentDetail->appoinment_date : ''; ?>" id="appoinment_date" name="appoinment_date" class="form-control form-change">
                        </div>



                        <div class="form-group">
                            <label for="inputName">Approval Order No</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($appoinmentDetail)) ? $appoinmentDetail->approval_order_no : ''; ?>" id="approval_order_no" name="approval_order_no" class="form-control">
                        </div>



                        <div class="form-group">
                            <label for="inputName">Approval date</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($appoinmentDetail)) ? $appoinmentDetail->approval_order_date : ''; ?>" id="approval_order_date" name="approval_order_date" class="form-control form-change">
                        </div>

                        <?php if (!empty($appoinmentDetail) && strlen($appoinmentDetail->appoinment_document) > 0) : ?>

                            <div class="form-group">
                                <label class="form-label" for="file">Current document</label>
                                <iframe loading="lazy" src="<?= APPOINMENT_DOCUMENTS . $appoinmentDetail->appoinment_document ?>" height="300" style="width: 100%;" id="previous_document" frameborder="0"></iframe>
                            </div>

                        <?php else : ?>

                            <div class="form-group">
                                <h5 class="text-danger">No document uploaded</h5>
                            </div>


                        <?php endif; ?>

                    <?php endforeach; ?>


                </div>
            </div>
        </div>



        <!---->

        <hr>

        <div class="col-md-12"> <span  role="button" data-collapse="qualificationDetails"  class="badge bg-warning mb-15 click-collapse plus">5. Qualifications Details</span></div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  role="button" data-collapse="qualificationDetails" class="card-title click-collapse plus">Qualifications Details</h3>

                    <?= empty($educationDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>

                </div>


                <div class="card-body row collapse" id="qualificationDetails">

                    <?php $i = 0;
                    foreach ($educationDetails as $educationDetail) :  $i++; ?>

                        <div class="form-group">
                            <span class="badge bg-primary"><?= $i ?> - Qualification</span>
                        </div>


                        <div class="form-group">
                            <label for="inputName">Course</label>
                            <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="course" id="course" class="form-control">
                                <?php foreach ($courses as $course) : ?>
                                    <option <?= ((!empty($educationDetail)) && $educationDetail->course == $course->course_id) ? 'selected' : ''; ?> value="<?= en_func($course->course_id, 'e') ?>"><?= $course->course_type . ' - ' . $course->course_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="inputName">Subject</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetail)) ? $educationDetail->subject : ''; ?>" id="subject" name="subject" class="form-control">
                        </div>



                        <div class="form-group">
                            <label for="inputName">University</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetail)) ? $educationDetail->university : ''; ?>" id="university" name="university" class="form-control">
                        </div>



                        <div class="form-group">
                            <label for="inputName">Institution</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetail)) ? $educationDetail->institution : ''; ?>" id="institution" name="institution" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="inputName">Class Obtained</label>
                            <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="class_obtained" id="class_obtained" class="form-control">
                                <option value="<?= en_func(1, 'e') ?>">Passed</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="inputName">Registration No</label>
                            <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetail)) ? $educationDetail->reg_no : ''; ?>" id="reg_no" name="reg_no" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="inputName">Year of Passing</label>
                            <input data-validation="required|numeric|exact_length-4" <?= ($operation == 'view') ? 'disabled' : '' ?> type="year" value="<?= (!empty($educationDetail)) ? $educationDetail->year_of_pass : ''; ?>" id="year_of_pass" name="year_of_pass" class="form-control">
                        </div>




                        <?php if (!empty($educationDetail) && strlen($educationDetail->qualification_document) > 0) : ?>

                            <div class="form-group">
                                <label class="form-label" for="file">Current document</label>
                                <iframe loading="lazy" src="<?= QUALIFICATION_DOCUMENTS . $educationDetail->qualification_document ?>" height="300" style="width: 100%;" id="previous_document" frameborder="0"></iframe>

                            </div>

                        <?php else : ?>

                            <div class="form-group">
                                <h5 class="text-danger">No document uploaded</h5>
                            </div>

                        <?php endif; ?>


                    <?php endforeach; ?>


                </div>
            </div>
        </div>



        <!---->

        <hr>


        <div class="col-md-12"> <span  role="button" data-collapse="probationDetails"  class="badge bg-warning mb-15 click-collapse plus">6. Probation Details</span></div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  role="button" data-collapse="probationDetails"  class="card-title click-collapse plus">Probation Details</h3>
                    <?= empty($probationDetails) ? ' <span class="badge badge-soft-danger"><i class="fa fa-times"></i> </span>':'<span class="badge badge-soft-success"><i class="fa fa-check"></i> </span>' ?>


                </div>


                <div class="card-body row collapse" id="probationDetails">



                    <div class="form-group col-6">
                        <label for="inputName">Department</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="department" id="department" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($department as $departments) : ?>
                                <option <?= ((!empty($probationDetails)) && $probationDetails->department == $departments->department_id) ? 'selected' : ''; ?> value="<?= en_func($departments->department_id, 'e') ?>"><?= $departments->department_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="inputName">District</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="district" id="district" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($districts as $district) : ?>
                                <option <?= ((!empty($probationDetails)) && $probationDetails->district == $district->id) ? 'selected' : ''; ?> value="<?= en_func($district->id, 'e') ?>"><?= $district->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Office</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="office" id="office" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($offices as $office) : ?>
                                <option <?= ((!empty($probationDetails)) && $probationDetails->office == $office->office_id) ? 'selected' : ''; ?> value="<?= en_func($office->office_id, 'e') ?>"><?= $office->office_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="designation" id="designation" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($designations as $designation) : ?>
                                <option <?= ((!empty($probationDetails)) && $probationDetails->designation == $designation->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designation->designation_id, 'e') ?>"><?= $designation->designation_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                    <div class="form-group col-6">
                        <label for="inputName">With Effect From</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($probationDetails)) ? $probationDetails->effect_from : ''; ?>" id="effect_from" name="effect_from" class="form-control form-change">
                    </div>


                    <div class="form-group col-6">
                        <label for="inputName">Order No</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($probationDetails)) ? $probationDetails->order_no : ''; ?>" id="order_no" name="order_no" class="form-control">
                    </div>



                    <div class="form-group col-6">
                        <label for="inputName">Order Date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($probationDetails)) ? $probationDetails->order_date : ''; ?>" id="order_date" name="order_date" class="form-control form-change">
                    </div>










                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->
        </div>





    </div>


</section>



<script>
    $('.select2').select2({
        closeOnSelect: true
    });
</script>