(function($) {

    var $document = $(document);

    $document.off('click', 'div.order_comment_item');
    $document.on('click', 'div.order_comment_item', function(){

        var template_engine = $.templateEngine.init('order_page'),
            $this = $(this);

        $('#order_status_editer').remove();

        var html = template_engine.applyTemplate('comment_container',{comment_body: $this.html()});
        $this.after(html);

        $('#order_status_editer').attr('order_id', $this.attr('order_id'));

        initCommentsLabels();
        selectLabel($this.attr('label_id'));
    });

    $document.off('click', '#order_status_editer .cancel');
    $document.on('click', '#order_status_editer .cancel', function() {
        $('#order_status_editer').remove();
    });

    $document.off('click', '#order_status_editer .save');
    $document.on('click', '#order_status_editer .save', function() {
        var $order_status_editer =  $(this).parent('#order_status_editer');
        var data = {
            action: 'save_order_comment',
            order_id: $order_status_editer.attr('order_id'),
            label_id: $('.labels_block .comment_label_element.active').attr('label_id'),
            label_color: $('.labels_block .comment_label_element.active').attr('color'),
            text:  $('#order_status_editer .comment_body').val()
        };

        $.ajax({
			type: "POST",
            url: "",
            data: (data),
			success: function(responce){
				if(responce != 1) 
				{
					alert(responce);
					$('#order_status_editer').remove();
				} 
				else 
				{
					var $edited_element = $('.order_comment_item[order_id="' +data.order_id + '"]');
					console.log(data.label_color);
					$edited_element.css('background-color', data.label_color);
					$edited_element.html(data.text);
					$('#order_status_editer').remove();            
				}
			}

        });
    });

    $document.off('click', '.comment_label_element');
    $document.on('click', '.comment_label_element', function() {
        var $this = $(this);
        selectLabel($this.attr('label_id'));
    });

})(jQuery);

function selectLabel(label_id) {
    $('.comment_label_element.active').removeClass('active');
    $('.comment_label_element[label_id="' + label_id + '"]').addClass('active');
}