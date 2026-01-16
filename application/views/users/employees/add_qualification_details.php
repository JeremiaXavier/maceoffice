<section class="content-main">
    <?php if ($operation == 'add') : ?>
        <?php echo form_open(base_url('users/employees/save_qualification_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
    <?php endif;
    if ($operation == 'edit') :  ?>
        <?php echo form_open(base_url('users/employees/update_qualification_details'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>
        <input type="hidden" name="eq_id" value="<?= $eq_id  ?>">
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
                    <h3 class="card-title">Qualification Details</h3>


                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label for="inputName">Course</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="course" id="course" class="form-control">
                            <?php foreach ($courses as $course) : ?>
                                <option <?= ((!empty($educationDetails)) && $educationDetails->course == $course->course_id) ? 'selected' : ''; ?> value="<?= en_func($course->course_id, 'e') ?>"><?= $course->course_type . ' - ' . $course->course_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="inputName">Subject</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetails)) ? $educationDetails->subject : ''; ?>" id="subject" name="subject" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">University</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetails)) ? $educationDetails->university : ''; ?>" id="university" name="university" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Institution</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetails)) ? $educationDetails->institution : ''; ?>" id="institution" name="institution" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Class Obtained</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="class_obtained" id="class_obtained" class="form-control">
                            <option value="<?= en_func(1, 'e') ?>">Passed</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="inputName">Registration No</label>
                        <input data-validation="required" <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($educationDetails)) ? $educationDetails->reg_no : ''; ?>" id="reg_no" name="reg_no" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Year of Passing</label>
                        <input data-validation="required|numeric|exact_length-4" <?= ($operation == 'view') ? 'disabled' : '' ?> type="year" value="<?= (!empty($educationDetails)) ? $educationDetails->year_of_pass : ''; ?>" id="year_of_pass" name="year_of_pass" class="form-control">
                    </div>





                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Qualification Document</h3>


                </div>


                <div class="card-body">


                    <?php if (!empty($educationDetails) && strlen($educationDetails->qualification_document) > 0) : ?>

                        <div class="form-group">
                            <label class="form-label" for="file">Current document</label>
                            <iframe loading="lazy" src="<?= QUALIFICATION_DOCUMENTS . $educationDetails->qualification_document ?>" height="300" style="width: 100%;" id="previous_document" frameborder="0"></iframe>

                        </div>
                    <?php endif; ?>



                    <div class="form-group">
                        <iframe src="" height="300" id="document-preview" style="display: none; width: 100%;" frameborder="0"></iframe>
                    </div>

                    <?php if (!empty($educationDetails)) : ?>
                        <input name="current_document" value="<?= $educationDetails->qualification_document ?>" type="hidden" class="form-control" id="current_document">
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