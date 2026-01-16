<h4 class="mb-15"><u>Teachers in month - <?= date('F', strtotime("$report_time")); ?></u></h4>

<?php
if(empty($teachersList))
    echo "No teachers available in this month";
?>
<?php foreach ($teachersList as $teachers) :  ?>
    <div class="col-md-3">
        <?= $teachers->teacher_name . ' - ' . $teachers->teacher_code ?>

        <?php

        $toggle_status = 'checked';
        ?>

        <div class="form-check form-switch">
            <input name="teachers_list" class="form-check-input" data-action="add" data-module="<?= $teachers->teacher_name . ' - ' . $teachers->teacher_code ?>" data-id="<?= en_func($teachers->teacher_id, 'e') ?>" type="checkbox" id="flexSwitchCheckChecked" <?= $toggle_status ?>>
            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
        </div>


    </div>

<?php endforeach; ?>