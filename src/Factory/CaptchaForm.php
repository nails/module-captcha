<?php

namespace Nails\Captcha\Factory;

class CaptchaForm
{
    /**
     * The label
     * @var string
     */
    protected $sLabel;

    /**
     * The HTML
     * @var string
     */
    protected $sHtml;

    // --------------------------------------------------------------------------

    /**
     * Sets the label
     *
     * @param string $sLabel The label to set
     *
     * @return $this
     */
    public function setLabel($sLabel)
    {
        $this->sLabel = $sLabel;
        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the label
     * @return string
     */
    public function getLabel()
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
    public function setHtml($sHtml)
    {
        $this->sHtml = $sHtml;
        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the HTML
     * @return string
     */
    public function getHtml()
    {
        return $this->sHtml;
    }
}
