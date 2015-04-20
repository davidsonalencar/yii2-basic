/*
 * SideNav - v1.0.0
 * Easy menu jQuery plugin for Twitter Bootstrap 3
 * https://github.com/davidsonalencar/yii2-sidenav
 *
 * Made by Davidson Alencar
 * Under MIT License
 */
;(function($, window, document, undefined) {

    var pluginName = "sidenav",
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
                $toggle = this.settings.toggle,
                obj = this;

            // Initialize collapses
            if (this.isIE() <= 9) {
//                $this.find("li.active").has("ul").children("ul").collapse("show");
//                $this.find("li").not(".active").has("ul").children("ul").collapse("hide");
                $this.find("li.active").has("ul").children("ul").collapse("show");
                $this.find("li").not(".active").has("ul").children("ul").collapse("hide");
            } else {
                $this.find("li.active").has("ul").children("ul").addClass("collapse in");
                $this.find("li").not(".active").has("ul").children("ul").addClass("collapse");
            }
            
            //
            $this.find('.collapse')
                .on('hidden.bs.collapse', function (e) {
                    var icon = $(this).prev('a').children('i');
                    var classHidden = icon.data('class-hidden');
                    var classShown  = icon.data('class-shown');
                    icon.removeClass(classShown);
                    icon.addClass(classHidden);
                    e.stopPropagation();
                })
                .on('shown.bs.collapse', function (e) {
                    var icon = $(this).prev('a').children('i');
                    var classHidden = icon.data('class-hidden');
                    var classShown  = icon.data('class-shown');
                    icon.removeClass(classHidden);
                    icon.addClass(classShown);
                    e.stopPropagation();
                });
            

            $this.find("li").has("ul").children("a").on("click" + "." + pluginName, function(e) {
                e.preventDefault();
                
                //$(this).children('i.indicator').

                $(this).parent("li").toggleClass("active").children("ul").collapse("toggle");

                if ($toggle) {
                    $(this).parent("li").siblings().removeClass("active").children("ul.in").collapse("hide");
                }
            });
        },

        isIE: function() { //https://gist.github.com/padolsey/527683
            var undef,
                v = 3,
                div = document.createElement("div"),
                all = div.getElementsByTagName("i");

            while (
                div.innerHTML = "<!--[if gt IE " + (++v) + "]><i></i><![endif]-->",
                all[0]
            ) {
                return v > 4 ? v : undef;
            }
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