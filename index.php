<?php
require "AutoLoad.php";
$ObjLayouts->heading();
$ObjMenus->main_menu($conf);
$ObjHeadings->main_banner();
$ObjCont->main_content();
$ObjCont->side_bar();
$ObjLayouts->footer($conf);