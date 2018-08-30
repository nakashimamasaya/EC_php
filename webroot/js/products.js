$(document).ready(function(){
    $('.show_button').click(function(){
        $('body').css('background-color','gray');
        $('table').css('background-color','gray');
        var classVal = $(this).attr('class');
        var classVals = classVal.split(' ');
        $('.' + classVals[1]).removeClass('disable');
        $('.button').prop("disabled", true);
    });

    $('.close').click(function(){
        $('body').css('background-color','white');
        $('table').css('background-color','white');
        $('.show').addClass('disable');
        $('.button').prop("disabled", false);
    });

    $('.list').click(function(){
        window.location.href = '/products';
    });

    $('.thumbnail').click(function(){
        window.location.href = '/products/index2';
    });
});
