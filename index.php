<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-2.2.4.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">Добавить событие</h4></div>
            <div class="modal-body">
                <input type="text" id="event" placeholder="Событие">
                <textarea id="desc" placeholder="Описание"></textarea>
                <input type="text" id="place" placeholder="Место">
                <input type="hidden" id="date">
                <input type="submit" id="sendEvent" value="Добавить" data-dismiss="modal" data-target="#modal-result" data-toggle="modal">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-result" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="event_result">
            .......
        </div>
    </div>
</div>


<?php
/**
 * Created by PhpStorm.
 * User: Dobrik
 * Date: 26.06.2016
 * Time: 9:39
 */
function calCreate($monthFrom = 0, $monthTo = 11)
{
    $months = [1451606400];//1 января 2016 00:00
    for ($m = 0; $m < 11; $m++) {
        $months[] = (date('t', $months[$m]) * 86400) + $months[$m];
    }
    echo '<div class="container"><div class="row">';
    for ($j = $monthFrom; $j <= $monthTo; $j++) {
        $curMonthName = date('F', $months[$j]);//Название месяца
        $curMonthDays = date('t', $months[$j]);//колво дней в месяце
        $numWeekFirstDay = date('N', $months[$j]);//Номер для в неделе
        echo "<div id=\"month\" class=\"col-md-3\">
        <table>
            <caption><strong>{$curMonthName}</strong></caption>
            <tr>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th>Сб</th>
                <th style=\"color: red;\">Вс</th>
            </tr>
            <tr>";
        for ($x = 1; $x < $numWeekFirstDay; $x++) {
            echo '<td></td>'; // вставляем пустые ячейки если первый день месяца не понедельник
        }
        for ($i = 1; $i <= $curMonthDays; $i++) {
            $curDayNumber = date('N', $months[$j] + (($i - 1) * 86400));
            if (($i + $x - 2) % 7 == 0) {
                echo '<tr>';//открываем строку если началась новая неделя
            }
            if ($curDayNumber == 7) {
                echo "<td data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" class=\"date_slot\" style=\"color: red;\" data-date=\"" . date('d.m.Y', $months[$j] + (($i - 1) * 86400)) . "\">";
            } else {
                echo "<td data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" class=\"date_slot\" data-date=\"" . date('d.m.Y', $months[$j] + (($i - 1) * 86400)) . "\">";
            }
            echo $i . "</td>";//отображаем число
        }
        $lastMonthDayUnix = date('N', (($i - 2) * 86400) + $months[$j]);
        for ($y = 0; $y < 7 - $lastMonthDayUnix; $y++) {
            echo '<td></td>'; // вставляем пустые ячейки после
        }
        echo '</table>
    </div>';
    }
    echo '</div></div>';
}

calCreate();
?>
<script src="js/main.js"></script>
</body>
</html>
