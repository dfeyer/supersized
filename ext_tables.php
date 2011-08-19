<?php

if (!defined ('TYPO3_MODE')) die ('Access denied.');

// Load Typoscript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Supersized Configuration');

t3lib_extMgm::allowTableOnStandardPages('tx_supersized_domain_model_resource');
$TCA['tx_supersized_domain_model_resource'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:supersized/Resources/Private/Language/locallang_db.xml:tx_supersized_domain_model_resource',
		'label' => 'title',
		'label_userFunc' => 'Tx_Supersized_Utility_UserFunc->getBackgroundTitle',
		'default_sortby' => 'ORDER BY title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'hideTable' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Resource.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_supersized_domain_model_resource.gif'
	),
);

// DATABASE: EXTEND TT_ADDRESS TABLE
t3lib_div::loadTCA('pages');

t3lib_extMgm::addTCAcolumns(
	'pages',
	array(
		'tx_supersized_background' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:supersized/Resources/Private/Language/locallang_db.xml:pages.tx_supersized_background',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_supersized_domain_model_resource',
				'foreign_field' => 'page',
				'maxitems' => 10,
				'appearance' => array(
					'collapseAll' => 1,
					'expandSingle' => 1,
				 ),
			 )
		)
	),
	TRUE
);
t3lib_extMgm::addToAllTCAtypes('pages', 'tx_supersized_background', '', 'before:module');

?>