<div class="progress mb-3 progress-lg" style="display: none;" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
    </div>
</div>



<div id="alert-message-div" class="mt-15" style="display: none; padding: 0% 3%;">
</div>


<!--print error messages-->
<?php if ($this->session->flashdata('errors')) : ?>
    <div class="m-b-15" style="margin: 10px 7px;padding: 0 34px;">

        <div class="alert alert-danger">
            <?= $this->session->flashdata('errors') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>


<!--print success messages-->
<?php if ($this->session->flashdata('success')) : ?>
    <div class="m-b-15" style="margin: 10px 7px;padding: 0 34px;">
        <div class="alert alert-dismissible alert-success show alert-msg" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


    </div>
<?php endif; ?>




<?php echo @$_mainContent; ?>