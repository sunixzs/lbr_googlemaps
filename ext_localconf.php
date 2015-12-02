<?php
if (! defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('LBR.' . $_EXTKEY, 'GoogleMap', array(
	'GoogleMap' => 'list'
), array());
