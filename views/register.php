<?php

/** @var $model \thecodeholic\phpmvc\Model */

use app\core\Application;
use app\core\form\Form;

$form = new Form();
?>
<?php Application::$app->showErrorMsgs() ?>
<?php Application::$app->showMsg('success') ?>

<?php $form = Form::begin('', 'post') ?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname') ?>
    </div>
</div>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'login_id') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
<button class="btn btn-success">Submit</button>
<?php Form::end() ?>