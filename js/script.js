function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$( document ).ready(function() {
    $(".myDIV").hide();

});
function myFunction(x) {
    x.classList.toggle("change");
    $(".myDIV").slideToggle("slow");
};

$(document).on("click",".clickable2",function(){
    if (!$(this).hasClass("active")) {
        $("button.clickable2").removeClass("active");
        $(this).addClass("active");
    }
});

/*$(document).on("click",".clickable",function(){
    if (!$(this).hasClass("active")) {
        $("li.current").removeClass("active");
        $(this).addClass("active");
    }
    //else{
        $(this).addClass("active");
    //}
});



$(function() {                       //run when the DOM is ready
    $(".clickable").click(function() {//use a class, since your ID gets mangled

            $(this).addClass("active");



        //add the class to the clicked element
    });
});

$(document).on("click",".clickable",function(){
    if (!$(this).hasClass("active")) {

        $("a.clickable").removeClass("active");
        $(this).addClass("active");
    }
});*/

$(function() {
    var href = window.location.href;
    $('footer a').each(function(e,i) {
        if (href.indexOf($(this).attr('href')) >= 0) {
            $(this).addClass('active');
        }
    });
});

