<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/scale_of_pay/save_scale_of_pay'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/scale_of_pay/update_scale_of_pay'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="sop_id" value="<?= $sop_id ?>">
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
                    <h3 class="card-title">Scale of pay Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Scale of Pay</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($scale_of_payDetails)) ? $scale_of_payDetails->pay_range : ''; ?>" id="pay_range" name="pay_range" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Scale of Pay (Full)</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($scale_of_payDetails)) ? $scale_of_payDetails->pay_range_full : ''; ?>" id="pay_range_full" name="pay_range_full" class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($scale_of_payDetails)) && $scale_of_payDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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