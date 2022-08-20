<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 18:19
 */

require_once 'view/header.php';

?>
<div class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-6 mt-2">
                <h3><?= $data['view_title'] ?></h3>
                <div><b>Логин:</b> <?= $data['user']['username'] ?></div>
                <div><b>Имя:</b> <?= $data['user']['firstname'] ?></div>
                <div><b>Фамилия:</b> <?= $data['user']['lastname'] ?></div>
                <div><b>Емейл:</b> <?= $data['user']['email'] ?></div>
                <div><b>Роль:</b> <?= $data['role_list'][$data['user']['role']] ?></div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'view/footer.php';
?>