<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 18:19
 */

use components\enums\NotificationTypeEnum;

require_once 'view/header.php';

?>
<div class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-2">
                <h3><?= $data['view_title'] ?></h3>
                <?= $data['btn'] ?>
                <div class="comment"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
       $('#click_btn').click(function (e){
           if($(this).data('type') == <?= NotificationTypeEnum::BTN_CLICK_A ?>){
               $(this).hide();
               $('.comment').html('Спасибо!');
           }
           $.ajax({
               url: '/click_btn',
               method: 'POST',
               data: {
                   type: $(this).data('type')
               },
               success(response){

               }
           });
       });
    });
</script>
<?php
require_once 'view/footer.php';
?>