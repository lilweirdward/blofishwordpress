;(function($) {
    'use strict';
    var $main = $('#main'),
        options = {
            prefetch: true,
            pageCacheSize: 4,
            onStart: {
                duration: 250,
                render: function (url, $container) {
                    $main.addClass('is-exiting');
                    smoothState.restartCSSAnimations();
                }
            },
            onReady: {
                duration: 0,
                render: function ($container, $content) {
                    $main.removeClass('is-exiting');
                    $main.html($content);
                }
            },
            onAfter: function ($container, $newContent) {
                $.readyFn.execute();
            }
        },
        smoothState = $main.smoothState(options).data('smoothState');
    window.smoothstate = smoothState;
})(jQuery);
