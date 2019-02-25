<div class="block-countdown" style="margin-bottom:30px">
	<div class="center-wrapper">
		<div class="block-content clearfix">
			<div class="block-ttl"><span>До Мастерских каникул осталось:</span></div>
			<div class="countdown-wrapper"><div class="countdown fc"></div></div>
			
			<?if($registration) {?><a href="./registration_event/" class="button button-4 button-4-alt">Зарегистрироваться<br>сейчас</a>
			<? } else {?>
				<?if($registration_s) {?><div class="button button-4 button-4-alt">Регистрация с<br />16.11.2015<?//=$d_reg_s?></div><?}?>
				<?if($registration_f) {?><div class="button button-4 button-4-alt">Регистрация<br />закрыта</div><?}?>
			<?}?>
		</div>
	</div>
</div>
