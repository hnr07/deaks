<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
// массив отелей

// площадка 1
$ar_hot["v1"]["date"][0]="19.02.2016";  // Рекомендуемые даты проживания от
$ar_hot["v1"]["date"][1]="27.02.2016";  // Рекомендуемые даты проживания до

$ar_hot["v1"]["hotel"][0]["name"]=GetMessage("v1_h_0_name");  // Наименование отеля
$ar_knora["v1"]["hotel"][0]["quantity"]=120;  // количество номеров
$ar_bron["v1"]["hotel"][0]["reserv"]=14;    // количество забронированных номеров

$ar_hot["v1"]["hotel"][1]["name"]=GetMessage("v1_h_1_name"); // Наименование отеля
$ar_knora["v1"]["hotel"][1]["quantity"]=200;  // количество номеров
$ar_bron["v1"]["hotel"][1]["reserv"]=10;    // количество забронированных номеров
/*
$ar_hot["v1"]["hotel"][2]["name"]=GetMessage("v1_h_2_name"); // Наименование отеля
$ar_knora["v1"]["hotel"][2]["quantity"]=200;  // количество номеров
$ar_bron["v1"]["hotel"][2]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v1"]["hotel"][3]["name"]=GetMessage("v1_h_3_name"); // Наименование отеля
$ar_knora["v1"]["hotel"][3]["quantity"]=200;  // количество номеров
$ar_bron["v1"]["hotel"][3]["reserv"]=10;    // количество забронированных номеров
*/
$ar_hot["v1"]["nomer"][0]["note"]=GetMessage("v1_nomer_0");  // тип номера
$ar_hot["v1"]["nomer"][0]["vizi"]=0;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][0]["size"]=1;       //  количество проживающих                   
$ar_hot["v1"]["nomer"][1]["note"]=GetMessage("v1_nomer_1");   // тип номера
$ar_hot["v1"]["nomer"][1]["vizi"]=0;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][1]["size"]=2;        //  количество проживающих
$ar_hot["v1"]["nomer"][2]["note"]=GetMessage("v1_nomer_2");   // тип номера
$ar_hot["v1"]["nomer"][2]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][2]["size"]=2;        //  количество проживающих
$ar_hot["v1"]["nomer"][3]["note"]=GetMessage("v1_nomer_3");   // тип номера
$ar_hot["v1"]["nomer"][3]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][3]["size"]=2;        //  количество проживающих
$ar_hot["v1"]["nomer"][4]["note"]=GetMessage("v1_nomer_4");   // тип номера
$ar_hot["v1"]["nomer"][4]["vizi"]=0;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][4]["size"]=3;       //  количество проживающих
$ar_hot["v1"]["nomer"][5]["note"]=GetMessage("v1_nomer_5");   // тип номера
$ar_hot["v1"]["nomer"][5]["vizi"]=0;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][5]["size"]=3;        //  количество проживающих
$ar_hot["v1"]["nomer"][6]["note"]=GetMessage("v1_nomer_6");  // тип номера
$ar_hot["v1"]["nomer"][6]["vizi"]=0;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][6]["size"]=4;        //  количество проживающих
$ar_hot["v1"]["nomer"][7]["note"]=GetMessage("v1_nomer_7");   // тип номера
$ar_hot["v1"]["nomer"][7]["vizi"]=0;  // показать в форме -1, скрыть -0
$ar_hot["v1"]["nomer"][7]["size"]=4;       //  количество проживающих
//$ar_hot["v1"]["nomer"][8]["note"]=GetMessage("v1_nomer_8");  // тип номера
//$ar_hot["v1"]["nomer"][8]["vizi"]=0;  // показать в форме -1, скрыть -0
//$ar_hot["v1"]["nomer"][8]["size"]=0;         //  количество проживающих



// площадка 2
$ar_hot["v2"]["date"][0]="19.02.2016"; // Рекомендуемые даты проживания от
$ar_hot["v2"]["date"][1]="09.03.2016"; // Рекомендуемые даты проживания до

