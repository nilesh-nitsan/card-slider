<?php
declare(strict_types=1);

namespace NITSAN\CardSlider\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Slide model for Card Slider
 */
class Slide extends AbstractEntity
{
    /**
     * @var string
     */
    #[Validate(['validator' => 'NotEmpty'])]
    protected string $title = '';

    /**
     * @var string
     */
    protected string $subtitle = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var string
     */
    protected string $linkText = '';

    /**
     * @var string
     */
    protected string $linkUrl = '';

    /**
     * @var string
     */
    protected string $linkTarget = '_self';

    /**
     * @var FileReference|null
     */
    #[Lazy()]
    protected ?FileReference $image = null;

    /**
     * @var int
     */
    protected int $sorting = 0;

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

    /**
     * @var ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    #[Lazy()]
    protected ObjectStorage $categories;

    /**
     * @var string
     */
    protected string $cssClass = '';

    /**
     * @var string
     */
    protected string $animation = 'fade';

    /**
     * @var int
     */
    protected int $duration = 5000;

    public function __construct()
    {
        $this->categories = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLinkText(): string
    {
        return $this->linkText;
    }

    public function setLinkText(string $linkText): void
    {
        $this->linkText = $linkText;
    }

    public function getLinkUrl(): string
    {
        return $this->linkUrl;
    }

    public function setLinkUrl(string $linkUrl): void
    {
        $this->linkUrl = $linkUrl;
    }

    public function getLinkTarget(): string
    {
        return $this->linkTarget;
    }

    public function setLinkTarget(string $linkTarget): void
    {
        $this->linkTarget = $linkTarget;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    public function getSorting(): int
    {
        return $this->sorting;
    }

    public function setSorting(int $sorting): void
    {
        $this->sorting = $sorting;
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

    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    public function setCategories(ObjectStorage $categories): void
    {
        $this->categories = $categories;
    }

    public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category): void
    {
        $this->categories->attach($category);
    }

    public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category): void
    {
        $this->categories->detach($category);
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function setCssClass(string $cssClass): void
    {
        $this->cssClass = $cssClass;
    }

    public function getAnimation(): string
    {
        return $this->animation;
    }

    public function setAnimation(string $animation): void
    {
        $this->animation = $animation;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function hasLink(): bool
    {
        return !empty($this->linkUrl);
    }

    public function isVisible(): bool
    {
        if ($this->hidden) {
            return false;
        }

        $now = new \DateTime();
        
        if ($this->starttime && $this->starttime > $now) {
            return false;
        }

        if ($this->endtime && $this->endtime < $now) {
            return false;
        }

        return true;
    }
}