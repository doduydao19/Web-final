<?php

use app\core\Application;
?>

<link rel="stylesheet" type="text/css" href="/assets/lib/jquery.gritter/css/jquery.gritter.css">

<?php Application::$app->showErrorMsgs() ?>
<?php Application::$app->showMsg('success') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-border-color card-border-color-primary">
            <div class="card-header card-header-divider">
                Giáo viên
            </div>
            <div class="card-body">

                <img id="image" style="max-width: 60px;" src="<?= $data->avatar ?>" />
                <form id="uploadForm" action="/upload" method="post">
                    <label>Avatar:</label><br />
                    <input name="file" type="file" class="inputFile" id="files" disabled/>
                    
                </form>

                <form action="/admin/teacher/edit_confirm?id=<?= $data->id ?>" method="POST">
                    <input value=<?= $data->avatar ?> class="form-control form-control-sm" type="hidden" name="avatar">
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Họ và tên</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input value="<?= $data->name ?>" class="form-control form-control-sm" type="text" name="name"  disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Chuyên ngành</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input value="<?= $data->specialized ?>" class="form-control form-control-sm" type="text" name="specialized"  disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Học vị</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input value="<?= $data->degree ?>" class="form-control form-control-sm" type="text" name="degree"  disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Mô tả thêm</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <textarea class="form-control form-control-sm" type="text" name="description"  disabled>
                                <?= trim($data->description) ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group row"></div>

                    <!-- <button class="btn btn-primary" type="submit" value="Update"> -->
                    <!-- <button class="btn btn-primary" onclick="/admin/teacher/edit?id=<?= $data->id ?>" type="submit" value="Fix"> -->
                    
                    <a class="btn btn-primary btn-sm" href="/admin/teacher/edit?id=<?= $data->id ?>">Sửa lại</a>
                    <a class="btn btn-primary btn-sm" href="/admin/teacher/complete?id=<?= $data->id ?>">Đăng ký</a>
            </div>
            </form>
        </div>
    </div>
</div>

@script
<script src="/assets/lib/jquery.gritter/js/jquery.gritter.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
        App.uiNotifications();
    });
</script>
<script type="text/javascript">

    $(document).ready(function(e) {
        document.getElementById('files').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        $("#uploadForm").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "/upload",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('input[name="avatar"]').val(data.url);

                    $.gritter.add({
                        title: 'Notification',
                        text: 'Upload file success',
                        class_name: 'color success'
                    });
                },
                error: function(err) {
                    $.gritter.add({
                        title: 'Notification',
                        text: err.responseJSON?.errors[0],
                        class_name: 'color danger'
                    });
                }
            });
        }));
    });
    
</script>
@endScript