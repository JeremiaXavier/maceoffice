<section class="content-main">

    <div class="content-header">
        <div>
            <h2 class="content-title card-title"><a href="<?= base_url() ?>admin/employees/index/<?= $employee_id ?>">Employee Details</a> / Qualification Details</h2>
            <p>Your details in this portal.</p>
            <span class="text-muted">5 out of 6</span>
        </div>
    </div>




    <div class="row">




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <a href="<?= base_url() ?>admin/employees/appoinment_details/<?= $employee_id ?>" class="float-start">
                        <h5 class="text-white"><i class="fa fa-arrow-left mr-10"></i> Appoinment details </h5>
                    </a>
                    <a href="<?= base_url() ?>admin/employees/probation_details/<?= $employee_id ?>" class="float-end">
                        <h5 class="text-white"> Declaration of Probation details <i class="fa fa-arrow-right ml-10"></i></h5>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header row">
                    <h3 class="card-title col-9">Qualification Details</h3>

                    
                </div>


                <div class="card-body row">


                    <?php foreach ($educationDetails as $educationDetail) : ?>

                        <div class="col-md-6 col-lg-4 col-sm-12">
                            <div class="card card-product-grid">

                                <div class="info-wrap">
                                    <p class="title mt-2"><?= $educationDetail->institution ?></p>
                                    <p class="title mt-2"><?= $educationDetail->course_type .' - ' .  $educationDetail->course_name ?></p>
                                    <p class="title mt-2"><?= $educationDetail->year_of_pass ?></p>
                                    <p class="title mt-2">  <?= date('d-m-Y', strtotime($educationDetail->updated_at)) . ' | ' . date('h:i a', strtotime($educationDetail->updated_at)) ?>  </p>
                                    
                                    <hr>
                                    <div class="action-buttons mt-15">
                                        <a data-url="<?= base_url() ?>admin/employees/edit_qualification_details/<?= en_func($educationDetail->eq_id,'e') ?>" class="btn btn-sm font-sm rounded btn-brand open-offcanvas"> <i class="material-icons md-edit"></i> Edit </a>
                                  
                                        
                                        <?php if (empty($educationDetail)) : ?>
                                            <span class="badge badge-soft-warning ml-10">InComplete <i class="fa fa-times ml-5"></i> </span>
                                        <?php else : ?>
                                            <span class="badge badge-soft-success ml-10">Completed <i class="fa fa-check ml-5"></i> </span>
                                        <?php endif; ?>

                                        <?php if (!empty($educationDetail) && $educationDetail->editable == 0) : ?>
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