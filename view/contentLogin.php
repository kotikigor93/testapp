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
            <div class="col-6">
                <h3><?= $data['view_title'] ?></h3>
                <form action="checklogin" id="login">
                    <div class="alert alert-danger p- hidden" id="login_error">Проверте логин и пароль!</div>
                    <label for="login">Логин</label>
                    <input type="text" name="username" id="username" placeholder="Ваш логин" class="form-control mb-2" required>
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="Ваш пароль" class="form-control mb-2" required>
                    <button class="btn btn-success w-100 mt-2" type="submit">
                        Вход
                    </button>
                    <br>
                    <div class="registration mt-2">
                        <a href="/registration" class="link-dark">Регистрация</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#login').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: 'singin',
            method: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
            },
            success: function (response){
                let result = $.parseJSON(response);
                if(result.result){
                    window.location.reload();
                } else {
                    $('#login_error').show();
                }
            }
        });
    });
</script>
<?php
require_once 'view/footer.php';
?>