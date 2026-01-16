<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/letters/save_letters'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/letters/update_letters'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
            <input type="hidden" name="letter_id" value="<?= $letter_id ?>">
        <?php endif; ?>

        <?php if ($operation != 'view') :  ?>




        <?php endif; ?>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Letter Orders</h3>
                </div>



                <div class="card-body">

                    <?php if ($operation == 'add') : ?>
                        <div class="points_div">
                            <?php
                            $i = 1;
                            foreach ($ordersList as $orders) :
                            ?>
                                <div class="input-group mb-10">
                                    <span class="input-group-text"><?= $i++ ?></span>
                                    <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= $orders->order_content ?>" id="points" name="points[]" class="form-control">
                                    <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="points_div">
                            <?php
                            $i = 1;
                            $ordersListStr = $lettersDetails->letter_orders;
                            $ordersList = explode("~", $ordersListStr);
                            foreach ($ordersList as $orders) :
                            ?>
                                <div class="input-group mb-10">
                                    <span class="input-group-text"><?= $i++ ?></span>
                                    <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= $orders ?>" id="points" name="points[]" class="form-control">
                                    <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_points">Add new points <i class="fa fa-plus-circle"></i></a>

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Letter Details</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">Letter title</label>
                        <input type="text" data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($lettersDetails)) ? trim($lettersDetails->letter_title) : ''; ?>" id="letter_title" name="letter_title" class="form-control letter_title">

                    </div>


                    <div class="form-group">
                        <label for="inputName">Sender</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="sender" id="sender" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($sendersList as $sender) : ?>
                                <option <?= ((!empty($lettersDetails)) && $lettersDetails->sender == $sender->sender_id) ? 'selected' : ''; ?> value="<?= en_func($sender->sender_id, 'e') ?>"><?= $sender->sender_name . ' - ' . $sender->sender_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Receiver</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="receiver" id="receiver" class="form-control select2 select2-hidden-accessible" style="width:100%;">
                            <?php foreach ($recipientsList as $recipient) : ?>
                                <option <?= ((!empty($lettersDetails)) && $lettersDetails->receiver == $recipient->recipient_id) ? 'selected' : ''; ?> value="<?= en_func($recipient->recipient_id, 'e') ?>"><?= $recipient->recipient_name . ' - ' . $recipient->recipient_name_mal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Letter date </label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($lettersDetails)) ? $lettersDetails->letter_date : date('Y-m-d'); ?>" id="letter_date" name="letter_date" class="form-control make-letter_title">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Letter Order no</label>
                        <input type="text" data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($lettersDetails)) ? trim($lettersDetails->order_no) : ''; ?>" id="order_no" name="order_no" class="form-control">

                    </div>


                    <div class="form-group">
                        <label for="inputName">Subject</label>
                        <input type="text" data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($lettersDetails)) ? trim($lettersDetails->subject) : ''; ?>" id="subject" name="subject" class="form-control make-letter_title">

                    </div>


                    <div class="form-group">
                        <label for="inputName">Salutation</label>
                        <input type="text" data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> value="<?= (!empty($lettersDetails)) ? trim($lettersDetails->salutation) : ''; ?>" id="salutation" name="salutation" class="form-control">

                    </div>



                    <div class="form-group">
                        <label for="inputName">Body</label>
                        <textarea <?= ($operation == 'view') ? 'disabled' : '' ?> id="body" name="body" class="form-control">
                            <?= (!empty($lettersDetails)) ? $lettersDetails->body : ''; ?>
                        </textarea>
                    </div>




                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($lettersDetails)) && $lettersDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                </div>
            </div>
        </div>




        <div class="col-12">
            <div class="content-header">
                <div>
                    <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                    <button type="submit" id="submit-button" class="btn btn-md teachers-report rounded font-sm hover-up btn-block float-right">Add report&nbsp; <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>


    </div>


</section>
<script>
    $(document).on('click', '.remove_points', function() {
        $(this).parent().remove()
    });


    $(document).on('click', '.remove_row', function() {
        $(this).parent().parent().remove()
    });


    $('#add_new_points').click(function(event) {
        let point_html = `<div class="input-group mb-10">
                            <input  type="text" value="" id="points" name="points[]" class="form-control">
                            <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>
                        </div>`;

        $('.points_div').append(point_html);
    });
</script>


<script>
    $('.select2').select2({
        closeOnSelect: true
    });
</script>


<script src="<?= base_url() ?>assets/admin/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace('body', {});
</script>