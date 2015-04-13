jQuery(window).load(function() {
	var tagline = jQuery(".page_heading .logo .tagline");
	tagline.css({
		'margin-top' : (jQuery(".page_heading").height() / 2 - tagline.height())+'px'
	});
});

jQuery(document).ready(function($) {

	// Enable mobile drop down navigation
	$("nav ul:first").mobileMenu();
	
	// Drop down menus
	$("header nav ul li").hover(function() {
		if($(this).find("ul").size != 0) {
			$(this).find("ul:first").stop(true, true).fadeIn("fast");
		}
	}, function() {
		$(this).find("ul:first").stop(true, true).fadeOut("fast");
	});
	
	$("header nav ul li").each(function() {
		$("ul li:last a", this).css({ 'border' : 'none' });
	});
	
  $('#actions .one_half:odd').addClass('column_last');
	
	if($("#sponsors ul li").length % 2 == 0) {
		$("#sponsors ul li:last").addClass("bottom");
		$("#sponsors ul li:last").prev().addClass("bottom");
	} else {
		$("#sponsors ul li:last").addClass("bottom");
	}
	
	if($("body").hasClass("admin-bar")) {
		$(".page_heading.home").css("top", "93px");
	}
	
	// Galleries
	function galleryHovers() {
		$(".two_column li, .three_column li, .four_column li").each(function() {
			$("a", this).append('<div class="hover"></div>');
		});
		$(".two_column li, .three_column li, .four_column li").hover(function() {
			$("a", this).find(".hover").stop(true, true).fadeIn(400);
		}, function() {
			$("a", this).find(".hover").stop(true, true).fadeOut(400);
		});

		$("div.gallery_wrap a, div.gallery a, .post a img, .two a img").hover(function() {
			$(this).animate({ 'opacity' : '0.6' }, 300);
		}, function() {
			$(this).stop(true,true).animate({ 'opacity' : '1' }, 300)
		});
	}
	galleryHovers();
	
	function initFancyboxes() {
		$("a.youtube").click(function() {
			$.fancybox({
					'padding'		: 0,
					'transitionIn'	: 'elastic',
					'overlayShow'	:	true,
					'title'			: this.title,
					'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
					'type'			: 'swf',
					'swf'			: {
					  'wmode'		: 'transparent',
						'allowfullscreen'	: 'true'
					}
				});
			return false;
		});
		$("a.vimeo").click(function() {
			$.fancybox({
				'padding'		: 0,
				'transitionIn'	: 'elastic',
				'overlayShow'	:	true,
				'title'			: this.title,
				'href' 			: this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
				'type'			: 'swf'
		  });
			return false;
		});
		$("a.fancybox").fancybox({
			"transitionIn":			"elastic",
			"transitionOut":		"elastic",
			"easingIn":					"easeOutBack",
			"easingOut":				"easeInBack",
			"padding":					0,
			"speedIn":      		500,
			"speedOut": 				500,
			"hideOnContentClick":	false,
			"overlayShow":        true
		});
	}
	initFancyboxes();
	
	// Gallery sorting
	var $filterType = $('ul.filter_list li.current a').attr('class');

	// Adding a data-id attribute. Required by the Quicksand plugin
	$(".gallery_thumbnails li").each(function(i){
      $(this).attr('data-id',i);
  });

	$(".gallery_thumbnails li a").each(function(i){
      $(this).attr("rel", "portfolio");
  });

 	// Clone applications to get a second collection
	var $data = $(".gallery_thumbnails").clone();

	$('.filter_list li a').click(function(e) {
		$(".filter_list li").removeClass("current");	
		// Use the last category class as the category to filter by.
		var filterClass = $(this).attr('class');
		$(this).parent().addClass('current');

		if (filterClass == 'all-items') {
			var $filteredData = $data.find('li');
		} else {
			var $filteredData = $data.find('li[data-type~=' + filterClass + ']');
		}
		$(".gallery_thumbnails").quicksand($filteredData, {
			duration: 600,
			adjustHeight: 'dynamic',
			useScaling: true
		}, function() { initFancyboxes(); galleryHovers(); });			
		return false;
	});
	
	// Form hints	
	$("#contact label, div.widget form label").inFieldLabels({ fadeOpacity: 0.4 });
	
	// Drop down menus
	$("header nav ul li").hover(function() {
		if($(this).find("ul").size != 0) {
			$(this).find("ul:first").stop(true, true).fadeIn("fast");
		}
	}, function() {
		$(this).find("ul:first").stop(true, true).fadeOut("fast");
	});
	
	$("header nav ul li").each(function() {
		$("ul li:last a", this).css({ 'border' : 'none' });
	});
	
	// Tooltips
	$("a[rel=tipsy]").tipsy({fade: true, gravity: 's', offset: 5, html: true});
	
	$("ul.social li a").each(function() {
		var title_text = $(this).attr("title");
		$(this).tipsy({
				fade: true, 
				gravity: 'n', 
				offset: 5,
				title: function() {
					return title_text;
				}
		});
	});
	
	// Reviews slideshow
	$("#reviews").tabs({ fx:{ opacity: "toggle" } }).tabs("rotate", 3000, true);

	$("#commentform #submit, #searchsubmit").addClass("button white");
	
	
	$("h4.event-day").each(function() {
		var event_day_text = $(this).text();
		$(this).after('<div class="box_heading"><h2>'+event_day_text+'</h2><span class="line"></span></div>');
		$(this).remove();
	});
			
	// Tabs
	$(".tabs").find(".pane:first").show().end().find("ul.nav li:first").addClass("current");
	$(".tabs ul.nav li a").click(function() {
		var tab_container = $(this).parent().parent().parent();
		$(this).parent().parent().find("li").removeClass("current");
		$(this).parent().addClass("current");
		$(".pane", tab_container).hide();
		$("#"+$(this).attr("class")+".pane", tab_container).show();
	});	
	
	// Toggle lists
	$(".toggle_list ul li .title").click(function() {
		var content_container = $(this).parent().find(".content");
		if(content_container.is(":visible")) {
			content_container.slideUp("fast");
			$(this).find("a.toggle_link").text($(this).find("a.toggle_link").data("open_text"));
		} else {
			content_container.slideDown("fast");
			$(this).find("a.toggle_link").text($(this).find("a.toggle_link").data("close_text"));
		}
	});
	
	$(".toggle_list ul li .title").each(function() {
		$(this).find("a.toggle_link").text($(this).find("a.toggle_link").data("open_text"));
		if($(this).parent().hasClass("opened")) {
			$(this).parent().find(".content").show();
		}
	});
	
	// Ajax contact form
	$("form#shortcode_contact").submit(function() {
  	var this_form = $(this);
  	$.ajax({
  		type: 'post',
  		data: this_form.serialize(),
  		url: this_form.find("#form_action").val(),
  		success: function(res) {
  			if(res == "true") {
  				this_form.fadeOut("fast");
					$(".success").fadeIn("fast");
					$(".validation").fadeOut("fast");
  			} else {
  				$(".validation").fadeIn("fast");
  				this_form.find(".text").removeClass("error");
  				$.each(res.split(","), function() {
  					this_form.find("#"+this).addClass("error");
  				});
  			}
  		}
  	});
  });
	
});