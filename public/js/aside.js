$(document).ready(function(){

    $('#header-menu').click(function(){
        $('.container-full').toggleClass('show-aside')
        $('header__user').removeClass('active')
        $('.header__user-menu').slideUp();
    })

    $('.header__user').click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active')
            $('.header__user-menu').slideUp();

        }else{
            $(this).addClass('active')
            $('.container-full').removeClass('show-aside')
            $('.aside__container ul').slideUp();
            $('.header__user-menu').slideDown('slow', function(){

            })
        }

    })

    $('.aside__item').click(function(e){

        if($(this).hasClass('active')){
            $(this).removeClass('active')
            $('.aside__container ul').slideUp();
        }else{
            $('.aside__container ul').slideUp();
            $(this).addClass('active')
            $('.header__user-menu').slideUp();
            $(this).children('ul').slideDown('slow', function(){ })
        }
    })
})
