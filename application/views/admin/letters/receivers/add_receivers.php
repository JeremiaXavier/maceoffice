<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/letters/save_receivers'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/letters/update_receivers'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="recipient_id" value="<?= $recipient_id  ?>">
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
                    <h3 class="card-title">Letters Recipents Details</h3>


                </div>


                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Recipents name</label>
                        <input type="text" data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($receiversDetails)) ? trim($receiversDetails->recipient_name) : ''; ?>" id="recipient_name" name="recipient_name" class="form-control">

                    </div>


                    <div class="form-group">
                        <label for="inputName">Recipents name Malayalam</label>
                        <textarea <?= ($operation == 'view') ? 'disabled' : '' ?> id="recipient_name_mal" name="recipient_name_mal" class="form-control">
                            <?= (!empty($receiversDetails)) ? trim($receiversDetails->recipient_name_mal) : ''; ?>
                        </textarea>

                    </div>


                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($receiversDetails)) && $receiversDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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

<script src="<?= base_url() ?>assets/admin/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace('recipient_name_mal', {});
</script>