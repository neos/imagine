<?php
namespace TYPO3\Imagine;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Imagine".               *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Abstract factory for Imagine package
 *
 * @Flow\Scope("singleton")
 */
class AbstractImagineFactory {

	/**
	 * @var array
	 */
	protected $settings = array();

	/**
	 * Injects the settings.
	 *
	 * @param array $settings
	 * @return void
	 * @throws \InvalidArgumentException
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
		if (!in_array($settings['driver'], array('Gd', 'Imagick', 'Gmagick'), TRUE)) {
			throw new \InvalidArgumentException('The "driver" setting for Imagine must be one of Gd, Imagick, Gmagick.', 1316887156);
		}
	}

}
