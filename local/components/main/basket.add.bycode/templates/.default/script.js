function getProductInfo(e)
{
    let code = $(e.target).val();
    $.get(
        '/ajax/getProductInfoByCode.php',
        {
            product_code: code
        },
        function (result) {
            let resultObj = $.parseJSON(result);
            let productName = $('.product-name');
            let productPrice = $('.product-price');
            let submitBtn = $('input[type=submit]');
            let productCountInput = $('#product_count');
            let elementIdInput = $('input[name=element_id]');
            let inputs = [productName, productPrice, submitBtn, productCountInput, elementIdInput];

            switch (resultObj.status) {
                case "success":
                    showProductInfo(resultObj.data, ...inputs);
                    break;
                default:
                    clearProductInfo(resultObj.errorMessage, ...inputs);
                    break;
            }
    })
}

function showProductInfo(data, productName, productPrice, submitBtn, productCountInput, elementIdInput)
{
    productName.text('Наименование товара: ' + data.NAME);
    productPrice.text('Стоимость товара: ' + data.PRICE);
    submitBtn.removeAttr('disabled');
    productCountInput.attr('max', data.COUNT)
    elementIdInput.val(data.ID)
    productCountInput.removeAttr( 'disabled');
}

function clearProductInfo(error, productName, productPrice, submitBtn, productCountInput, elementIdInput)
{
    productName.text('Наименование товара: ');
    productPrice.text('Стоимость товара: ');
    submitBtn.attr('disabled', 'disabled');
    productCountInput.attr('max', '1')
    elementIdInput.val('1')
    productCountInput.attr( 'disabled', 'disabled');
    alert(error);
}

function addProduct2Basket() {
    let elementIdInput = $('input[name=element_id]');
    let productCountInput = $('#product_count');
    $.get(
        '/ajax/addProduct2Basket.php',
        {
            product_id: elementIdInput.val(),
            max_count: productCountInput.attr('max'),
            count_value: productCountInput.val()
        },
        function (result) {
            let resultObj = $.parseJSON(result);
            switch (resultObj.status) {
                case "success":
                    alert('Товар успешно добавлен в корзину')
                    break;
                default:
                    alert(resultObj.errorMessage);
                    break;
            }
    })
}