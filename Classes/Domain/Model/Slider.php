<?php
declare(strict_types=1);

namespace NITSAN\CardSlider\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Slider model for Card Slider
 */
class Slider extends AbstractEntity
{
    /**
     * @var string
     */
    #[Validate(['validator' => 'NotEmpty'])]
    protected string $title = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var ObjectStorage<\NITSAN\CardSlider\Domain\Model\Slide>
     */
    #[Lazy()]
    protected ObjectStorage $slides;

    /**
     * @var bool
     */
    protected bool $autoplay = true;

    /**
     * @var int
     */
    protected int $autoplaySpeed = 5000;

    /**
     * @var bool
     */
    protected bool $showArrows = true;

    /**
     * @var bool
     */
    protected bool $showDots = true;

    /**
     * @var bool
     */
    protected bool $infinite = true;

    /**
     * @var bool
     */
    protected bool $pauseOnHover = true;

    /**
     * @var int
     */
    protected int $slidesToShow = 1;

    /**
     * @var int
     */
    protected int $slidesToScroll = 1;

    /**
     * @var string
     */
    protected string $animation = 'slide';

    /**
     * @var int
     */
    protected int $animationSpeed = 300;

    /**
     * @var string
     */
    protected string $height = 'auto';

    /**
     * @var string
     */
    protected string $cssClass = '';

    /**
     * @var bool
     */
    protected bool $lazyLoad = true;

    /**
     * @var bool
     */
    protected bool $touchSwipe = true;

    /**
     * @var bool
     */
    protected bool $accessibility = true;

    /**
     * @var string
     */
    protected string $breakpoints = '';

    /**
     * @var bool
     */
    protected bool $hidden = false;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $starttime = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $endtime = null;

    public function __construct()
    {
        $this->slides = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSlides(): ObjectStorage
    {
        return $this->slides;
    }

    public function setSlides(ObjectStorage $slides): void
    {
        $this->slides = $slides;
    }

    public function addSlide(Slide $slide): void
    {
        $this->slides->attach($slide);
    }

    public function removeSlide(Slide $slide): void
    {
        $this->slides->detach($slide);
    }

    public function isAutoplay(): bool
    {
        return $this->autoplay;
    }

    public function setAutoplay(bool $autoplay): void
    {
        $this->autoplay = $autoplay;
    }

    public function getAutoplaySpeed(): int
    {
        return $this->autoplaySpeed;
    }

    public function setAutoplaySpeed(int $autoplaySpeed): void
    {
        $this->autoplaySpeed = $autoplaySpeed;
    }

    public function isShowArrows(): bool
    {
        return $this->showArrows;
    }

    public function setShowArrows(bool $showArrows): void
    {
        $this->showArrows = $showArrows;
    }

    public function isShowDots(): bool
    {
        return $this->showDots;
    }

    public function setShowDots(bool $showDots): void
    {
        $this->showDots = $showDots;
    }

    public function isInfinite(): bool
    {
        return $this->infinite;
    }

    public function setInfinite(bool $infinite): void
    {
        $this->infinite = $infinite;
    }

    public function isPauseOnHover(): bool
    {
        return $this->pauseOnHover;
    }

    public function setPauseOnHover(bool $pauseOnHover): void
    {
        $this->pauseOnHover = $pauseOnHover;
    }

    public function getSlidesToShow(): int
    {
        return $this->slidesToShow;
    }

    public function setSlidesToShow(int $slidesToShow): void
    {
        $this->slidesToShow = $slidesToShow;
    }

    public function getSlidesToScroll(): int
    {
        return $this->slidesToScroll;
    }

    public function setSlidesToScroll(int $slidesToScroll): void
    {
        $this->slidesToScroll = $slidesToScroll;
    }

    public function getAnimation(): string
    {
        return $this->animation;
    }

    public function setAnimation(string $animation): void
    {
        $this->animation = $animation;
    }

    public function getAnimationSpeed(): int
    {
        return $this->animationSpeed;
    }

    public function setAnimationSpeed(int $animationSpeed): void
    {
        $this->animationSpeed = $animationSpeed;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function setHeight(string $height): void
    {
        $this->height = $height;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function setCssClass(string $cssClass): void
    {
        $this->cssClass = $cssClass;
    }

    public function isLazyLoad(): bool
    {
        return $this->lazyLoad;
    }

    public function setLazyLoad(bool $lazyLoad): void
    {
        $this->lazyLoad = $lazyLoad;
    }

    public function isTouchSwipe(): bool
    {
        return $this->touchSwipe;
    }

    public function setTouchSwipe(bool $touchSwipe): void
    {
        $this->touchSwipe = $touchSwipe;
    }

    public function isAccessibility(): bool
    {
        return $this->accessibility;
    }

    public function setAccessibility(bool $accessibility): void
    {
        $this->accessibility = $accessibility;
    }

    public function getBreakpoints(): string
    {
        return $this->breakpoints;
    }

    public function setBreakpoints(string $breakpoints): void
    {
        $this->breakpoints = $breakpoints;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getStarttime(): ?\DateTime
    {
        return $this->starttime;
    }

    public function setStarttime(?\DateTime $starttime): void
    {
        $this->starttime = $starttime;
    }

    public function getEndtime(): ?\DateTime
    {
        return $this->endtime;
    }

    public function setEndtime(?\DateTime $endtime): void
    {
        $this->endtime = $endtime;
    }

    public function getVisibleSlides(): ObjectStorage
    {
        $visibleSlides = new ObjectStorage();
        
        foreach ($this->slides as $slide) {
            if ($slide->isVisible()) {
                $visibleSlides->attach($slide);
            }
        }

        return $visibleSlides;
    }

    public function hasSlides(): bool
    {
        return $this->slides->count() > 0;
    }

    public function getSlideCount(): int
    {
        return $this->slides->count();
    }

    public function getVisibleSlideCount(): int
    {
        return $this->getVisibleSlides()->count();
    }
}