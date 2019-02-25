<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<style>
.res_co a {
	color:#623790;
	text-decoration:none;
}
.res_co a:hover {
	color:rgba(98, 55, 144, 0.7);
}
.res_co .box_img {
	width:18px;
	height:30px;
	background:url(/images/document_image_24.png) no-repeat;
	background-size: contain;
	margin-left:20px;
}
.res_co table {
	width:90%;
	margin:20px 10px;
	 border-collapse:collapse;
}
.res_co table tr:nth-child(2n+2){
	background-color:#faf6fe;
}
.res_co table td{
	padding:10px;
}
.res_co table td.td_img{
	width:40px;
}
.res_co .res_co_box{
	padding:20px;margin:40px;  
	-moz-box-shadow:0px 0px 5px #623790;
	-webkit-box-shadow:0px 0px 5px #623790;
	box-shadow: 0px 0px 5px #623790;
}
.res_co .res_co_box hr {
	background-color:#623790;
	color:#623790;
	border:0;
}
.sh_time {
/*text-shadow: 0px 0px 10px #623790;*/
padding:5px;
letter-spacing:1px;
}
.sh_name {
	float:left;
	width:30%;
	box-sizing: border-box;
	padding:5px;
}
.sh_prof {
	float:left;
	width:70%;
	padding:5px;
	box-sizing: border-box;
}
strong {
letter-spacing:1px;
font-size:120%;
}
</style>
	<script type="text/javascript">
		$(document).ready(function() {

			$('.fancybox').fancybox({
			openEffect : 'elastic',
			openSpeed  : 150,

			closeEffect : 'elastic',
			closeSpeed  : 150,
			
			prevEffect : 'elastic',
			nextEffect : 'elastic', //'elastic' 'fade', 'none'
		});

		});

	</script>
<div class="res_co">
<div class="res_co_box" style="">
<img alt="" src="demidov_a_foto.jpg" width="300" height="250"><br>
 <br>
 Демидов Александр Николаевич<br>
<?
$happyday = "16.09.1965";
$ar_happyday=explode(".",$happyday);
$years = date("Y")-$ar_happyday[2];
if ($ar_happyday[1].$ar_happyday[0] > date('md')) {
	$years--;
}
switch($years%10) {
	case 1:$years_text="год";break;
	case 2:
	case 3:
	case 4:$years_text="года";break;
	default:$years_text="лет";
}

?>
 <strong><?=$years?> <?=$years_text?></strong><br><strong> Москва</strong><br>


<hr>
<!-- +7 977 4891147 <br>

 <a href="mailto:hnr07@mail.ru">hnr07@mail.ru</a><br>-->
 <a href="/contacts.php">Обратная связь</a><br>

<hr>
 <br>

 Желаемая должность и зарплата:  <strong>Программист Битрикс.</strong> 120 000 &#8381;<br>

 <br>
 Занятость: полная занятость<br>
 График работы: полный день<br>
 <br>
 Образование: высшее<br>

<table>
<tbody>
<tr>
	<td>
		 1989
	</td>
	<td>
		 Донецкий политехнический институт. Горловский филиал.<br>
		 Автомобильный транспорт, инженер-механик<br>
 
	</td>
	<td class="td_img">
		<a class="fancybox" href="/images/job/diplom.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
	</td>
</tr>
</tbody>
</table>
 Знание языков<br>
 <br>
 Русский — родной<br>
 <br>
 Повышение квалификации, курсы<br>
