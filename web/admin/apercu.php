<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CMS Mobile | ADMIN | apercu</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php echo $cd ?><?php echo CSS_DIR ?>admin.css"/>
		<script src="<?php echo $cd ?><?php echo JS_DIR ?>jquery-1.2.6.min.js"></script>
		<script type="text/javascript" src="<?php echo $cd ?><?php echo JS_DIR ?>ui.core-1.5.3.js"></script>
		<script type="text/javascript" src="<?php echo $cd ?><?php echo JS_DIR ?>ui.slider.js"></script>
		<script type="text/javascript" src="<?php echo $cd ?><?php echo JS_DIR ?>iphone-unlock.js"></script>
	</head>

<body>
<div id="iphone-scrollcontainer">
	
	<input type="hidden" name="target" id="target" value="<?php echo BASE_DIR ?><?php echo $_GET['culture'] ?>/<?php echo $_GET['page'] ?>" />
	
	<div id="iphone-inside">
        <div id="unlock-top">
            <p id="timepicker" class="time">08:23</p>
            <p id="datepicker" class="date">Wednesday, July 6</p>
        </div>
        <div id="unlock-spacer">
        	&nbsp;
        </div>
        <div id="unlock-bottom">
        	<div id="slide-to-unlock"></div>
        	<div id="unlock-slider-wrapper">
        		<div id="unlock-slider"><div id="unlock-handle"></div></div>
        	</div>
        </div>
    </div>
</div>
</body>
</html>