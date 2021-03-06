<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Специальные символы HTML");
?>
<style>
.tb_code_html {
	width:100%;
	border-collapse: collapse;
}
.tb_code_html th{
	background-color: #623790;
	color:#fff;
	padding:5px 20px;
	border-left:solid 1px #fff;
}
.tb_code_html th:nth-child(1) {
	border-left:solid 1px #623790;
}
.tb_code_html td{

	color:#333;
	padding:5px 20px;
	border:solid 1px #623790;
}
</style>

<table class="tb_code_html">
<tbody><tr>
<th>символ</th>
<th>html-код</th>
<th>десятичный<br>код</th>
<th>описание</th>
</tr>
<tr><th colspan="4" style="border-top:solid 1px #fff;">разметка</th></tr>
<tr><td><span style="background:gray">&nbsp;</span>	</td><td>&amp;nbsp;	</td><td>&amp;#160;</td><td>неразрывный пробел</td></tr>
<tr><td><span style="background:gray"> </span>	</td><td>&amp;ensp;	</td><td>&amp;#8194;</td><td>узкий пробел (еn-шириной в букву n)</td></tr>
<tr><td><span style="background:gray"> </span>	</td><td>&amp;emsp;	</td><td>&amp;#8195;</td><td>широкий пробел (em-шириной в букву m)</td></tr>
<tr><td>–</td><td>&amp;ndash;</td><td>&amp;#8211;</td><td>узкое тире (en-тире)</td></tr>
<tr><td>—</td><td>&amp;mdash;</td><td>&amp;#8212;</td><td>широкое тире (em -тире)</td></tr>
    <tr><td>­</td><td>&amp;shy;</td><td>&amp;#173;</td><td>мягкий перенос</td></tr>
    <tr><td>а́</td><td>&nbsp;</td><td>&amp;#769;</td><td>ударение, ставится после "ударной" буквы</td></tr>


