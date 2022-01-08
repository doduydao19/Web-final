<?php

use app\core\Application;
?>

<?php Application::$app->showErrorMsgs() ?>
<?php Application::$app->showMsg('success') ?>

<div class="row">
    <div class="col-4 mx-auto">
        <div class="card-body">
            <form method="get" action="/admin/device">
                <div class="form-group row">
                    <label class="col-3 col-lg-2 col-form-label text-right">Tòa nhà</label>
                    <div class="col-9 col-lg-10">
                        <select class="form-control form-control-sm" name="status">
                            <option value="">Chọn trạng thái</option>
                            <?php if ($status === 0) : ?>
                                <option value="0" selected="selected">Đang rảnh</option>
                            <?php else : ?>
                                <option value="0">Đang rảnh</option>
                            <?php endif; ?>
                            <?php if ($status === 1) : ?>
                            <?php else : ?>
                                <option value="1">Đang mượn</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-lg-2 col-form-label text-right">Từ khóa</label>
                    <div class="col-9 col-lg-10">
                        <input value="<?= $q ?>" class="form-control form-control-sm" type="text" name="q">
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
                        <a class="dropdown-item" href="/admin/device/create">Thêm</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:30%;">Tên phòng học</th>
                            <th>Trạng thái</th>
                            <th style="width:30%;">Mô tả chi tiết</th>
                            <th colspan="2" class="actions">Action</th>
                        </tr>
                    </thead>
                    <tbody class="no-border-x">
                        <?php $i = 1 ?>
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <td><label> <?= $i; ?> </label></td>
                                <td><label> <?= $item->name; ?> </label></td>
                                <td><label> <?= "ok"; ?> </label></td>
                                <td><label> <?= $item->description; ?> </label></td>
                                <td style="width:60px" class="actions">
                                    <a class="btn btn-danger btn-sm" href="/admin/device/destroy?id=<?= $item->id ?>">Xóa</a>
                                </td>
                                <td style="width:60px" class="actions"><a class="btn btn-primary btn-sm" href="/admin/device/edit?id=<?= $item->id ?>">Sửa</a></td>
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