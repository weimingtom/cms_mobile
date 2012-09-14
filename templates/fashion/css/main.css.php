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
img {border:0; vertical-align:top}
ul {margin:0; padding:0; list-style:none}
ul li {margin:0 0 0 20px; padding:0}
a {color:#<?php echo $css['color2']['100'] ?>; outline:none; -moz-outline-style:none}
table {width:100%; border:0; border-collapse:collapse}
p {margin-top:0;}
.responsive_img {max-width:100%; height:auto; width:auto; box-sizing:border-box; -ms-interpolation-mode:bicubic;}

h1 {font-size:<?php echo $css['h1_size'] ?>; margin:0; font-weight:bold; text-transform:uppercase; color:#<?php echo $css['color2']['100'] ?>;}
h2 {font-size:<?php echo $css['h2_size'] ?>; font-weight:lighter; font-weight:bold; margin:20px 0 0; position:relative; color:#<?php echo $css['color1']['100'] ?>;}
h3 {font-size:<?php echo $css['h3_size'] ?>; font-weight:bold; margin:0 0 10px; color:#<?php echo $css['color1']['80'] ?>;}
h4 {font-size:<?php echo $css['h4_size'] ?>; margin:15px 0 0 0; color:#333;}
h5 {font-size:<?php echo $css['h5_size'] ?>; font-weight:bold; text-transform:uppercase; margin:0;}


.wrapper {background-color:#fff; margin:0 10px;}

header {}
header #header_top {color:#fff; font-size:15px; font-weight:bold; height:40px; line-height:40px; text-align:center;
background:rgb(56,56,56);
background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzM4MzgzOCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMyYTJhMmEiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background:-moz-linear-gradient(top, rgba(56,56,56,1) 0%, rgba(42,42,42,1) 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(56,56,56,1)), color-stop(100%,rgba(42,42,42,1)));
background:-webkit-linear-gradient(top, rgba(56,56,56,1) 0%,rgba(42,42,42,1) 100%);
background:-o-linear-gradient(top, rgba(56,56,56,1) 0%,rgba(42,42,42,1) 100%);
background:-ms-linear-gradient(top, rgba(56,56,56,1) 0%,rgba(42,42,42,1) 100%);
background:linear-gradient(to bottom, rgba(56,56,56,1) 0%,rgba(42,42,42,1) 100%);
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#383838', endColorstr='#2a2a2a',GradientType=0);}

header #backBtn {display:block; color:#FFF; font-size:12px; height:30px; line-height:28px; position:absolute; left:20px; text-decoration:none; top:5px; width:30px; /*border:1px solid #6d1c1a;*/ -webkit-border-radius:0 5px 5px 0; border-radius:0 5px 5px 0; text-shadow:0 -1px #444; -webkit-box-shadow:0 0 1px 0 #888; box-shadow:0 0 1px 0 #888; padding:0 10px;
/*background:#828d9a;
background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzgyOGQ5YSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iIzY0NzQ4MyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iIzU3Njg3OCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM1NzY4NzgiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background:-moz-linear-gradient(top, #828d9a 0%, #647483 50%, #576878 51%, #576878 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#828d9a), color-stop(50%,#647483), color-stop(51%,#576878), color-stop(100%,#576878));
background:-webkit-linear-gradient(top, #828d9a 0%,#647483 50%,#576878 51%,#576878 100%);
background:-o-linear-gradient(top, #828d9a 0%,#647483 50%,#576878 51%,#576878 100%);
background:-ms-linear-gradient(top, #828d9a 0%,#647483 50%,#576878 51%,#576878 100%);
background:linear-gradient(to bottom, #828d9a 0%,#647483 50%,#576878 51%,#576878 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#828d9a', endColorstr='#576878',GradientType=0 );*/
background-color:#576878;}
header #backBtn:after {right:100%; border:solid transparent; content:" "; height:0; width:0; position:absolute; pointer-events:none; border-right-color:#576878; border-width:15px; margin-top:-15px; top:50%;}
header #backBtn:hover {/*background:#576878;
background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzU3Njg3OCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iIzU3Njg3OCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iIzY0NzQ4MyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM4MjhkOWEiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background:-moz-linear-gradient(top, #576878 0%, #576878 50%, #647483 51%, #828d9a 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#576878), color-stop(50%,#576878), color-stop(51%,#647483), color-stop(100%,#828d9a));
background:-webkit-linear-gradient(top, #576878 0%,#576878 50%,#647483 51%,#828d9a 100%);
background:-o-linear-gradient(top, #576878 0%,#576878 50%,#647483 51%,#828d9a 100%);
background:-ms-linear-gradient(top, #576878 0%,#576878 50%,#647483 51%,#828d9a 100%);
background:linear-gradient(to bottom, #576878 0%,#576878 50%,#647483 51%,#828d9a 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#576878', endColorstr='#828d9a',GradientType=0 );*/
background-color:#828d9a;}
header #backBtn:hover:after {border-right-color:#828d9a;}


header #addFavorite {display:block; color:#FFF; font-size:25pt; height:30px; line-height:28px; position:absolute; right:5px; text-decoration:none; top:3px; width:30px; border:1px solid #6d1c1a; -webkit-border-radius:5px; border-radius:5px; text-shadow:0 -1px #444; -webkit-box-shadow:0 0 1px 0 #888; box-shadow:0 0 1px 0 #888; 
background:#cb5644;
background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2NiNTY0NCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iI2I4MzgyYyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iI2FmMWQxMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM5OTEyMTEiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background:-moz-linear-gradient(top, #cb5644 0%, #b8382c 50%, #af1d10 51%, #991211 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#cb5644), color-stop(50%,#b8382c), color-stop(51%,#af1d10), color-stop(100%,#991211));
background:-webkit-linear-gradient(top, #cb5644 0%,#b8382c 50%,#af1d10 51%,#991211 100%);
background:-o-linear-gradient(top, #cb5644 0%,#b8382c 50%,#af1d10 51%,#991211 100%);
background:-ms-linear-gradient(top, #cb5644 0%,#b8382c 50%,#af1d10 51%,#991211 100%);
background:linear-gradient(to bottom, #cb5644 0%,#b8382c 50%,#af1d10 51%,#991211 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#cb5644', endColorstr='#991211',GradientType=0 );}
header #addFavorite:hover {
background:#991211;
background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzk5MTIxMSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iI2FmMWQxMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iI2I4MzgyYyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjYjU2NDQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background:-moz-linear-gradient(top, #991211 0%, #af1d10 50%, #b8382c 51%, #cb5644 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#991211), color-stop(50%,#af1d10), color-stop(51%,#b8382c), color-stop(100%,#cb5644));
background:-webkit-linear-gradient(top, #991211 0%,#af1d10 50%,#b8382c 51%,#cb5644 100%);
background:-o-linear-gradient(top, #991211 0%,#af1d10 50%,#b8382c 51%,#cb5644 100%);
background:-ms-linear-gradient(top, #991211 0%,#af1d10 50%,#b8382c 51%,#cb5644 100%);
background:linear-gradient(to bottom, #991211 0%,#af1d10 50%,#b8382c 51%,#cb5644 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#991211', endColorstr='#cb5644',GradientType=0 );}

header #switch_culture {float:right;}
header #switch_culture li {float:left; margin-left:5px;}
header #switch_culture li img {opacity:0.7; -moz-opacity:0.7; -ms-filter:"alpha(opacity=70)"; filter:alpha(opacity=70);}
header #switch_culture li img#current_culture {opacity:1; -moz-opacity:1; -ms-filter:"alpha(opacity=100)"; filter:alpha(opacity=100);}

header #header_middle {padding-top:15px;}

div#container {padding:5px 0 20px;}

footer {text-align:center; color:#fff; padding:10px 0; font-size:10px}
footer a {color:#fff; text-decoration:none;}
footer a:hover {text-decoration:underline;}


/* BOUTON */
.btn {display:inline-block; height:30px; color:#fff; /*padding:0 15px;*/width:95%; font-weight:bold; font-family:Helvetica; text-align:center; font-size:13px; line-height:30px; text-decoration:none; cursor:pointer; -webkit-border-radius:3px; border-radius:3px; margin:5px 0; -webkit-box-shadow:-3px 2px 3px 0 #999; box-shadow:-3px 2px 3px 0 #999; border:0;
background:#<?php echo $css['color1']['50'] ?>;
background:-moz-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%, #<?php echo $css['color1']['60'] ?> 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $css['color1']['50'] ?>), color-stop(100%,#<?php echo $css['color1']['60'] ?>));
background:-webkit-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:-o-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:-ms-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:linear-gradient(to bottom, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $css['color1']['50'] ?>', endColorstr='#<?php echo $css['color1']['60'] ?>',GradientType=0 );}
.btn:hover {background:#<?php echo $css['color2']['100'] ?>;}
form .btn {width:30%;}

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

/* NAV */
/* menu_inline_all_on_bar */
nav.menu_inline_all_on_bar {width:100%;}
nav.menu_inline_all_on_bar table tr {float:right; width:90%; background-color:#<?php echo $css['color1']['100'] ?>; margin:0; padding:0}
nav.menu_inline_all_on_bar table tr td {vertical-align:middle; height:55px; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s;}
nav.menu_inline_all_on_bar table tr td a {display:block; width:55px; text-decoration:none; font-weight:bold; padding:0 10px; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s; text-align:center;}
nav.menu_inline_all_on_bar table tr td:hover, nav.menu_inline_all_on_bar table tr td.active_menu_item {background-color:#<?php echo $css['color2']['100'] ?>;}
nav.menu_inline_all_on_bar table tr td:hover a, nav.menu_inline_all_on_bar table tr td a:hover, nav.menu_inline_all_on_bar table tr td.active_menu_item a {color:#fff;}
/* menu_inline_one_by_one */
nav.menu_inline_one_by_one {width:98%; margin:0 1% 25px;}
nav.menu_inline_one_by_one .home {width:45px;}
nav.menu_inline_one_by_one .menu_navigator {width:20px;}
nav.menu_inline_one_by_one .menu_navigator img {vertical-align:bottom;}
nav.menu_inline_one_by_one .menu_separator {width:0;}
nav.menu_inline_one_by_one .menu_item {color:#fff; font-falily:Helvetica; font-weight:bold; font-size:16px;}
nav.menu_inline_one_by_one .home, nav.menu_inline_one_by_one .menu_navigator, nav.menu_inline_one_by_one .menu_item {height:30px;
background:#<?php echo $css['color1']['50'] ?>;
background:-moz-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%, #<?php echo $css['color1']['60'] ?> 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $css['color1']['50'] ?>), color-stop(100%,#<?php echo $css['color1']['60'] ?>));
background:-webkit-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:-o-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:-ms-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:linear-gradient(to bottom, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $css['color1']['50'] ?>', endColorstr='#<?php echo $css['color1']['60'] ?>',GradientType=0 );}
nav.menu_inline_one_by_one table {}
nav.menu_inline_one_by_one table tr {margin:0; padding:0}
nav.menu_inline_one_by_one table tr td {vertical-align:middle; text-align:center; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s;}
nav.menu_inline_one_by_one table tr td.menu_separator {background:none;}
nav.menu_inline_one_by_one table tr td a {text-decoration:none; -webkit-transition-duration:0.5s; -moz-transition-duration:0.5s; transition-duration:0.5s;}
nav.menu_inline_one_by_one table tr td:hover, nav.menu_inline_one_by_one table tr td.active_menu_item {background-color:#<?php echo $css['color2']['100'] ?>;}
nav.menu_inline_one_by_one table tr td:hover a, nav.menu_inline_one_by_one table tr td a:hover, nav.menu_inline_one_by_one table tr td.active_menu_item a {color:#fff;}

/* menu_block_one_by_lign */
nav.menu_block_one_by_lign {margin-top:15px;}
nav.menu_block_one_by_lign ul {width:100%;}
nav.menu_block_one_by_lign ul li {margin:0;}
nav.menu_block_one_by_lign ul li a {display:block; position:relative; padding-left:10px; height:30px; color:#fff; font-weight:bold; font-family:Helvetica; font-size:13px; line-height:30px; text-decoration:none; cursor:pointer; -webkit-border-radius:3px; border-radius:3px; margin:5px 20px; -webkit-box-shadow:-3px 2px 3px 0 #999; box-shadow:-3px 2px 3px 0 #999;
background:#<?php echo $css['color1']['50'] ?>;
background:-moz-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%, #<?php echo $css['color1']['60'] ?> 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $css['color1']['50'] ?>), color-stop(100%,#<?php echo $css['color1']['60'] ?>));
background:-webkit-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:-o-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:-ms-linear-gradient(top, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
background:linear-gradient(to bottom, #<?php echo $css['color1']['50'] ?> 0%,#<?php echo $css['color1']['60'] ?> 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $css['color1']['50'] ?>', endColorstr='#<?php echo $css['color1']['60'] ?>',GradientType=0 );}
nav.menu_block_one_by_lign ul li:last-child a, nav.menu_block_one_by_lign ul li a:hover {background:#<?php echo $css['color2']['100'] ?>;}
nav.menu_block_one_by_lign ul li a img {position:absolute; right:7px; top:7px;}
 
/* menu_inline_all_in_txt */
nav.menu_inline_all_in_txt a {font-size:11px; text-decoration:underline;}
nav.menu_inline_all_in_txt a:hover {text-decoration:none;}


/* TABLEU */
table.tableau {width:100%;border-collapse:collapse;}
table.tableau td, table.tableau th {border:#eee solid 1px;text-align:center;padding:3px;}
table.tableau thead {background:#<?php echo $css['color1']['100'] ?>;color:#fff;}
table.tableau tbody th {background:#ddd;}
table.tableau tbody td {font-weight:bold;color:#<?php echo $css['color1']['100'] ?>;}