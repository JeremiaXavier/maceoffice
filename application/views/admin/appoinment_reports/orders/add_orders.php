<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('admin/appoinment_reports/save_orders'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('admin/appoinment_reports/update_orders'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="order_id" value="<?= $order_id ?>">
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
                    <h3 class="card-title">Appoinment Order Details</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">Order no</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($ordersDetails)) ? $ordersDetails->order_number : ''; ?>" id="order_number" name="order_number" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Order content</label>
                        <textarea data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> id="order_content" name="order_content" class="form-control">
                            <?= (!empty($ordersDetails)) ? trim($ordersDetails->order_content) : ''; ?>
                        </textarea>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($ordersDetails)) && $ordersDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
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