<table>
<tbody>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Администрирование системы. Часть 3<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td class="td_img">
				<a class="fancybox" href="/images/job/admin_s_3.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Администрирование системы. Часть 2<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/admin_s_2.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Администрирование системы. Часть 1<br>
				 Компания «1С-Битрикс», Сертификат<br>
 
			</td>
			<td>
				<a class="fancybox" href="/images/job/admin_s_1.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Интеграция<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/integraciya.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Элементы управления. Обучающий курс<br>
				 Компания «1С-Битрикс», Сертификат<br>
 
			</td>
			<td>
				<a class="fancybox" href="/images/job/element_upr.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Компоненты 2.0<br>
				 Компания «1С-Битрикс», Сертификат<br>
 
			</td>
			<td>
				&nbsp;
			</td>
		</tr>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Конфигурирование веб-систем для оптимальной работы<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/config.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Контент-менеджер<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/kontent_m.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Визуальный HTML-редактор<br>
				 Компания «1С-Битрикс», Сертификат
 
			</td>
			<td>
				&nbsp;
			</td>
		</tr>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Многосайтовость<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				&nbsp;
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Установка и настройка<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/ustanovka.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Администратор. Базовый<br>
				 Компания «1С-Битрикс», Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/admin_b.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>

		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Управление сайтом «Интернет-коммерция»<br>
				 Авторизованный учебный центр "Группа Махаон", Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/bitrix_comerc.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Управление сайтом «Модули»<br>
				 Авторизованный учебный центр "Группа Махаон", Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/bitrix_modul.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
		
		<tr>
			<td>
				 2011
			</td>
			<td>
				 1С-Битрикс: Управление сайтом «Базовый»<br>
				 Авторизованный учебный центр "Группа Махаон", Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/bitrix_baz.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>

		<tr>
			<td>
				 2010
			</td>
			<td>
				 Введение в конфигурирование в системе «1С:Предприятие 8». Основные объекты<br>
				 Учебный центр сертифицированного обучения "Сетевая Академия АМИ", Свидетельство<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/sert_c1.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2007
			</td>
			<td>
				 Администрирование ОС Windows XP/2000 Professional<br>
				 Национальный учебный центр "Шаг", Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/shag_admin.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2007
			</td>
			<td>
				 Аппаратное обеспечение персонального компьютера<br>
				 Национальный учебный центр "Шаг", Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/shag_apparat.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>
	
		<tr>
			<td>
				 2006
			</td>
			<td>
				 Язык сценариев JavaScript<br>
				 Национальный учебный центр "Шаг", Сертификат<br>

			</td>
			<td>
				<a class="fancybox" href="/images/job/shag_js.jpg" data-fancybox-group="gallery" title=""><div class="box_img"></div>
			</td>
		</tr>

</tbody>
</table>
 <br>
 <b>Опыт работы</b><br>
 <br>
 <table>
 <tr>
	<td><div class="sh_time">март 2016 — по настоящее время</div><div class="sh_note"><div class="sh_name">ООО "Горизонт"<br /><a href="http://4dls.pro">4dls.pro</a></div><div class="sh_prof"><strong>Программист Битрикс</strong><br />Программирование и администрирование сайтов компании.</div></div></td>
 </tr>
 <tr>
	<td><div class="sh_time">сентябрь 2012 — март 2016 (3 года 7 месяцев)</div><div class="sh_note"><div class="sh_name">Компания "Коралловый клуб"<br /><a href="http://coral-club.com">coral-club.com</a></div><div class="sh_prof"><strong>Web-программист</strong><br />Программирование и администрирование сайтов компании (Битрикс).</div></div></td>
 </tr>
 <tr>
	<td><div class="sh_time">декабрь 2010 — сентябрь 2012  (1 год 10 месяцев)</div><div class="sh_note"><div class="sh_name">ООО "Автоматика"</div><div class="sh_prof"><strong>Web-программист</strong><br />Программирование и администрирование сайтов компании.</div></div></td>
 </tr>
 <tr>
	<td><div class="sh_time">май 2008 — август 2010 (2 года 4 месяца)</div><div class="sh_note"><div class="sh_name">ООО "Нонна"</div><div class="sh_prof"><strong>Программист</strong><br />Программирование и администрирование сайтов компании.</div></div></td>
 </tr>
 <tr>
	<td><div class="sh_time">апрель 2007 — апрель 2008 (1 год 1 месяц)</div><div class="sh_note"><div class="sh_name">ООО "Парус"</div><div class="sh_prof"><strong>Консультант по программному обеспечению</strong><br />Презентация ПО. Продажа и техподдержка ПО. Консультации клиентов. Обновление ПО.</div></div></td>
 </tr>
 <tr>
	<td><div class="sh_time">сентябрь 1994 — февраль 2007 (12 лет 6 месяцев)</div><div class="sh_note"><div class="sh_name">ООО "Элис"</div><div class="sh_prof"><strong>Сервисный инженер банковского оборудования. Начальник отдела.</strong><br />Сервисное обслуживание и ремонт различного электронно-механического оборудования в том числе и специализированного. Консультации клиентов. Координация работы отдела и контроль взаимодействия с другими отделами. Начальник отдела.</div></div></td>
 </tr>

 
 </table>


 <br>
 &nbsp;<br>
 Ключевые навыки<br>
 <br>
 CMS 1С-Битрикс, HTML, PHP+MySQL, CSS, JavaScript, jQuery, ajax, Git, Photoshop для web <br>
 <br>

 Портфолио:&nbsp;&nbsp; <a href="/portfolio/">http://<?=$_SERVER["HTTP_HOST"]?>/portfolio/</a>
 <br><br>
 Примеры работ:&nbsp;&nbsp; <a href="/primery/">http://<?=$_SERVER["HTTP_HOST"]?>/primery/</a>
 <br>
 <!--<br>Гражданство, время в пути до работы<br>-->
 <br>
 Гражданство: Россия<br>
 <!--Желательное время в пути до работы: Не имеет значения<br>-->
 </div>
 <br>
 <br>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>