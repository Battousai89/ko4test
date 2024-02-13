<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Catalog\Model\Price;
use Bitrix\Iblock\ElementTable;
use Bitrix\Catalog\ProductTable;

Loader::includeModule('catalog');
Loader::includeModule('iblock');

$element = ElementTable::getList([
    'select' => ['ID', 'NAME'],
    'filter' => ['CODE' => $_GET['product_code']]
])->fetch();


$product = ProductTable::getList([
    'select' => ['*'],
    'filter' => ['=ID' => $element['ID']],
])->fetch();


//Проверка на ошибки
if (!$element || !$product) {
    $errorMessage = "Не удается найти товар по указанному символьному коду";
} else if ($product['TYPE'] == PRODUCT_TYPE_SKU) {
    $errorMessage = "Символьный код, который вы указали относится к товару с торговыми предложениями.\n\n" .
        "Пожалуйста, укажите символьный код торгового предложения, который вы бы хотели добавить в корзину";
} else if ($product['QUANTITY'] <= 0) {
    $errorMessage = "К сожалению указанного товара нет в наличии";
}

if (isset($errorMessage)) {
    echo json_encode([
        'status' => 'error',
        'errorMessage' => $errorMessage
    ]);
} else {

    $price = Price::getList([
        'filter' => [
            'PRODUCT_ID' => $element['ID']
        ]
    ])->fetch();

    echo json_encode([
        'status' => 'success',
        'data'   => [
            'ID'    => $element['ID'],
            'NAME'  => $element['NAME'],
            'COUNT' => $product['QUANTITY'],
            'PRICE' => $price['PRICE'],
        ]
    ]);
}
