<?php

namespace App\Model\Dashboard;

trait DisplayContextTrait
{
    protected ?string $title;
    protected ?string $subTitle;
    protected ?string $icon;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return DisplayContextTrait
     */
    public function setTitle(?string $title): DisplayContextTrait
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    /**
     * @param string|null $subTitle
     *
     * @return DisplayContextTrait
     */
    public function setSubTitle(?string $subTitle): DisplayContextTrait
    {
        $this->subTitle = $subTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     *
     * @return DisplayContextTrait
     */
    public function setIcon(?string $icon): DisplayContextTrait
    {
        $this->icon = $icon;
        return $this;
    }

}
