<style>

    #top_slider .item img{
        display: block;
        width: 100%;
        height: auto;
		box-sizing: border-box;
    }

</style>
<?if(CModule::IncludeModule("iblock")){?>	
<?
$el_slide = GetIBlockElementList(21, 0, Array("SORT"=>"ASC"), 10);

	while($ar_el = $el_slide->GetNext()) {
		$ar_slide[]=CFile::GetPath($ar_el["DETAIL_PICTURE"]);
	}
	//echo "<pre>";print_r($ar_slide);echo "</pre>";

?>
	 <div id="top_slider" class="owl-carousel owl-theme">
	 <?foreach($ar_slide as $src) { ?>
		<div class="item"><img src="<?=$src?>"></div>
	 <?}?>
     </div>

			
			    <script>
				
    $(document).ready(function() {
      $("#top_slider").owlCarousel({
        autoPlay : 3000,
        stopOnHover : true,
        navigation:true,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        autoHeight : true,
        transitionStyle:"fade"
      });
    });
    </script>

<?}?>