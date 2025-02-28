<?php
if (file_exists('../resources/chat.txt')) {
    echo nl2br(file_get_contents('../resources/chat.txt'));
}
?>