<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_supersized_domain_model_resource'] = array(
	'ctrl' => $TCA['tx_supersized_domain_model_resource']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'title, resource',
	),
	'types' => array(
		'1' => array('showitem' => '
			--palette--;LLL:EXT:medialib/Resources/Private/Language/locallang.xml:palette.resource;resource,
			--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access, hidden, starttime, endtime
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden'),
		'resource' => array(
			'canNotCollapse' => TRUE,
			'showitem' => 'title, resource'
		),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'noIconsBelowSelect' => TRUE,
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'noIconsBelowSelect' => TRUE,
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_supersized_domain_model_resource',
				'foreign_table_where' => 'AND tx_supersized_domain_model_resource.pid=###CURRENT_PID### AND tx_supersized_domain_model_resource.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' =>array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:supersized/Resources/Private/Language/locallang_db.xml:tx_supersized_domain_model_resource.title',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim,required'
			),
		),
		'resource' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:supersized/Resources/Private/Language/locallang_db.xml:tx_supersized_domain_model_resource.resource',
			'config' => array(
				'type' => 'input',
				'size' => 60,
				'eval' => 'trim,required',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1'
					)
				),
			),
		)
	),
);
?>