<tr><td>©</td><td>&amp;copy;</td><td>&amp;#169;</td><td>копирайт</td></tr>
<tr><td>®</td><td>&amp;reg;</td><td>&amp;#174;</td><td>знак зарегистрированной торговой марки</td></tr>
<tr><td>™</td><td>&amp;trade;</td><td>&amp;#8482;</td><td>знак торговой марки</td></tr>
<tr><td>º</td><td>&amp;ordm;</td><td>&amp;#186;</td><td>копье Марса</td></tr>
<tr><td>ª</td><td>&amp;ordf;</td><td>&amp;#170;</td><td>зеркало Венеры</td></tr>
<tr><td>‰</td><td>&amp;permil;</td><td>&amp;#8240;</td><td>промилле</td></tr>
<tr><td style="font-size:23pt;font-family:Times New Roman,serif;">π</td><td>&amp;pi;</td><td>&amp;#960;</td><td>пи (используйте Times New Roman)</td></tr>
<tr><td>¦</td><td>&amp;brvbar;</td><td>&amp;#166;</td><td>вертикальный пунктир	</td></tr>
<tr><td>§</td><td>&amp;sect;</td><td>&amp;#167;</td><td>параграф</td></tr>
<tr><td>°</td><td>&amp;deg;</td><td>&amp;#176;</td><td>градус</td></tr>
<tr><td>µ</td><td>&amp;micro;</td><td>&amp;#181;</td><td>знак "микро"</td></tr>
<tr><td>¶</td><td>&amp;para;</td><td>&amp;#182;</td><td>знак абзаца</td></tr>
<tr><td>…</td><td>&amp;hellip;</td><td>&amp;#8230;</td><td>многоточие		</td></tr>
<tr><td>‾</td><td>&amp;oline;</td><td>&amp;#8254;</td><td>надчеркивание		</td></tr>
<tr><td>´</td><td>&amp;acute;</td><td>&amp;#180;</td><td>знак ударения		</td></tr>
<tr><td>№</td><td>&nbsp;</td><td>&amp;#8470;</td><td>знак номера</td></tr>
<tr><th colspan="4">иконки</th></tr>
    <tr><td>🔍</td><td>&nbsp;</td><td>&amp;#128269;</td><td>Лупа (наклонённая влево)</td></tr>
    <tr><td>🔎</td><td>&nbsp;</td><td>&amp;#128270;</td><td>Лупа (наклонённая вправо)</td></tr>
    <tr><td>☎</td><td>&nbsp;</td><td>&amp;#9742;</td><td>Телефон</td></tr>
    <tr><td>✉</td><td>&nbsp;</td><td>&amp;#9993;</td><td>Конверт, email, почта</td></tr>
    <tr><td>💾</td><td>&nbsp;</td><td>&amp;#128190;</td><td>Дискета</td></tr>
    <tr><td>🛠</td><td>&nbsp;</td><td>&amp;#128736;</td><td>Молоток и гаечный ключ, настройка</td></tr>
    <tr><td>🔒</td><td>&nbsp;</td><td>&amp;#128274;</td><td>Замок закрыт</td></tr>
    <tr><td>🔓</td><td>&nbsp;</td><td>&amp;#128275;</td><td>Замок открыт</td></tr>
    <tr><td>🔔</td><td>&nbsp;</td><td>&amp;#128276;</td><td>Колокольчик</td></tr>
    <tr><td>🔕</td><td>&nbsp;</td><td>&amp;#128277;</td><td>Колокольчик перечеркнутый</td></tr>
    <tr><td>🗑</td><td>&nbsp;</td><td>&amp;#128465;</td><td>Урна</td></tr>
    <tr><td>🔥</td><td>&nbsp;</td><td>&amp;#128293;</td><td>Огонь</td></tr>
    <tr><td>🛇</td><td>&nbsp;</td><td>&amp;#128711;</td><td>Запрещено</td></tr>
    <tr><td>⛔</td><td>&nbsp;</td><td>&amp;#9940;</td><td>Вход запрещен (кирпич)</td></tr>
    <tr><td>⛳</td><td>&nbsp;</td><td>&amp;#9971;</td><td>Фраг в воронке, местоположение, место встречи, гольф</td></tr>

    <tr><th colspan="4">знаки арифметических и математических операций</th></tr>
