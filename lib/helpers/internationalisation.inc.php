<?php
////////////////////////////////////////////////////////////////////////////
//                          INTERNATIONALISATION                          //
////////////////////////////////////////////////////////////////////////////
include('classes/i10n.php');
include('classes/Error.php');

$culture = isset($_GET['lang'])? $_GET['lang']:'fr';
i10n::SetLocale($culture);

// Call to translation CMS methode
function __($string, $args = array()) {
	return i10n::translate($string, $args);
}

function t($string, $args = array()){
	return __($string, $args);
}// alias pour les librairy ClearBricks

function tPlural($regular, $plural, $count) {
	return i10n::format_plural($regular, $plural, $count);
}