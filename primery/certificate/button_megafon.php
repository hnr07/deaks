<?
global $USER;
?>
<style>
.but_megafon {
	position:relative;
}
.but_megafon div{
	position:absolute;
	top:-100px;
	right:30px;
	text-align:center;
	font-size:18pt;
	background-color:#d8fde6;
	padding:10px;
	border:solid 1px #d8fde6;
	border-radius:10px;
	-webkit-box-shadow: 0px 0px 3px #1ea74f;
	-moz-box-shadow: 0px 0px 3px #1ea74f;
	box-shadow: 0px 0px 3px #1ea74f;
}
</style>
<?
include "array_user.php";

if (in_array($USER->GetLogin(), $ar_meu)) {
	?>
	<div class="but_megafon"><a href="megafon"><div><?=$USER->GetFullName();?><br /><br />Сертификат<br />
	<img src="megafon/megafon.png" width="200">
	</div></a></div>
	
	
<?
}


?>
