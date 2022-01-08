<?php

use app\core\Application;
?>

<link rel="stylesheet" type="text/css" href="/assets/lib/jquery.gritter/css/jquery.gritter.css">
<link rel="stylesheet" type="text/css" href="/assets/lib/select2/css/select2.min.css" />
<style>
    .select2-selection__arrow b::after {
        display: none !important;
    }
</style>

<?php Application::$app->showErrorMsgs() ?>
<?php Application::$app->showMsg('success') ?>
<div class="row">
    <div class="col-12">
        <div class="card card-border-color card-border-color-primary">
            <div class="card-header card-header-divider">
                Transaction
                <span class="card-subtitle">
                    These are the different form control component sizes
                </span>
            </div>
            <div class="card-body">
                <form action="/admin/transaction/create" method="POST">

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Thiết bị</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <select class="select2 select2-sm" name="device_id">
                                <?php foreach ($devices as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Giáo viên</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <select class="select2 select2-sm" name="teacher_id">
                                <?php foreach ($teachers as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Lớp học</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <select class="select2 select2-sm" name="classroom_id">
                                <?php foreach ($classRooms as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Thời gian bắt đầu</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <div class="input-group date datetimepicker" data-min-view="2" data-date-format="dd-mm-yyyy">
                                <input class="form-control" size="16" type="text" value="" name="start_transaction_plan">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Thời gian kết thúc</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <div class="input-group date datetimepicker" data-min-view="2" data-date-format="dd-mm-yyyy">
                                <input class="form-control" size="16" type="text" value="" name="end_transaction_plan">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row"></div>
                    <input class="btn btn-primary" type="submit" value="Mượn">
                </form>

            </div>
        </div>
    </div>
</div>

@script
<script src="/assets/lib/jquery.gritter/js/jquery.gritter.js" type="text/javascript"></script>
<script src="/assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="/assets/lib/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
<script src="/assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
<script src="/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
<script src="/assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/lib/bootstrap-slider/bootstrap-slider.min.js" type="text/javascript"></script>
<script src="/assets/lib/bs-custom-file-input/bs-custom-file-input.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
        App.uiNotifications();
        App.formElements();
    });
</script>
<script>

</script>

@endScript