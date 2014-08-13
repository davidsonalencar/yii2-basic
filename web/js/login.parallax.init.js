$(function(){
    
    function moveDiv(e){
    
        var windowWidth  = $('body').width();
        var windowHeight = $('body').height();

        $('div.parallax').each(function(){

            var div = $(this);

            var left   = (windowWidth  - div.width() )*0.5;
            var top    = (windowHeight - div.height())*0.5;
            var factor = parseFloat(div.data('factor'));

            left = factor * (0.2 * windowWidth  - e.pageX) + left;
            top  = factor * (0.6 * windowHeight - e.pageY) + top;
            
            div.css({
                left: left,
                top : top
            });

        });

    }

    function initParallax() {

        $('body')
                .on('mousemove', moveDiv)
                .append($('<div/>', {
                    class: 'parallax',
                    id: 'reflex1',
                    'data-factor': '0.4'
                }))
                .append($('<div/>', {
                    class: 'parallax',
                    id: 'reflex2',
                    'data-factor': '0.6'
                }))
                .append($('<div/>', {
                    class: 'parallax',
                    id: 'reflex3',
                    'data-factor': '1.0'
                }))
                .append($('<div/>', {
                    class: 'parallax',
                    id: 'reflex4',
                    'data-factor': '1.2'
                }));

        var windowWidth  = $('body').width();
        var windowHeight = $('body').height();
        
        moveDiv({
            pageX: windowWidth*0.2,
            pageY: windowHeight*0.6
        });
        
        setTimeout(function(){
            moveDiv({
                pageX: windowWidth*0.5,
                pageY: windowHeight*0.4
            });
            $('div.parallax').css('opacity', 1);
        }, 200);
        
    }
    
    initParallax();
    
});