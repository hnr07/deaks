<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Домохозяйки правят миром.");
global $USER;

include "config.php";

?>
<link rel="stylesheet" type="text/css" href="/css/private_office.css" />
<link rel="stylesheet" type="text/css" href="./style.css" />

<script type="text/javascript">
		$(document).ready(function() {
			$("a.gallery").fancybox();
		});
</script>
<style>
.lazy {
 display: none;
}
</style>
	<Br><br>
<h1><?$APPLICATION->ShowTitle();?> Альбом</h1>
<?
if ($USER->IsAuthorized()) {
	$fio=$USER->GetFullName();

	if ($handle = opendir($dir_albom_min)) {
		while (false !== ($file = readdir($handle))) { 
			if($file!="." && $file!="..") {
				$ar_file=explode("_",$file);
				$ar_files[$ar_file[2]][]=$file;
			}
		}
    }

    closedir($handle); 
//echo "<pre>"; print_r($ar_files); echo "</pre>";
	?>
<div class="border-top"></div>
<div class="private_office">
	<div class="left" style="width:200px;">

		
	 <?	 include "sect_inc.php";?>
		
	</div>

	<div class="right">
	
	
		<?foreach($ar_files as $login=>$val) {?>
			 <?
				$rsUser = CUser::GetByLogin($login);
				$arUser = $rsUser->Fetch();
				//echo "<pre>"; print_r($arUser); echo "</pre>";
			 foreach($val as $res) {
				$inf_img=getimagesize ($dir_albom_min."/".$res);
				//echo "111<pre>"; print_r($inf_img); echo "</pre>";
				?>
				<div class="fon_fo">
					<a href="<?=$dir_albom."/".$res?>" class="gallery" rel="group" title="<?=$arUser["LAST_NAME"]." ".$arUser["NAME"]?>">
						<img src="<?=$dir_albom_min."/".$res?>?d=<?=date("His")?>" class="lazy" data-original="<?=$dir_albom_min."/".$res?>" <?=$inf_img[3]?> style="margin-top:<?=(300-$inf_img[1])/2?>px;">
					</a>
				</div>
				

			<?}?>
		<?}?>
	</div>

</div>
	
	
	<?
}

else echo "Нет доступа";
?>
<Div class="clear-all"></div>
<br /><br /><br /><br />
<script src="/js/infinity/jquery.lazyload.js" type="text/javascript" charset="utf-8"></script>

<script>
$(function() {
    $("img.lazy").show().lazyload({
		effect : "fadeIn",
		failure_limit: 1,
	});
});

</script>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>