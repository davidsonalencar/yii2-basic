/**
 * Faz com que apenas um grupo do menu fique aberto
 * 
 * @param jQuery $
 * @returns {undefined}
 */
(function($) {
    $('ul.collapse')
            .on('show.bs.collapse', function(e) {
                e.stopPropagation();

                if ($(this).closest('#menu').length) {
                    var t = $(this).parents('li').length;
                    if (t != 1)
                        return;

                    var a = $('#menu > div > div > ul > li.active > ul').not(this);

                    a.removeClass('in')
                     .addClass('collapse')
                     .removeAttr('style')
                     .closest('.active')
                     .removeClass('active');
                }
            })
            .on('shown.bs.collapse', function(e) {
                e.stopPropagation();

                if ($(this).closest('#menu').length) {
                    $('#menu *').getNiceScroll().resize();
                }
            });
})(jQuery);