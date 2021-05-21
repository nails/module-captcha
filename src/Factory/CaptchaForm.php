<?php

namespace Nails\Captcha\Factory;

/**
 * Class CaptchaForm
 *
 * @package Nails\Captcha\Factory
 */
class CaptchaForm
{
    /**
     * The label
     *
     * @var string
     */
    protected $sLabel;

    /**
     * The HTML
     *
     * @var string
     */
    protected $sHtml;

    /**
     * Whether the captcha is invisible
     *
     * @var bool
     */
    protected $bIsInvisible = false;

    // --------------------------------------------------------------------------

    /**
     * Sets the label
     *
     * @param string $sLabel The label to set
     *
     * @return $this
     */
    public function setLabel(string $sLabel): CaptchaForm
    {
        $this->sLabel = $sLabel;
        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the label
     *
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->sLabel;
    }

    // --------------------------------------------------------------------------

    /**
     * Sets the HTML
     *
     * @param string $sHtml The HTML to set
     *
     * @return $this
     */
    public function setHtml(string $sHtml): CaptchaForm
    {
        $this->sHtml = $sHtml;
        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the HTML
     *
     * @return string
     */
    public function getHtml(): ?string
    {
        return $this->sHtml;
    }

    // --------------------------------------------------------------------------

    /**
     * Sets whether the captcha is invisible
     *
     * @param bool $bIsInvisible Whether the captcha is invisible or not
     *
     * @return $this
     */
    public function setInvisible(bool $bIsInvisible): CaptchaForm
    {
        $this->bIsInvisible = $bIsInvisible;
        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns whether the captcha is invisible
     *
     * @return bool
     */
    public function isInvisible(): bool
    {
        return $this->bIsInvisible;
    }
}
