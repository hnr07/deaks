//Проверка подключения jQuery
/*
 if (window.jQuery) alert("Библиотека jQuery подключена");
 else alert("Библиотека jQuery не подключена");
 */
function vi_status() {
    var sel = $("#ti_blo_status input:radio").filter(":checked").val();
    var hisel = $("#ti_blo_status input:hidden:eq(0)").val();
//document.getElementById('tr').innerHTML = sel;
    if (sel == hisel) {
        $("#sipo_1").css("display", "block");
        $("#sipo_0").css("display", "none");
        $("#ti_blo_2").css("display", "none");
    }
    else {
        $("#sipo_0").css("display", "block");
        $("#sipo_1").css("display", "none");
        $("#ti_blo_2").css("display", "block");
    }
    sub_but();
}
function pro_su() {
//регулярные выражения
    var reg_chk = /^[0-9]{6,7}$/;   //  номер - только 6-7 цифр
    var reg_fio = /^[a-zA-Zа-яА-Я-Ёё]+$/;   // только буквы и дефис - кирилица, латынь
//var reg_mail = /^[a-zA-Z0-9][-\._a-zA-Z0-9]+@(?:[a-zA-Z0-9][-a-zA-Z0-9]+\.)+[a-zA-Z]{2,6}$/; // електронная почта 
    var reg_mail = /^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
    var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел
    var reg_dm = /^[0-9.]{1,5}$/;   //  число - только 1-3 цифры
    var reg_mp = /^[0-9.]{1,100}$/;   //  число - только цифры

    var po = 0; // индикатор ошибок
    var po_tx = ""; // текст ошибок

    // проверка поля E-mail
    if (document.getElementById('ti_blo_email')) {
        var nf = $("#ti_blo_email input:text:eq(0)").val();
        if (reg_mail.test(nf)) oker("email", 1);
        else {
            oker("email", 0);
            po += 1;
            po_tx += erp("email") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////

    // проверка поля Телефон
    if (document.getElementById('ti_blo_tel')) {
        var nf = $("#ti_blo_tel input:text:eq(0)").val();
        if (reg_phone.test(nf)) oker("tel", 1);
        else {
            oker("tel", 0);
            po += 1;
            po_tx += erp("tel") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////
    // проверка поля Доп. Телефон
    if (document.getElementById('ti_blo_tel_2')) {
        var nf = $("#ti_blo_tel_2 input:text:eq(0)").val();
        if (reg_phone.test(nf) || nf == "") oker("tel_2", 1);
        else {
            oker("tel_2", 0);
            po += 1;
            po_tx += erp("tel_2") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////
    // проверка поля Skype
    var pre = $("#pvs input:radio").filter(":checked").val();
    var hipre = $("#ti_blo_skype input:hidden:eq(0)").val();
    if (pre == hipre) {
        var ska = $("#ti_blo_skype input:text:eq(0)").val();
        if (ska) {
            oker("skype", 1);
        }
        else {
            oker("skype", 0);
            po += 1;
            po_tx += erp("skype") + "\r\n <br>";
        }
    }
    else {
        {
            oker("skype", 1);
        }
    }
//////////////////////////////////////////

    // проверка поля Пол
    var sxq = $("#ti_blo_sex input:radio").filter(":checked").val();
    if (sxq) {
        oker("sex", 1);
    }
    else {
        oker("sex", 0);
        po += 1;
        po_tx += erp("sex") + "\r\n <br>";
    }
//////////////////////////////////////////

    // проверка поля Возраст
    var sxq = $("#ti_blo_age input:radio").filter(":checked").val();
    if (sxq) {
        oker("age", 1);
    }
    else {
        oker("age", 0);
        po += 1;
        po_tx += erp("age") + "\r\n <br>";
    }
//////////////////////////////////////////

    // проверка поля Город проживания
    if (document.getElementById('ti_blo_city')) {
        var nf = $("#ti_blo_city input:text:eq(0)").val();
        if (nf) oker("city", 1);
        else {
            oker("city", 0);
            po += 1;
            po_tx += erp("city") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////

    // проверка поля Дата рождения
    if (document.getElementById('ti_blo_birthday')) {
        var nf = $("#ti_blo_birthday input:text:eq(0)").val();
        if (nf) oker("birthday", 1);
        else {
            oker("birthday", 0);
            po += 1;
            po_tx += erp("birthday") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////


    // проверка поля Наличие загранпаспорта
    if (document.getElementById('ti_blo_p_nal')) {
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();

        if (fop != undefined) {
            if (fop == hifop) {
                $("#p_nal_ok").css("display", "block");
                $("#p_nal_not").css("display", "none");
            }
            else {
                $("#p_nal_not").css("display", "block");
                $("#p_nal_ok").css("display", "none");
            }
            if (fop) {
                oker("p_nal", 1);
            }
            else {
                oker("p_nal", 0);
                po_tx += erp("p_nal") + "\r\n <br>";
            }
        }
        else {
            oker("p_nal", 0);
            po_tx += erp("p_nal") + "\r\n <br>";
        }
    }
//////////////////////////////////////////
// Имя по загранпаспорту //
    if (document.getElementById('ti_blo_p_name')) {
        var ff = $("#ti_blo_p_name input:text:eq(0)").val();
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (reg_fio.test(ff)) oker("p_name", 1);
            else {
                oker("p_name", 0);
                po += 1;
                po_tx += erp("p_name") + "\r\n <br>";
            }
        }
        else {
            oker("p_name", 1);
        }
    }
    //////////////////////////////////////////

// Фамилия по загранпаспорту //
    if (document.getElementById('ti_blo_p_family')) {
        var ff = $("#ti_blo_p_family input:text:eq(0)").val();
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (reg_fio.test(ff)) oker("p_family", 1);
            else {
                oker("p_family", 0);
                po += 1;
                po_tx += erp("p_family") + "\r\n <br>";
            }
        }
        else {
            oker("p_family", 1);
        }
    }
    //////////////////////////////////////////

// Действие загранпаспорта //
    if (document.getElementById('ti_blo_p_due_date')) {
        var ff = $("#ti_blo_p_due_date input:text:eq(0)").val();
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ff) oker("p_due_date", 1);
            else {
                oker("p_due_date", 0);
                po += 1;
                po_tx += erp("p_due_date") + "\r\n <br>";
            }
        }
        else {
            oker("p_due_date", 1);
        }
    }
    //////////////////////////////////////////

// Дата выдачи загранпаспорта //
    if (document.getElementById('ti_blo_p_date')) {
        var ff = $("#ti_blo_p_date input:text:eq(0)").val();
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ff) oker("p_date", 1);
            else {
                oker("p_date", 0);
                po += 1;
                po_tx += erp("p_date") + "\r\n <br>";
            }
        }
        else {
            oker("p_date", 1);
        }
    }
    //////////////////////////////////////////

// Серия и номер загранпаспорта //
    if (document.getElementById('ti_blo_p_sn')) {
        var ff = $("#ti_blo_p_sn input:text:eq(0)").val();
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ff) oker("p_sn", 1);
            else {
                oker("p_sn", 0);
                po += 1;
                po_tx += erp("p_sn") + "\r\n <br>";
            }
        }
        else {
            oker("p_sn", 1);
        }
    }
    //////////////////////////////////////////

// Нет паспорта? Укажите дату //

    if (document.getElementById('ti_blo_p_ready')) {
        var ff = $("#ti_blo_p_ready input:text:eq(0)").val();
        var fop = $("#ti_blo_p_nal input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_nal input:hidden:eq(0)").val();
        if (fop == hifop) {
            oker("p_ready", 1);
        }
        else {
            if (ff) oker("p_ready", 1);
            else {
                oker("p_ready", 0);
                po += 1;
                po_tx += erp("p_ready") + "\r\n <br>";
            }
        }
    }
    //////////////////////////////////////////

// проверка поля Оформление визы
    if (document.getElementById('ti_blo_p_viza')) {
//var cot=$("#m_country").val();
        var cot = $("#sel_country").val();
        var yes_visa = $("#yes_visa").val();
        var ivi = yes_visa.indexOf(cot);         //есть ли выбранная страна в списке визовых
        if (ivi == -1) {
           // $("#ti_blo_p_viza").css("display", "none");
            $("#ti_blo_p_viza input:radio:eq(2)").attr("checked", true);
        }
        else {
           // $("#ti_blo_p_viza").css("display", "block");
           // $("#p_viza_2").css("display", "none");
        }
        var fop = $("#ti_blo_p_viza input:radio").filter(":checked").val();
        if (fop) {
            oker("p_viza", 1);
        }
        else {
            oker("p_viza", 0);
            po += 1;
            po_tx += erp("p_viza") + "\r\n <br>";
        }
    }
//////////////////////////////////////////


// проверка поля Вариант проживания
    if (document.getElementById('ti_blo_p_hotel')) {
        var fop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
        if (fop) {
            oker("p_hotel", 1);
        }
//else {oker("p_hotel",0);po+=1;po_tx+=erp("p_hotel")+"\r\n <br>";}	
    }
//////////////////////////////////////////


    // проверка поля Дата начала проживания
    if (document.getElementById('ti_blo_day_hotel_start')) {
        /*
         var b_d=$("#ti_blo_day_hotel_start #b_d option:selected").val();
         if(b_d && b_d<10) b_d="0"+b_d;
         var b_m=$("#ti_blo_day_hotel_start #b_m option:selected").val();
         if(b_m && b_m<10) b_m="0"+b_m;
         var b_y=$("#ti_blo_day_hotel_start #b_y option:selected").val();
         if(b_d && b_m && b_y) $("#ti_blo_day_hotel_start input:text:eq(0)").val(b_d+"."+b_m+"."+b_y);
         else $("#ti_blo_day_hotel_start input:text:eq(0)").val("");
         b_d='';b_m='';b_y='';
         */
        var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
        var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
        var f_fs = $("#ti_blo_day_hotel_start input:text:eq(0)").val();
        if (hop == hihop) {
            if (f_fs) oker("day_hotel_start", 1);
            else {
                oker("day_hotel_start", 0);
                po += 1;
                po_tx += erp("day_hotel_start") + "\r\n <br>";
            }
        }
        else {
            oker("day_hotel_start", 1);
        }
    }
    //////////////////////////////////////////

    // проверка поля Дата окончания проживания

    if (document.getElementById('ti_blo_day_hotel_finish')) {
        /*
         var b_d=$("#ti_blo_day_hotel_finish #b_d option:selected").val();
         if(b_d && b_d<10) b_d="0"+b_d;
         var b_m=$("#ti_blo_day_hotel_finish #b_m option:selected").val();
         if(b_m && b_m<10) b_m="0"+b_m;
         var b_y=$("#ti_blo_day_hotel_finish #b_y option:selected").val();
         if(b_d && b_m && b_y) $("#ti_blo_day_hotel_finish input:text:eq(0)").val(b_d+"."+b_m+"."+b_y);
         else $("#ti_blo_day_hotel_finish input:text:eq(0)").val("");
         b_d='';b_m='';b_y='';
         */
        var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
        var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
        var f_ff = $("#ti_blo_day_hotel_finish input:text:eq(0)").val();
        if (hop == hihop) {
            if (f_ff) oker("day_hotel_finish", 1);
            else {
                oker("day_hotel_finish", 0);
                po += 1;
                po_tx += erp("day_hotel_finish") + "\r\n <br>";
            }
        }
        else {
            oker("day_hotel_finish", 1);
        }
    }

    //////////////////////////////////////////

    // проверка количества дней проживания
    var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
    var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
    var f_fs = $("#ti_blo_day_hotel_start input:text:eq(0)").val();
    var f_ff = $("#ti_blo_day_hotel_finish input:text:eq(0)").val();
    if (hop == hihop) {
        var ar_n = f_fs.split(".");
        var ar_k = f_ff.split(".");
        var tew_n = Date.parse(ar_n[2] + "-" + ar_n[1] + "-" + ar_n[0]);
        var tew_k = Date.parse(ar_k[2] + "-" + ar_k[1] + "-" + ar_k[0]);
        if (tew_k <= tew_n) {
            po += 1;
            po_tx += erp("day_c") + "\r\n <br>";
        }
    }

    ///////////////////////////////////////

    // проверка поля Отель
    if (document.getElementById('ti_blo_hotel')) {
        var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
        var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
        var fop = $("#ti_blo_hotel input:radio").filter(":checked").val();
        if (hop == hihop) {
            if (fop) {
                oker("hotel", 1);
            }
            else {
                oker("hotel", 0);
                po += 1;
                po_tx += erp("hotel") + "\r\n <br>";
            }
        }
        else {
            oker("hotel", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Номер
    if (document.getElementById('ti_blo_nomer')) {
        var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
        var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
        var fop = $("#ti_blo_nomer input:radio").filter(":checked").val();

        if (hop == hihop) {
            if (fop) {
                oker("nomer", 1);
            }
            else {
                oker("nomer", 0);
                po += 1;
                po_tx += erp("nomer") + "\r\n <br>";
            }
        }
        else {
            oker("nomer", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Гостевая карта
    if (document.getElementById('ti_blo_guest_card')) {
        var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
        var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
        if (hop != hihop) {
            var fop = $("#ti_blo_guest_card input:radio").filter(":checked").val();
            if (fop) {
                oker("guest_card", 1);
            }
            else {
                oker("guest_card", 0);
                po += 1;
                po_tx += erp("guest_card") + "\r\n <br>";
            }
        }
    }
//////////////////////////////////////////

// проверка поля Вариант перелёта
    if (document.getElementById('ti_blo_p_fly')) {
        var fop = $("#ti_blo_p_fly input:radio").filter(":checked").val();
        if (fop) {
            oker("p_fly", 1);
        }
        else {
            oker("p_fly", 0);
            po += 1;
            po_tx += erp("p_fly") + "\r\n <br>";
        }
    }
//////////////////////////////////////////

// проверка поля Перелет туда
    if (document.getElementById('ti_blo_fly_1')) {
        var fop = $("#ti_blo_p_fly input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_fly input:hidden:eq(0)").val();
        var fl = $("#ti_blo_fly_1 input:radio").filter(":checked").val();
        if (fop == hifop) {
            if (fl && fl !== undefined) {
                oker("fly_1", 1);
            }
            else {
                oker("fly_1", 0);
                po += 1;
                po_tx += erp("fly_1") + "\r\n <br>";
            }
        }
        else {
            oker("fly_1", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Перелет обратно
    if (document.getElementById('ti_blo_fly_2')) {
        var fop = $("#ti_blo_p_fly input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_p_fly input:hidden:eq(0)").val();
        var fl = $("#ti_blo_fly_2 input:radio").filter(":checked").val();

        if (fop == hifop) {
            if (fl && fl !== undefined) {
                oker("fly_2", 1);
            }
            else {
                oker("fly_2", 0);
                po += 1;
                po_tx += erp("fly_2") + "\r\n <br>";
            }
        }
        else {
            oker("fly_2", 1);
        }
    }
//////////////////////////////////////////


    // проверка поля Форма оплаты
    if (document.getElementById('ti_blo_oplata')) {
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop != undefined) {
            if (fop == hifop) {
                $("#pl_div").css("display", "block");
                $("#op_div").css("display", "none");
            }
            else {
                $("#op_div").css("display", "block");
                $("#pl_div").css("display", "none");
            }
            if (fop) {
                oker("oplata", 1);
            }
            else {
                oker("oplata", 0);
                po_tx += erp("oplata") + "\r\n <br>";
            }
        }
        else {
            oker("oplata", 0);
            po_tx += erp("oplata") + "\r\n <br>";
        }
    }
//////////////////////////////////////////

// проверка поля ЧК плательщика
    if (document.getElementById('ti_blo_pl_chk')) {
        var ff = $("#ti_blo_pl_chk input:text:eq(0)").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (reg_chk.test(ff)) oker("pl_chk", 1);
            else {
                oker("pl_chk", 0);
                po += 1;
                po_tx += erp("pl_chk") + "\r\n <br>";
            }
        }
        else {
            oker("pl_chk", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Имя плательщика
    if (document.getElementById('ti_blo_pl_name')) {
        var ff = $("#ti_blo_pl_name input:text:eq(0)").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (reg_fio.test(ff)) oker("pl_name", 1);
            else {
                oker("pl_name", 0);
                po += 1;
                po_tx += erp("pl_name") + "\r\n <br>";
            }
        }
        else {
            oker("pl_name", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Фамилия плательщика
    if (document.getElementById('ti_blo_pl_family')) {
        var ff = $("#ti_blo_pl_family input:text:eq(0)").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (reg_fio.test(ff)) oker("pl_family", 1);
            else {
                oker("pl_family", 0);
                po += 1;
                po_tx += erp("pl_family") + "\r\n <br>";
            }
        }
        else {
            oker("pl_family", 1);
        }
    }
//////////////////////////////////////////

// проверка поля № телефона плательщика
    if (document.getElementById('ti_blo_pl_phone')) {
        var ff = $("#ti_blo_pl_phone input:text:eq(0)").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (reg_phone.test(ff)) oker("pl_phone", 1);
            else {
                oker("pl_phone", 0);
                po += 1;
                po_tx += erp("pl_phone") + "\r\n <br>";
            }
        }
        else {
            oker("pl_phone", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Проверка плательщика и допуска к регистрации
    if (document.getElementById('ti_blo_pl_ok')) {
        var ff = $("#ti_blo_pl_ok input:text:eq(0)").val();
        var ffp = $("#pl_ok_id").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
		//alert(ffp);
        if (fop == hifop) {
            if (ff && (ffp == "2" || ffp == "3")) oker("pl_ok", 1);
            //else {oker("pl_ok",0);po+=1;po_tx+=erp("pl_ok")+"\r\n <br>"; } /// ВЕРНУТЬ НА СЛЕДУЮЩЕЙ!!!!!!!!!!
            if (ffp == "2") {
                $("#garant_div").css("display", "block");
            }
            else {
                $("#garant_div").css("display", "none");
            }
        }
        else {
            oker("pl_ok", 1);
        }
    }
//////////////////////////////////////////

// проверка поля № ЧК гаранта
    if (document.getElementById('ti_blo_garant_chk')) {
        var ff = $("#ti_blo_garant_chk input:text:eq(0)").val();
        var ffp = $("#pl_ok_id").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ffp == "2") {
                if (reg_chk.test(ff)) oker("garant_chk", 1);
                //else {oker("garant_chk",0);po+=1;po_tx+=erp("garant_chk")+"\r\n <br>";}
            }
            else {
                oker("garant_chk", 1);
            }
        }
        else {
            oker("garant_chk", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Имя гаранта
    if (document.getElementById('ti_blo_garant_name')) {
        var ff = $("#ti_blo_garant_name input:text:eq(0)").val();
        var ffp = $("#pl_ok_id").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ffp == "2") {
                if (reg_fio.test(ff)) oker("garant_name", 1);
                //else {oker("garant_name",0);po+=1;po_tx+=erp("garant_name")+"\r\n <br>";}
            }
            else {
                oker("garant_name", 1);
            }
        }
        else {
            oker("garant_name", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Фамилия гаранта
    if (document.getElementById('ti_blo_garant_family')) {
        var ff = $("#ti_blo_garant_family input:text:eq(0)").val();
        var ffp = $("#pl_ok_id").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ffp == "2") {
                if (reg_fio.test(ff)) oker("garant_family", 1);
                //else {oker("garant_family",0);po+=1;po_tx+=erp("garant_family")+"\r\n <br>";}
            }
            else {
                oker("garant_family", 1);
            }
        }
        else {
            oker("garant_family", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Проверка гаранта и допуска к регистрации
    if (document.getElementById('ti_blo_garant_ok')) {
        var ff = $("#ti_blo_garant_ok input:text:eq(0)").val();
        var ffp = $("#pl_ok_id").val();
        var ffg = $("#garant_ok_id").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            if (ffp == "2") {
                if (ff && ffg == "2") oker("garant_ok", 1);
                //else {oker("garant_ok",0);po+=1;po_tx+=erp("garant_ok")+"\r\n <br>";}
            }
            else {
                oker("garant_ok", 1);
            }
        }
        else {
            oker("garant_ok", 1);
        }
    }
//////////////////////////////////////////

// проверка поля Страна
    if (document.getElementById('ti_blo_op_country')) {
        var noe = $("#ti_blo_op_country option:selected").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            oker("op_country", 1);
        }
        else {
            if (noe)  oker("op_country", 1);
            else {
                oker("op_country", 0);
                po += 1;
                po_tx += erp("op_country") + "\r\n <br>";
            }
        }
    }
//////////////////////////////////////////

// проверка поля Город
    if (document.getElementById('ti_blo_op_city')) {
        var noe = $("#ti_blo_op_city option:selected").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            oker("op_city", 1);
        }
        else {
            if (noe)  oker("op_city", 1);
            else {
                oker("op_city", 0);
                po += 1;
                po_tx += erp("op_city") + "\r\n <br>";
            }
        }
    }
//////////////////////////////////////////

// проверка поля № Офиса продаж
    if (document.getElementById('ti_blo_op_nof')) {
        var noe = $("#ti_blo_op_nof option:selected").val();
        var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
        var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();
        if (fop == hifop) {
            oker("op_nof", 1);
        }
        else {
            if (noe)  oker("op_nof", 1);
            else {
                oker("op_nof", 0);
                po += 1;
                po_tx += erp("op_nof") + "\r\n <br>";
            }
        }
    }
//////////////////////////////////////////

// проверка поля Участие в конференции
    if (document.getElementById('ti_blo_d_konf')) {
        var fop = $("#ti_blo_d_konf input:radio").filter(":checked").val();
        if (fop) {
            oker("d_konf", 1);
        }
//else {oker("d_konf",0);po+=1;po_tx+=erp("d_konf")+"\r\n <br>";}	
    }
//////////////////////////////////////////

// проверка поля Участие в гала ужине
    if (document.getElementById('ti_blo_d_ujin')) {
        var fop = $("#ti_blo_d_ujin input:radio").filter(":checked").val();
        if (fop) {
            oker("d_ujin", 1);
        }
//else {oker("d_ujin",0);po+=1;po_tx+=erp("d_ujin")+"\r\n <br>";}	
    }
//////////////////////////////////////////


// проверка поля Питание на конференции
    if (document.getElementById('ti_blo_d_eat_2')) {
        var fop = $("#ti_blo_d_eat_2 input:radio").filter(":checked").val();
        if (fop) {
            oker("d_eat_2", 1);
        }
//else {oker("d_eat_2",0);po+=1;po_tx+=erp("d_eat_2")+"\r\n <br>";}	
    }
//////////////////////////////////////////

    // проверка поля Место
    if (document.getElementById('ti_blo_mesto')) {
        var nf = $("#ti_blo_mesto input:text:eq(0)").val();
        if (nf) oker("mesto", 1);
        else {
            oker("mesto", 0);
            po += 1;
            po_tx += erp("mesto") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////

// проверка поля Размер футболки
    if (document.getElementById('ti_blo_d_futbolka')) {
        var hop = $("#ti_blo_d_konf input:radio").filter(":checked").val();
        var hihop = $("#ti_blo_d_konf input:hidden:eq(0)").val();
        var fop = $("#ti_blo_d_futbolka input:radio").filter(":checked").val();
        if (hop == hihop) {
            if (fop) {
                oker("d_futbolka", 1);
            }
            else {
                oker("ti_blo_d_futbolka", 0);
                po += 1;
                po_tx += erp("ti_blo_d_futbolka") + "\r\n <br>";
            }
        }

    }
//////////////////////////////////////////


    // Скидка %
    if (document.getElementById('ti_blo_discount')) {
        //var nf=parseInt($("#ti_blo_discount input:text:eq(0)").val());
        //if(typeof(nf)!="number") nf=0;
        var nf = $("#ti_blo_discount input:text:eq(0)").val();
       // $("#ti_blo_discount input:text:eq(0)").val(nf);
        if (reg_dm.test(nf) && (nf >= 0 && nf <= 100)) oker("discount", 1);
        else {
            oker("discount", 0);
            po += 1;
            po_tx += erp("discount") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////

    // Наценка %
    if (document.getElementById('ti_blo_markup')) {
        var nf = $("#ti_blo_markup input:text:eq(0)").val();
       // $("#ti_blo_markup input:text:eq(0)").val(nf);
        if (reg_dm.test(nf) && (nf >= 0 && nf <= 100)) oker("markup", 1);
        else {
            oker("markup", 0);
            po += 1;
            po_tx += erp("markup") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////
    // Минус
    if (document.getElementById('ti_blo_minus')) {
        //var nf=parseInt($("#ti_blo_discount input:text:eq(0)").val());
        //if(typeof(nf)!="number") nf=0;
        var nf = $("#ti_blo_minus input:text:eq(0)").val();
       // $("#ti_blo_minus input:text:eq(0)").val(nf);
        if (reg_mp.test(nf)) oker("minus", 1);
        else {
            oker("minus", 0);
            po += 1;
            po_tx += erp("minus") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////

    // Плюс
    if (document.getElementById('ti_blo_plus')) {
        var nf = $("#ti_blo_plus input:text:eq(0)").val();
       // $("#ti_blo_plus input:text:eq(0)").val(nf);
        if (reg_mp.test(nf)) oker("plus", 1);
        else {
            oker("plus", 0);
            po += 1;
            po_tx += erp("plus") + "\r\n <br>";
        }
    }
    //////////////////////////////////////////
					var pls=$("#fls").val();
					if(pls=="1") {
					// проверка поля Участие в Leader Ship
					if(document.getElementById('ti_blo_d_leader_ship'))
					{
					var fop=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
					if(fop) {oker("d_leader_ship",1);}
					else {oker("d_leader_ship",0);po+=1;po_tx+=erp("d_leader_ship")+"\r\n <br>";}	
					}
					//////////////////////////////////////////

					// проверка поля Соучастие в Leader Ship
					if(document.getElementById('ti_blo_s_leader_ship'))
					{
					var fop=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
					if(fop) {oker("s_leader_ship",1);}
					else {oker("s_leader_ship",0);po+=1;po_tx+=erp("s_leader_ship")+"\r\n <br>";}	
					}
					//////////////////////////////////////////
						
								 // проверка поля Дата начала проживания для Leader Ship
						if (document.getElementById('ti_blo_day_hotel_start_ls')) {
						 
					  var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
							var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
							var f_fs=$("#ti_blo_day_hotel_start_ls input:text:eq(0)").val();
							if(hop==hihop) {
							if($("#hiscer").val()==0) {
								var hop=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
								var hihop=$("#ti_blo_d_leader_ship input:hidden:eq(0)").val();
								}
								else {
								var hop=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
								var hihop=$("#ti_blo_s_leader_ship input:hidden:eq(0)").val();
								}
								if(hop==hihop) {
									if(f_fs) oker("day_hotel_start_ls",1);
									else {oker("day_hotel_start_ls",0);po+=1;po_tx+=erp("day_hotel_start_ls")+"\r\n <br>";}	
								}
								else {oker("day_hotel_start_ls",1);}
								}
							else {oker("day_hotel_start_ls",1);}
						}
						//////////////////////////////////////////

						// проверка поля Дата окончания проживания для Leader Ship

						if (document.getElementById('ti_blo_day_hotel_finish')) {

							var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
							var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
							var f_ff=$("#ti_blo_day_hotel_finish_ls input:text:eq(0)").val();
							if(hop==hihop) {
							if($("#hiscer").val()==0) {
								var hop=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
								var hihop=$("#ti_blo_d_leader_ship input:hidden:eq(0)").val();
								}
								else {
								var hop=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
								var hihop=$("#ti_blo_s_leader_ship input:hidden:eq(0)").val();
								}
								if(hop==hihop) {
									if(f_ff) oker("day_hotel_finish_ls",1);
									else {oker("day_hotel_finish_ls",0);po+=1;po_tx+=erp("day_hotel_finish_ls")+"\r\n <br>";}	
								}
								else {oker("day_hotel_finish_ls",1);}
								}
							else {oker("day_hotel_finish_ls",1);}
						}

						//////////////////////////////////////////

						// проверка количества дней проживания для Leader Ship
						var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
							var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
							var f_fs=$("#ti_blo_day_hotel_start_ls input:text:eq(0)").val();
							var f_ff=$("#ti_blo_day_hotel_finish_ls input:text:eq(0)").val();
							//alert(f_fs);
							if(hop==hihop) {
							var ar_n=f_fs.split(".");
							var ar_k=f_ff.split(".");
							var tew_n=Date.parse(ar_n[2]+"-"+ar_n[1]+"-"+ar_n[0]);
							var tew_k=Date.parse(ar_k[2]+"-"+ar_k[1]+"-"+ar_k[0]);
							if(tew_k<=tew_n) {po+=1;po_tx+=erp("day_c_ls")+"\r\n <br>";}
							}

						///////////////////////////////////////
								
						
							// проверка поля Отель для Leader Ship
					if(document.getElementById('ti_blo_hotel_ls'))
					{

					var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
					var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
					var fop=$("#ti_blo_hotel_ls input:radio").filter(":checked").val();
					if(hop==hihop) {
						if($("#hiscer").val()==0) {
						var hop=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
						var hihop=$("#ti_blo_d_leader_ship input:hidden:eq(0)").val();
						}
						else {
						var hop=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
						var hihop=$("#ti_blo_s_leader_ship input:hidden:eq(0)").val();
						}
						if(hop==hihop) {
							if(fop) {oker("hotel_ls",1);}
							else {oker("hotel_ls",0);po+=1;po_tx+=erp("hotel_ls")+"\r\n <br>";}
							}
							else {oker("hotel_ls",1);}		
							}
						else {oker("hotel_ls",1);}
					}
					//////////////////////////////////////////

					// проверка поля Номер для Leader Ship
					if(document.getElementById('ti_blo_nomer_ls'))
					{
					var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
					var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
					var fop=$("#ti_blo_nomer_ls input:radio").filter(":checked").val();

					if(hop==hihop) {
						if($("#hiscer").val()==0) {
							var hop=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
							var hihop=$("#ti_blo_d_leader_ship input:hidden:eq(0)").val();
							}
							else {
							var hop=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
							var hihop=$("#ti_blo_s_leader_ship input:hidden:eq(0)").val();
							}
								if(hop==hihop) {
								if(fop) {oker("nomer_ls",1);}
								else {oker("nomer_ls",0);po+=1;po_tx+=erp("nomer_ls")+"\r\n <br>";}	
							}
							else {oker("nomer_ls",1);}
						}
						else {oker("nomer_ls",1);}
					}
					//////////////////////////////////////////
					}
// проверка поля Синхронный перевод
if(document.getElementById('ti_blo_interpretation'))
{
var fop=$("#ti_blo_interpretation input:radio").filter(":checked").val();
if(fop) {oker("interpretation",1);}
else {oker("interpretation",0);po+=1;po_tx+=erp("interpretation")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Выбор языка синхронного перевода
if(document.getElementById('ti_blo_interpretation_lang'))
{
var fop=$("#ti_blo_interpretation input:radio").filter(":checked").val();
var hifop=$("#ti_blo_interpretation input:hidden:eq(0)").val();

if(fop==hifop) {
var fop=$("#interpretation_lang option:selected").val();
	if(fop!=0) {oker("interpretation_lang",1);}
	else {oker("interpretation_lang",0);po+=1;po_tx+=erp("interpretation_lang")+"\r\n <br>";}
}
else {oker("interpretation_lang",1);}

}
//////////////////////////////////////////
    return po_tx;

}

function sub_form() {

    if (pro_su() != "") {
        //alert(pro_su());
        //$("#err_p").css("display","block");
        $("#err_p_t").html(pro_su());
        $("#err_p_b").click();
        return false;
    }
    else return true;

}

function sub_but() {

//meter_fly();  //фнкция обработки рейсов
//meter_hotel(); //фнкция обработки проживания

    residue_fly(); // функция вывода остатка мест на рейсы
    residue_hotel(); // функция вывода остатка мест в отелях
	
    if (pro_su() != "") {

        $("#but_bot_3_a").css("display", "none");
        $("#but_bot_3").css("display", "block");
    }
    else {

        $("#but_bot_3").css("display", "none");
        $("#but_bot_3_a").css("display", "block");
    }
	
    if ($("#hiscer").val() == "0") {
        $("#sx_2").css("display", "none");
        $("#sx_3").css("display", "none");
        $("#sx_4").css("display", "none");
    }
    if ($("#hiscer").val() == "1") {
        $("#sx_2").css("display", "block");
        $("#sx_3").css("display", "block");
        $("#sx_4").css("display", "block");

    }
	
	// Доп. обработка поля Питание в гостинице
var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();

if(hop==hihop) 	{
$("#ti_blo_d_eat_1").css("display", "block" );

}
else {
$("#ti_blo_d_eat_1").css("display", "none" );
$("#ti_blo_d_eat_1 input:radio").attr ("checked", false);
}
	
    //доп.обработка пр выборе варианта перелёта
    var fop = $("#ti_blo_p_fly input:radio").filter(":checked").val();
    var hifop = $("#ti_blo_p_fly input:hidden:eq(0)").val();
    if (fop == hifop) {
        $("#fly_to").css("display", "block");
        $("#ti_blo_p_transfer input:radio:eq(0)").attr("checked", true);
        $("#ti_blo_p_transfer #p_transfer_0").css("display", "block");
        $("#ti_blo_p_transfer  #p_transfer_1").css("display", "none");
    }
    else {
        $("#fly_to").css("display", "none");
        $("#ti_blo_fly_1 input:radio").filter(":checked").attr("checked", false);
        $("#ti_blo_fly_2 input:radio").filter(":checked").attr("checked", false);
        $("#ti_blo_p_transfer input:radio:eq(1)").attr("checked", true);
        $("#ti_blo_p_transfer  #p_transfer_1").css("display", "block");
        $("#ti_blo_p_transfer  #p_transfer_0").css("display", "none");
        $("#ti_blo_fly_1 input:radio").filter(":checked").attr("checked", false);
        $("#ti_blo_fly_2 input:radio").filter(":checked").attr("checked", false);
    }
//////////////////////////////


    var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
    var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
    if (hop == hihop) { // Выбор отеля, номера и срока при проживании через компанию
        $("#hotel_to").css("display", "block");
        $("#hotel_not").css("display", "none");
        $("#ti_blo_guest_card input:radio").filter(":checked").attr("checked", false);// сброс гостевой карты
    }
    else { // Выбор гостевой карты при самостоятельном проживании
       // $("#hotel_to").css("display", "none");
       // $("#hotel_not").css("display", "block");
    }

    var hios1 = $("#ti_blo_sex input:hidden:eq(0)").val();
    var hios2 = $("#ti_blo_sex input:hidden:eq(1)").val();
    var fos = $("#ti_blo_sex input:radio").filter(":checked").val();

    if ((fos == hios1) || (fos == hios2)) {
        $("#det_fly_1").css("display", "none");
        $("#det_fly_2").css("display", "none");
    }
    else {
        $("#det_fly_1").css("display", "block");
        $("#det_fly_2").css("display", "block");
    }
//////////////////////////////

    var hop = $("#ti_blo_p_hotel input:radio").filter(":checked").val();
    var hihop = $("#ti_blo_p_hotel input:hidden:eq(0)").val();
    if (hop == hihop) {
        $("#hotel_to").css("display", "block");
    }
    else {
        $("#hotel_to").css("display", "none");
    }

    var hios1 = $("#s_sex input:hidden:eq(0)").val();
    var hios2 = $("#s_sex input:hidden:eq(1)").val();
    var hios3 = $("#s_sex input:hidden:eq(2)").val();
    var fos = $("#s_sex input:radio").filter(":checked").val();
 
    var dt_s = $("#ti_blo_day_hotel_start input:text:eq(0)").val();
    var dt_f = $("#ti_blo_day_hotel_finish input:text:eq(0)").val();
    var d = $("#date_v_1").val();
    var ard = d.split("-");
    var kld_1 = 0;
	var kld_2 = 0;
    if (dt_s && dt_f && dt_s == ard[0] && dt_f == ard[1]) kld_1 = 1;

	//var dt_s = $("#ti_blo_day_hotel_start_ls input:text:eq(0)").val();
    //var dt_f = $("#ti_blo_day_hotel_finish_ls input:text:eq(0)").val();
    d = $("#date_v_2").val();
    ard = d.split("-");
    if (dt_s && dt_f && dt_s == ard[0] && dt_f == ard[1]) kld_2 = 1;

    if (kld_1 || kld_2) {
		$("#p_fly_0").css("display", "block");
		if(kld_1) {
			$("#fly_1_date_1").css("display", "block");
			$("#fly_1_date_2").css("display", "none");
			$("#fly_2_date_1").css("display", "block");
			$("#fly_2_date_2").css("display", "none");
		}
		if(kld_2) {
			$("#fly_1_date_1").css("display", "none");
			$("#fly_1_date_2").css("display", "block");
			$("#fly_2_date_1").css("display", "none");
			$("#fly_2_date_2").css("display", "block");
		}
		
	}
    else {
        $("#p_fly_0").css("display", "none");
        $("#p_fly_1 input").click();
    }

    var hop = $("#ti_blo_d_konf input:radio").filter(":checked").val();
    var hihop = $("#ti_blo_d_konf input:hidden:eq(0)").val();
    if (hop == hihop) {
        $("#ti_blo_d_futbolka").css("display", "block");
    }
    else {
        $("#ti_blo_d_futbolka").css("display", "none");
        $("#ti_blo_d_futbolka input:radio").filter(":checked").attr("checked", false);
    }

    var fop = $("#ti_blo_hotel input:radio").filter(":checked").val();
    if (fop) {
        $("#ti_blo_nomer").css("display", "block");
    }
    else {
        $("#ti_blo_nomer").css("display", "none");
    }

    var fop = $("#ti_blo_fly_1 input:radio").filter(":checked").val();
    if (fop) {
        $("#ti_blo_fly_2").css("display", "block");
    }
    else {
        $("#ti_blo_fly_2").css("display", "none");
    }

    var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();
    var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();

    if (fop == hifop) {
        $("#pl_div").css("display", "block");
        $("#op_div").css("display", "none");
    }
    else {
        $("#op_div").css("display", "block");
        $("#pl_div").css("display", "none");
    }
	//доп обработка поля языка синхронного перевода
var fop=$("#ti_blo_interpretation input:radio").filter(":checked").val();
var hifop=$("#ti_blo_interpretation input:hidden:eq(0)").val();
if(fop!=hifop) 	{$("#ti_blo_interpretation_lang").css("display", "none" );$("#interpretation_lang [value='0']").attr("selected", "selected");}
else {$("#ti_blo_interpretation_lang").css("display", "block" );}


	//доп обработка поля  второго языка синхронного перевода
var fop=$("#ti_blo_interpretation input:radio").filter(":checked").val();
var hifop=$("#ti_blo_interpretation input:hidden:eq(0)").val();
if(fop!=hifop) 	{$("#ti_blo_second_interpretation_lang").css("display", "none" );$("#second_interpretation_lang [value='0']").attr("selected", "selected");}
else {$("#ti_blo_second_interpretation_lang").css("display", "block" );}

	// доп. обработка полей № ЧК, Фамилия, Имя
var sel = $("#ti_blo_status input:radio").filter(":checked").val();
var hisel = $("#ti_blo_status input:hidden:eq(0)").val();
if(sel==hisel) {
	var vch=$("#ti_blo_chk  input:text:eq(0)").val();
	var ich=$("#ti_blo_chk input:hidden:eq(0)").val();
	
	if(vch!=ich) $("#ti_blo_history_chk input").val(ich+"-"+vch);
	else $("#ti_blo_history_chk input").val("");
	}
//////////////////////// доп обработка полей Leader Ship
	//var pls=$("#fls").val();
					if($("#hiscer").val()==0){
					var hop=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
					var hihop = $("#ti_blo_d_leader_ship input:hidden:eq(0)").val();
					}
					else {
					var hop=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
					var hihop = $("#ti_blo_s_leader_ship input:hidden:eq(0)").val();
					}
						//alert(hop+" "+hihop);
							if (hop == hihop) { 
								$("#plsd").css("display", "block");
														
							}
							else {
							$("#plsd").css("display", "none");
							$("#ti_blo_hotel_ls input:radio").filter(":checked").attr("checked", false);// 
							$("#ti_blo_nomer_ls input:radio").filter(":checked").attr("checked", false);// 
							
							}
	
	///////////////////////////

}

function erp(n) {
    var ty = $("#erp_" + n).html();
    return ty;
}

function oker(n, s) {
    /*
     if(s) {$("#ti_blo_"+n+" .ti_di").css({"border-color": color_ok,"background-color":color_ok});$("#ti_blo_"+n+" .ti_pol").css({"border-color": color_ok});}
     else {$("#ti_blo_"+n+" .ti_di").css({"border-color": color_er,"background-color":color_er});$("#ti_blo_"+n+" .ti_pol").css({"border-color": color_er});}
     */
}

function f_nas_country(zcity, znof) {
    var y = document.getElementById('sel_op_country').options[document.getElementById('sel_op_country').selectedIndex].value;
    $.ajax({
        type: "POST",
        url: "vop2.php",
        data: "vcountry=" + y + "&zcity=" + zcity,
        cache: false,
        success: function (html) {
            $("#soc").html(html);
        }
    });
    setTimeout("f_nas_city('" + znof + "')", 500);
    //setTimeout("f_jq_select()",1000);
    setTimeout("sub_but()", 500);
}

function f_nas_city(znof) {
    var y = document.getElementById('sel_op_city').options[document.getElementById('sel_op_city').selectedIndex].value;
    $.ajax({
        type: "POST",
        url: "vop2.php",
        data: "vcity=" + y + "&znof=" + znof,
        cache: false,
        success: function (html) {
            $("#sos").html(html);
        }
    });
    setTimeout("f_nas_nof()", 1000);
    setTimeout("f_jq_select()", 500);
    setTimeout("sub_but()", 500);
}

function f_nas_nof() {
    var y = document.getElementById('sel_op_nof').options[document.getElementById('sel_op_nof').selectedIndex].value;
    $.ajax({
        type: "POST",
        url: "vop2.php",
        data: "vnof=" + y,
        cache: false,
        success: function (html) {
            //$("#tr").html(html);
            var ar_h = html.split("^");
            document.getElementById('currency_id').value = ar_h[0];
            document.getElementById('currency').value = ar_h[1];
        }
    });

    setTimeout("f_jq_select()", 500);
    setTimeout("sub_but()", 500);
}

function show_check() {
    var p_chk = "";
    var p_fio = "";
    var p_name = "";
    var stts = "";
    var cop0 = $("#ti_blo_pl_ok input:hidden:eq(0)").val();
    var cop1 = $("#ti_blo_pl_ok input:hidden:eq(1)").val();
    var cop2 = $("#ti_blo_pl_ok input:hidden:eq(2)").val();
    var cop3 = $("#ti_blo_pl_ok input:hidden:eq(3)").val();
    var chk = $("#chk").val();

    p_chk = $("#ti_blo_pl_chk input:text:eq(0)").val();
    p_fio = $("#ti_blo_pl_family input:text:eq(0)").val();
    p_name = $("#ti_blo_pl_name input:text:eq(0)").val();
    if (p_chk == chk) stts = "o_0";
    else stts = "o_1";

    $.ajax({
        type: "POST",
        url: "check_chk_13.php",
        data: "p_chk=" + p_chk + "&p_fio=" + p_fio + "&p_name=" + p_name + "&stts=" + stts,
        cache: false,
        success: function (html) {
            $("#tr").html(html);
            var ar_h = html.split("^");
            $("#promotion_3").val(ar_h[3]);
            if (ar_h[3] == "1" || ar_h[3] == "0") {
                if (ar_h[3] == "1") {
                    $("#pl_ok").val(cop2);
                    $("#pl_ok_id").val("2");
                    show_hsh("div_er_pro2");
                }
                if (ar_h[3] == "0") {
                    $("#pl_ok").val(cop3);
                    $("#pl_ok_id").val("3");
                    show_hsh("div_er_pro3");
                }
            }
            else {
                $("#pl_ok").val(cop0);
                $("#pl_ok_id").val("0");
                show_hsh("div_er_pro0");
            }
            sub_but();
        }
    });
}

function show_check_gr() {
    var p_chk = "";
    var p_fio = "";
    var p_name = "";
    var stts = "gr";
    var cop0 = $("#ti_blo_garant_ok input:hidden:eq(0)").val();
    var cop1 = $("#ti_blo_garant_ok input:hidden:eq(1)").val();
    var cop2 = $("#ti_blo_garant_ok input:hidden:eq(2)").val();
    p_chk = $("#ti_blo_garant_chk input:text:eq(0)").val();
    p_fio = $("#ti_blo_garant_family input:text:eq(1)").val();
    p_name = $("#ti_blo_garant_name input:text:eq(1)").val();
    $.ajax({
        type: "POST",
        url: "check_chk_13.php",
        data: "p_chk=" + p_chk + "&p_fio=" + p_fio + "&p_name=" + p_name + "&stts=" + stts,
        cache: false,
        success: function (html) {
            $("#tr").html(html);
            var ar_h = html.split("^");

            if (ar_h[0] == "1") {
                $("#promotion_3").val("2");
                $("#garant_ok").val(cop2);
                $("#garant_ok_id").val("2");
                show_hsh("div_er_pro4");
            }
            else {
                show_hsh("div_er_pro5");
                $("#garant_ok").val(cop0);
                $("#garant_ok_id").val("0");
            }
            sub_but();
        }
    });
}

function show_hsh(nid) {

    var n = $("#" + nid).html();
    $("#note").html(n);
    if (n) {
        $("#leb_2").addClass("leb_r");
        $("#leb_2 legend").addClass("lg_r");
    }
}
function unshow_hsh() {
    $("#note").html("");
    $("#leb_2").removeClass("leb_r");
    $("#leb_2 legend").removeClass("lg_r");
}

function pro_pl() {
    $("#pl_ok").val("");
    $("#pl_ok_id").val("1");
    $("#garant_ok").val("");
    $("#garant_ok_id").val("1");
    sub_but();
}
function pro_gr() {
    if ($("#promotion_3").val() == 2) $("#promotion_3").val("1");
    $("#garant_ok").val("");
    $("#garant_ok_id").val("1");
    sub_but();
}
function pro_op() {
    $("#ti_blo_op_country option").removeAttr("selected");
    sub_but();
}
function pro_opt() {
    document.getElementById('sel_op_country').selectedIndex = 0;
//document.getElementById('sel_op_country').selectedIndex=0;
//$("#ti_blo_op_city option").removeAttr("selected");
//$("#ti_blo_op_country option").removeAttr("selected");

//$("#ti_blo_op_nof option").removeAttr("selected");
//f_nas_country("","");
    sub_but();
}
function p_pe(p, v, o) {
/*
    $("#ti_blo_" + p + " .ti_dis").css({"display": "none"});
    $("#ti_blo_" + v + " .ti_dis").css({"display": "none"});
    $("#ti_blo_" + p + " .ti_dis:eq(" + o + ")").css({"display": "block"});
    $("#ti_blo_" + v + " .ti_dis:eq(" + o + ")").css({"display": "block"});
*/
}

function p_pes(b, c) {
    f_nochev(b);
	f_nochev(c);
    if ($("#ti_blo_" + c + " input:radio").filter(":checked").val() == undefined) {
        $("#ti_blo_" + b + " .ti_dis").css({"display": "block"});
        $("#ti_blo_" + c + " .ti_dis").css({"display": "block"});
    }
}
// Сброс радиоточек //////////////////
function f_nochev(n) {
    $("#ti_blo_" + n + " input:radio").filter(":checked").attr("checked", false);
}
///////////////////////////////////////////////////

// Сброс радиоточек //////////////////
function f_nochev(n) {
    $("#ti_blo_" + n + " input:radio").filter(":checked").attr("checked", false);
}
///////////////////////////////////////////////////

//// Проверка на количество номеров в отеле
function meter_hotel() {

    var strf = $("#meter_nomer").val();
    var ar_nom = strf.split("^");
    for (var i = 0; i < ar_nom.length; i++) {
        if (ar_nom[i] <= 0) {
            $("#hotel_" + i).css({"display": "none"});
        }
        else {
            $("#hotel_" + i).css({"display": "block"});
        }
    }
}
////  Вывод остатка количества номеров в отеле
function residue_hotel() {

    var strf = $("#meter_nomer").val();
    var ar_nom = strf.split("^");
    for (var i = 0; i < ar_nom.length; i++) {
        $("#hotel_" + i + " span").html(ar_nom[i]);
    }
}

//// Проверка на количество рейсов
function meter_fly() {
    var strf = $("#meter_fly").val();
    var ar_polo = strf.split("&");
    var ar_pt = ar_polo[0].split("^");
    var ar_po = ar_polo[1].split("^");
    for (var i = 0; i < ar_pt.length; i++) {
        if (ar_pt[i] <= 0) $("#fly_1_" + i).css({"display": "none"});
        else $("#fly_1_" + i).css({"display": "block"});
    }
    for (var i = 0; i < ar_po.length; i++) {
        if (ar_po[i] <= 0) $("#fly_2_" + i).css({"display": "none"});
        else $("#fly_2_" + i).css({"display": "block"});
    }

}
//// Вывод остатка количества рейсов
function residue_fly() {
    var strf = $("#meter_fly").val();
    var ar_polo = strf.split("&");
    var ar_pt = ar_polo[0].split("^");
    var ar_po = ar_polo[1].split("^");
    for (var i = 0; i < ar_pt.length; i++) {
        $("#fly_1_" + i + " span").html(ar_pt[i]);
    }
    for (var i = 0; i < ar_po.length; i++) {
        $("#fly_2_" + i + " span").html(ar_po[i]);
    }

}

//// Добавление рекомендуемых дат проживания из комментария в поля
function date_v(n) {
    var d = $("#date_v_" + n).val();
    var ard = d.split("-");
    var ds_ard = ard[0].split(".");
    if (ds_ard[0][0] == "0") ds_ard[0] = ds_ard[0][1];
    $("#ti_blo_day_hotel_start #b_d [value=" + ds_ard[0] + "]").attr("selected", "selected");
    var df_ard = ard[1].split(".");
    if (df_ard[0][0] == "0") df_ard[0] = df_ard[0][1];
    $("#ti_blo_day_hotel_finish #b_d [value=" + df_ard[0] + "]").attr("selected", "selected");

    $("#ti_blo_day_hotel_start #date_day_hotel_start").val(ard[0]);
    $("#ti_blo_day_hotel_finish #date_day_hotel_finish").val(ard[1]);

   // $("#ti_blo_fly_2 input:radio").filter(":checked").attr("checked", false);
    if (n == 1) {
        $("#v12").css({"display": "block"});
        $("#v15").css({"display": "none"});
    }
    else {
        $("#v12").css({"display": "none"});
        $("#v15").css({"display": "block"});
    }
//$("#date_day_hotel_start").val(ard[0]);
//$("#date_day_hotel_finish").val(ard[1]);
    sub_but();
}
//// Добавление рекомендуемых дат проживания из комментария в поля 2
function date_v_2(n) {
    var d = $("#date_v_" + n).val();
    var ard = d.split("-");
    var ds_ard = ard[0].split(".");
    if (ds_ard[0][0] == "0") ds_ard[0] = ds_ard[0][1];
    $("#ti_blo_day_hotel_start_ls #b_d [value=" + ds_ard[0] + "]").attr("selected", "selected");
    var df_ard = ard[1].split(".");
    if (df_ard[0][0] == "0") df_ard[0] = df_ard[0][1];
    $("#ti_blo_day_hotel_finish_ls #b_d [value=" + df_ard[0] + "]").attr("selected", "selected");

    $("#ti_blo_day_hotel_start_ls #date_day_hotel_start_ls").val(ard[0]);
    $("#ti_blo_day_hotel_finish_ls #date_day_hotel_finish_ls").val(ard[1]);

   // $("#ti_blo_fly_2 input:radio").filter(":checked").attr("checked", false);
    if (n == 1) {
       // $("#v12").css({"display": "block"});
       // $("#v15").css({"display": "none"});
    }
    else {
      //  $("#v12").css({"display": "none"});
      //  $("#v15").css({"display": "block"});
    }
//$("#date_day_hotel_start").val(ard[0]);
//$("#date_day_hotel_finish").val(ard[1]);
    sub_but();
}

//// Управление номерами
function upr_nomer(r) {
/*
    $("#ti_blo_nomer input:radio").filter(":checked").attr("checked", false);
    if (r == 3) {
        $("#nomer_2").css({"display": "none"});
    }
    else {
        $("#nomer_2").css({"display": "block"});
    }
	*/
}

//// Управление номерами для Leader Ship при загрузке страницы
function upr_nomer_ls_one(r) {

 switch (r) {
 case 0 :
	$("#nomer_ls_1").css({"display": "block"});
	$("#nomer_ls_2").css({"display": "block"});
	$("#nomer_ls_4").css({"display": "none"});
	$("#nomer_ls_5").css({"display": "none"});
	$("#nomer_ls_6").css({"display": "none"});
	$("#nomer_ls_7").css({"display": "none"});
	break;
case 1 :
	$("#nomer_ls_1").css({"display": "block"});
	$("#nomer_ls_2").css({"display": "block"});
	$("#nomer_ls_4").css({"display": "block"});
	$("#nomer_ls_5").css({"display": "block"});
	$("#nomer_ls_6").css({"display": "block"});
	$("#nomer_ls_7").css({"display": "block"});
	break;
case 2 :
	$("#nomer_ls_1").css({"display": "none"});
	$("#nomer_ls_2").css({"display": "none"});
	$("#nomer_ls_4").css({"display": "block"});
	$("#nomer_ls_5").css({"display": "block"});
	$("#nomer_ls_6").css({"display": "block"});
	$("#nomer_ls_7").css({"display": "block"});
	break;
 }
}
//// Управление номерами для Leader Ship
function upr_nomer_ls_two(r) {
 $("#ti_blo_nomer_ls input:radio").filter(":checked").attr ("checked", false);

 switch (r) {
 case 0 :
	$("#nomer_ls_1").css({"display": "block"});
	$("#nomer_ls_2").css({"display": "block"});
	$("#nomer_ls_4").css({"display": "none"});
	$("#nomer_ls_5").css({"display": "none"});
	$("#nomer_ls_6").css({"display": "none"});
	$("#nomer_ls_7").css({"display": "none"});
	break;
case 1 :
	$("#nomer_ls_1").css({"display": "block"});
	$("#nomer_ls_2").css({"display": "block"});
	$("#nomer_ls_4").css({"display": "block"});
	$("#nomer_ls_5").css({"display": "block"});
	$("#nomer_ls_6").css({"display": "block"});
	$("#nomer_ls_7").css({"display": "block"});
	break;
case 2 :
	$("#nomer_ls_1").css({"display": "none"});
	$("#nomer_ls_2").css({"display": "none"});
	$("#nomer_ls_4").css({"display": "block"});
	$("#nomer_ls_5").css({"display": "block"});
	$("#nomer_ls_6").css({"display": "block"});
	$("#nomer_ls_7").css({"display": "block"});
	break;
 }
}
//// Управление перелётами
function upr_fly(r) {
    $("#ti_blo_fly_2 input:radio").filter(":checked").attr("checked", false);
    if (r == 0) {
        $("#ko").css({"display": "none"});
        $("#mo").css({"display": "block"});
    }
    else {
        $("#ko").css({"display": "block"});
        $("#mo").css({"display": "none"})
    }
}

function old_show_check() {

    var fop = $("#ti_blo_oplata input:radio").filter(":checked").val();//какой способ оплаты выбран
    var hifop = $("#ti_blo_oplata input:hidden:eq(0)").val();  //скрытое поле - первый способ оплпты для сравнения
    var gn = $("#ti_blo_time_money_chk input:radio").filter(":checked").val(); //какая  выбрана рассрочка
    var gnh = $("#ti_blo_time_money_chk input:hidden:eq(0)").val(); //скрытое поле - первый тип рассрочки для сравнения

    if (fop == hifop) {
        var p_chk = "";   //№ ЧК плательщика
        var p_family = "";  //Фамилия плательщика
        var p_name = "";  //Имя плательщика
        var stts = "";
        var br = "";
        $("#erch").html("");
        // Скрытые поля проверки плательщика с сообщениями
        var cop0 = $("#ti_blo_pl_ok input:hidden:eq(0)").val(); // Проверка не пройдена
        var cop1 = $("#ti_blo_pl_ok input:hidden:eq(1)").val(); // Проверки не было
        var cop2 = $("#ti_blo_pl_ok input:hidden:eq(2)").val(); // Нужен гарант
        var cop3 = $("#ti_blo_pl_ok input:hidden:eq(3)").val(); // Не нужен гарант
        var cop4 = $("#ti_blo_pl_ok input:hidden:eq(4)").val(); // Проверка пройдена
        var chk = $("#chk").val();   //№ ЧК

        p_chk = $("#ti_blo_pl_chk input:text:eq(0)").val();  //№ ЧК плательщика
        p_family = $("#ti_blo_pl_family input:text:eq(0)").val();  //Фамилия плательщика
        p_name = $("#ti_blo_pl_name input:text:eq(0)").val(); //Имя плательщика
        gr_chk = $("#ti_blo_garant_chk input:text:eq(0)").val(); // № ЧК гаранта
        gr_family = $("#ti_blo_garant_family input:text:eq(0)").val(); // Фамилия гаранта
        gr_name = $("#ti_blo_garant_name input:text:eq(0)").val();  // Имя гаранта
        // Проверка если плательщик и заявитель одно лицо
        if (p_chk == chk) stts = 1;   //Если № ЧК равен № ЧК плательщика
        else stts = 0;   //Если № ЧК не равен № ЧК плательщика
        if (gn == gnh) br = 1; // Если оплата без рассрочки
        else br = 0; // Если оплата с рассрочкой

        $.ajax({
            type: "POST",
            url: "check_chk.php",
            data: "p_chk=" + p_chk + "&p_family=" + p_family + "&p_name=" + p_name + "&stts=" + stts + "&br=" + br + "&gr_chk=" + gr_chk + "&gr_family=" + gr_family + "&gr_name=" + gr_name,
            cache: false,
            success: function (html) {
                $("#tr").html(html);
                var ar_h = html.split("^");
                //ar_h[0] - id валюты
                //ar_h[1] - символьный код валюты
                //ar_h[2] - возвращаемый проверкой плательщика параметр
                //ar_h[3] - e-mail плательщика
                //ar_h[4] - код необходимости гаранта 1-нужен, 0 - не нужен
                //ar_h[5] - код ошибки
                if (ar_h[5] == 0) // Ошибки нет
                {
                    $("#pl_ok").val(cop4);// В поле Проверка плательщика - Проверка пройдена
                    $("#currency_id").val(ar_h[0]); // В поле ID валюты - ID валюты
                    $("#currency").val(ar_h[1]);// В поле валюта - символьный код валюты
                    $("#promotion_3").val(ar_h[2]); // В поле промоушен оплата -  - возвращаемый проверкой плательщика параметр
                    $("#garant_ok_id").val(ar_h[4]); // В поле валюта - код необходимости гаранта 1-нужен, 0 - не нужен
                    $("#pl_ok_id").val(ar_h[3]); // В поле код проверки плательщика - e-mail плательщика
                    //alert("OK");
                    setTimeout(function () {
                        $("#gud").click();
                    }, 1000); //// На следующий шаг, если все ОК
                }
                else  // Ошибка есть
                {//alert(ar_h[4]+" "+gn+"=="+gnh);

                    if (ar_h[4] && (ar_h[5] == 2 || ar_h[5] == 5)) {// ошибка проверки гаранта
                        if (gn == gnh) $("#garant_div").css("display", "none"); // гарант не нужен
                        else {
                            $("#garant_div").css("display", "block");
                            show_hsh("div_er_pro" + ar_h[5]);
                            var jo = $("#div_er_pro" + ar_h[5]).html();
                            $("#err_p_t").html(jo);
                            $("#err_p_b").click();
                        }

                    }
                    else {		// остальные ошибки
                        show_hsh("div_er_pro" + ar_h[5]);
                        $("#pl_ok").val(ar_h[5]);
                        var jo = $("#div_er_pro" + ar_h[5]).html();
                        $("#err_p_t").html(jo);
                        $("#err_p_b").click();
                    }


                }


            }

        });

    }
    else $("#gud").click();
}