"use strict";
var rtl = $('html[dir=rtl]');
$(window).on("load", function() {
	$(".loader").fadeOut("slow");
});

$( document ).ready(function() {

    $('.custom--dropdown').on('click', function(){
        $(this).closest('.custom--dropdown').find('.drop-l-content').toggleClass('active')
    })

    new WOW().init();
	$('#send-from').selectmenu();
	if(rtl.length == true) {
		$('#send-from').selectmenu({
			isRTL:true
		});
		$('#lang').selectmenu({
			isRTL: true
		});
	}else {
		$('#send-from').selectmenu();
		$('#lang').selectmenu();
	}

	$(document).on('mouseenter', '#sin-m', function() {
		$("#sin-m").addClass('hover');
		$("#sup-m").removeClass('hover');
	});
	$(document).on('mouseenter', '#sup-m', function() {
		$("#sin-m").removeClass('hover');
		$("#sup-m").addClass('hover');
	});
	$(document).on('mouseenter', '#sin-s', function() {
		$("#sin-s").addClass('hover');
		$("#sup-s").removeClass('hover');
	});
	$(document).on('mouseenter', '#sup-s', function() {
		$("#sin-s").removeClass('hover');
		$("#sup-s").addClass('hover');
	});
	$(document).on('click', 'button.navbar-toggler', function() {
  		$('.side-nav').toggleClass('show')
  	});
  	$(document).on('click', '.side-nav button.cross', function() {
  		$('.side-nav').removeClass('show')
  	});
  	$( "#send-input" ).spinner();
  	$('#transfer-type').selectpicker();
  	$(document).on('click keyup change', '.select2-search.select2-search--dropdown input', function() {
  		$(this).parent('.select2-search.select2-search--dropdown').addClass('focus');
  	});



	if( rtl.length == true){
		$('.blog-slider').slick({
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 1,
			rtl: true,
			prevArrow:"<button type='button' class='slick-prev pull-left'><i class=\"icofont-rounded-left\"  aria-hidden='true'></i> PREV</button>",
	    	nextArrow:"<button type='button' class='slick-next pull-right'>NEXT<i class=\"icofont-rounded-right\"  aria-hidden='true'></i></button>",
			responsive: [{
				breakpoint: 991,
				settings: {
					slidesToShow: 1
				}
			}]
		});
		$('.payment-methods').slick({
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			rtl: true,
			prevArrow:"<button type='button' class='slick-prev pay-left'><i class=\"icofont-rounded-left\"  aria-hidden='true'></i></button>",
	    	nextArrow:"<button type='button' class='slick-next pay-right'><i class=\"icofont-rounded-right\"  aria-hidden='true'></i></button>",
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: 5
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow:4
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow:3
					}
				},
				{
					breakpoint: 450,
					settings: {
						slidesToShow:2
					}
				}
			]
		});
		$('.popular-countries').slick({
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			rtl:true,
			prevArrow:"<button type='button' class='slick-prev pay-left'><i class=\"icofont-rounded-left\"  aria-hidden='true'></i></button>",
	    	nextArrow:"<button type='button' class='slick-next pay-right'><i class=\"icofont-rounded-right\"  aria-hidden='true'></i></button>",
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: 5
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow:4
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow:3
					}
				},
				{
					breakpoint: 450,
					settings: {
						slidesToShow:2
					}
				}
			]
		});
	} else {
		$('.blog-slider').slick({
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 1,
			prevArrow:"<button type='button' class='slick-prev pull-left'><i class=\"icofont-rounded-left\"  aria-hidden='true'></i> PREV</button>",
	    	nextArrow:"<button type='button' class='slick-next pull-right'>NEXT<i class=\"icofont-rounded-right\"  aria-hidden='true'></i></button>",
			responsive: [{
				breakpoint: 991,
				settings: {
					slidesToShow: 1
				}
			}]
		});
		$('.payment-methods').slick({
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			prevArrow:"<button type='button' class='slick-prev pay-left'><i class=\"icofont-rounded-left\"  aria-hidden='true'></i></button>",
	    	nextArrow:"<button type='button' class='slick-next pay-right'><i class=\"icofont-rounded-right\"  aria-hidden='true'></i></button>",
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: 5
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow:4
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow:3
					}
				},
				{
					breakpoint: 450,
					settings: {
						slidesToShow:2
					}
				}
			]
		});
		$('.popular-countries').slick({
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			prevArrow:"<button type='button' class='slick-prev pay-left'><i class=\"icofont-rounded-left\"  aria-hidden='true'></i></button>",
	    	nextArrow:"<button type='button' class='slick-next pay-right'><i class=\"icofont-rounded-right\"  aria-hidden='true'></i></button>",
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: 5
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow:4
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow:3
					}
				},
				{
					breakpoint: 450,
					settings: {
						slidesToShow:2
					}
				}
			]
		});
	}

    $(".back-to-top").on("click",function(){
        $("html, body").animate({scrollTop:0},1e3)}
    )




	$('#send-money-currency').selectmenu();
    $('#select-service').selectmenu();
    $('#select-airtime').selectmenu();
    $('#sleect-bank').selectmenu();
    $('#trnasection').selectmenu();
    $('#exchange').selectmenu();
    $('#select-reason').selectmenu();



});
