$(function(){
    
    function moveDiv(pageX, pageY, duration, delay){
    
        var windowWidth  = $('body').width();
        var windowHeight = $('body').height();

        $('div.reflection').each(function(){

            var div = $(this);

            // Define a posição do topo e da esquerda das div em um fator de distancia do ponteiro mouse
            var left   = (windowWidth  - div.width() )*0.5;
            var top    = (windowHeight - div.height())*0.5;
            var factor = parseFloat(div.data('factor'));

            left = factor * (0.2 * windowWidth  - pageX) + left;
            top  = factor * (0.6 * windowHeight - pageY) + top;
            
            // Define a opacidade baseado na posição das divs. Quanto mais ao centro, mas transparente é.
            var halfWidth = windowWidth * 0.5;
            var refLeft = Math.abs( left + div.width() * 0.5 - halfWidth );
            var opacity = (1 * refLeft / halfWidth) * 5;

            // Aplica css
            div.css({
                left: left,
                top : top,
                opacity: opacity,
                'transition-duration': (duration||'0s'),
                '-webkit-transition-duration': (duration||'0s'),
                'transition-delay': (delay||'0s'),
                '-webkit-transition-delay': (delay||'0s'),
                'transition-timing-function': 'ease-in-out',
                '-webkit-transition-timing-function': 'ease-in-out'
            });
                        
        });

    }
    
    function onMouseMove(e) {
        
        moveDiv(e.pageX, e.pageY, '2s', '0.1s');
    }

    function initParallax() {

        $('body')
                .on('mousemove', onMouseMove)
                .append($('<div/>', {
                    class: 'reflection reflection1',
                    'data-factor': '0.4'
                }))
                .append($('<div/>', {
                    class: 'reflection reflection2',
                    'data-factor': '0.6'
                }))
                .append($('<div/>', {
                    class: 'reflection reflection3',
                    'data-factor': '1.0'
                }))
                .append($('<div/>', {
                    class: 'reflection reflection4',
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