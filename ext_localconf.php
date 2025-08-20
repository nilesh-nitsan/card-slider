<?php

defined('TYPO3') || die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

(function () {
    ExtensionUtility::configurePlugin(
        'CardSlider',
        'Slider',
        [
            \NITSAN\CardSlider\Controller\SliderController::class => 'list, show'
        ],
        [
            \NITSAN\CardSlider\Controller\SliderController::class => ''
        ]
    );

    // Register icon
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'card-slider-plugin',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:card_slider/Resources/Public/Icons/Extension.svg']
    );
})();