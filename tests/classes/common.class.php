<?php
class Common {

	const STATUS_OFFLINE	= 0;
	const STATUS_ONLINE		= 1;
	const STATUS_ARCHIVED	= 2;

	public static function getStatus($status) {
		$statusList = array(
			self::STATUS_OFFLINE	=> 'Hors Ligne',
			self::STATUS_ONLINE		=> 'En Ligne',
			self::STATUS_ARCHIVED	=> 'Archivé'
		);

		return $statusList[$status];
	}
	
}