<tr><td>×</td><td>&amp;times;</td><td>&amp;#215;</td><td>умножить</td></tr>
<tr><td>÷</td><td>&amp;divide;	</td><td>&amp;#247;</td><td>разделить</td></tr>
<tr><td>&lt;</td><td>&amp;lt;	</td><td>&amp;#60;</td><td>меньше</td></tr>
<tr><td>&gt;</td><td>&amp;gt;	</td><td>&amp;#62;</td><td>больше</td></tr>
<tr><td>±</td><td>&amp;plusmn;	</td><td>&amp;#177;</td><td>плюс/минус</td></tr>
<tr><td>¹</td><td>&amp;sup1;	</td><td>&amp;#185;</td><td>степень 1</td></tr>
<tr><td>²</td><td>&amp;sup2;	</td><td>&amp;#178;</td><td>степень 2</td></tr>
<tr><td>³</td><td>&amp;sup3;	</td><td>&amp;#179;</td><td>степень 3</td></tr>
<tr><td>¬</td><td>&amp;not;	</td><td>&amp;#172;</td><td>отрицание</td></tr>
<tr><td>¼</td><td>&amp;frac14;	</td><td>&amp;#188;</td><td>одна четвертая</td></tr>
<tr><td>½</td><td>&amp;frac12;	</td><td>&amp;#189;</td><td>одна вторая</td></tr>
<tr><td>¾</td><td>&amp;frac34;	</td><td>&amp;#190;</td><td>три четверти</td></tr>
<tr><td>⁄</td><td>&nbsp;frasl;	</td><td>&amp;#8260;</td><td>дробная черта</td></tr>
<tr><td>−</td><td>&nbsp;minus;	</td><td>&amp;#8722;</td><td>минус</td></tr>
<tr><td>≤</td><td>&amp;le;	</td><td>&amp;#8804;</td><td>меньше или равно</td></tr>
<tr><td>≥</td><td>&amp;ge;	</td><td>&amp;#8805;</td><td>больше или равно</td></tr>
<tr><td>≈</td><td>&amp;asymp;	</td><td>&amp;#8776;</td><td>приблизительно (почти) равно</td></tr>
<tr><td>≠</td><td>&amp;ne;	</td><td>&amp;#8800;</td><td>не равно</td></tr>
<tr><td>≡</td><td>&amp;equiv;	</td><td>&amp;#8801;</td><td>тождественно</td></tr>
<tr><td>√</td><td>&amp;radic;	</td><td>&amp;#8730;</td><td>квадратный корень (радикал)	</td></tr>
<tr><td>∞</td><td>&amp;infin;	</td><td>&amp;#8734;</td><td>бесконечность		</td></tr>
<tr><td>∑</td><td>&amp;sum;	</td><td>&amp;#8721;</td><td>знак суммирования		</td></tr>
<tr><td>∏</td><td>&amp;prod;	</td><td>&amp;#8719;</td><td>знак произведения		</td></tr>
<tr><td>∂</td><td>&amp;part;	</td><td>&amp;#8706;</td><td>частичный дифференциал	</td></tr>
<tr><td>∫</td><td>&amp;int;	</td><td>&amp;#8747;</td><td>интеграл			</td></tr>
<tr><td>∀</td><td>&amp;forall;	</td><td>&amp;#8704;</td><td>для всех (видно только если жирным шрифтом)</td></tr>
<tr><td>∃</td><td>&amp;exist;	</td><td>&amp;#8707;</td><td>существует</td></tr>
<tr><td>∅</td><td>&amp;empty;	</td><td>&amp;#8709;</td><td>пустое множество</td></tr>
<tr><td>Ø</td><td>&amp;Oslash;	</td><td>&amp;#216;</td><td>диаметр</td></tr>
<tr><td>∈</td><td>&amp;isin;	</td><td>&amp;#8712;</td><td>принадлежит</td></tr>
<tr><td>∉	</td><td>&amp;notin;	</td><td>&amp;#8713;</td><td>не принадлежит</td></tr>
<tr><td>∋</td><td>&amp;ni;	</td><td>&amp;#8727;</td><td>содержит</td></tr>
<tr><td>⊂</td><td>&amp;sub;	</td><td>&amp;#8834;</td><td>является подмножеством</td></tr>
<tr><td>⊃</td><td>&amp;sup;	</td><td>&amp;#8835;</td><td>является надмножеством</td></tr>
<tr><td>⊄</td><td>&amp;nsub;	</td><td>&amp;#8836;</td><td>не является подмножеством</td></tr>
<tr><td>⊆</td><td>&amp;sube;	</td><td>&amp;#8838;</td><td>является подмножеством либо равно</td></tr>
<tr><td>⊇</td><td>&amp;supe;	</td><td>&amp;#8839;</td><td>является надмножеством либо равно</td></tr>
<tr><td>⊕</td><td>&amp;oplus;	</td><td>&amp;#8853;</td><td>плюс в кружке</td></tr>
<tr><td>⊗</td><td>&amp;otimes;	</td><td>&amp;#8855;</td><td>знак умножения в кружке </td></tr>
<tr><td>⊥</td><td>&amp;perp;	</td><td>&amp;#8869;</td><td>перпендикулярно</td></tr>
<tr><td>∠</td><td>&amp;ang;	</td><td>&amp;#8736;</td><td>угол</td></tr>
<tr><td>∧</td><td>&amp;and;	</td><td>&amp;#8743;</td><td>логическое И</td></tr>
<tr><td>∨</td><td>&amp;or;	</td><td>&amp;#8744;</td><td>логическое ИЛИ</td></tr>
<tr><td>∩</td><td>&amp;cap;	</td><td>&amp;#8745;</td><td>пересечение</td></tr>
<tr><td>∪</td><td>&amp;cup;	</td><td>&amp;#8746;</td><td>объединение</td></tr>

