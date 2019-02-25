<?IncludePublicLangFile(__FILE__);?>
<script src="/js/textchange/jquery.textchange.min.js"></script>
<link rel="stylesheet" href="/js/jquery_mobile/themes/сс_16/cc_16.min.css" />
<link rel="stylesheet" href="/js/jquery_mobile/themes/сс_16/jquery.mobile.icons.min.css" />
 <link rel="stylesheet" href="/js/jquery_mobile/themes/сс_16/structure.css" /> 
  <script src="qq/js/jquery_mobile/jquery.mobile-1.4.5.js"></script>

  <!-- Прелоадер начало -->
<style>
#loading {
width:100%;
height:100%;
position:fixed;
top: 0;
left: 0;
	background-color:rgba(255, 255, 255, 0.8);
	/*
	background-image: url(/images/loading_b.gif);
	background-position:center center;
	background-repeat: no-repeat;
	*/
z-index:3000;
display:none;	
}

#loading-center{
	width: 100%;
	height: 100%;
	position: relative;
	}
#loading-center-absolute {
	position: absolute;
	left: 50%;
	top: 50%;
	height: 50px;
	width: 300px;
	margin-top: -25px;
	margin-left: -150px;

}
.object{
	width: 18px;
	height: 18px;
	background-color: #333;
	float: left;
    margin-top: 15px;
	margin-right: 15px;
	-moz-border-radius: 50% 50% 50% 50%;
	-webkit-border-radius: 50% 50% 50% 50%;
	border-radius: 50% 50% 50% 50%;
	-webkit-animation: object 1s infinite;
	animation: object 1s infinite;
}
.object:last-child {
	margin-right: 0px;
	}

.object:nth-child(9){
	-webkit-animation-delay: 0.9s;
    animation-delay: 0.9s;
	}
.object:nth-child(8){
	-webkit-animation-delay: 0.8s;
    animation-delay: 0.8s;
	}
.object:nth-child(7){
	-webkit-animation-delay: 0.7s;
    animation-delay: 0.7s;
	}	
.object:nth-child(6){
	-webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;
	}
.object:nth-child(5){
	-webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;
	}
.object:nth-child(4){
	-webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
	}
.object:nth-child(3){
	-webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
	}
.object:nth-child(2){
	-webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
	}								

@-webkit-keyframes object{
50% {
    -ms-transform: translate(0,-50px); 
   	-webkit-transform: translate(0,-50px);
    transform: translate(0,-50px);
	}
}		
@keyframes object{
50% {
    -ms-transform: translate(0,-50px); 
   	-webkit-transform: translate(0,-50px);
    transform: translate(0,-50px);
	}
}



</style>
 

<div id="loading">
	<div id="loading-center">
		<div id="loading-center-absolute">
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
			<div class="object"></div>
		</div>
	</div>
</div>
<!-- Прелоадер конец -->
<br/>


<style>
.top_note {
		background-color:#fff;
	-moz-box-shadow:0px 0px 10px #000;
	-webkit-box-shadow:0px 0px 10px #000;
	box-shadow: 0px 0px 10px #000;
	padding:10px;
}

.hk_sp {
	font-size:16px;
	line-height:32px;
}
.dn_step {
	display:inline-block;
	width:30px;
	height:30px;
	padding:auto;
	border:solid 2px #28d8b2;
	text-align:center;
	border-radius:16px;
	background: #fff;
	margin:0px 5px 0px 15px;
	color:#28d8b2;
	font-weight: bold;
}
</style>
<div class="top_note">
<div class="hk_sp">
<div class="dn_step" id="dn_step_1">1</div> <?=GetMessage('title_n1')?> &nbsp;&nbsp; &mdash;&mdash;
<div class="dn_step" id="dn_step_2">2</div> <?=GetMessage('title_n2')?> &nbsp;&nbsp; &mdash;&mdash; 
<div class="dn_step" id="dn_step_3">3</div> <?=GetMessage('title_n3')?>
</div>


<!--<h1  class="htit">&nbsp;<?=GetMessage('TITLE_PR_REG')?>&nbsp; </h1>-->

<h2 class="attention"> &nbsp;<?=GetMessage('VN_NOTE_Z')?>&nbsp; </h2>
<div  class="htit_note">&nbsp;<?=GetMessage('TITLE_PR_REG_NOTE')?>&nbsp; </div>

<!-- График шагов регистрации  -->
<!--
<div class="grafik">
<div class="prok"></div>
<div class="circ circ_1"><div class="cext"><?=GetMessage('TITLE_STEP1')?></div></div>
<div class="circ circ_2"><div class="cext"><?=GetMessage('TITLE_STEP2')?></div></div>
<div class="circ circ_3"><div class="cext"><?=GetMessage('TITLE_STEP3')?></div></div>
<!--
<div class="circ circ_4"><div class="cext"><?=GetMessage('TITLE_STEP4')?></div></div>
<div class="circ circ_5"><div class="cext"><?=GetMessage('TITLE_STEP5')?></div></div>
<div class="circ circ_6"><div class="cext"><?=GetMessage('TITLE_STEP6')?></div></div>

</div>

-->
</div>