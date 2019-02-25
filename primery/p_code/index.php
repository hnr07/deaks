<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Примеры кода.");
?>
<style>
.t_code {
	margin-top:20px;
	padding:10px;
	width:800px;
	height:500px;
	overflow:auto;
	border:solid 1px #b2b2b2;
}
.box_button button {
	margin-right:10px;
	border:solid 1px #b2b2b2;
		  -moz-border-radius: 3px; /* Firefox */
  -webkit-border-radius: 3px; /* Safari, Chrome */
  -khtml-border-radius: 3px; /* KHTML */
  border-radius: 3px; /* CSS3 */
}
.box_button button:hover {
	-moz-box-shadow: 0 0 5px #000; /* Firefox */
    -webkit-box-shadow: 0 0 5px #000; /* Safari, Chrome */
    box-shadow: 0 0 5px #000; /* CSS3 */
}
.box_button .b_th {
	--border:solid 1px #000;
	color:#fff;
	background-color: #b2b2b2;
	-moz-box-shadow: 0 0 5px #b2b2b2; /* Firefox */
    -webkit-box-shadow: 0 0 5px #b2b2b2; /* Safari, Chrome */
    box-shadow: 0 0 5px #b2b2b2; /* CSS3 */
}
</style>
<script>
	$(document).ready(function(){
		 $('button').click(function(){
		$('button').removeClass('b_th');
		$(this).addClass('b_th');
		});
	});
	function ajax_code(in_file) {
		$.ajax({ 
				type: "POST",			
                url: in_file,
				data: '',  
                cache: false,  
                success: function(html){  
                    $(".t_code pre").html(html); 				
                }  
        });	
	}
	
</script>
<h2>Примеры кода</h2>
<div class="box_button">
<button type="button" class="b_th" onclick="ajax_code('code_html.php')"> PHP + html </button>
<button type="button" onclick="ajax_code('code_php.php')"> PHP </button>
<button type="button" onclick="ajax_code('code_js.php')"> javascript </button>
<button type="button" onclick="ajax_code('code_comp.php')"> компонент Битрикс </button>
<button type="button" onclick="ajax_code('code_api.php')"> html + API Битрикс </button>
<button type="button" onclick="ajax_code('code_css.php')"> CSS </button>

</div>
<div class="t_code">
<pre>

<?include "code_html.php";?>

</pre>
</div>

<div class="clear-all"></div>
<br /><br /><br /><br /> <br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>