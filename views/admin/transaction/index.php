<?php

use app\core\Application;
?>

<?php Application::$app->showErrorMsgs() ?>
<?php Application::$app->showMsg('success') ?>

<div class="row">
    <div class="col-4 mx-auto">
        <div class="card-body">
            <form method="get" action="/admin/transaction">
                <div class="form-group row">
                    <label class="col-3 col-lg-2 col-form-label text-right">Thiết bị</label>
                    <div class="col-9 col-lg-10">
                        <input value="<?= $q ?>" class="form-control form-control-sm" type="text" name="q">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-lg-2 col-form-label text-right">Giáo viên</label>
                    <div class="col-9 col-lg-10">
                        <select class="form-control form-control-sm" name="teacher">
                            <option value="">Giáo viên</option>
                            <?php foreach ($teachers as $value) : ?>
                                <?php if ($value === $teacher) : ?>
                                    <option value="<?= $value->name ?>" selected="selected"><?= $value->name ?></option>
                                <?php else : ?>
                                    <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?> 
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <label style="font-size:14px;font-weight: 500; color: #009688">Số phòng học tìm thấy: <?= count($data) ?></label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-table">
            <div class="card-header">Class room table
                <div class="tools dropdown">
                    </span><a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><span class="icon mdi mdi-more-vert"></span></a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="/admin/transaction/create">Thêm</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:30%;">Tên thiết bị</th>
                            <th>Thời gian dự kiến mượn</th>
                            <th>Thời điểm trả</th>
                            <th>Giảng viên mượn</th>
                        </tr>
                    </thead>
                    <tbody class="no-border-x">
                        <?php $i = 1 ?>
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <td><label> <?= $i; ?> </label></td>
                                <td><label> <?= $i; ?> </label></td>
                                <td><label> <?= $i; ?> </label></td>
                                <td><label> <?= $i; ?> </label></td>
                                <td><label> <?= $i; ?> </label></td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>

                    </tbody>
                </table>
                <?php if (count($data) === 0) : ?>
                    <div class="alert alert-info p-2 text-center">Không có kết quả nào</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>