$ar_hot["v2"]["hotel"][0]["name"]=GetMessage("v2_h_0_name"); // Наименование отеля
$ar_knora["v2"]["hotel"][0]["quantity"]=200;  // количество номеров
$ar_bron["v2"]["hotel"][0]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v2"]["hotel"][1]["name"]=GetMessage("v2_h_1_name"); // Наименование отеля
$ar_knora["v2"]["hotel"][1]["quantity"]=200;  // количество номеров
$ar_bron["v2"]["hotel"][1]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v2"]["hotel"][2]["name"]=GetMessage("v2_h_2_name"); // Наименование отеля
$ar_knora["v2"]["hotel"][2]["quantity"]=200;  // количество номеров
$ar_bron["v2"]["hotel"][2]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v2"]["hotel"][3]["name"]=GetMessage("v2_h_3_name"); // Наименование отеля
$ar_knora["v2"]["hotel"][3]["quantity"]=200;  // количество номеров
$ar_bron["v2"]["hotel"][3]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v2"]["nomer"][0]["note"]=GetMessage("v2_nomer_0");  // тип номера
$ar_hot["v2"]["nomer"][0]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][0]["size"]=1;       //  количество проживающих                   
$ar_hot["v2"]["nomer"][1]["note"]=GetMessage("v2_nomer_1");   // тип номера
$ar_hot["v2"]["nomer"][1]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][1]["size"]=2;        //  количество проживающих
$ar_hot["v2"]["nomer"][2]["note"]=GetMessage("v2_nomer_2");   // тип номера
$ar_hot["v2"]["nomer"][2]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][2]["size"]=2;        //  количество проживающих
$ar_hot["v2"]["nomer"][3]["note"]=GetMessage("v2_nomer_3");   // тип номера
$ar_hot["v2"]["nomer"][3]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][3]["size"]=2;        //  количество проживающих
$ar_hot["v2"]["nomer"][4]["note"]=GetMessage("v2_nomer_4");   // тип номера
$ar_hot["v2"]["nomer"][4]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][4]["size"]=3;       //  количество проживающих
$ar_hot["v2"]["nomer"][5]["note"]=GetMessage("v2_nomer_5");   // тип номера
$ar_hot["v2"]["nomer"][5]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][5]["size"]=3;        //  количество проживающих
$ar_hot["v2"]["nomer"][6]["note"]=GetMessage("v2_nomer_6");  // тип номера
$ar_hot["v2"]["nomer"][6]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][6]["size"]=4;        //  количество проживающих
$ar_hot["v2"]["nomer"][7]["note"]=GetMessage("v2_nomer_7");   // тип номера
$ar_hot["v2"]["nomer"][7]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v2"]["nomer"][7]["size"]=4;       //  количество проживающих
//$ar_hot["v2"]["nomer"][8]["note"]=GetMessage("v2_nomer_8");  // тип номера
//$ar_hot["v2"]["nomer"][8]["vizi"]=1;  // показать в форме -1, скрыть -0
//$ar_hot["v2"]["nomer"][8]["size"]=0;         //  количество проживающих

/*
// площадка 3
$ar_hot["v3"]["date"][0]="17.12.2015"; // Рекомендуемые даты проживания от
$ar_hot["v3"]["date"][1]="27.12.2015"; // Рекомендуемые даты проживания до

$ar_hot["v3"]["hotel"][0]["name"]=GetMessage("v3_h_0_name"); // Наименование отеля
$ar_knora["v3"]["hotel"][0]["quantity"]=200;  // количество номеров
$ar_bron["v3"]["hotel"][0]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v3"]["hotel"][1]["name"]=GetMessage("v3_h_1_name"); // Наименование отеля
$ar_knora["v3"]["hotel"][1]["quantity"]=200;  // количество номеров
$ar_bron["v3"]["hotel"][1]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v3"]["hotel"][2]["name"]=GetMessage("v3_h_2_name"); // Наименование отеля
$ar_knora["v3"]["hotel"][2]["quantity"]=200;  // количество номеров
$ar_bron["v3"]["hotel"][2]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v3"]["hotel"][3]["name"]=GetMessage("v3_h_3_name"); // Наименование отеля
$ar_knora["v3"]["hotel"][3]["quantity"]=200;  // количество номеров
$ar_bron["v3"]["hotel"][3]["reserv"]=10;    // количество забронированных номеров

$ar_hot["v3"]["nomer"][0]["note"]=GetMessage("v3_nomer_0");  // тип номера
$ar_hot["v3"]["nomer"][0]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][0]["size"]=1;       //  количество проживающих                   
$ar_hot["v3"]["nomer"][1]["note"]=GetMessage("v3_nomer_1");   // тип номера
$ar_hot["v3"]["nomer"][1]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][1]["size"]=2;        //  количество проживающих
$ar_hot["v3"]["nomer"][2]["note"]=GetMessage("v3_nomer_2");   // тип номера
$ar_hot["v3"]["nomer"][2]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][2]["size"]=2;        //  количество проживающих
$ar_hot["v3"]["nomer"][3]["note"]=GetMessage("v3_nomer_3");   // тип номера
$ar_hot["v3"]["nomer"][3]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][3]["size"]=2;        //  количество проживающих
$ar_hot["v3"]["nomer"][4]["note"]=GetMessage("v3_nomer_4");   // тип номера
$ar_hot["v3"]["nomer"][4]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][4]["size"]=3;       //  количество проживающих
$ar_hot["v3"]["nomer"][5]["note"]=GetMessage("v3_nomer_5");   // тип номера
$ar_hot["v3"]["nomer"][5]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][5]["size"]=3;        //  количество проживающих
$ar_hot["v3"]["nomer"][6]["note"]=GetMessage("v3_nomer_6");  // тип номера
$ar_hot["v3"]["nomer"][6]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][6]["size"]=4;        //  количество проживающих
$ar_hot["v3"]["nomer"][7]["note"]=GetMessage("v3_nomer_7");   // тип номера
$ar_hot["v3"]["nomer"][7]["vizi"]=1;  // показать в форме -1, скрыть -0
$ar_hot["v3"]["nomer"][7]["size"]=4;       //  количество проживающих
//$ar_hot["v3"]["nomer"][8]["note"]=GetMessage("v3_nomer_8");  // тип номера
//$ar_hot["v3"]["nomer"][8]["vizi"]=1;  // показать в форме -1, скрыть -0
//$ar_hot["v3"]["nomer"][8]["size"]=0;         //  количество проживающих

*/

//echo"<pre>";print_r($ar_hot);echo"</pre>";
?>