<tr><th colspan="4">знаки валют</th></tr>
<tr><td>€	</td><td>&amp;euro;	</td><td>&amp;#8364;</td><td>Евро	</td></tr>
<tr><td>¢	</td><td>&amp;cent;	</td><td>&amp;#162;</td><td>Цент	</td></tr>
<tr><td>£	</td><td>&amp;pound;	</td><td>&amp;#163;</td><td>Фунт	</td></tr>
<tr><td>¤	</td><td>&amp;current;	</td><td>&amp;#164;</td><td>Знак валюты	</td></tr>
<tr><td>¥	</td><td>&amp;yen;	</td><td>&amp;#165;</td><td>Знак йены и юаня</td></tr>
<tr><td>ƒ	</td><td>&amp;fnof;	</td><td>&amp;#402;</td><td>Знак флорина</td></tr>
    <tr><td>₽	</td><td>&nbsp;	</td><td>&amp;#8381;</td><td>Знак рубля</td></tr>

<tr><th colspan="4">маркеры, птички, галочки, check mark</th></tr>
<tr><td>•		</td><td>&amp;bull;	</td><td>&amp;#8226;</td><td>простой маркер	</td></tr>
<tr><td>○		</td><td>&nbsp; 	</td><td>&amp;#9675;</td><td>круг	</td></tr>
<tr><td>·		</td><td>&amp;middot;	</td><td>&amp;#183;</td><td>средняя точка	</td></tr>
<tr><td>†		</td><td>&nbsp;		</td><td>&amp;#8224;</td><td>крестик		</td></tr>
<tr><td>‡		</td><td>&nbsp;		</td><td>&amp;#8225;</td><td>двойной крестик	</td></tr>
<tr><td>♠		</td><td>&amp;spades;	</td><td>&amp;#9824;</td><td>пики		</td></tr>
<tr><td>♣		</td><td>&amp;clubs;	</td><td>&amp;#9827;</td><td>трефы		</td></tr>
<tr><td>♥		</td><td>&amp;hearts;	</td><td>&amp;#9829;</td><td>червы		</td></tr>
<tr><td>♦		</td><td>&amp;diams;	</td><td>&amp;#9830;</td><td>бубны		</td></tr>
<tr><td>◊		</td><td>&amp;loz;	</td><td>&amp;#9674;</td><td>ромб		</td></tr>
    <tr><td>❤    </td><td>&nbsp;		</td><td>&amp;#10084;</td><td>жирное сердце	</td></tr>
    <tr><td>✓    </td><td>&nbsp;		</td><td>&amp;#10003;</td><td>Символ галочка	</td></tr>
    <tr><td>✔    </td><td>&nbsp;		</td><td>&amp;#10004;</td><td>Жирная отметка галочкой	</td></tr>
    <tr><td>𐄂    </td><td>&nbsp;		</td><td>&amp;#65794;</td><td>Крестик	</td></tr>
    <tr><td>🗸    </td><td>&nbsp;		</td><td>&amp;#128504;</td><td>Тонкая галочка	</td></tr>
    <tr><td>✅    </td><td>&nbsp;		</td><td>&amp;#9989;</td><td>Жирная незакрашенная отметка галочка	</td></tr>
    <tr><td>☑    </td><td>&nbsp;		</td><td>&amp;#9745;</td><td>Галочка в квадрате</td></tr>
    <tr><td>🗹    </td><td>&nbsp;		</td><td>&amp;#128505;</td><td>Жирная галочка в квадрате	</td></tr>
    <tr><td>⚠    </td><td>&nbsp;		</td><td>&amp;#9888;</td><td>Внимание!	</td></tr>

    <tr><th colspan="4">карандаши, перья, кисти</th></tr>
    <tr><td>✍		</td><td>&nbsp;		</td><td>&amp;#9997;</td><td>пишущая рука		</td></tr>
    <tr><td>✎		</td><td>&nbsp;		</td><td>&amp;#9998;</td><td>карандаш, направленный вправо-вниз		</td></tr>
