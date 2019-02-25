<?IncludePublicLangFile(__FILE__);?>
<style>
#gde_volna {
	display:none;
}
#gde_volna table {
	width:100%;
	cursor:pointer;
}
#gde_volna table tr {
	border:solid 1px #e2e2e2;

}
#gde_volna table tr:nth-child(odd) {
	background-color:#f2f2f2;
}
#gde_volna table td {
	padding:10px;
}
#gde_volna table td .img img {

	-moz-border-radius: 50px; /* Firefox */
  -webkit-border-radius: 50px; /* Safari, Chrome */
  -khtml-border-radius: 50px; /* KHTML */
  border-radius: 50px; /* CSS3 */ 
}
#gde_volna a{
	color:#b2b2b2;
	text-decoration:none;
}

</style>

<?include "venue/venue_array.php";?>
<div id="gde_volna">

	<table title="<?=getMessage("vibrat");?>">
		<?foreach($ar_vlm as $id => $item) {?>
			<?if($item["door"] || CSite::InGroup(array($group_id))) {?>
				<tr>
					<td style="display:none;"><?=$id?></td>
					<td style="font-weight: bold;"><?=$item["name"]?></td>
					<td><?=$item["datemin"]?></td>
					<td><?=$item["text"]?></td>
					<td width="100">
						<?//if($item["PREVIEW_PICTURE"]["ID"]) {
							 //$file_img = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_EXACT, true); //BX_RESIZE_IMAGE_PROPORTIONAL
							?>
							<div class="img"><img src="<?= $item["img"]?>" width="100" height="100"></div>
						<?//}?>
						<?//else echo "&nbsp;";?>
					</td>
					<td>
					<?if($item["info_print"]["ID"]) {?>
						<a href="<?=$item["info_print"]?>" download><img src="/images/registration_event/pdf_download_48.png"><br /><?=getMessage("detailed_information")?></a>
					<?}?>
					</td>
				</tr>
			<?}?>
		<?}?>
	</table>
</div>
<script>
$(document).ready(function(){
	$("#gde_volna table tr").click(function(){
		var id_venue=$(this).children("td:eq(0)").html();
		var name_venue=$(this).children("td:eq(1)").html();
		$("#id_venue").val(id_venue);
		$("#name_venue").val(name_venue);
		$("#gde_volna").slideToggle("slow");
		var ip=$("#ti_blo_venue input");
		pro_po(ip);
	});
});
</script>
