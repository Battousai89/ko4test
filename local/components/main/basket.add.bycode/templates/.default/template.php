<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div id="add2BasketForm">
    <label for="codeInput">Введите код товара:</label>
    <input id="codeInput" onchange="getProductInfo(event)" placeholder="Введите код товара" type="text" name="code" value="">
    <div class="flex-column">
        <div>
            <div class="product-name">Наименование товара: </div>
            <div class="product-price">Стоимость товара: </div>
        </div>
        <div>
            <label for="product_count">Количество товара:</label>
            <input id="product_count" step="1" name="product_count" type="number" disabled min="1" max="1" value="1">
            <label>
                <input name="element_id" hidden value="1">
            </label>
        </div>
        <input onclick="addProduct2Basket()" type="submit" disabled value="Добавить">
    </div>
</div>
