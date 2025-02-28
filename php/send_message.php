<?php
if (isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message']);
    $timestamp = date('Y-m-d H:i:s');
    $dateTime = new DateTime($timestamp);
    $dateTime->sub(new DateInterval('PT5H'));
    $fecha = $dateTime->format('d/m/Y');
    $hora = $dateTime->format('h:i A');
    $formatted_message = $fecha . ' - ' . $hora . ' - ' . $message;
    file_put_contents('../resources/chat.txt', $formatted_message . "\n", FILE_APPEND);
}
?>