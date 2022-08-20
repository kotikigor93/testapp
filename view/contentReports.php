<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 18:19
 */

use components\enums\NotificationTypeEnum;

require_once 'view/header.php';

?>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
<link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
<link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
<div class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-2">
                <h3><?= $data['view_title'] ?></h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">Просмотры страницы А</th>
                        <th scope="col">Просмотр страницы Б</th>
                        <th scope="col">Нажато «Купить корову»</th>
                        <th scope="col">Нажмито "Скачать"</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($data['report_list'] as $key => $items) { ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td>
                            <?
                                $viewed = 0;
                                foreach ($items as $item) {
                                    if($item['type'] == NotificationTypeEnum::VIEW_PAGE_A) {
                                        $viewed = $item['count'];
                                    }
                                }
                            ?>
                                <?= $viewed ?>
                            </td>
                            <td>
                                <?
                                $viewed = 0;
                                foreach ($items as $item) {
                                    if($item['type'] == NotificationTypeEnum::VIEW_PAGE_B) {
                                        $viewed = $item['count'];
                                    }
                                }
                                ?>
                                <?= $viewed ?>
                            </td>
                            <td>
                                <?
                                $viewed = 0;
                                foreach ($items as $item) {
                                    if($item['type'] == NotificationTypeEnum::BTN_CLICK_A) {
                                        $viewed = $item['count'];
                                    }
                                }
                                ?>
                                <?= $viewed ?>
                            </td>
                            <td>
                                <?
                                $viewed = 0;
                                foreach ($items as $item) {
                                    if($item['type'] == NotificationTypeEnum::BTN_CLICK_B) {
                                        $viewed = $item['count'];
                                    }
                                }
                                ?>
                                <?= $viewed ?>
                            </td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
                <div class="col-12" id="container"></div>
            </div>
        </div>
    </div>
</div>
<style>
    #container{
        height: 500px;
    }
</style>
<script>

    let listCart = $.parseJSON('<?= json_encode($data['report_list']) ?>');
    let typePageA = '<?= NotificationTypeEnum::VIEW_PAGE_A ?>';
    let typePageB = '<?= NotificationTypeEnum::VIEW_PAGE_B ?>';
    let typeBtnA = '<?= NotificationTypeEnum::BTN_CLICK_A?>';
    let typeBtnB = '<?= NotificationTypeEnum::BTN_CLICK_B ?>';

    anychart.onDocumentReady(function () {


        let rows = [];

        $.each(listCart, function( index, items ) {
            let row = [];
            row.push(index);
            row.push(setCount(items, typePageA));
            row.push(setCount(items, typePageB));
            row.push(setCount(items, typeBtnA));
            row.push(setCount(items, typeBtnB));
            rows.push(row);
        });

        // create data set on our data
        var chartData = {
            title: 'График активности пользователей',
            header: ['#', 'Просмотры страницы А', 'Просмотр страницы Б', 'Нажато «Купить корову»', 'Нажмито "Скачать"'],
            rows: rows
        };

        // create column chart
        var chart = anychart.column();

        // turn scroller on
        chart.xScroller(true);
        // define zoom settings
        var xZoom = chart.xZoom();
        xZoom.setTo(0, 0.7);

        // set chart data
        chart.data(chartData);

        // turn on chart animation
        chart.animation(true);

        chart.yAxis().labels().format('{%Value}{groupsSeparator: }');

        // set titles for Y-axis
        chart.yAxis().title('Просмотров');

        // set titles for Y-axis
        chart.xAxis().title('Дата');

        chart
            .labels()
            .enabled(true)
            .position('center-top')
            .anchor('center-bottom')
            .format('{%Value}{groupsSeparator: }');
        chart.hovered().labels(false);

        // turn on legend and tune it
        chart.legend().enabled(true).fontSize(13).padding([0, 0, 20, 0]);

        // interactivity settings and tooltip position
        chart.interactivity().hoverMode('single');

        chart
            .tooltip()
            .positionMode('point')
            .position('center-top')
            .anchor('center-bottom')
            .offsetX(0)
            .offsetY(5)
            .titleFormat('{%X}')
            .format('{%SeriesName} : {%Value}{groupsSeparator: }');

        // set container id for the chart
        chart.container('container');

        // initiate chart drawing
        chart.draw();
    });

    function setCount(items, pageTpe){
        let result = '0';
        $.each(items, function(index, items) {
            if(items['type'] == pageTpe){
                result = items['count'];
                return false;
            }
        });
        return result;
    }
</script>
<?php
require_once 'view/footer.php';
?>