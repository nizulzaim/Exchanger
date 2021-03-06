$.fn.mxRipple = function(args) {
    var Defaults = {
        rippleColor : "#FFFFFF",
    }
    
    args = $.extend(true, {}, Defaults, args);
    var $element = $(this);
    
    
    var square = $element.outerWidth();
    var height = $element.outerHeight();
    
    if (square < height) {
        square = height;
    }
    
    $element.on("mousedown", function(e){
        var offset = $element.offset(),
            offsetY = (e.pageY - offset.top),
            offsetX = (e.pageX - offset.left);
        var $rippleCircle = $('<span class="ripple-circle"></span>')
        $element.css('overflow', "hidden");
        $element.addClass('clicked').append(
            
            $rippleCircle.css({
                'top' : offsetY,
                'left' : offsetX, 
                "width" : square,
                "height" : square,
                "margin-top" : -(square/2),
                "margin-left" : -(square/2),
            })
        );
        if (args.rippleColor) {
            $rippleCircle.css({
                'background' : args.rippleColor
            })
        }
    }).on('mouseup mouseout', function(e){
        $element.removeClass('clicked')
        .children(".ripple-circle").fadeOut("slow", function(){
            $(this).remove();
        });
    });
}

$(".ripple").each(function() {
    var $rippleColor = $(this).data("ripple-color");
    
    if ($rippleColor == undefined) {
        $(this).mxRipple();
    } else {
        $(this).mxRipple({
            rippleColor :$rippleColor
        })
    }
})
	