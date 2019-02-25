	</div>

</section>

<!--==============================footer=================================-->
<footer style="display:none;">
    <div class="main">
        <div class="wrapper">
            <div class="fleft">
                <div class="text-bot">
                    <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array("AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/copyright.php"),
                    false);
                    ?>
                </div>
            </div>
            <div class="footer-link"></div>
        </div>
    </div>
</footer>
<!--==============================End footer=================================-->
<div id="to_top" class="dico dico_small-up_8"></div>
</body>
</html>