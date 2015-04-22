/*
 * SideNav - v1.0.0
 * Easy menu jQuery plugin for Twitter Bootstrap 3
 * https://github.com/davidsonalencar/yii2-sidenav
 *
 * Made by Davidson Alencar
 * Under MIT License
 */
;(function($, window, document, undefined) {

    var pluginName = "navbar",
        defaults = {
            toggle: true
        };

    function Plugin(element, options) {
        this.element = $(element);
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function() {

            var $this = this.element,
                obj = this;

            var toggleButton   = $this.find(".navbar-toggle");
            if (!toggleButton.length) {
                return;
            }
            
            var classToggled   = toggleButton.data('class-toggled');
            var classCollapsed = toggleButton.data('class-collapsed');
            
            $(document.body).on("click" + "." + pluginName, function(e) {
                e.preventDefault();
                
                if (e.target === toggleButton[0]) {
                    var classToggle = ($(window).width() < 768) ? classToggled : classCollapsed;
                    $(document.body).toggleClass( classToggle );
                } else {
                    $(document.body).removeClass( classToggled );
                }
                
            });
        },

        remove: function() {
            this.element.off("." + pluginName);
            this.element.removeData(pluginName);
        }
    };

    $.fn[pluginName] = function(options) {
        this.each(function () {
            var el = $(this);
            if (el.data(pluginName)) {
                el.data(pluginName).remove();
            }
            el.data(pluginName, new Plugin(this, options));
        });
        return this;
    };

})(jQuery, window, document);