<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$email = COption::GetOptionString("main", "email_from");
$json = mail($email, 'Сообщение об ошибке', $_GET['text']) ? 'success' : 'error';
return $json;