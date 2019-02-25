
jQ(window).resize(function() {

	fixedMenu();

});

jQ(window).scroll(function() {
	var scrollPos = jQ(window).scrollTop();



});

jQ(window).load(function() {
	var wLocation = window.location.hash;
	if(jQ('a[data-href="'+wLocation+'"]').length>0){
		jQ.colorbox({
			innerWidth:"840px",
			height:'90%',
			href:jQ('a[data-href="'+wLocation+'"]').first().attr('href')
		});
	}
	if(jQ('a[href="'+wLocation+'"]').length>0){
		jQ('a[href="'+wLocation+'"]').trigger('click');
	}
	
});

jQ(document).ready(function() {
	//jQ('.reviews-item .review-cite > h3').each(function(){
	//	var str = jQ(this).text();
	//	if(str.length > 77){
	//		str = str.substr(0,77) + '...';
	//		jQ(this).text(str);
	//	}
	//});
	//jQ('.reviews-item .review-cite > span').each(function(){
	//	var str = jQ(this).text();
	//	if(str.length > 347){
	//		str = str.substr(0,347) + '...';
	//		jQ(this).html('<p>'+str+'</p>');
	//	}
	//});

	var buyticket = false;
	jQ('.buyticket').on('click',function(){
		buyticket = true;
	});
	jQ('.program-table').each(function(){
		var table = jQ(this);
		jQ(table).find('.event-col-blue').each(function(){
			if(jQ(this).text()=='') jQ(this).remove();
		})
		if(jQ(table).find('.event-col-blue').length==0) jQ(table).find('.event-col.blue').remove();
	});
	jQ('.event-col-violet').each(function(){
		if(jQ(this).text()==''){
			var tbody = jQ(this).closest('tbody');
			var text = jQ(this).closest('tr').find('.event-col-green').html();
			var aTime = jQ(this).closest('tr').find('td.time-range .cont').text().split(' - ');
			jQ(this).closest('tr').remove();
			jQ(tbody).find('td.time-range .cont').each(function(){
				var aTime1 = jQ(this).text().split(' - ');
				var i = 2;
				if(aTime1[0]==aTime[0]){
					jQ(this).closest('tr').next().each(function(){
						var aTime2 = jQ(this).find('td.time-range .cont').text().split(' - ');
						if(aTime2[1]!=aTime[1]) i = i + 1;
					});
					jQ(this).closest('tr').find('td.event-name-narrow.event-col-green').html(text);
					jQ(this).closest('tr').find('td.event-name-narrow.event-col-green').attr('rowspan',i);
					jQ(this).closest('tr').find('td.event-name-narrow.event-col-green').css('background-color','#dcf7e8');
				}
			})

		}
	});

	jQ('.program-table').each(function(){
		var table = jQ(this);
		jQ(table).find('.event-col-green').each(function(){
			if(jQ(this).text()=='') jQ(this).remove();
		})
	});


	// Счетчик

	var curDate = new Date();

	curDate.setDate(curDate.getDate());

	//var endDate = new Date("November 13, 2015 00:00:00");

	jQ(".countdown").each(function() {
		jQ(this).countdown({
			until: endDate,
			format: 'yODHMS',
			layout: "{o<}<div class='cd-section clearfix'><div class='cd-num'>{o10}</div><div class='cd-num'>{o1}</div><div class='cd-units'>{ol}</div></div>{o>}" +

			"{d<}<div class='cd-section clearfix'><div class='cd-num'>{d10}</div><div class='cd-num'>{d1}</div><div class='cd-units'>{dl}</div></div>{d>}" +

			"{h<}<div class='cd-section clearfix'><div class='cd-num'>{h10}</div><div class='cd-num'>{h1}</div><div class='cd-units'>{hl}</div></div>{h>}"
		});
	});


	var ticketsLeft = (endDate.getDate() - curDate.getDate() + 3)*3;

	if (ticketsLeft < 12) {
		ticketsLeft = 12
	}

	jQ(".tickets-left").html(ticketsLeft)

	// Карусель с логотипами участников

	jQ(".participants .jcarousel").jcarousel({
		wrap: 'circular',
		scroll: 6
	});

	itvl = window.setInterval(function(){
		$(".participants .jcarousel-next").click();
	},5000);

	$(".participants .jcarousel").hover(function() {
		window.clearInterval(itvl);
	}, function() {
		itvl = window.setInterval(function(){
			$(".participants .jcarousel-next").click();
		},5000);
	});

	// Счетчик END

	jQ('form[action="/webforms/send/"]').each(function(){
		if(jQ(this).find('input[name="data[new][form_title]"]').length==0){
			jQ(this).append('<input type="hidden" value="" name="data[new][form_title]" />');
		}
	});

	jQ('body').on('click','a[data-title]',function(event){
		//event.preventDefault();
		var t = $(this).attr('href');
		var title = $(this).data('title');
		title = title.replace('<br />','');
		title = title.replace('&lt;br /&gt;','');

		if(jQ(t).length==1){
			jQ(t).find('h2').first().text(title);
			jQ(t).find('input[name="data[new][form_title]"]').val(title);
		}
	})

	var nextSpeaker = 'следующий спикер';
	var prevSpeaker = 'предыдущий спикер';

	if(jQ('#lang').data('lang')=='/en'){
		var nextSpeaker = 'next speaker';
		var prevSpeaker = 'previous speaker';
	}
	var wLocation = window.location.hash;

	if (wLocation) {
		if (jQ('.main-menu a.anchor[href="'+wLocation+'"]').length) {
			jQ('.main-menu a.anchor[href="'+wLocation+'"]').addClass("act")
		}


	}

	fixedMenu();

	jQ('#registerPopup input[type="submit"]').on('click',function(){
		ga('send', 'event', 'order', 'sendorder');
	});
	jQ('#ticketPopup input[type="submit"]').on('click',function(){
		ga('send', 'event', 'order', 'sendorder');
	});
	jQ('.block-contacts .contacts-person a.mail-link').on('click',function(){
		ga('send', 'event', 'mail', 'sendmail');
	});

	jQ('body').on('click','.materials-footer a',function(event){
		event.preventDefault();
		var link = jQ(this).attr('href');
		//var p = jQ(this).attr('href').split('?p=');
		//p = parseInt(p[1]);
		var cont = jQ(this).closest('.materials').find('div').first();
		jQ.ajax({
			url: link,
			global: true,
			type: "POST",
			dataType: "html",
			complete: function (oHtml) {
				jQ(oHtml.responseText).find('.materials .row').each(function(){
					jQ(cont).append(jQ(this));
				});
				jQ('.materials-footer').html('');
				if(jQ(oHtml.responseText).find('.materials-footer').length){
					jQ('.materials-footer').html(jQ(oHtml.responseText).find('.materials-footer').html());
				}

				jQ(".speakers-list .ajaxBox").colorbox({
					maxWidth:"850px",
					innerWidth:"840px",
					height:'90%',
					fixed:false,
					rel: "speakers-item",
					previous: "<span>"+prevSpeaker+"</span>",
					next: "<span>"+nextSpeaker+"</span>",
					onOpen:function(){
						jQ("html,body").css({overflow:"hidden"})
						jQ("#colorbox").addClass("colorbox-speaker");

					},
					onComplete:function() {
						jQ("#colorbox #cboxLoadedContent").css({
							height:jQ("#cboxContent").height() - 40
						})
						window.location.hash = jQ(jQ.colorbox.element()).attr('href').split('?')[0];
					},
					onClosed:function(){
						jQ("html,body").css({overflow:"auto"})
						jQ("#colorbox").removeClass("colorbox-speaker")
					}
				});
				//$(oHtml).appendTo('');
			}
		});
		//p = p + 1;
		//jQ(this).attr('href','?p='+p);
	})

	// Запуск верхнего слайдера

	jQ(".main-slider").mainSlider();

	// Табы с видео

	jQ(".video-tabs .tab").click(function() {
		jQ(".video-tabs .tab").removeClass("tab-act");
		jQ(this).addClass("tab-act");

		jQ(".video-player").hide();
		jQ(".video-player").eq(jQ(this).prevAll(".tab").length).fadeIn(250);

	});

	// Отзывы

	jQ(".reviews-carousel .jcarousel").jcarousel({
		scroll: 2,
		wrap: 'circular'
	});

	// Лидеры о счастье

	if(jQ('#content-slider-1').length){
		jQ('#content-slider-1').royalSlider({
			autoHeight: true,
			arrowsNav: false,
			fadeinLoadedSlide: false,
			controlNavigationSpacing: 0,
			controlNavigation: 'thumbnails',
			imageScaleMode: 'none',
			imageAlignCenter:false,
			loop: false,
			loopRewind: true,
			numImagesToPreload: 6,
			keyboardNavEnabled: true,
			usePreloader: false,
			transitionType:'fade',
			thumbs: {
				autoCenter: true,
				fitInViewport: true,
				orientation: 'horizontal',
				spacing: 0,
				paddingBottom: 0
			},
			controlsInside:false,
			navigateByClick:false
		});
	}

	// Цели рефорума

	jQ('.tItem').on('mouseenter',function(){
		var heartPice = jQ(this).attr('data-heart');
		jQ('.'+heartPice).show().siblings('.heart').hide();
	}).on('mouseleave',function(){
		jQ('.heart').hide();
	})

	// Speakers row height fix

	jQ(".speakers-list .row").each(function() {
		jQ(this).css({
			height: jQ(this).height() + 20
		})
	});

	// Colorbox
	jQ(".button-presentation").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			var isSend =  jQ.cookie('present_form');
			var link = jQ(this).data('link');
			jQ('#presentPopup form').append('<input name="link" value="'+link+'">');
			if(isSend=='1'){
				window.location.href = link;
			}else{
				jQ("#colorbox").addClass("colorbox-1 colorbox-form");
			}
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-1 colorbox-form");
		}
	});

	jQ(".speakers-list .ajaxBox").colorbox({
		maxWidth:"850px",
		innerWidth:"840px",
		height:'90%',
		fixed:false,
		rel: "speakers-item",
		previous: "<span>"+prevSpeaker+"</span>",
		next: "<span>"+nextSpeaker+"</span>",
		onOpen:function(){
			jQ("html,body").css({overflow:"hidden"})
			jQ("#colorbox").addClass("colorbox-speaker");

		},
		onComplete:function() {
			jQ("#colorbox #cboxLoadedContent").css({
				height:jQ("#cboxContent").height() - 40
			})
			window.location.hash = jQ(jQ.colorbox.element()).attr('href').split('?')[0];
		},
		onClosed:function(){
			jQ("html,body").css({overflow:"auto"})
			jQ("#colorbox").removeClass("colorbox-speaker")
		}
	});

	jQ(".register-popup-button").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-1 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-1 colorbox-form")
		}
	});

	jQ(".mailing-link").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-2 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-2 colorbox-form")
		}
	});

	jQ(".speakers-popup-button").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-3 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-3 colorbox-form")
		}
	});

	jQ(".company-popup-button").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-3 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-3 colorbox-form")
		}
	});

	jQ(".ticket-popup-button").on('click',function(){
		ga('send', 'event', 'order', 'sendorder' );
		//console.log('sendorder');
	});

	jQ(".ticket-popup-button1").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			//if (jQ(window).width() >= 1225) {
			//	yDiff = 40
			//} else {
			//	yDiff = 90
			//}
            //
			//jQ("html,body").animate({
			//	scrollTop: jQ("a[name='prices']").offset().top - yDiff
			//},1000);
			//jQ("#colorbox").css('top',jQ("a[name='prices']").offset().top + yDiff);
			jQ("#colorbox").addClass("colorbox-4 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-4 colorbox-form")
		}
	});

	jQ(".request-popup-button").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-1 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-1 colorbox-form")
		}
	});

	jQ(".partner-popup-button").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-4 colorbox-form")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-4 colorbox-form")
		}
	});

	jQ(".button-organizer").colorbox({
		innerWidth:"870px",
		height:"90%",
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-5 colorbox-organizer")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-5 colorbox-organizer")
		}
	});

	jQ(".button-toolshop").colorbox({
		inline:true,
		fixed:false,
		onOpen:function(){
			jQ("#colorbox").addClass("colorbox-6 colorbox-toolshop")
		},
		onClosed:function(){
			jQ("#colorbox").removeClass("colorbox-6 colorbox-toolshop")
		}
	});

	// Tabbed content

	jQ(".tabbed-content").each(function() {
		var tabs = jQ(this).find(".tabs").find(".tab");
		var tabContents = jQ(this).find(".tabs-content").find(".tab-content");

		if (!tabs.hasClass("act")) {
			tabs.first().addClass("act");
		}

		tabContents.hide();
		tabContents.filter("[rel='"+tabs.filter(".act").attr("rel")+"']").show();

		tabs.click(function() {
			tabs.removeClass("act");
			jQ(this).addClass("act");

			// window.location.hash = jQ(this).attr("rel");

			tabContents.hide();

			tabContents.filter("[rel='"+jQ(this).attr("rel")+"']").fadeIn(200)

		});


		if (jQ(this).find(".tabs-nav").length) {
			jQ(".tabbed-content").each(function() {
				var prev = jQ(this).find(".tabs-nav .prev");
				var next = jQ(this).find(".tabs-nav .next");

				var tabs = jQ(this).find(".tabs");

				if (tabs.find(".act").prev(".tab").length) {
					prev.show();
					prev.find("span").html(tabs.find(".act").prev(".tab").find("span").html());
				} else {
					prev.hide();
				}

				if (tabs.find(".act").next(".tab").length) {
					next.show();
					next.find("span").html(tabs.find(".act").next(".tab").find("span").html());
				} else {
					next.hide();
				}

				prev.click(function() {
					tabs.find(".act").prev(".tab").click();
					if (tabs.find(".act").prev(".tab").length) {
						next.show();
						jQ(this).find("span").html(tabs.find(".act").prev(".tab").find("span").html());
						next.find("span").html(tabs.find(".act").next(".tab").find("span").html());
					} else {
						jQ(this).hide();
						next.find("span").html(tabs.find(".act").next(".tab").find("span").html());
					}
				});

				next.click(function() {
					tabs.find(".act").next(".tab").click();
					if (tabs.find(".act").next(".tab").length) {
						prev.show();
						jQ(this).find("span").html(tabs.find(".act").next(".tab").find("span").html());
						prev.find("span").html(tabs.find(".act").prev(".tab").find("span").html());
					} else {
						jQ(this).hide();
						prev.find("span").html(tabs.find(".act").prev(".tab").find("span").html());
					}
				})

				tabs.find(".tab").click(function() {
					next.find("span").html(jQ(this).next(".tab").find("span").html());
					prev.find("span").html(jQ(this).prev(".tab").find("span").html());
					if (jQ(this).prev(".tab").length) {
						prev.show();
					} else {
						prev.hide();
					}
					if (jQ(this).next(".tab").length) {
						next.show();
					} else {
						next.hide();
					}
				})

			});
		}

	});

	// Program tab trigger

	jQ(".expandable-content").each(function() {
		var content = jQ(this);
		// var origHeight = jQ(this).outerHeight(true);
		jQ(this).css({
			height: 430
		})
		var trigger = jQ(this).find(".expandable-trigger");
		var fade = jQ(this).find(".expandable-fade");

		trigger.click(function() {
			var origHeight = content.find(".expandable-inner").outerHeight(true);
			if (!jQ(this).hasClass("trigger-on")) {
				jQ(this).addClass("trigger-on");
				content.transition({
					height: origHeight
				},1000)
				trigger.html(trigger.data("collapsetext"));
				fade.fadeOut(1000);
			} else {
				jQ(this).removeClass("trigger-on");
				content.transition({
					height: 430
				},1000)
				trigger.html(trigger.data("expandtext"))
				fade.fadeIn(1000);
			}
		});

	});

	// Place map trigger

	jQ(".place-map-trigger").click(function() {
		var trigger = jQ(this);
		var mapCont = jQ(".place-map");
		if (!trigger.hasClass("place-map-trigger-on")) {
			trigger.addClass("place-map-trigger-on");
			trigger.find(".text").html(trigger.data("ontext"));
			mapCont.transition({
				opacity:1
			},250)
		} else {
			trigger.removeClass("place-map-trigger-on");
			trigger.find(".text").html(trigger.data("offtext"));
			mapCont.transition({
				opacity:0
			},250)
		}
	});

	// Contacts info trigger

	jQ(".contacts-info-trigger").click(function() {
		var trigger = jQ(this);
		var contactsInfo = jQ(".contacts-info");
		if (!trigger.hasClass("contacts-info-trigger-on")) {
			trigger.addClass("contacts-info-trigger-on");
			trigger.html(trigger.data("ontext"));
			contactsInfo.fadeIn(250);
		} else {
			trigger.removeClass("contacts-info-trigger-on");
			trigger.html(trigger.data("offtext"));
			contactsInfo.fadeOut(250);
		}
	});

	jQ(".contacts-info .close").click(function() {
		jQ(".contacts-info").fadeOut(250)
		jQ(".contacts-info-trigger").removeClass("contacts-info-trigger-on");
		jQ(".contacts-info-trigger").html(jQ(".contacts-info-trigger").data("offtext"));
	});

	// Top menu

	jQ(".main-menu a.anchor").click(function() {

		if(jQ('#lang').data('lang')=='/en'){
			var anchor = jQ(this).attr("href").replace("en/index.html#","");
		}else{
			var anchor = jQ(this).attr("href").replace("index.html#","");
		}
		var link = jQ(this);

		jQ("a.anchor").removeClass("act");
		jQ(".main-menu").each(function() {
			jQ(this).find("li").eq(link.parents("li").prevAll("li").length).find("a.anchor").addClass("act");
		});

		if (jQ(window).width() >= 1225) {
			yDiff = 40
		} else {
			yDiff = 90
		}

		jQ("html,body").animate({
			scrollTop: jQ("a[name='"+anchor+"']").offset().top - yDiff
		},1000);

		return false;
	});


	// Forms

	jQ("input:text").each(function() {
		if (jQ(this).val()) {
			jQ(this).prev(".placeholder").hide();
		}
	});

	jQ("input.phone").mask("+7 (999) 999-99-99");

	validateForms();
	jQ(".capth_update").on('click',function(event){
		event.preventDefault();
		$('.form-captcha img').attr('src','captchad41d.jpg?'+Math.random());
	});
	jQ("form").submit(function(event) {
		event.preventDefault();
		if (jQ(this).valid()) {
			var form_id = jQ(this).find('input[name=system_form_id]').val();
			var link ='index.php';
			if(form_id == '152') link = jQ(this).find('input[name=link]').val();
			var cost = 48500;
			var sdate = new Date();
			var sDay = sdate.getDate()+'-'+(sdate.getMonth()+1)+'-'+ sdate.getFullYear()+' '+sdate.getHours()+':'+sdate.getMinutes();
			var form = jQ(this);
			if(!jQ(form).hasClass('query')) {
				jQ(form).addClass('query');
				jQ(form).append('<input type="hidden" name="data[new][date]" value="' + sDay + '">');
				var action = jQ(this).attr('action');
				var data = jQ(this).serialize();
				jQ.ajax({
					url: '/udata://webforms/jsend/',
					data: data,
					global: true,
					type: "POST",
					dataType: "html",
					complete: function (oHtml) {
						jQ(form).removeClass('query');
						if (jQ(oHtml.responseText).find('msg_id').length > 0) {
							var msg_id = jQ(oHtml.responseText).find('msg_id').text();
							//jQ('#infoPopup').html('<h2>' + jQ(oHtml.responseText).find('msg').text() + '</h2>');
                            jQ.colorbox({html:'<h2>' + jQ(oHtml.responseText).find('msg').text() + '</h2>'});
                            //inline:true,
                            //    fixed:false,
                            //jQ(form).html('<h2>' + jQ(oHtml.responseText).find('msg').text() + '</h2>');
							if(form_id == '152'){
								window.location.href=link;
								jQ.cookie('present_form', '1', {expires: 365, path: '/', domain:'.winningthehearts.com' });
							}
							//if (form_id == '132' || form_id == '128' || form_id == '133') {
							//    jQ(form).append('<iframe src="https://4517375.fls.doubleclick.net/activityi;src=4517375;type=sales;cat=cWe0cO4v;qty=1;cost=' + cost + ';ord=' + msg_id + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
							//    ga('require', 'ec');
							//    ga('ec:addProduct', {
							//        'id': '1', // ID для регистраций, всегда равное 1.
							//        'name': 'Регистрация', // Название продукта - Регистрация
							//        'quantity': 1 // Количество – всегда 1
							//    });
							//    ga('ec:setAction', 'purchase', {
							//        'id': msg_id // уникальный ID заказа
							//    });
							//    ga('send', 'event', 'transaction_enh', 'registration');
							//
							//}
						}

						if (jQ(oHtml.responseText).find('.error').length > 0) {
							jQ(form).prepend('<div class="error">' + jQ(oHtml.responseText).find('.error').html() + '</div>');
						}
						if(buyticket){
							//ga('send', 'event', ' ticket', ' buytick', 'http://winningthehearts.com/');
							//console.log('buyticket');
						}
						buyticket = false;
					}
				});
			}
//
//			jQ(this).find("input:text").val("");
//			jQ(this).find("textarea").val("");
//
//			jQ(this).find(".placeholder").show();

		}
	});

	jQ("input:text, input:password, textarea").each(function() {
		jQ(this).addClass("initial");

		if (jQ(this).prop("tagName") == "INPUT" || jQ(this).prop("tagName") == "TEXTAREA") {
			// if (!jQ(this).parents(".input-wrapper").length) jQ(this).wrap("<div class='input-wrapper'></div>");
			if (jQ(this).hasClass("phone") || jQ(this).hasClass("form-date")) {
				jQ(this).focus(function() {
					jQ(this).removeClass("initial");
					jQ(this).parents(".form-item").find(".placeholder").hide();
				});
			} else {
				jQ(this).focus(function() {
					jQ(this).parents(".form-item").find(".placeholder").addClass("placeholder-initial");
				});
				jQ(this).keydown(function() {
					jQ(this).removeClass("initial");
					jQ(this).parents(".form-item").find(".placeholder").hide();
				});
			}
			jQ(this).blur(function() {
				jQ(this).prev().prev(".placeholder").hide();
				jQ(this).parents(".form-item").find(".placeholder").removeClass("placeholder-initial");
				if (!jQ(this).val()) {
					jQ(this).addClass("initial");
					jQ(this).parents(".form-item").find(".placeholder").show();
				}
			});
		} else {
			jQ(this).focus(function() {
				jQ(this).removeClass("initial");
				jQ(this).parents(".form-item").find(".placeholder").hide();
			});
			jQ(this).blur(function() {
				if (!jQ(this).val()) {
					jQ(this).addClass("initial");
					jQ(this).parents(".form-item").find(".placeholder").show();
				}
			});
		}

		jQ(this).parents(".form-item").find(".placeholder").click(function() {
			jQ(this).focus();
		});

	});

	jQ(".fancybox").fancybox();


});