<tr><td>✏		</td><td>&nbsp;		</td><td>&amp;#9999;</td><td>карандаш		</td></tr>
    <tr><td>✐	</td><td>&nbsp;		</td><td>&amp;#10000;</td><td>карандаш, направленный вправо-вверх		</td></tr>
    <tr><td>✑		</td><td>&nbsp;		</td><td>&amp;#10001;</td><td>незакрашенное острие пера		</td></tr>
    <tr><td>✒		</td><td>&nbsp;		</td><td>&amp;#10002;</td><td>закрашенное острие пера		</td></tr>
    <tr><td>🖌		</td><td>&nbsp;		</td><td>&amp;#128396;</td><td>кисть, направленная влево-вниз		</td></tr>

<tr><th colspan="4">кавычки</th></tr>
<tr><td>"		</td><td>&amp;quot;	</td><td>&amp;#34;</td><td>двойная кавычка</td></tr>
<tr><td>&amp;		</td><td>&amp;amp;	</td><td>&amp;#38;</td><td>амперсанд</td></tr>
<tr><td>«		</td><td>&amp;laquo;	</td><td>&amp;#171;</td><td>левая типографская кавычка (кавычка-елочка) </td></tr>
<tr><td>»		</td><td>&amp;raquo;	</td><td>&amp;#187;</td><td>правая типографская кавычка (кавычка-елочка)</td></tr>
<tr><td>‹		</td><td>&nbsp;		</td><td>&amp;#8249;</td><td>одиночная угловая кавычка открывающая	</td></tr>
<tr><td>›		</td><td>&nbsp;		</td><td>&amp;#8250;</td><td>одиночная угловая кавычка закрывающая	</td></tr>
<tr><td>′		</td><td>&amp;prime;	</td><td>&amp;#8242;</td><td>штрих (минуты, футы)			</td></tr>
<tr><td>″		</td><td>&amp;Prime;	</td><td>&amp;#8243;</td><td>двойной штрих (секунды, дюймы)		</td></tr>
<tr><td>‘		</td><td>&amp;lsquo;	</td><td>&amp;#8216;</td><td>левая верхняя одиночная кавычка		</td></tr>
<tr><td>’		</td><td>&amp;rsquo;	</td><td>&amp;#8217;</td><td>правая верхняя одиночная кавычка	</td></tr>
<tr><td>‚		</td><td>&amp;sbquo;	</td><td>&amp;#8218;</td><td>правая нижняя одиночная кавычка		</td></tr>
<tr><td>“		</td><td>&amp;ldquo;	</td><td>&amp;#8220;</td><td>кавычка-лапка левая			</td></tr>
<tr><td>”		</td><td>&amp;rdquo;	</td><td>&amp;#8221;</td><td>кавычка-лапка правая верхняя		</td></tr>
<tr><td>„		</td><td>&amp;bdquo;	</td><td>&amp;#8222;</td><td>кавычка-лапка правая нижняя		</td></tr>
<tr><td>❛	</td><td>&nbsp;		</td><td>&amp;#10075;</td><td>одиночная английская кавычка открывающая</td></tr>
<tr><td>❜	</td><td>&nbsp;		</td><td>&amp;#10076;</td><td>одиночная английская кавычка закрывающая</td></tr>
<tr><td>❝	</td><td>&nbsp;		</td><td>&amp;#10077;</td><td>двойная английская кавычка открывающая</td></tr>
<tr><td>❞	</td><td>&nbsp;		</td><td>&amp;#10078;</td><td>двойная английская кавычка закрывающая</td></tr>

