<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Шрифты и подключение");
?>
<style>
pre {
	font-size:10pt;
}
table td {
	border-bottom:dotted 1px #000;
}

@font-face {
    font-family: 'dincondensedcregular';
    src: url('/fonts/pt_din_condensed_cyrillic-webfont.eot');
    src: url('/fonts/pt_din_condensed_cyrillic-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('/fonts/pt_din_condensed_cyrillic-webfont.woff') format('woff'),
         url('/fonts/pt_din_condensed_cyrillic-webfont.ttf') format('truetype'),
         url('/fonts/pt_din_condensed_cyrillic-webfont.svg#dincondensedcregular') format('svg');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'gotham_probold';
    src: url('/fonts/gothaprobol-webfont.eot');
    src: url('/fonts/gothaprobol-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('/fonts/gothaprobol-webfont.woff') format('woff'),
         url('/fonts/gothaprobol-webfont.ttf') format('truetype'),
         url('/fonts/gothaprobol-webfont.svg#gotham_probold') format('svg');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'gotham_prolight';
    src: url('/fonts/gothaprolig-webfont.eot');
    src: url('/fonts/gothaprolig-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('/fonts/gothaprolig-webfont.woff') format('woff'),
         url('/fonts/gothaprolig-webfont.ttf') format('truetype'),
         url('/fonts/gothaprolig-webfont.svg#gotham_proligium') format('svg');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'gotham_promedium';
    src: url('/fonts/gothapromed-webfont.eot');
    src: url('/fonts/gothapromed-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('/fonts/gothapromed-webfont.woff') format('woff'),
         url('/fonts/gothapromed-webfont.ttf') format('truetype'),
         url('/fonts/gothapromed-webfont.svg#gotham_promedium') format('svg');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'gotham_proregular';
    src: url('/fonts/gothaproreg-webfont.eot');
    src: url('/fonts/gothaproreg-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('/fonts/gothaproreg-webfont.woff') format('woff'),
         url('/fonts/gothaproreg-webfont.ttf') format('truetype'),
         url('/fonts/gothaproreg-webfont.svg#gotham_proregular') format('svg');
    font-weight: normal;
    font-style: normal;
}

.dincondensedcregular {
	font-family: 'dincondensedcregular';
	font-size:14pt;
}
.gotham_probold {
	font-family: 'gotham_probold';
	font-size:14pt;
}
.gotham_prolight {
	font-family: 'gotham_prolight';
	font-size:14pt;
}

.gotham_promedium {
	font-family: 'gotham_promedium';
	font-size:14pt;
}

.gotham_proregular {
	font-family: 'gotham_proregular';
	font-size:14pt;
}

	
</style>
<?$ptx="qwertyuiopasdf<br />ghjklzxcvbnm<br />QWERTYUIOPASDF<br />GHJKLZXCVBNM<br />1234567890<br/>йцукенгшщзфыва<br />пролдячсмитьё<br />ЙЦУКЕНГШЩЗФЫВА<br />ПРОЛДЖЯЧСМИТЬЁ"?>
<table>
	<tr>
		<td>
			<div class="dincondensedcregular"><?=$ptx?></div>
		</td>
		<td>
			<a href="pt_din_condensed_cyrillic-webfont.zip" download title="скачать"><img src="/images/shrift_ico.png"></a>
		</td>
		<td>
<pre>
@font-face {
	font-family: 'dincondensedcregular';
	src: url('/fonts/pt_din_condensed_cyrillic-webfont.eot');
	src: url('/fonts/pt_din_condensed_cyrillic-webfontd41d.eot?#iefix') format('embedded-opentype'),
		 url('/fonts/pt_din_condensed_cyrillic-webfont.woff') format('woff'),
		 url('/fonts/pt_din_condensed_cyrillic-webfont.ttf') format('truetype'),
		 url('/fonts/pt_din_condensed_cyrillic-webfont.svg#dincondensedcregular') format('svg');
	font-weight: normal;
	font-style: normal;
	}
</pre>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<div class="gotham_probold"><?=$ptx?></div>
		</td>
		<td>
			<a href="gothaprobol-webfont.zip" download title="скачать"><img src="/images/shrift_ico.png"></a>
		</td>
		<td>
<pre>
@font-face {
	font-family: 'gotham_probold';
	src: url('/fonts/gothaprobol-webfont.eot');
	src: url('/fonts/gothaprobol-webfontd41d.eot?#iefix') format('embedded-opentype'),
		 url('/fonts/gothaprobol-webfont.woff') format('woff'),
		 url('/fonts/gothaprobol-webfont.ttf') format('truetype'),
		 url('/fonts/gothaprobol-webfont.svg#gotham_probold') format('svg');
	font-weight: normal;
	font-style: normal;
	}
</pre>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<div class="gotham_prolight"><?=$ptx?></div>
		</td>
		<td>
			<a href="gothaprolig-webfont.zip" download title="скачать"><img src="/images/shrift_ico.png"></a>
		</td>
		<td>
<pre>
@font-face {
    font-family: 'gotham_prolight';
    src: url('../fonts/gothaprolig-webfont.eot');
    src: url('../fonts/gothaprolig-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('../fonts/gothaprolig-webfont.woff') format('woff'),
         url('../fonts/gothaprolig-webfont.ttf') format('truetype'),
         url('../fonts/gothaprolig-webfont.svg#gotham_proligium') format('svg');
    font-weight: normal;
    font-style: normal;
	}
</pre>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<div class="gotham_promedium"><?=$ptx?></div>
		</td>
		<td>
			<a href="gothapromed-webfont.zip" download title="скачать"><img src="/images/shrift_ico.png"></a>
		</td>
		<td>
<pre>
@font-face {
    font-family: 'gotham_promedium';
    src: url('../fonts/gothapromed-webfont.eot');
    src: url('../fonts/gothapromed-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('../fonts/gothapromed-webfont.woff') format('woff'),
         url('../fonts/gothapromed-webfont.ttf') format('truetype'),
         url('../fonts/gothapromed-webfont.svg#gotham_promedium') format('svg');
    font-weight: normal;
    font-style: normal;
	}
</pre>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<div class="gotham_proregular"><?=$ptx?></div>
		</td>
		<td>
			<a href="gothaproreg-webfont.zip" download title="скачать"><img src="/images/shrift_ico.png"></a>
		</td>
		<td>
<pre>
@font-face {
    font-family: 'gotham_proregular';
    src: url('../fonts/gothaproreg-webfont.eot');
    src: url('../fonts/gothaproreg-webfontd41d.eot?#iefix') format('embedded-opentype'),
         url('../fonts/gothaproreg-webfont.woff') format('woff'),
         url('../fonts/gothaproreg-webfont.ttf') format('truetype'),
         url('../fonts/gothaproreg-webfont.svg#gotham_proregular') format('svg');
    font-weight: normal;
    font-style: normal;
	}
</pre>
		</td>
		
	</tr>
	
	<tr>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>
	
	<tr>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>
	
	<tr>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>






</table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>