(function( jQ ) {
	jQ.fn.mainSlider = function() {


		var slider = jQ(this);
		var slides = slider.find(".slide");
		var sliderSize = slides.size();

		slides.hide();
		slides.eq(0).show().addClass("slide-act");

		//sliderMakeup();

		var listerDescr = slider.find(".lister-descr");

		listerDescr.html(slides.eq(0).find(".descr").html());
		listerDescr.attr("onclick",slides.eq(0).attr("onclick"))

		if (sliderSize > 1) {

			slides.bind("click",function () {
				if (listerItems.filter(".act").next().length) {
					listerItems.filter(".act").next().click();
				} else {
					listerItems.eq(0).click();
				}
			});

			var listerItems = slider.find(".lister-item");

			// slider.find(".slides").after("<div class='next' />");
			// slider.find(".slides").after("<div class='prev' />");

			var prevBtn = slider.find(".prev");
			var nextBtn = slider.find(".next");

			nextBtn.click(function() {
				curIndex = parseInt(slider.find(".slide-act").prevAll(".slide").length)
				slides.fadeOut(500).removeClass("slide-act");
				if (curIndex < sliderSize-1) {
					curIndex++;
				} else {
					curIndex = 0;
				}
				slides.eq(curIndex).fadeIn(500).addClass("slide-act");
				listerDescr.html(slides.eq(curIndex).find(".descr").html());
				listerDescr.attr("onclick",slides.eq(curIndex).attr("onclick"))
				listerDescr.hide().fadeIn(250);
			});

			prevBtn.click(function() {
				curIndex = parseInt(slider.find(".slide-act").prevAll(".slide").length)
				slides.fadeOut(500).removeClass("slide-act");
				if (curIndex > 0) {
					curIndex--;
				} else {
					curIndex = slides.length-1;
				}
				slides.eq(curIndex).fadeIn(500).addClass("slide-act");
				listerDescr.html(slides.eq(curIndex).find(".descr").html());
				listerDescr.attr("onclick",slides.eq(curIndex).attr("onclick"))
				listerDescr.hide().fadeIn(250);
			});


			timer = setInterval( function() {
				nextBtn.click();
			}, 4000);

			// jQ('.main-slider').hover(
			// function () {
			// clearInterval(timer)
			// },
			// function () {
			// timer = setInterval( function() {
			// nextBtn.click();
			// }, 5000);
			// }
			// );

		}

	}
})( jQ );

