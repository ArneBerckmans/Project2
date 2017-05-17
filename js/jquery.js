/**
 * Created by Arne on 17/05/2017.
 */
var imageSlider = $('#slider').CircularSlider({
    min : 0,
    max: 359,
    radius: 100,
    innerCircleRatio : .7,
    formLabel : function(value, prefix, suffix) {
        //return '<img src="assets/images/baby'+ parseInt(value / 26)+'.png"></img>';
    },
    slide : function(ui, value) {
        var colors = ['deeppink', 'seagreen', 'deepskyblue', 'coral', 'cadetblue', 'olive', 'chocolate',
            'yellowgreen', 'cornflowerblue', 'slategrey', 'salmon', 'brown', 'darkgoldenrod', 'dimgrey'];
        var color = colors[parseInt(value / 26)];
        ui.find('.jcs').css({'border-color' : color });
        ui.find('.jcs-indicator').css({'background' : color });
    }
});