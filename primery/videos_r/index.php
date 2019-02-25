<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Конкурс видеосюжетов");
?>
<style>
.video_list  {
	max-width:910px;
	padding:10px 10px;
		 background: #323c44;
   background: -moz-linear-gradient(top, #323c44 0%, #fff 20%,#fff 80%, #323c44 100%);
   background: -webkit-linear-gradient(top, #323c44 0%, #fff 20%,#fff 80%, #323c44 100%);
   background: -o-linear-gradient(top, #323c44 0%, #fff 20%,#fff 80%, #323c44 100%);
    background: -ms-linear-gradient(top, #323c44 0%, #fff 20%,#fff 80%, #323c44 100%);
    background: linear-gradient(top, #323c44 0%, #fff 20%,#fff 80%, #323c44 100%);

}
.video_list table td{

}
.video_list h2 {
text-align:center;
color:#fff;
}
.video_list .el_video {
	border:solid 1px #b2b2b2;
	background-color:#fff;
	width:275px;
	height:225px;
	padding:10px;
	margin:10px;
	float:left;
	 -moz-box-shadow: 0 0 5px #333; /* Firefox */
    -webkit-box-shadow: 0 0 5px #333; /* Safari, Chrome */
    box-shadow: 0 0 5px #333; /* CSS3 */
	position:relative;
}
.video_list .img_box {
	width:230px;
	height:140px;
	padding:10px;
	margin:10px;
	background-color:#bfdaa5;
	border:solid 2px #5c9b56;
	 -moz-border-radius:8px; /* Firefox */
  -webkit-border-radius: 8px; /* Safari, Chrome */
  -khtml-border-radius: 8px; /* KHTML */
  border-radius: 8px; /* CSS3 */
  position:relative;
  overflow: hidden;
}
.video_list .img_box img{
	width:206px;
	height:116px;
	 -moz-border-radius:8px; /* Firefox */
  -webkit-border-radius: 8px; /* Safari, Chrome */
  -khtml-border-radius: 8px; /* KHTML */
  border-radius: 8px; /* CSS3 */
  
}
.video_list .like_box {
	width:48px;
	height:48px;
	float:right;
	margin-right:10px;
	cursor:pointer;
}
.video_list .sum_box {
	height:44px;
	line-height:44px;
	float:right;
	margin-right:5px;
	margin-top:-9px;
	font-size:20px;
	color:#2b2b8f;
}
.video_list .info {
	position:absolute;
	bottom:15px;
	left:15px;
	background-color:rgba(255,255,255,0.7);
	color:#2b2b8f;
	padding:10px 3px;
	font-size:13px;
}
.video_list .ret {
	position:absolute;
	bottom:10px;
	left:20px;
	color:#b41010;
	font-size:40px;
}
.kinofon {
	max-width:910px;
	height:20px;
	background-color:#323c44;
	background-image:url("/images/videos_img/filmstriponecell.png");
	border-top:solid 1px #323c44;
	border-bottom:solid 1px #323c44;
}
.t_img {
	position:absolute;
	left:0px;
	bottom:-6px;
	height:0px;
	width:226px;
	/*background-color:rgba(255,255,255,0.8);*/
	background-color:rgba(92,155,86,0.8);
	padding:3px;
	 -moz-border-radius:0px 0px 6px 6px; /* Firefox */
  -webkit-border-radius: 0px 0px 6px 6px; /* Safari, Chrome */
  -khtml-border-radius: 0px 0px 6px 6px; /* KHTML */
  border-radius:0px 0px 6px 6px; /* CSS3 */
text-align:center;
}
.video_list a {
	color:#fff;
}
.video_list .pravila {
	text-align:right;
}

.video_list .pravila a {
	color:#fff;
}
.video_list .pravila a:hover {
	color:#323c44;
}
#box_pravila {
	display:none;
	width:485px;
}
#box_pravila .text{
	margin:10px 0px;
}
</style>
<div id="tr"></div>
<? include "./videos/sum_like.php";?>
<div class="kinofon" ></div>
<table class="video_list" cellpadding="0" cellspacing="0"><tr><td>

	<h2><?$APPLICATION->ShowTitle();?></h2>
	<div class="pravila"><a class="fancybox" href="#box_pravila">правила конкурса</a></div>
	
		<?for($i=1;$i<=6;$i++) {?>
			<div class="el_video" id="video_<?=$i?>"><div class="info"></div><div class="ret" title="Место клипа в рейтинге."><?=$ar_ret["video_".$i]?></div>
				<div class="img_box"><a class="fancybox fancybox.ajax" href="./videos/video_<?=$i?>.php"><img src="/images/videos_img/video_<?=$i?>.jpg"><div class="t_img">Всё начинается с мечты</div></a></div>
				
				<div><div class="like_box" title="Мне нравится!"><img src="/images/videos_img/like_48.png" alt="Мне нравится"></div><div class="sum_box" title="<?=$ar_sum["video_".$i]?> чел. нравится клип"><?=$ar_sum["video_".$i]?></div></div>
			</div>	
		<?}?>		

</td></tr></table>
<div class="kinofon"></div>

<div id="box_pravila">
	<div class="kinofon" ></div>
	
	<div class="text">
		<h3>Правила проведения конкурса видеосюжетов</h3>
	</div>
	
	<div class="kinofon" ></div>
</div>

<br /><br /><br />


<script>
	$(document).ready(function() {
			
		$(".like_box").click(function() {
		  var id=$(this).parent().parent().attr("id");
		  add_like(id);
		});
		
		$(".ret").click(function() {
		  var id=$(this).parent().attr("id");
		  add_like(id);
		});

		$('.fancybox').fancybox();
		
		$('.img_box').hover(
			function(){
				$(this).children("a").children(".t_img").stop(true,true).animate({height: 50, bottom:0}, 500);
			},
			function(){
				$(this).children("a").children(".t_img").animate({height: 0, bottom:-6}, 1000);
		});
	});
		
	function add_like(id) {

			$.ajax({  
                type: "POST",
                url: "videos/ajax_add.php",  
				data: "id="+id, 
                cache: false,  
                success: function(html){ 
					//$("#tr").html(html);
					var ret=html.split('^');
					$("#"+id+" .info").html(ret[1]);
					setTimeout(function(){$("#"+id+" .info").html("")}, 3000);
					
					
					if(ret[0].trim()=="1") {
						//var date = new Date(new Date().getTime() + 86400 * 1000); // сутки от текущего времени
						var date = new Date(new Date().getTime() + 60 * 1000); // минута от текущего времени
						document.cookie = "visit_"+id+"=Y;path=/;expires=" + date.toUTCString(); // установим куку
						sum_like();
					}
                } 
		
            });
			
	}
	function sum_like() {

			$.ajax({  
                type: "POST",
                url: "videos/sum_like.php",  
				data: "fa=1", 
                cache: false,  
                success: function(html){ 
					//$("#tr").html(html);
					var rem=html.split('|');
					var ret;
					 $.each(rem, function(index, value){
						ret=value.trim().split('^');
						$("#"+ret[2]+" .sum_box").html(ret[0]);
						$("#"+ret[2]+" .sum_box").attr("title",ret[0]+" чел. нравится клип");
						$("#"+ret[2]+" .ret").html(ret[1]);
					});
				}
		
            });
			
	}

</script>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