<tr><th colspan="4">стрелки</th></tr>
<tr><td>←</td><td>&amp;larr;	</td><td>&amp;#8592;</td><td>стрелка влево	</td></tr>
<tr><td>↑</td><td>&amp;uarr;	</td><td>&amp;#8593;</td><td>стрелка вверх 	</td></tr>
<tr><td>→</td><td>&amp;rarr;	</td><td>&amp;#8594;</td><td>стрелка вправо	</td></tr>
<tr><td>↓</td><td>&amp;darr;	</td><td>&amp;#8595;</td><td>стрелка вниз  	</td></tr>
<tr><td>↔</td><td>&amp;harr;	</td><td>&amp;#8596;</td><td>стрелка влево и вправо</td></tr>
<tr><td>↕</td><td>&nbsp;		</td><td>&amp;#8597;</td><td>стрелка вверх и вниз</td></tr>
<tr><td>↵</td><td>&amp;crarr;		</td><td>&amp;#8629;</td><td>возврат каретки</td></tr>
<tr><td>⇐</td><td>&amp;lArr;	</td><td>&amp;#8656;</td><td>двойная стрелка влево	</td></tr>
<tr><td>⇑</td><td>&amp;uArr;	</td><td>&amp;#8657;</td><td>двойная стрелка вверх 	</td></tr>
<tr><td>⇒</td><td>&amp;rArr;	</td><td>&amp;#8658;</td><td>двойная стрелка вправо	</td></tr>
<tr><td>⇓</td><td>&amp;dArr;	</td><td>&amp;#8659;</td><td>двойная стрелка вниз  	</td></tr>
<tr><td>⇔</td><td>&amp;hArr;	</td><td>&amp;#8660;</td><td>двойная стрелка влево и вправо</td></tr>
<tr><td>⇕</td><td>&nbsp;</td><td>&amp;#8661;</td><td>двойная стрелка вверх и вниз</td></tr>
<tr><td>▲</td><td>&nbsp;</td><td>&amp;#9650;</td><td>треугольная стрелка вверх </td></tr>
<tr><td>▼</td><td>&nbsp;</td><td>&amp;#9660;</td><td>треугольная стрелка вниз  </td></tr>
<tr><td>►</td><td>&nbsp;</td><td>&amp;#9658;</td><td>треугольная стрелка вправо</td></tr>
<tr><td>◄</td><td>&nbsp;</td><td>&amp;#9668;</td><td>треугольная стрелка влево </td></tr>

