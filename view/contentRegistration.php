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
                <form action="registrationuser" id="registration">
                    <label for="username">Логин</label>
                    <input type="text" name="username" id="username" placeholder="Введите логин" class="form-control mb-2" required>
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="Введите пароль" class="form-control mb-2" required>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Введите email" class="form-control mb-2" required>
                    <label for="firstname">Ваше имя</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Введите имя" class="form-control mb-2" required>
                    <label for="lastname">Ваша фамилия</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Введите фамилия" class="form-control mb-2" required>
                    <button class="btn btn-success w-100 mt-2" type="submit">
                        Регистрироваться
                    </button>
                    <div class="registration mt-2">
                        <a href="/login" class="link-dark">Войти</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#registration').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: 'registrationuser',
            method: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                email: $('#email').val(),
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
            },
            success: function (response){
                let result = $.parseJSON(response);
                if(result.result){
                    swal('', result.text, 'success').then(function (){
                        window.location = '/index';
                    });
                } else {
                    swal('', result.text, 'warning');
                }
            }
        });
    });
</script>
<?php
require_once 'view/footer.php';
?>