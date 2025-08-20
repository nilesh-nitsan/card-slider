<?php

declare(strict_types=1);

namespace NITSAN\CardSlider\Controller;

use NITSAN\CardSlider\Domain\Model\Slide;
use NITSAN\CardSlider\Domain\Repository\SlideRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * SlideController handles individual slide display and management
 */
class SlideController extends ActionController
{
    public function __construct(
        private readonly SlideRepository $slideRepository
    ) {
    }

    /**
     * Show action - displays a single slide
     */
    public function showAction(Slide $slide = null): ResponseInterface
    {
        if ($slide === null) {
            $uid = (int)($this->settings['slide'] ?? 0);
            if ($uid > 0) {
                $slide = $this->slideRepository->findByUid($uid);
            }
        }

        $this->view->assignMultiple([
            'slide' => $slide,
            'settings' => $this->settings
        ]);

        return $this->htmlResponse();
    }

    /**
     * List action - displays slides for a specific slider
     */
    public function listAction(): ResponseInterface
    {
        $sliderUid = (int)($this->settings['slider'] ?? 0);
        $slides = [];
        
        if ($sliderUid > 0) {
            $slides = $this->slideRepository->findBySlider($sliderUid);
        } else {
            $slides = $this->slideRepository->findByHidden(0);
        }

        $this->view->assignMultiple([
            'slides' => $slides,
            'sliderUid' => $sliderUid,
            'settings' => $this->settings
        ]);

        return $this->htmlResponse();
    }

    /**
     * Gallery action - displays slides in gallery format
     */
    public function galleryAction(): ResponseInterface
    {
        $sliderUid = (int)($this->settings['slider'] ?? 0);
        $limit = (int)($this->settings['limit'] ?? 0);
        $orderBy = $this->settings['orderBy'] ?? 'sorting';
        
        $slides = [];
        if ($sliderUid > 0) {
            $slides = $this->slideRepository->findBySlider($sliderUid, $orderBy, $limit);
        }

        $this->view->assignMultiple([
            'slides' => $slides,
            'gallerySettings' => $this->getGallerySettings(),
            'settings' => $this->settings
        ]);

        return $this->htmlResponse();
    }

    /**
     * Get gallery-specific settings
     */
    private function getGallerySettings(): array
    {
        return [
            'columns' => (int)($this->settings['columns'] ?? 3),
            'showTitles' => (bool)($this->settings['showTitles'] ?? true),
            'showDescriptions' => (bool)($this->settings['showDescriptions'] ?? true),
            'lightbox' => (bool)($this->settings['lightbox'] ?? false),
            'cropVariant' => $this->settings['cropVariant'] ?? 'default',
            'imageWidth' => (int)($this->settings['imageWidth'] ?? 400),
            'imageHeight' => (int)($this->settings['imageHeight'] ?? 300)
        ];
    }
}