<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('users/employees/save_appoinment_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('users/employees/update_appoinment_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="ea_id" value="<?= $ea_id  ?>">
    <?php endif; ?>



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


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Appoinment Details</h3>


                </div>


                <div class="card-body">






                    <div class="form-group">
                        <label for="inputName">Designation</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="designation" id="designation" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($designations as $designation) : ?>
                                <option <?= ((!empty($appoinmentDetails)) && $appoinmentDetails->designation == $designation->designation_id) ? 'selected' : ''; ?> value="<?= en_func($designation->designation_id, 'e') ?>"><?= $designation->designation_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">With effect from</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($appoinmentDetails)) ? $appoinmentDetails->effect_from : ''; ?>" id="effect_from" name="effect_from" class="form-control form-change">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Appoinment Order No</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($appoinmentDetails)) ? $appoinmentDetails->appoinment_order_no : ''; ?>" id="appoinment_order_no" name="appoinment_order_no" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Appoinment date</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($appoinmentDetails)) ? $appoinmentDetails->appoinment_date : ''; ?>" id="appoinment_date" name="appoinment_date" class="form-control form-change">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="inputName">Approval Order No (Optional)</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($appoinmentDetails)) ? $appoinmentDetails->approval_order_no : ''; ?>" id="approval_order_no" name="approval_order_no" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Approval date (Optional)</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($appoinmentDetails)) ? $appoinmentDetails->approval_order_date : ''; ?>" id="approval_order_date" name="approval_order_date" class="form-control form-change">
                    </div>






                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Appoinment Document</h3>


                </div>


                <div class="card-body">


                    <?php if (!empty($appoinmentDetails) && strlen($appoinmentDetails->appoinment_document) > 0) : ?>

                        <div class="form-group">
                            <label class="form-label" for="file">Current document</label>
                            <iframe loading="lazy" src="<?= APPOINMENT_DOCUMENTS . $appoinmentDetails->appoinment_document ?>" height="300" style="width: 100%;" id="previous_document" frameborder="0"></iframe>

                        </div>
                    <?php endif; ?>



                    <div class="form-group">
                        <iframe src="" height="300" id="document-preview" style="display: none; width: 100%;" frameborder="0"></iframe>
                    </div>

                    <?php if (!empty($appoinmentDetails)) : ?>
                        <input name="current_document" value="<?= $appoinmentDetails->appoinment_document ?>" type="hidden" class="form-control" id="current_document">
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="form-label" for="file">Upload Document (PDF File of size less than 4 MB )</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> class="form-control  document-upload" id="document" name="document" type="file" accept="application/pdf">
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
    $('.select2').select2({
        closeOnSelect: true
    });
</script>