<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
$APPLICATION->SetTitle(GetMessage('register_site'));
 header("Location: reglament.php");// переадресация на шаблоны шапок
?>


<Br><br>
<h1><?$APPLICATION->ShowTitle();?></h1>

<div class="border-top"></div>
	<div class="left" style="width:230px;">
		<?
		// включаемая область для раздела
		$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/../user/sect_inc.php", Array(), Array(
			"MODE"      => "html",                                           // будет редактировать в веб-редакторе
			"NAME"      => "Редактирование включаемой области раздела",      // текст всплывающей подсказки на иконке
			"TEMPLATE"  => "sect_inc.php"                    // имя шаблона для нового файла
			));
		?>
	</div>
	
	<div class="right" style="width:650px; overflow:auto; min-height:350px;">





<?if($_GET['pravila']<>1):?>
<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>index.php">
<?endif;?>
<script type="text/javascript" src="/js/validate/jquery.validate.min.js"></script>
<link rel="stylesheet" href="/css/register_site.css" />
<script>
$(document).ready(function(){
//var sim="<span class='ersim'>&#10006; </span>";


	//$("#form_register form").validate();
	
    $("#form_register form").validate({
		
       rules:{
            family:{
               required: true,
            },
			name:{
                required: true,

            },
			middle_name:{
                required: true,

            },
           chk:{
                required: true,
				digits:true,
				rangelength: [6,7]
                
            },
            
       },
/*
       messages:{
          //  fam:{
             //   required: sim + " Это поле обязательно для заполнения",
          //  },
			  name:{
                required: sim + " Это поле обязательно для заполнения",

            },
			  middle_name:{
                required: sim + " Это поле обязательно для заполнения",

            },
            chk:{
                required: sim + " Это поле обязательно для заполнения",
				digits: sim + " В номере ЧК можно использовать только цифры, номер должен состоять из 6 символов",
				rangelength: sim + " Неправильный номер ЧК",

            },
         

       }
*/
    });
	
});

 </script>

 <script type="text/javascript" src="/com/register_site/lang/<?=$_lang?>/validate_message.js"></script>
 <div id="form_register">
 <br/>
<h2><?$APPLICATION->ShowTitle();?></h2>
<div class="shkala"><div class="ts_1"><?=GetMessage('step_1')?></div><div class="ts_2"><?=GetMessage('step_2')?></div>
<div class="nich"></div>
<div class="img"><img src="/images/register_site/shkala_1.png"></div>
</div>

<form action="step_2.php" method="POST">
<input type="hidden" name="ok" value="ok">
<table>
<tr>
<td><div class="tit_pol" id="family"><?=GetMessage('family')?></div></td>
<td><input type="text" name="family"  class ="fam"></td>
</tr>
<tr>
<td><div class="tit_pol"><?=GetMessage('name')?></div></td>
<td><input type="text" name="name"></td>
</tr>
<tr>
<td><div class="tit_pol"><?=GetMessage('middle_name')?></div></td>
<td><input type="text" name="middle_name"></td>
</tr>
<tr>
<td><div class="tit_pol"><?=GetMessage('chk')?></div></td>
<td><input type="text" name="chk"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" value="<?=GetMessage('next')?>"></td>
</tr>
</table>
</form>
</div>



</div>
 <div class="clear-all"></div>
<br /><br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>