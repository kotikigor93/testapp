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
            <div class="col-12 mt-2">
                <h3>Статистика</h3>
                <form action="" id="fiter" class="filter_form">
                    <div class="col-3">
                        <label for="filter_user" class="mb-2">Пользователь: </label>
                        <select name="filter_user" class="form-control col-3">
                            <option value="0">Выберите пользователя</option>
                            <? foreach ($data['users_list'] as $id => $value) { ?>
                                <option value="<?= $value['id'] ?>" <?= $_GET['filter_user'] == $value['id'] ? selected : ''?>><?= $value['username'] ?></option>
                            <? } ?>
                        </select>
                    </div>
                    <div class="col-3 alert m-2">
                        <label for="filter_type" class="mb-2">Действие: </label>
                        <select name="filter_type" class="form-control col-3">
                            <option value="0">Выберите действие</option>
                            <? foreach ($data['notification_type_list'] as $id => $value) { ?>
                                <option value="<?= $id ?>" <?= $_GET['filter_type'] == $id ? selected : ''?> ><?= $value ?></option>
                            <? } ?>
                        </select>
                    </div>
                    <div class="col-3 m-2">
                        <label for="filter_date" class="mb-2">Дата: </label>
                        <input type="date" name="filter_date" class="form-control" value="<?= $_GET['filter_date'] ? $_GET['filter_date'] : ''?>">
                    </div>
                </form>
                <div class="col-3">
                    <button class="btn btn-success mb-2" id="filtered">Фильтровать</button>
                    <a href="<?= $data['link'] ?>/1 " class="btn btn-danger mb-2">Очистить</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($data['statistic_list'] as $ket => $value) { ?>
                        <tr>
                            <td><?= $value['date_created'] ?></td>
                            <td><?= $data['users_list'][$value['user_id']]['username']?></td>
                            <td><?= $data['notification_type_list'][$value['type']] ?></td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
                <nav aria-label="...">
                    <ul class="pagination">
                        <?
                            $currentPage = (int)$data['current_page'];
                            $prevPage = (int)$data['current_page']-1;
                            $nextPage = (int)$data['current_page']+1;
                        ?>
                        <li class="page-item <?= $prevPage == 0 ? hidden : '' ?>">
                            <a class="page-link" href= "<?= $data['link'].'/'.$prevPage ?>" tabindex="-1"><?= $prevPage ?></a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="<?= $data['link'].'/'.$currentPage ?>"><?= $currentPage ?></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="<?= $data['link'].'/'.$nextPage ?>"><?= $nextPage ?></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('#filtered').click(function (){
            $('#fiter').submit();
        });
    });
</script>
<?php
require_once 'view/footer.php';
?>