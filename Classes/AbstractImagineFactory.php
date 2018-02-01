<?php
namespace Neos\Imagine;

/*
 * This file is part of the Neos.Imagine package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;

/**
 * Abstract factory for Imagine package
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
        if (!isset($settings['enabledDrivers'])) {
            // FIXME: This is a hotfix and should actually be fixed in the Neos setup step. As soon as it is fixed there, this condition can be removed.
            return;
        }
        if (!in_array($settings['driver'], array_keys(array_filter($settings['enabledDrivers'])), true)) {
            throw new \InvalidArgumentException('The "driver" for Imagine must be enabled by settings, check Neos.Imagine.enabledDrivers.', 1515402616);
        }
    }
}
