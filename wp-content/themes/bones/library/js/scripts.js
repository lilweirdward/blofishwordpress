jQuery(document).ready(function($) {
    $('.categories div').click(function() {
        $(this).parent().addClass('side');
        $('.categories div').removeClass('active');
        $(this).addClass('active');
    });

    $('#logo').click(function() {
        var $card = $('#card');

        if ($card.hasClass('')) {
            $('#card').addClass('flipped');
            console.log('popping the cherry');
        } else {
            if ($card.hasClass('flipped')) {
                $card.addClass('unflipped');
                $card.removeClass('flipped');
                console.log('unflipping back to normal');
            } else {
                $card.addClass('flipped');
                $card.removeClass('unflipped');
                console.log('flipping to header');
            }
        }
    });

    $('#bringtotop').click(function() {
        $(this).parent().addClass('totop');
    });

}); /* end of as page load scripts */
