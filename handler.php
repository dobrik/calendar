<?php
/**
 * Created by PhpStorm.
 * User: Dobrik
 * Date: 01.07.2016
 * Time: 0:43
 */
$filename = 'events.txt';
$postData[] = ['event' => $_POST['event'], 'date' => $_POST['date'], 'place' => $_POST['place'], 'desc' => $_POST['desc']];

if ($_POST['event'] && $_POST['date'] && $_POST['place'] && $_POST['desc']) {// если пришли данные
    echo 'Событие: ' . $_POST['event'] . ' было создано на дату: ' . $_POST['date'] . '. Место проведения: ' . $_POST['place'] . '. Описание события: ' . $_POST['desc'];
    if (!file_exists($filename)) {
        file_put_contents($filename, serialize($postData));
    } else {
        $fileData = unserialize(file_get_contents($filename));
        $fileData = array_merge($fileData,$postData);
        file_put_contents($filename, serialize($fileData));
    }
}
if (isset($_POST['getEvent']) && file_exists($filename)) {
    $getData = json_encode(unserialize(file_get_contents($filename)));
    echo $getData;
}