function validateForms() {

	jQ("form").each(function() {
		jQ(this).validate({
			focusInvalid: false,
			sendForm : false,
			errorPlacement: function(error, element) {
				// element.parents(".input-wrapper").addClass("input-wrapper-error");
				if (element.attr("errortext")) {
					error.html(element.attr("errortext"))
				}
				error.insertAfter(element);
				element.prev(".placeholder").addClass("placeholder-error")
				if (element[0].tagName == "SELECT") {
					element.parents(".form-item").find(".param-selector").addClass("param-sel-error")
				}

			},
			unhighlight: function(element, errorClass, validClass) {
				// jQ(element).parents(".input-wrapper").removeClass("input-wrapper-error");
				jQ(element).removeClass(errorClass);
				jQ(element).next(".error").remove();
				jQ(element).prev(".placeholder").removeClass("placeholder-error");
				if (jQ(element)[0].tagName == "SELECT") {
					jQ(element).parents(".form-item").find(".param-selector").removeClass("selector-error")
				}
			},
			invalidHandler: function(form, validatorcalc) {
				var errors = validatorcalc.numberOfInvalids();
				if (errors && validatorcalc.errorList[0].element.tagName == "INPUT") {
					validatorcalc.errorList[0].element.focus();
				}
			}
		});

		if (jQ(this).find("input.email").length) {
			if(jQ('#lang').data('lang')=='/en'){
				jQ(this).find("input.email").rules('add', {
					email: true,
					messages: {
						required:  "Please enter a valid email"
					}
				});
			}else{
				jQ(this).find("input.email").rules('add', {
					email: true,
					messages: {
						required:  "Введите правильный e-mail"
					}
				});
			}

		}

		if (jQ(this).find(".form-date").length) {
			if(jQ('#lang').data('lang')=='/en'){
				jQ(this).find(".form-date").rules('add', {
					messages: {
						required:  "Please enter a valid date!"
					}
				});
			}else{
				jQ(this).find(".form-date").rules('add', {
					messages: {
						required:  "Выберите дату!"
					}
				});
			}
		}

		if (jQ(this).find("input.email").length && jQ(this).find("input.phone").length) {
			var thisField = jQ(this).find("input.phone");
			var relatedField = jQ(this).find("input.email");
			thisField.rules('add', {
				required: function(element) {
					if (relatedField.val() == "") {
						return true;
					} else {
						return false;
					}
				}
			});
			var thisField2 = jQ(this).find("input.email");
			var relatedField2 = jQ(this).find("input.phone");
			thisField2.rules('add', {
				required: function(element) {
					if (relatedField2.val() == "") {
						return true;
					} else {
						return false;
					}
				}
			});
		}

		jQ(document).mouseup(function (e) {
			var container = jQ("form");

			if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				jQ(".error-wrapper").remove();
			}
		});

		jQ(document).mouseup(function (e) {
			var container = jQ(".tooltip");

			if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				jQ(".tooltip").fadeOut(150);
			}
		});

	});

}

