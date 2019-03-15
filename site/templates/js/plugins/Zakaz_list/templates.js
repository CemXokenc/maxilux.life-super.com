(function($) {
    var $document = $(document);

    $document.ready(
        function(){
            $.templateEngine.addTemplate(
                'order_page',
                {
                    comment_container:
                        '<div id="order_status_editer">' +
                            '<div class="labels_block"></div>' +
                            '<textarea class="comment_body">' +
                                '{!comment_body!}' +
                            '</textarea>' +
                            '<div class="button save">Сохранить</div>' +
                            '<div class="button cancel">Отмена</div>' +
                        '</div>'
                }
            );
        }
    )

})(jQuery);