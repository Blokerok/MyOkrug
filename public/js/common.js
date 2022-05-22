
$(window).load(function () {
	if (window.matchMedia('(min-width: 768px)').matches) {
		$('.header-promo').addClass('bg-scale');
	};

    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $(".calendar").datepicker();

});

$(document).ready(function () {

	/* INCLUDE PLUGINS */

    $('.calendar').mask('00.00.0000');

	$(".fb").fancybox({

		touch: false,
	});

	/* slick init */


    $(".about-box__more").click(function () {
        var box = $(this).closest('.about-box').find('.about-box__wrap');
        var toggleText = $(this).text();
        $(this).text($(this).data('toggle-text'));
        $(this).data('toggle-text', toggleText);



        if ( box.hasClass('open') ) {
            box.height( box.data('height') );
        } else {
            box.data('height', box.height());
            box.height('100%');
        }


        box.toggleClass('open');

        return false;
    });


	$('.js-promo-slider').slick({
		arrows: true,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		speed: 2000,
  		autoplaySpeed: 6000,

		responsive: [{
			breakpoint: 767,
			settings: {
				arrows: false,
				dots: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				speed: 2000,
				autoplaySpeed: 6000,
			}
		}]
	});




	/* BASE FUNCTION */

	$(".js-toggle-nav").click(function () {
		$(this).toggleClass('open');
		$('body').toggleClass('open-nav');
		$('.header__nav').toggle();

		return false;
	});


	if (window.matchMedia('(min-width: 768px)').matches) {

		$(window).bind('scroll', function () {

			opacity = 1 - $(window).scrollTop() / $(window).height() * 3;

			if (opacity < 0) {
				opacity = 0
			}

			$('.header-promo__shadow').css('box-shadow', 'rgba(0, 0, 0, '+opacity+') 0px 400px 0px 400px');


			pos = (150 - $(window).scrollTop() / 2.5) * -1;

			if (pos > 0) {
				pos = 0
			}

			$('.home-content').css('transform', 'translate(0px, '+pos+'px)');

		});

	};


	if (window.matchMedia('(max-width: 767px)').matches) {

		$('.header__auth').appendTo('.main-nav__wrap').addClass('main-nav__auth');

	}




	window.mobileAndTabletcheck = function () {
		var check = false;
		(function (a) {
			if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true
		})(navigator.userAgent || navigator.vendor || window.opera);
		return check;
	}

	if (window.mobileAndTabletcheck()) {
		$('.phone-num').each(function () {
			num = $(this).data('phone');
			num_text = $(this).text();
			$(this).html('<a href="tel:' + num + '">' + num_text + '</a>');
		});
	}

	$(".js-goto-top").click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 1000);
		return false;
	});

	$(".js-goto").click(function () {
		var scroll = 0;
		scroll = $($(this).attr("href")).offset().top - 70;
		$("html, body").animate({
			scrollTop: scroll
		}, 1000);
		return false;
	});


	$(".js-scroll-screen").click(function () {
		$("html, body").animate({
			scrollTop: $('html').height()
		}, 1000);
		return false;
	});




	$(".js-next-toggle").click(function () {
		$(this).toggleClass('open');
		$(this).next().slideToggle();
		return false;
	});


	$('.input-file input[type="file"]').change(function() {
		$(this).closest('.input-file').find('.input-file__field').text( $(this)[0].files[0].name );
	});


	if (window.matchMedia('(max-width: 767px)').matches) {

		$(".js-mob-toggle").click(function () {
			block = $(this).data('toggle')

			$('#'+block).stop().slideToggle();

			return false;
		});

	}


	/* mobile search */

	if (window.matchMedia('(max-width: 992px)').matches) {

		$(".js-open-search").bind("click", function () {
			$('.header__search').show();
			return false;
		});

		$(".js-close-search").bind("click", function () {
			$('.header__search').hide();
			return false;
		});

		$("html").bind("click", function () {
			$('.header__search').hide();
		});

		$(".h-search").bind("click", function (event) {
			event.stopPropagation();
		});

	}


	/* drop select */

	$(".drop-list__title").bind("click touchstart", function () {
		$('.drop-list__dropdown').hide();
		$(this).closest('.drop-list').toggleClass('open').find('.drop-list__dropdown').fadeToggle(300);

		return false;
	});


	$(".drop-list__dropdown li").bind("click touchstart", function () {
		var title = $(this).closest('.drop-list').find('.drop-list__title');
		title.html($(this).html());

		$('.drop-list__dropdown').hide();
	});


	$("html").bind("click touchstart", function () {
		$('.drop-list__dropdown').fadeOut();
		$('.drop-list').removeClass('open');
	});

	$(".drop-list").bind("click touchstart", function (event) {
		event.stopPropagation();
	});



	/* tabs */

	$('.tabs__header').delegate('.tabs__item:not(.active)', 'click', function () {
		$(this).closest('.tabs__header').find('.active').removeClass('active');
		$(this).addClass('active')
			.parents('.tabs').find('.tabs__box').hide().removeClass('visible').eq($(this).index()).show().addClass('visible');

		$(this).closest('.tabs').find('.obj-sldier').slick('setPosition');
	});


	$('ul.tabs__caption').on('click', 'li:not(.active)', function() {
		$(this)
			.addClass('active').siblings().removeClass('active')
			.closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
	});

	/* --- item counter  --- */

	$(".js-counter input").on("keydown", function (event) {
		if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39) {} else {
			if (event.keyCode == 38) {
				var value = parseInt($(this).val());
				$(this).val(value + 1).change();
			}

			if (event.keyCode == 40) {
				var value = parseInt($(this).val());
				var min = 1;
				if ($(this).data('mincount')) {
					min = $(this).data('mincount');
				}

				if (value > min) $(this).val(value - 1).change();
			}

			if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
				event.preventDefault();
			}
		}
	});

	$(".js-counter input").on("keyup", function () {
		var min = 2;
		if ($(this).data('mincount')) {
			min = $(this).data('mincount') + 1;
		}

		if ($(this).val() < min) $(this).val(min - 1).change();
	});

	$(".js-counter span").click(function () {

		var min = 1;
		var input = $(this).closest('.js-counter').find('input');
		var value = parseInt(input.val());

		if (input.data('mincount')) {
			min = input.data('mincount');
		}


		if ($(this).hasClass('js-counter-down') && value > min) input.val(value - 1).change();
		if ($(this).hasClass('js-counter-up')) input.val(value + 1).change();

		return false;
	});


	$('.js-counter input[type="text"]').each(function () {
		$(this).val($(this).prop('defaultValue'));
	});


	$(".map-box").on("click", function () {
		$(this).addClass('unlock');
	});




	/* fix fly */

	if (window.matchMedia('(min-width: 768px)').matches) {
		$('.fix-scroll').each(function () {

			var fs = $(this);
			var fsFly= fs.find('.fix-scroll__fly');
			fs.css('min-height', fsFly.height() );

			$(window).bind('scroll', function () {

				var tp = fs.offset();
				tp = tp.top;

				if ($(window).scrollTop() > tp) {
					fsFly.addClass('fixed');
				} else {
					fsFly.removeClass('fixed');
				}


				var navFixCorrect = 0;

				if ( $('.header').hasClass('header-promo') ) {
					navFixCorrect = 33;
				}

				if ($(window).scrollTop() > tp + navFixCorrect) {
					fsFly.addClass('fixed--sm');
				} else {
					fsFly.removeClass('fixed--sm');
				}

			});

		});


		$(window).bind('scroll', function () {
			var tp = $('.header').height();

			if ($(window).scrollTop() > tp) {
					$('.header-fix').addClass('sm');
			} else {
					$('.header-fix').removeClass('sm');
			}
		});
	};

    $(".like").click(function () {

        var  data = new FormData();
        data.append("id", $(this).data('id'));

        $.ajax({
            data: data,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/fotokonkurs/set-voice',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(data) {
               if (data==1)
                location.reload();
            }
        });
    });

    $(".mark_liked").click(function () {

        var  data = new FormData();
        data.append("id", $(this).data('id'));
        data.append("model", $(this).data('model'));

        $.ajax({
            data: data,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/set-like',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                if (data==1)
                    location.reload();
            }
        });
    });

    $(".unmark_liked").click(function () {

        var  data = new FormData();
        data.append("id", $(this).data('id'));
        data.append("model", $(this).data('model'));

        $.ajax({
            data: data,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/unset-like',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                if (data==1)
                    location.reload();
            }
        });
    });


    $(".radio_opros").change(function () {

        var id_block = $(this).data('opros');

        var self_answer = $(this).data('selfanswer');

        console.log(self_answer)

        if (self_answer)
            $('.self_answer'+id_block).show();
        else
            $('.self_answer'+id_block).hide();

    })

    $(".go-voice").click(function () {

        var  data = new FormData();
        data.append("opros", $(this).data('opros'));
        data.append("selfanswer", $(this).data('selfanswer'));
        var id_block = $(this).data('opros');
        data.append("selfanswer_text", $('textarea[name="self_answer' +id_block+'"]').val());

        var vopros = $('input[name="vopros' +id_block+'"]:checked').val();


        data.append("vopros", $('input[name="vopros' +id_block+'"]:checked').val());


        $.ajax({
            data: data,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/cabinet/save-voice',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                $('#result'+id_block).html(data);
                $('#result'+id_block).removeClass('popup_video');
                $('#polls'+id_block).remove();


            }
        });
    });

    $('body').on("click", ".button-yes,.button-no", function (event) {

        event.preventDefault();

        var data = new FormData();
        var voice = $(this).attr("class");
        var id = $(this).data("id");
        data.append("voice",voice);
        data.append("id_green",id);

        $.ajax({
            data: data,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/ozelenenie/save-voice',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                $('.balloon-card__voting-variant'+'.'+id).html('<strong>'+data+'</strong>');



            }
        });
    });



    $(".add_foto").click(function(){

        var r = 2;

        r += $(".dop_foto").length;
        if (r==11) {  return false;}

        $("#dop_foto").append('<div class="forms__field dop_foto"><div class="input-file"><label>Фото '+ r + '</label><span class="input-file__field"></span><span class="input-file__button">Обзор</span><input id="post_images'+r+'" type="file" class="" name="post_images[]" value=""></div></div>');
        if (r==10) $(this).remove();
        $('.input-file input[type="file"]').change(function() {
            $(this).closest('.input-file').find('.input-file__field').text( $(this)[0].files[0].name );
        });
    })


});
