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
                Class rooom
                <span class="card-subtitle">
                    These are the different form control component sizes
                </span>
            </div>
            <div class="card-body">

                <img id="image" style="max-width: 60px;" src="<?= $data->avatar ?>" />
                <form id="uploadForm" action="/upload" method="post">
                    <label>Avatar:</label><br />
                    <input name="file" type="file" class="inputFile" id="files" />
                    <input type="submit" value="Upload" class="btnSubmit" />
                </form>

                <form action="/admin/class-room/edit?id=<?= $data->id ?>" method="POST">
                    <input value=<?= $data->avatar ?> class="form-control form-control-sm" type="hidden" name="avatar">
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Name</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input value="<?= $data->name ?>" class="form-control form-control-sm" type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Building</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input value="<?= $data->building ?>" class="form-control form-control-sm" type="text" name="building">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-form-label mb-2">Description</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <textarea class="form-control form-control-sm" type="text" name="description">
                                <?= $data->description ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group row"></div>
                    <button class="btn btn-primary" type="submit" value="Update">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>