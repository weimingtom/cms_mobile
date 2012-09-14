<?php
namespace helpers;
use \MyPDO as MyPDO;

class ImportSqlFile
{
	
	function __construct($file)
	{
		$contents = file_get_contents($file);
		
		// Remove C style and inline comments
		$comment_patterns = array('/\/\*.*(\n)*.*(\*\/)?/', '/\s*--.*\n/', '/\s*#.*\n/');
		$contents = preg_replace($comment_patterns, "\n", $contents);
		
		// Retrieve sql statements
		$statements = explode(";\n", $contents);
		$statements = preg_replace("/\s/", ' ', $statements);
		
		// Execute statements
		$pdo = MyPDO::getInstance();
		foreach($statements as $query) {
			if(trim($query) != '')
				$pdo->exec($query);
		}
	}
	
}