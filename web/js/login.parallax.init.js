$(function(){
    
    function moveDiv(pageX, pageY, duration){
    
        var windowWidth  = $('body').width();
        var windowHeight = $('body').height();

        $('div.parallax').each(function(){

            var div = $(this);

            var left   = (windowWidth  - div.width() )*0.5;
            var top    = (windowHeight - div.height())*0.5;
            var factor = parseFloat(div.data('factor'));

            left = factor * (0.2 * windowWidth  - pageX) + left;
            top  = factor * (0.6 * windowHeight - pageY) + top;
            
            div.css({
                left: left,
                top : top,
                'transition-duration': (duration||'0s'),
                '-webkit-transition-duration': (duration||'0s')
            });

        });

    }
    
    function onMouseMove(e) {
        
        moveDiv(e.pageX, e.pageY);
    }

    function initParallax() {

        $('body')
                .on('mousemove', onMouseMove)
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
        
        moveDiv( windowWidth*0.2, windowHeight*0.6 );
        
        setTimeout(function(){
            moveDiv( windowWidth*0.5, windowHeight*0.4, '2s' );
            $('div.parallax').css('opacity', 1);
        }, 200);
        
    }
    
    initParallax();
    
});