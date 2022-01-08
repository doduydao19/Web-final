<?php

use app\core\Application;
?>
<?php Application::$app->showErrorMsgs() ?>
<h2>TEACHER</h2>
<form action="/admin/class-room" method="POST">
    <div>
        <input type="text" name="name">
    </div>
    <div>
        <input type="text" name="avatar">
    </div>
    <div>
        <input type="text" name="building">
    </div>
    <div>
        <textarea name="description"></textarea>
    </div>
    <div>
        <input type="submit" value="create">
    </div>
</form>

<form action="/admin/class-room/update?id=6" method="POST">
    <div>
        <input type="text" name="name">
    </div>
    <div>
        <input type="text" name="avatar">
    </div>
    <div>
        <input type="text" name="building">
    </div>
    <div>
        <textarea name="description"></textarea>
    </div>
    <div>
        <input type="submit" value="edit">
    </div>
</form>