<?php
////////////////////////////////////////////////////////////////////////////
//                          INTERNATIONALISATION                          //
////////////////////////////////////////////////////////////////////////////
include(__DIR__.'/../lib/classes/i10n.php');
include(__DIR__.'/../lib/classes/Error.php');

$culture = isset($_GET['lang'])? $_GET['lang']:'fr';
i10n::SetLocale($culture);

// Call to translation CMS methode
function t($string, $args = array())
{
	return i10n::translate($string, $args);
}

function __($str) {
	return t($str);
} // alias pour les librairy ClearBricks

function tPlural($regular, $plural, $count)
{
	return i10n::format_plural($regular, $plural, $count);
}