jQuery.extend(jQuery.validator.messages, {
	required: "Заполните поле!",
	remote: "Please fix this field.",
	email: "Введите правильный e-mail",
	url: "Please enter a valid URL.",
	date: "Please enter a valid date.",
	dateISO: "Please enter a valid date (ISO).",
	number: "Please enter a valid number.",
	digits: "Please enter only digits.",
	creditcard: "Please enter a valid credit card number.",
	equalTo: "Please enter the same value again.",
	accept: "Please enter a value with a valid extension.",
	maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
	minlength: jQuery.validator.format("Please enter at least {0} characters."),
	rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
	range: jQuery.validator.format("Please enter a value between {0} and {1}."),
	max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
	min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

function fixedMenu() {

	if (jQ(window).width() >= 1225) {
		jQ(".fixed-menu-v").fadeIn(100);
		jQ(".fixed-menu-h").fadeOut(100);
		jQ(".header").css({
			marginTop: 0
		});
		jQ(".top-wrap,.footer").css({
			marginLeft:150
		});
	} else {
		jQ(".fixed-menu-v").fadeOut(100);
		jQ(".fixed-menu-h").fadeIn(100);
		jQ(".header").css({
			marginTop: 80
		});
		jQ(".top-wrap,.footer").css({
			marginLeft:0
		});
	}

	jQ(".fixed-menu-h .soclinks-trigger").click(function() {
		jQ(".fixed-menu-h .soclinks").fadeToggle(100);
		jQ(this).toggleClass("trigger-on")
	});

	jQ(document).mouseup(function (e) {
		var container1 = jQ(".fixed-menu-h .soclinks");
		var container2 = jQ(".fixed-menu-h .soclinks-trigger").not(".trigger-on");

		if (!container1.is(e.target) && !container2.is(e.target) // if the target of the click isn't the container...
			&& container1.has(e.target).length === 0 && container2.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container1.fadeOut(150);
		}
	});
}

jQuery.extend(jQuery.fn, {
	toplinkwidth: function(){
		var totalContentWidth = jQuery('#content').outerWidth(); // ширина блока с контентом, включая padding
		var totalTopLinkWidth = jQuery(this).children('a').outerWidth(true); // ширина самой кнопки наверх, включая padding и margin
		var h = jQuery(window).width()/2-totalContentWidth/2-totalTopLinkWidth;
		if(h<0){
			// если кнопка не умещается, скрываем её
			jQuery(this).hide();
			return false;
		} else {
			if(jQuery(window).scrollTop() >= 1){
				jQuery(this).show();
			}

			return true;
		}
	}
});
jQuery(function($){
	var topLink = $('#top-link');

	topLink.css({'padding-bottom': $(window).height()});
	// если вам не нужно, чтобы кнопка подстраивалась под ширину экрана - удалите следующие четыре строчки в коде
	topLink.toplinkwidth();
	$(window).resize(function(){
		topLink.css({'padding-bottom': $(window).height()});
		topLink.toplinkwidth();
	});
	$(window).scroll(function() {
		if($(window).scrollTop() >= 2000 && topLink.toplinkwidth()) {
			topLink.fadeIn(300);
		} else {
			topLink.fadeOut(300);
		}
	});
	topLink.click(function(e) {
		$("body,html").animate({scrollTop: 0}, 500);
		return false;
	});
});


