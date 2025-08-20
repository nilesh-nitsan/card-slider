<?php

declare(strict_types=1);

namespace NITSAN\CardSlider\Controller;

use NITSAN\CardSlider\Domain\Model\Slider;
use NITSAN\CardSlider\Domain\Repository\SliderRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * SliderController handles frontend display of card sliders
 */
class SliderController extends ActionController
{
    public function __construct(
        private readonly SliderRepository $sliderRepository
    ) {
    }

    /**
     * List action - displays all active sliders
     */
    public function listAction(): ResponseInterface
    {
        $sliders = $this->sliderRepository->findByHidden(0);
        $this->view->assign('sliders', $sliders);
        
        return $this->htmlResponse();
    }

    /**
     * Show action - displays a single slider
     */
    public function showAction(Slider $slider = null): ResponseInterface
    {
        if ($slider === null) {
            $uid = (int)($this->settings['slider'] ?? 0);
            if ($uid > 0) {
                $slider = $this->sliderRepository->findByUid($uid);
            }
        }

        if ($slider === null) {
            $sliders = $this->sliderRepository->findByHidden(0);
            $slider = $sliders->getFirst();
        }

        $this->view->assignMultiple([
            'slider' => $slider,
            'settings' => $this->settings,
            'flexformSettings' => $this->getFlexformSettings()
        ]);

        return $this->htmlResponse();
    }

    /**
     * Display action - flexible slider display with various options
     */
    public function displayAction(): ResponseInterface
    {
        $displayMode = $this->settings['displayMode'] ?? 'carousel';
        $limit = (int)($this->settings['limit'] ?? 10);
        $orderBy = $this->settings['orderBy'] ?? 'sorting';
        $orderDirection = $this->settings['orderDirection'] ?? 'ASC';
        
        $sliders = $this->getSlidersBySettings($limit, $orderBy, $orderDirection);
        
        $this->view->assignMultiple([
            'sliders' => $sliders,
            'displayMode' => $displayMode,
            'settings' => $this->settings,
            'flexformSettings' => $this->getFlexformSettings()
        ]);

        return $this->htmlResponse();
    }

    /**
     * Category action - displays sliders filtered by categories
     */
    public function categoryAction(): ResponseInterface
    {
        $categories = GeneralUtility::intExplode(',', $this->settings['categories'] ?? '', true);
        $sliders = [];
        
        if (!empty($categories)) {
            $sliders = $this->sliderRepository->findByCategories($categories);
        } else {
            $sliders = $this->sliderRepository->findByHidden(0);
        }

        $this->view->assignMultiple([
            'sliders' => $sliders,
            'categories' => $categories,
            'settings' => $this->settings
        ]);

        return $this->htmlResponse();
    }

    /**
     * Get sliders based on plugin settings
     */
    private function getSlidersBySettings(int $limit, string $orderBy, string $orderDirection): QueryResultInterface
    {
        $selectedSliders = GeneralUtility::intExplode(',', $this->settings['selectedSliders'] ?? '', true);
        
        if (!empty($selectedSliders)) {
            return $this->sliderRepository->findByUids($selectedSliders, $orderBy, $orderDirection, $limit);
        }
        
        return $this->sliderRepository->findAll($orderBy, $orderDirection, $limit);
    }

    /**
     * Get flexform settings from plugin configuration
     */
    private function getFlexformSettings(): array
    {
        return [
            'autoplay' => (bool)($this->settings['autoplay'] ?? true),
            'autoplaySpeed' => (int)($this->settings['autoplaySpeed'] ?? 5000),
            'showArrows' => (bool)($this->settings['showArrows'] ?? true),
            'showDots' => (bool)($this->settings['showDots'] ?? true),
            'infinite' => (bool)($this->settings['infinite'] ?? true),
            'slidesToShow' => (int)($this->settings['slidesToShow'] ?? 1),
            'slidesToScroll' => (int)($this->settings['slidesToScroll'] ?? 1),
            'responsive' => (bool)($this->settings['responsive'] ?? true),
            'fade' => (bool)($this->settings['fade'] ?? false),
            'lazyLoad' => (bool)($this->settings['lazyLoad'] ?? true),
            'accessibility' => (bool)($this->settings['accessibility'] ?? true),
            'cssClass' => $this->settings['cssClass'] ?? '',
            'height' => $this->settings['height'] ?? 'auto'
        ];
    }
}