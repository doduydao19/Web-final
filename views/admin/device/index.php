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
                    <label class="col-3 col-lg-2 col-form-label text-right">Từ khóa</label>
                    <div class="col-9 col-lg-10">
                        <input value="<?= $q ?>" class="form-control form-control-sm" type="text" name="q">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3 col-lg-2 col-form-label text-right">Tình trạng</label>
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

                <div class="text-center">
                    <button class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <label style="font-size:14px;font-weight: 500; color: #009688">Số thiết bị tìm thấy: <?= count($data) ?></label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-table">
            <div class="card-header">
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
                            <th style="width:30%;">Tên Thiết bị</th>
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
                                <td><label> <?= $item->status === 0 ? 'Đang rảnh' : 'Đang mượn' ?> </label></td>
                                <td><label> <?= $item->description; ?> </label></td>
                                <td style="width:60px" class="actions">
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mod-danger-<?= $item->id ?>" type="button">Xóa</a>
                                </td>
                                <td style="width:60px" class="actions"><a class="btn btn-primary btn-sm" href="/admin/device/edit?id=<?= $item->id ?>">Sửa</a></td>
                                <td style="width:60px" class="actions">
                                    <?php if ($item->status === 0) : ?>
                                        <a class="btn btn-success btn-sm" href="/admin/transaction/create?device_id=<?= $item->id ?>">Mượn</a>
                                    <?php endif ?>
                                </td>
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

<?php foreach ($data as $item) : ?>
    <div class="modal fade" id="mod-danger-<?= $item->id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>Xóa</h3>
                        <p>Bạn chắc chắn thực hiện hành động này ?</p>
                        <div class="mt-8">
                            <button class="btn btn-space btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                            <a href="/admin/device/destroy?id=<?= $item->id ?>" class="btn btn-space btn-danger">Đồng ý</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- @script
<script>
    $(document).ready(function() {
        $('delete-button').click(function() {
            alert("Fuck u");
        });
    })
</script>
@endScript -->