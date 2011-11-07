<?php

########################################################################
# Extension Manager/Repository config file for ext "supersized".
#
# Auto generated 18-09-2011 19:52
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Supersized Background',
	'description' => 'This extension include the jQuery Supersized plugin to add fullscreen background to your site.',
	'category' => 'fe',
	'shy' => 0,
	'version' => '1.1.0',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Dominique Feyer',
	'author_email' => 'dominique.feyer@reelpeek.net',
	'author_company' => 'ReelPeek',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.0-0.0.0',
			'typo3' => '4.5.0-4.6.99',
			'extbase' => '1.3.0-0.0.0',
			'fluid' => '1.3.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:25:{s:10:"README.rst";s:4:"957c";s:12:"ext_icon.gif";s:4:"02f9";s:17:"ext_localconf.php";s:4:"12a9";s:14:"ext_tables.php";s:4:"5f91";s:14:"ext_tables.sql";s:4:"6817";s:43:"Classes/Controller/BackgroundController.php";s:4:"d0a4";s:29:"Classes/Domain/Model/Page.php";s:4:"6402";s:33:"Classes/Domain/Model/Resource.php";s:4:"5e12";s:44:"Classes/Domain/Repository/PageRepository.php";s:4:"0873";s:48:"Classes/Domain/Repository/ResourceRepository.php";s:4:"88eb";s:35:"Classes/Utility/UserFuncUtility.php";s:4:"3231";s:39:"Classes/ViewHelpers/ImageViewHelper.php";s:4:"f8c2";s:30:"Configuration/TCA/Resource.php";s:4:"22c9";s:38:"Configuration/TypoScript/constants.txt";s:4:"6f3f";s:34:"Configuration/TypoScript/setup.txt";s:4:"f712";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"d630";s:38:"Resources/Private/Layouts/Default.html";s:4:"3562";s:37:"Resources/Private/Partials/Index.html";s:4:"d41d";s:53:"Resources/Private/Templates/Background/Configure.html";s:4:"ab60";s:62:"Resources/Public/Icons/tx_supersized_domain_model_resource.gif";s:4:"43db";s:41:"Resources/Public/JavaScript/jquery.min.js";s:4:"3c37";s:56:"Resources/Public/JavaScript/supersized.core.3.2.0.min.js";s:4:"485c";s:47:"Resources/Public/StyleSheet/supersized.core.css";s:4:"5bdd";s:14:"doc/manual.pdf";s:4:"ed4d";s:14:"doc/manual.sxw";s:4:"a178";}',
	'suggests' => array(
	),
);

?>