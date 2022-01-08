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
                    <input name="file" type="file" class="inputFile" id="files" />
                    <input type="submit" value="Upload" class="btnSubmit" />
                </form>

                <form action="/admin/teacher/edit?id=<?= $data->id ?>" method="POST">
                    <input value=<?= $data->avatar ?> class="form-control form-control-sm" type="hidden" name="avatar">
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Họ và tên</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input value="<?= $data->name ?>" class="form-control form-control-sm" type="text" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Chuyên ngành</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <select class="select2 select2-sm" name="specialized">
                                <option value="Khoa học máy tính">Khoa học máy tính</option>
                                <option value="Khoa học dữ liệu">Khoa học dữ liệu</option>
                                <option value="Hải dương học">Hải dương học</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Học vị</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <select class="select2 select2-sm" name="degree">
                                <option value="Cử nhân">Cử nhân</option>
                                <option value="Thạc sĩ">Thạc sĩ</option>
                                <option value="Tiến sĩ">Tiến sĩ</option>
                                <option value="Phó giáo sư">Phó giáo sư</option>
                                <option value="Giáo sư">Giáo sư</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Mô tả thêm</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <textarea class="form-control form-control-sm" type="text" name="description">
                                <?= trim($data->description) ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group row"></div>
                    <button class="btn btn-primary" type="submit" name="confirm" value="Update">Xác nhận</button>
            </div>
            </form>
        </div>
    </div>
</div>