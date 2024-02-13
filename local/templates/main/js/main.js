document.addEventListener('keypress', function(event) {
    if (event.code == 'Enter' && event.ctrlKey) {
        let selectedItem =  window.getSelection()
        sendErrorAjax(selectedItem.toString());
    }
});

function sendErrorAjax(selectedText) {
    if (!selectedText) {
        return;
    }

    if (!confirm('Вы уверены, что хотите отправить сообщение об ошибке в тексте "' + selectedText + '"?')) {
        return;
    }

    $.get( "/ajax/sendTextError.php" , { text: selectedText }, function(result) {
        switch (result) {
            case "success":
                alert( "Сообщение об ошибке успешно отправлено" );
                break;
            default:
                alert( "Не удалось отправить сообщение об ошибке. Попробуйте позже" );
        }
    })
}
