(function($) {
    function get_post_id(element) {
        return element.attr("href");
    }

    $(document).on( 'click', 'ul.products a', function(event) {
        event.preventDefault();
        p_id = get_post_id($(this).clone());

        $('.details iframe').attr('src', p_id);
        $('#content').addClass('has_product');

        // $.ajax({
        //     url: ajaxpagination.ajaxurl,
        //     type: 'post',
        //     data: {
        //         action: 'ajax_woocommerce',
        //         query_vars: ajaxpagination.query_vars,
        //         page: p_id
        //     },
        //     success: function(html) {
        //         // $('#main').find('.details').remove();
        //         $('.details').html(html);
        //         // console.log(html);
        //     },
        //     error: function(MLHttpRequest, textStatus, errorThrown) {
		// 		alert(errorThrown);
		// 	}
        // })
    })
})(jQuery);
