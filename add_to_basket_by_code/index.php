<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление товара в корзину по коду");
?>
<?$APPLICATION->IncludeComponent(
    "main:basket.add.bycode",
    "",
    [
        'IBLOCK_ID' => CLOTHES_IBLOCK_ID
    ]
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>