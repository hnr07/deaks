<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?global $USER;?>
<? include "./functions.php"; ?>

<?
setLocale(LC_ALL, 'en_US.utf8');
$handle = fopen("./All_sales_offices.csv", "r");
while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
    $num = count($data);
	//$ar_offices[$data[0]]=$data[0]." - ".$data[1];
	$ar_offices[$data[0]]="**** - Город N";
}
fclose($handle);

?>

<?=$arResult["FORM_HEADER"];?>
<?=bitrix_sessid_post()?>

<input type="hidden" name="<?=fGetName("user",0)?>" value="<?=$USER->GetFirstName()." ".$USER->GetLastName()." (".$USER->GetLogin().") [".$USER->GetEmail()."]"?>">
<input type="hidden" name="<?=fGetName("date_filling",0)?>" value="<?=date("d.m.Y H:i")?>">


<div class="div_select">

<?=fGetQuestion("question_1")?>:<br /><br />
<select class="" name="<?=fGetName("question_1")?>" id="<?=fGetName("question_1")?>">
<?foreach($ar_offices as $key=>$val) {?>
	<option value="<?=$val?>"><?=$val?></option>
<?}?>
</select>
<!--
<?=fGetQuestion("question_10")?>:
<?=fGetHTML("question_10")?>
<br />
<?=fGetQuestion("question_11")?>:
<?=fGetHTML("question_11")?>
<br />
<?=fGetQuestion("question_12")?>:
<?=fGetHTML("question_12")?>
-->
</div>


<div class="div_select">
<?=fGetQuestion("question_2")?>:<br /><br />
<?=fGetHTML("question_2")?>
</div>
<br /><br /><br /><br /><br/><br/>
<div class="clear-all"></div>
<p>Пожалуйста, ответьте на вопросы, выбрав один из вариантов предложенных ответов.</p>
<div class="clear-all"></div>
<table class="t_ti">
<thead>
<tr><th>Вопрос</th><th>Вариант ответа</th><th>Комментарий</th></tr>

</thead>
<tr><td colspan=4></td></tr>


<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_3")?></div></td>
	<td><?=fGetHTML("question_3")?>
	</td>
	<td><textarea name="<?=fGetName("question_3_comment",0)?>"></textarea></td>
</tr>

<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_4")?></div></td>
	<td>
	<?=fGetHTML("question_4")?>
	</td>
	<td><textarea name="<?=fGetName("question_4_comment",0)?>"></textarea></td>
</tr>

<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_5")?></div></td>
	<td>
	<?=fGetHTML("question_5")?>
	</td>
	<td><textarea name="<?=fGetName("question_5_comment",0)?>"></textarea></td>
</tr>

<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_6")?></div></td>
	<td>
	<?=fGetHTML("question_6")?>
	</td>
	<td><textarea name="<?=fGetName("question_6_comment",0)?>"></textarea></td>
</tr>

<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_7")?></div></td>
	<td>
	<?=fGetHTML("question_7")?>
	</td>
	<td><textarea name="<?=fGetName("question_7_comment",0)?>"></textarea></td>
</tr>

<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_8")?></div></td>
	<td>
	<?=fGetHTML("question_8")?>
	</td>
	<td><textarea name="<?=fGetName("question_8_comment",0)?>"></textarea></td>
</tr>

<tr class="plt">
	<td><div class="zap"><?=fGetQuestion("question_9")?></div></td>
	<td>
	<?=fGetHTML("question_9")?>
	</td>
	<td><textarea name="<?=fGetName("question_9_comment",0)?>"></textarea></td>
</tr>



</table>
<br /><br />
<?=fGetQuestion("complaint")?><br /><br />
<textarea name="<?=fGetName("complaint",0)?>" style="width:97%;"></textarea>


<input id="but_submit_form" type="submit" class="" value="Отправить" name="web_form_submit">
 </form>
 <div class="div_but"><button id="but_submit" class="but_s">Отправить</button></div>
 
