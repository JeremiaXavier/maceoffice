<section class="content-main">

    <div class="content-header">
        <div>
            <h2 class="content-title card-title"><a href="<?= base_url() ?>users/employees">Employee Details</a> / Appoinment Details</h2>
            <p>Your details in this portal.</p>
            <span class="text-muted">4 out of 6</span>
        </div>
    </div>




    <div class="row">




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <a href="<?= base_url() ?>users/employees/address_details" class="float-start">
                        <h5 class="text-white"><i class="fa fa-arrow-left mr-10"></i> Present / Permanent Address details </h5>
                    </a>
                    <a href="<?= base_url() ?>users/employees/qualification_details" class="float-end">
                        <h5 class="text-white"> Qualifications details <i class="fa fa-arrow-right ml-10"></i></h5>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header row">
                    <h3 class="card-title col-9">Appoinments Details</h3>

                    <div class="col-3">
                        <a data-url="<?= base_url() ?>users/employees/add_appoinment_details" class="btn btn-info btn-sm open-offcanvas">Add <i class="fa fa-plus-circle ml-5"></i> </a>
                    </div>
                </div>


                <div class="card-body row">


                    <?php foreach ($appoinmentDetails as $appoinmentDetail) : ?>

                        <div class="col-md-6 col-lg-4 col-sm-12">
                            <div class="card card-product-grid">

                                <div class="info-wrap">
                                    <p class="title mt-2"><?= $appoinmentDetail->appoinment_order_no . ' - ' .  $appoinmentDetail->appoinment_date ?></p>
                                    <p class="title mt-2"><?= $appoinmentDetail->approval_order_no . ' - ' .  $appoinmentDetail->approval_order_date ?></p>
                                    <p class="title mt-2">  <?= date('d-m-Y', strtotime($appoinmentDetail->updated_at)) . ' | ' . date('h:i a', strtotime($appoinmentDetail->updated_at)) ?> </p>

                                    <hr>
                                    <div class="action-buttons mt-15">
                                        <a data-url="<?= base_url() ?>users/employees/edit_appoinment_details/<?= en_func($appoinmentDetail->ea_id, 'e') ?>" class="btn btn-sm font-sm rounded btn-brand open-offcanvas"> <i class="material-icons md-edit"></i> Edit </a>

                                        <?php if (empty($appoinmentDetail)) : ?>
                                            <span class="badge badge-soft-warning ml-10">InComplete <i class="fa fa-times ml-5"></i> </span>
                                        <?php else : ?>
                                            <span class="badge badge-soft-success ml-10">Completed <i class="fa fa-check ml-5"></i> </span>
                                        <?php endif; ?>

                                        <?php if (!empty($appoinmentDetail) && $appoinmentDetail->editable == 0) : ?>
                                            <span class="badge badge-soft-warning ml-10">Not Editable<i class="fa fa-times ml-5"></i> </span>
                                        <?php else : ?>
                                            <span class="badge badge-soft-success ml-10">Editable <i class="fa fa-check ml-5"></i> </span>
                                        <?php endif;  ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>


                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->





        </div>









    </div>


</section>