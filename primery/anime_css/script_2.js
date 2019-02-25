	$(document).ready(function(){
		$(".box_button_2 .but_form").hover(function(){
			$(this).children(".krilo_left_start").addClass("left_toup");
			$(this).children(".krilo_right_start").addClass("right_toup");
			setTimeout(add_krilo,2000);
			setTimeout(add_korona,1400);
		},
		function() {
			$(this).children(".box_korona"); //.removeClass("rotate");
			$(this).children(".box_korona").children(".korona").removeClass("swing");
		});

	});
	function add_krilo(){
		$(".box_button_2 .but_form").children(".krilo_left_start").css({"visibility":"hidden"});
		$(".box_button_2 .but_form").children(".krilo_right_start").css({"visibility":"hidden"});
		$(".box_button_2 .but_form").children(".krilo_left").css({"visibility":"visible"}).addClass("akt");
		$(".box_button_2 .but_form").children(".krilo_right").css({"visibility":"visible"}).addClass("akt");
	}
	function add_korona() {
		$(".box_button_2 .but_form").children(".box_korona"); //.addClass("rotate");
		$(".box_button_2 .but_form").children(".box_korona").children(".korona").addClass("swing");
	}
