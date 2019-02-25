<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule("sale");
// Актуальная корзина для текущего пользователя
$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID
            ),
        false,
        false,
        array("ID")
    );
while ($arItems = $dbBasketItems->Fetch())
{
	// Удаляем из корзины записи, если есть;
	CSaleBasket::Delete($arItems["ID"]);
}
		//Добавляем в корзину товар по ID
		if(count($_POST["in_cart"])>0) {
			CModule::IncludeModule("catalog");
			
			foreach($_POST["in_cart"] as $id => $sht) {
				if($sht>0) {
					$id_c=Add2BasketByProductID(
						$id, // ID товара
						$sht, // количество товара
						array(),
						array(
							//array("NAME"=>"Упаковка","CODE" => "UPAKOVKA", "VALUE" => "100")	
						)
					);
					//$_SESSION["in_cart"][]=$id_c;
				}
			}
			//if(count($_SESSION["in_cart"])>0) $_SESSION["add_cart"]="Y";
			?>
		
		<?} //unset($_SESSION["add_cart"]);?>
	<?header("Location: /".LANGUAGE_ID."/personal/basket/order.php");?>	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>