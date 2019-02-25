<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница создания мема");
global $USER;
//
include "config.php";
include('func.php'); // функции изменения размера картинки


?>
<link rel="stylesheet" type="text/css" href="/css/private_office.css" />
<link rel="stylesheet" type="text/css" href="./style.css" />

<script type="text/javascript">
		$(document).ready(function() {
			$("a.gallery").fancybox();
		});
		
Share = {
    vkontakte: function(purl, ptitle, pimg, text) {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image='       + encodeURIComponent(pimg);
        url += '&noparse=true';
        Share.popup(url);
    },
    odnoklassniki: function(purl, text) {
        url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
        url += '&st.comments=' + encodeURIComponent(text);
        url += '&st._surl='    + encodeURIComponent(purl);
        Share.popup(url);
    },
    facebook: function(purl, ptitle, pimg, text) {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(ptitle);
        url += '&p[summary]='   + encodeURIComponent(text);
        url += '&p[url]='       + encodeURIComponent(purl);
        url += '&p[images][0]=' + encodeURIComponent(pimg);
        Share.popup(url);
    },
    twitter: function(purl, ptitle) {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(ptitle);
        url += '&url='      + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        Share.popup(url);
    },
    mailru: function(purl, ptitle, pimg, text) {
        url  = 'http://connect.mail.ru/share?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&imageurl='    + encodeURIComponent(pimg);
        Share.popup(url)
    },

    popup: function(url) {
        window.open(url,'','toolbar=0,status=0,width=626,height=436');
    }
	
};

 // function sel_a(v) {$("#"+v).select();}
</script>
	<br><br>
<h1><?//$APPLICATION->ShowTitle();?> Домохозяйки правят миром</h1>
<?

	$fio=$USER->GetFullName();
	
	if(isset($_GET['tmp'])) {
		$tmp_file=$ar_file[$_GET['tmp']]["tmp"]; // временный путь к файлу
		$result_file=$ar_file[$_GET['tmp']]["file"]; // относительный путь к результату
		$result_file_min=$ar_file[$_GET['tmp']]["min"]; // относительный путь к миниатюре 
		
		rename($tmp_file,$result_file);
		sozdatMiniaturu($result_file,$result_file_min, $size_min, $size_min);
	}
	?>
<div class="border-top"></div>
<div class="private_office">
	<div class="left" style="width:202px;">

		
	 <?	 include "sect_inc.php";?>
		
	</div>
	
	
	
	<div class="right">
		<div class="dd_res">
			<table>
			<tr><th>Мой вариант 1</th><th>Мой вариант 2</th></tr>
			<tr>
				<?foreach($ar_file as $id_img => $file) {?>
					<td>
						<?if (file_exists($file["file"])) {?>
						<a href="<?=$file["file"]?>" class="gallery" rel="group" title="<?=$fio?>">
							<img src="<?=$file["file"]?>?d=<?=date("His")?>" width="300" align="top">
						</a>
						<?} else {?>
						<a href="<?=$ar_img[$id_img]?>" class="gallery" rel="group" title="">
							<img src="<?=$ar_img[$id_img]?>?d=<?=date("His")?>" width="300" align="top">
						</a>
						<?}?>
					</td>
				<?}?>
				
			
			</tr>
			<tr>
			<?foreach($ar_file as $id_img => $file) {?>
				<td>
				<?if (file_exists($file["file"])) {?>
					<a href="<?=$file["file"]?>?tmp=<?=time()?>"  download><button class="a_download">Скачать</button></a><br /><br />
					<!--<button class="a_download" onclick="sel_a('av_<?=$id_img?>');">Ссылка на картинку</button>--> <div style="text-align:left;font-size:12px;">Ссылка на картинку <?=$id_img?><a href="<?=$dir_a.$file["file"]?>" style="float:right;" target="_blank" title="открыть в новом окне">открыть</a></div> <input type="text" id="av_<?=$id_img?>" value="<?=$dir_a.$file["file"]?>" onclick="this.select();" >
					
					<div class="div_socset_ico">
								<?
								$ar_share['URL']=$dir_a.$file["file"];
								$ar_share['IMG_PATH']=$dir_a.$file["min"];
								$ar_share['TITLE']='Домохозяйки правят миром.';
								$ar_share['DESC']='Домохозяйки правят миром.';
								?>
								
								<div class="tit">Поделиться: </div>
								<div class="b-share-icon_vkontakte" onclick="Share.vkontakte('<?=$ar_share['URL']?>','<?=$ar_share['TITLE']?>','<?=$ar_share['IMG_PATH']?>','<?=$ar_share['DESC']?>')"></div>
								<div class="b-share-icon_facebook" onclick="Share.facebook('<?=$ar_share['URL']?>','<?=$ar_share['TITLE']?>','<?=$ar_share['IMG_PATH']?>','<?=$ar_share['DESC']?>')"></div>
								<div class="b-share-icon_mail" onclick="Share.mailru('<?=$ar_share['URL']?>','<?=$ar_share['TITLE']?>','<?=$ar_share['IMG_PATH']?>','<?=$ar_share['DESC']?>')"></div>
								<div class="b-share-icon_odnoklassniki" onclick="Share.odnoklassniki('<?=$ar_share['URL']?>','<?=$ar_share['DESC']?>')"></div>
								<div class="b-share-icon_twitter" onclick="Share.twitter('<?=$ar_share['URL']?>','<?=$ar_share['TITLE']?>')"></div>
								
								<?unlink($ar_share);?>
							</div>
					
					<?if (!file_exists($file["min"])) {sozdatMiniaturu($file["file"],$file["min"], $size_min, $size_min);}?>
					<?} else {?>
						Ваш вариант не найден
					<?}?>
				</td>
			<?}?>
		
			</tr>
			</table>
		</div>
	</div>

</div>
	
	

<div class="clear-all"></div>
<br /><br /><br /><br /> <br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
