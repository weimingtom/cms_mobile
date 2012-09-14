<?php
header("Content-type:text/css; charset=UTF-8");
$css = json_decode($_GET['values'], true);
?>
body {width:100%; height:100%; margin:0; padding:0; background-color:#<?php echo $css['background'] ?>; font-family:"<?php echo $css['font_family'] ?>",Arial,sans-serif; font-size:<?php echo $css['font_size'] ?>; color:#<?php echo $css['font_color'] ?>}

abbr,article,aside,audio,bb,canvas,datagrid,datalist,details,dialog,eventsource,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video {display:block}

.clear {clear:both; display:block; float:none !important}
.clearfix:after {content:"."; display:block; clear:both; visibility:hidden; line-height:0; height:0}
.clearfix {display:inline-block}
.acenter {text-align:center}
.aright {text-align:right}
.ajustify {text-align:justify}
.fleft {float:left}
.fright {float:right}
.w50 {width:50%}
.w100 {width:100%}
img {border:0; vertical-align:bottom}
ul {margin:0; padding:0; list-style:none}
ul li {margin:0; padding:0}
a {color:#<?php echo $css['color2']['100'] ?>; outline:none; -moz-outline-style:none}
table {width:100%; border:0; border-collapse:collapse}
p {margin-top:0;}
.responsive_img {max-width:100%; height:auto; width:auto; box-sizing:border-box; -ms-interpolation-mode:bicubic;}

h1 {font-size:<?php echo $css['h1_size'] ?>; margin:0; text-transform:uppercase; color:#<?php echo $css['color1']['100'] ?>;}
h2 {font-size:<?php echo $css['h2_size'] ?>; font-weight:lighter; margin:0px 0 10px; position:relative; color:#333;}
h3 {font-size:<?php echo $css['h3_size'] ?>; font-weight:bold; margin:0 0 10px; color:#333;}
h4 {font-size:<?php echo $css['h4_size'] ?>; margin:15px 0 0 0; color:#333;}
h5 {font-size:<?php echo $css['h5_size'] ?>; font-weight:bold; text-transform:uppercase; margin:0;}

header {}
header #header_top {color:#fff; font-size:15px; font-weight:bold; line-height:35px; text-align:center;
background:#<?php echo $css['color2']['80'] ?>;
background:-moz-linear-gradient(top, #<?php echo $css['color2']['80'] ?> 0%, #<?php echo $css['color1']['100'] ?> 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $css['color2']['80'] ?>), color-stop(100%,#<?php echo $css['color1']['100'] ?>));
background:-webkit-linear-gradient(top, #<?php echo $css['color2']['80'] ?> 0%,#<?php echo $css['color1']['100'] ?> 100%);
background:-o-linear-gradient(top, #<?php echo $css['color2']['80'] ?> 0%,#<?php echo $css['color1']['100'] ?> 100%);
background:-ms-linear-gradient(top, #<?php echo $css['color2']['80'] ?> 0%,#<?php echo $css['color1']['100'] ?> 100%);
background:linear-gradient(top, #<?php echo $css['color2']['80'] ?> 0%,#<?php echo $css['color1']['100'] ?> 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#4096ee', endColorstr='#f94346',GradientType=0 );}

header #switch_culture {float:right;}
header #switch_culture li {float:left; margin-left:5px;}
header #switch_culture li img {opacity:0.7; -moz-opacity:0.7; -ms-filter:"alpha(opacity=70)"; filter:alpha(opacity=70);}
header #switch_culture li img#current_culture {opacity:1; -moz-opacity:1; -ms-filter:"alpha(opacity=100)"; filter:alpha(opacity=100);}

header #header_middle {margin-bottom:15px;}
header nav#menu_principal {width:100%;}
/*
header nav#menu_principal .triangle {border-color:#<?php echo $css['background'] ?> #<?php echo $css['color1']['100'] ?> #<?php echo $css['background'] ?> #<?php echo $css['background'] ?>; border-style:solid; border-width:28px; width:0; height:0;}*/
header nav#menu_principal ul {float:right; width:90%; background-color:#<?php echo $css['color1']['100'] ?>; margin:0; padding:0}
header nav#menu_principal ul li {margin:0; float:left;}
header nav#menu_principal ul li a {/*text-indent:-9999px;*/ display:block; width:55px; height:55px; text-decoration:none; font-weight:bold; line-height:52px; padding:0 10px; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s; text-align:center;}
header nav#menu_principal ul li a:hover, nav#menu_principal ul li a.active_menu_item {background-color:#<?php echo $css['color2']['100'] ?>; color:#fff;}
*/
header nav#menu_principal .triangle {background-color:#<?php echo $css['background'] ?>; padding:0; margin:0;}
header nav#menu_principal .triangle:hover {background-color:#<?php echo $css['background'] ?> !important;}
header nav#menu_principal .triangle div {position:relative; background:#<?php echo $css['color1']['100'] ?>;}
header nav#menu_principal .triangle div:after {right:100%; border:solid transparent; content:" "; height:0; width:0; position:absolute; pointer-events:none; border-right-color:#<?php echo $css['color1']['100'] ?>; border-width:27px; margin-top:-28px; top:50%;}
header nav#menu_principal table tr {float:right; width:90%; background-color:#<?php echo $css['color1']['100'] ?>; margin:0; padding:0}
header nav#menu_principal table tr td {vertical-align:middle; height:55px; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s;}
header nav#menu_principal table tr td a {display:block; width:55px; text-decoration:none; font-weight:bold; padding:0 10px; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s; text-align:center;}
header nav#menu_principal table tr td:hover, nav#menu_principal table tr td.active_menu_item {background-color:#<?php echo $css['color2']['100'] ?>;}
header nav#menu_principal table tr td:hover a, header nav#menu_principal table tr td a:hover, nav#menu_principal table tr td.active_menu_item a {color:#fff;}

div#container {margin:0 15px;}

footer {border-top:1px solid #bdbdbc; background-color:#<?php echo $css['color1']['100'] ?>; text-align:center; color:#fff; line-height:25px; margin:20px auto 0; font-size:11px}
footer a {color:#fff; text-decoration:none;}
footer a:hover {text-decoration:underline;}


/* BOUTON */
.button {display:block; width:250px; height:30px; color:white; background-color:#272930; text-align:center; font-size:13px; line-height:30px; font-weight:bold; text-decoration:none; cursor:pointer; background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#272930), to(#1f2126)); background:-moz-linear-gradient(19% 75% 90deg,#1f2126, #272930); border-left:solid 1px #373737; border-top:solid 1px #373737; border-right:solid 1px #333; border-bottom:solid 1px #333; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; -webkit-gradient(linear, 0% 0%, 0% 100%, from(#272930), to(#1f2126);)}
.button:hover {text-shadow:0px 0px 4px #fff}
.btn_savoir_plus {width:120px}
.btn_sabonner, .btn_archives {width:100px; float:left; margin:15px 10px 0 0}
#picto_rss {left:-3px; position:relative; top:-3px}
.btn_telecharger_cv {width:170px; float:right}
.btn_telecharger_cd {width:160px; float:right; position:relative; z-index:2; right:85px; top:10px}
.btn_submit {width:120px; text-transformation:uppercase; float:none !important}
.btn_contact {float:right; position:relative; right:-10px}

/* FORM */
.warning_box, .valid_box, .error_box {padding:15px 20px 15px 60px; margin:0 0 10px 0}
.warning_box {background:url(../img/warning.png) no-repeat 15px center #fcfae9; border:1px #e9e6c7 solid}
.valid_box {background:url(../img/valid.png) no-repeat 15px center #edfce9; border:1px #cceac4 solid}
.error_box {background:url(../img/error.png) no-repeat 15px center #fce9e9; border:1px #eac7c7 solid}
.form_fields {margin-bottom:15px;}
.form_fields label {font-weight:bold;}
.form_fields input[type="text"], .form_fields textarea, .form_fields select {width:99%; padding:0.3em 0.5%; -webkit-box-shadow:inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2); -moz-box-shadow:inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2); box-shadow:inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2); -webkit-border-radius:0.6em; -moz-border-radius:0.6em; border-radius:0.6em; border:1px solid #B3B3B3; color:#333; text-shadow:0 1px 0 #fff; filter:dropshadow(color=#fff, offx=0, offy=1); font-size:16px; line-height:1.4; margin-top:0.3em; background-image:none; background:#f0f0f0;background-image:-moz-linear-gradient(top,#fff,#f0f0f0);background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,#fff),color-stop(1,#f0f0f0));-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorStr='#ffffff',EndColorStr='#f0f0f0')";}
.form_fields textarea {height:8em;}
.form_fields select {width:100%;}
.form_fields .box_check_radio {}
.form_fields .box_check_radio label {font-weight:normal; position:relative; top:-2px;}

.form_fields input:focus, .form_fields textarea:focus, .form_fields select:focus {box-shadow:0 0 12px #387bbe;}