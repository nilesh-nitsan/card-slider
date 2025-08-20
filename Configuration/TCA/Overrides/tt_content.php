<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'CardSlider',
    'Slider',
    'LLL:EXT:card_slider/Resources/Private/Language/locallang_db.xlf:tx_cardslider_plugin.title'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['cardslider_slider'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'cardslider_slider',
    'FILE:EXT:card_slider/Configuration/FlexForms/PluginSettings.xml'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'card_slider',
    'Configuration/TypoScript',
    'Card Slider Static Template'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['cardslider_slider'] = 'layout,recursive,select_key,pages';