<tr><th colspan="4">звездочки, снежинки</th></tr>
<tr><td>☃		</td><td>&nbsp;	</td><td>&amp;#9731;</td><td>Снеговик</td></tr>
<tr><td>❄	</td><td>&nbsp;	</td><td>&amp;#10052;</td><td>Снежинка</td></tr>
<tr><td>❅	</td><td>&nbsp;	</td><td>&amp;#10053;</td><td>Зажатая трилистниками снежинка</td></tr>
<tr><td>❆	</td><td>&nbsp;	</td><td>&amp;#10054;</td><td>Жирная остроугольная снежинка</td></tr>
<tr><td>★		</td><td>&nbsp;	</td><td>&amp;#9733;</td><td>Закрашенная звезда</td></tr>
<tr><td>☆		</td><td>&nbsp;	</td><td>&amp;#9734;</td><td>Незакрашенная звезда</td></tr>
<tr><td>✪	</td><td>&nbsp;	</td><td>&amp;#10026;</td><td>Незакрашенная звезда в закрашенном круге</td></tr>
<tr><td>✫	</td><td>&nbsp;	</td><td>&amp;#10027;</td><td>Закрашенная звезда с незакрашенным кругом внутри</td></tr>
<tr><td>✯	</td><td>&nbsp;	</td><td>&amp;#10031;</td><td>Вращающаяся звезда</td></tr>
<tr><td>⚝		</td><td>&nbsp;	</td><td>&amp;#9885;</td><td>Начерченная белая звезда</td></tr>
<tr><td>⚪		</td><td>&nbsp;	</td><td>&amp;#9898;</td><td>Средний незакрашенный круг</td></tr>
<tr><td>⚫		</td><td>&nbsp;	</td><td>&amp;#9899;</td><td>Средний закрашенный круг</td></tr>
<tr><td>⚹		</td><td>&nbsp;	</td><td>&amp;#9913;</td><td>Секстиле (типа снежинка)</td></tr>
<tr><td>✵	</td><td>&nbsp;	</td><td>&amp;#10037;</td><td>Восьмиконечная вращающаяся звезда</td></tr>
<tr><td>❉	</td><td>&nbsp;	</td><td>&amp;#10057;</td><td>Звёздочка с шарообразными окончаниями</td></tr>
<tr><td>❋	</td><td>&nbsp;	</td><td>&amp;#10059;</td><td>Жирная восьмиконечная каплеобразная звёздочка-пропеллер</td></tr>
<tr><td>✺	</td><td>&nbsp;	</td><td>&amp;#10042;</td><td>Шестнадцатиконечная звёздочка</td></tr>
<tr><td>✹	</td><td>&nbsp;	</td><td>&amp;#10041;</td><td>Двенадцатиконечная закрашенная звезда</td></tr>
<tr><td>✸	</td><td>&nbsp;	</td><td>&amp;#10040;</td><td>Жирная восьмиконечная прямолинейная закрашенная звезда</td></tr>
<tr><td>✶	</td><td>&nbsp;	</td><td>&amp;#10038;</td><td>Шестиконечная закрашенная звезда</td></tr>
<tr><td>✷	</td><td>&nbsp;	</td><td>&amp;#10039;</td><td>Восьмиконечная прямолинейная закрашенная звезда</td></tr>
<tr><td>✴	</td><td>&nbsp;	</td><td>&amp;#10036;</td><td>Восьмиконечная закрашенная звезда</td></tr>
<tr><td>✳	</td><td>&nbsp;	</td><td>&amp;#10035;</td><td>Восьмиконечная звёздочка</td></tr>
<tr><td>✲	</td><td>&nbsp;	</td><td>&amp;#10034;</td><td>Звёздочка с незакрашенным центром</td></tr>
<tr><td>✱	</td><td>&nbsp;	</td><td>&amp;#10033;</td><td>Жирная звёздочка</td></tr>
<tr><td>✧	</td><td>&nbsp;	</td><td>&amp;#10023;</td><td>Заострённая четырёхконечная незакрашенная звезда</td></tr>
<tr><td>✦	</td><td>&nbsp;	</td><td>&amp;#10022;</td><td>Заострённая четырёхконечная закрашенная звезда</td></tr>
<tr><td>⍟		</td><td>&nbsp;	</td><td>&amp;#9055;</td><td>Звезда в круге</td></tr>
<tr><td>⊛		</td><td>&nbsp;	</td><td>&amp;#8859;</td><td>Снежинка в круге</td></tr>

<tr><th colspan="4">часы, время</th></tr>
<tr><td>⏰		</td><td>&nbsp;	</td><td>&amp;#9200;</td><td>Будильник</td></tr>
<tr><td>⌚		</td><td>&nbsp;	</td><td>&amp;#8986;</td><td>Наручные часы</td></tr>
<tr><td>⌛		</td><td>&nbsp;	</td><td>&amp;#8987;</td><td>Песочные часы</td></tr>
<tr><td>⏳		</td><td>&nbsp;	</td><td>&amp;#9203;</td><td>Песочные часы</td></tr>
    <tr><td>🕰		</td><td>&nbsp;	</td><td>&amp;#128368;</td><td>Каминные часы</td></tr>


</tbody>
</table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>