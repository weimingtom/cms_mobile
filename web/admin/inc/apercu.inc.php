<?php
$apercu_culture	= (isset($culture) && !is_object($culture))? $culture:'fr';
$apercu_page	= (isset($oPageTranslate) && $oPageTranslate)? \classes\model\Page::getPageUrl($oPageTranslate->id, $oPageTranslate->culture):'';
?>
<h2>Aperçu</h2>
<div id="apercu_iphone">
	<iframe src="apercu.php?culture=<?php echo $apercu_culture ?>&page=<?php echo $apercu_page ?>"></iframe>
</div>