<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

use Bitrix\Catalog\Product\Basket;

Loader::includeModule('catalog');

$fields = [
    'PRODUCT_ID' => $_GET['product_id'],
    'QUANTITY' => $_GET['count_value'],
];

$result = Basket::addProduct($fields);

if ($result->isSuccess()) {
    echo json_encode([
        'status' => 'success',
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'errorMessage' => $result->getErrorMessages()
    ]);
}