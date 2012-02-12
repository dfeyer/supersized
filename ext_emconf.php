<?php

########################################################################
# Extension Manager/Repository config file for ext "supersized".
#
# Auto generated 10-02-2012 16:24
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
	'version' => '1.1.1',
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
	'author_email' => 'dfeyer@ttree.ch',
	'author_company' => 'ttree ltd',
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
	'_md5_values_when_last_written' => 'a:46:{s:10:"README.rst";s:4:"957c";s:12:"ext_icon.gif";s:4:"02f9";s:17:"ext_localconf.php";s:4:"12a9";s:14:"ext_tables.php";s:4:"5f91";s:14:"ext_tables.sql";s:4:"6817";s:43:"Classes/Controller/BackgroundController.php";s:4:"ff90";s:29:"Classes/Domain/Model/Page.php";s:4:"6402";s:33:"Classes/Domain/Model/Resource.php";s:4:"5e12";s:44:"Classes/Domain/Repository/PageRepository.php";s:4:"0873";s:48:"Classes/Domain/Repository/ResourceRepository.php";s:4:"ea58";s:35:"Classes/Utility/UserFuncUtility.php";s:4:"3231";s:39:"Classes/ViewHelpers/ImageViewHelper.php";s:4:"272d";s:30:"Configuration/TCA/Resource.php";s:4:"22c9";s:38:"Configuration/TypoScript/constants.txt";s:4:"693f";s:34:"Configuration/TypoScript/setup.txt";s:4:"e837";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"d630";s:38:"Resources/Private/Layouts/Default.html";s:4:"3562";s:37:"Resources/Private/Partials/Index.html";s:4:"d41d";s:53:"Resources/Private/Templates/Background/Configure.html";s:4:"0cfa";s:62:"Resources/Public/Icons/tx_supersized_domain_model_resource.gif";s:4:"43db";s:32:"Resources/Public/Images/back.png";s:4:"d3a5";s:36:"Resources/Public/Images/bg-black.png";s:4:"7798";s:36:"Resources/Public/Images/bg-hover.png";s:4:"761a";s:44:"Resources/Public/Images/button-tray-down.png";s:4:"eef3";s:42:"Resources/Public/Images/button-tray-up.png";s:4:"b0cb";s:35:"Resources/Public/Images/forward.png";s:4:"8a82";s:34:"Resources/Public/Images/nav-bg.png";s:4:"7bac";s:35:"Resources/Public/Images/nav-dot.png";s:4:"88ff";s:33:"Resources/Public/Images/pause.png";s:4:"2b94";s:32:"Resources/Public/Images/play.png";s:4:"3579";s:41:"Resources/Public/Images/progress-back.png";s:4:"b1f5";s:40:"Resources/Public/Images/progress-bar.png";s:4:"3358";s:36:"Resources/Public/Images/progress.gif";s:4:"db34";s:43:"Resources/Public/Images/supersized-logo.png";s:4:"57b4";s:38:"Resources/Public/Images/thumb-back.png";s:4:"15ad";s:41:"Resources/Public/Images/thumb-forward.png";s:4:"e4d1";s:48:"Resources/Public/JavaScript/jquery.easing.min.js";s:4:"ec64";s:41:"Resources/Public/JavaScript/jquery.min.js";s:4:"3c37";s:47:"Resources/Public/JavaScript/supersized.3.2.6.js";s:4:"88d8";s:51:"Resources/Public/JavaScript/supersized.3.2.6.min.js";s:4:"9fce";s:52:"Resources/Public/JavaScript/supersized.core.3.2.1.js";s:4:"10cc";s:56:"Resources/Public/JavaScript/supersized.core.3.2.1.min.js";s:4:"2271";s:47:"Resources/Public/StyleSheet/supersized.core.css";s:4:"5bdd";s:52:"Resources/Public/StyleSheet/supersized.slideshow.css";s:4:"94ad";s:14:"doc/manual.pdf";s:4:"ed4d";s:14:"doc/manual.sxw";s:4:"874c";}',
	'suggests' => array(
	),
);

?>