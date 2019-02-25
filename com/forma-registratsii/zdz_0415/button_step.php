<!-- Кнопки -->

<div class="cont_but">

<!-- кнопка к шагу ... не активная -->
<input id="but_bot_3" type="button" class="vst" value="<?=getMessage("BUT_BOT_3")?> <?=($t_step+1)?>" onclick="sub_form()">

<!-- кнопка к шагу ...  активная -->

<?if($t_step==3) { // Для третьего шага перехват клика для проверки ?>

<input id="but_bot_3_a" type="button" class="vst" value="<?=getMessage("BUT_BOT_3")?> <?=($t_step+1)?>" onclick="old_show_check()" hidden> 
<div class="but_preloader"><br /><b><?=getMessage("going_verification")?></b><br /><br /><img src="/images/registration_event/proc_3.gif"></div>
<input id="gud"  name="web_form_submit" type="submit" class="vst" value="<?=getMessage("BUT_BOT_3")?> <?=($t_step+1)?>" style="visibility:hidden">

<?}else{?>

<input id="but_bot_3_a" name="web_form_submit" type="submit" class="vst" value="<?=getMessage("BUT_BOT_3")?> <?=($t_step+1)?>">
<div class="but_preloader"><br /><b><?=getMessage("going_verification")?></b><br /><br /><img src="/images/registration_event/proc_3.gif"></div>

<?}?>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("a.gallery").fancybox();
	});
</script>
