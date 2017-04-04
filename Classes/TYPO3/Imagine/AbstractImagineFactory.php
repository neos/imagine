<?php
namespace TYPO3\Imagine;

/*
 * This file is part of the TYPO3.Imagine package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Annotations as Flow;

/**
 * Abstract factory for Imagine package.
 *
 * @Flow\Scope("singleton")
 */
class AbstractImagineFactory
{
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * Injects the settings.
     *
     * @param array $settings
     * @return void
     * @throws \InvalidArgumentException
     */
    public function injectSettings(array $settings)
    {
        $this->settings = $settings;
        if (!in_array($settings['driver'], ['Gd', 'Imagick', 'Gmagick'], true)) {
            throw new \InvalidArgumentException('The "driver" setting for Imagine must be one of Gd, Imagick, Gmagick.', 1316887156);
        }
    }
}
