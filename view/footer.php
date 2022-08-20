<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 19:51
 */

?>
<script>
    $(document).ready(function (){
        $('.logout').click(function (){
            $.ajax({
                url: 'logout',
                method: 'POST',
                data: {
                    id: $(this).data('id')
                },
                success(response) {
                    let result = $.parseJSON(response);
                    if(result.result){
                        window.location.reload();
                    }
                }
            })
        });
    });
</script>
</body>
</html>
