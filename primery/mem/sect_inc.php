<ul class="menu-mem">
	<li <?if($APPLICATION->GetCurPage()==$dir_o) :?> class="active"<?endif;?>><a href="<?=$dir_o?>">Мои варианты</a></li>
	<li <?if($APPLICATION->GetCurPage()==$dir_o."edit_img.php" && $_REQUEST["id_img"]==1) :?> class="active"<?endif;?>><a href="edit_img.php?id_img=1">Изменить вариант 1</a></li>
	<li <?if($APPLICATION->GetCurPage()==$dir_o."edit_img.php" && $_REQUEST["id_img"]==2) :?> class="active"<?endif;?>><a href="edit_img.php?id_img=2">Изменить вариант 2</a></li>
	<li <?if($APPLICATION->GetCurPage()==$dir_o."albom.php") :?> class="active"<?endif;?>><a href="albom.php">Альбом</a></li>
</ul>