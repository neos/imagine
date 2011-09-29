<?php
namespace Imagine;

/*                                                                        *
 * This script belongs to the FLOW3 package "Imagine".                    *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Abstract factory for Imagine package
 *
 * @scope singleton
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
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
		if (!in_array($settings['driver'], array('Gd', 'Imagick', 'Gmagick'), TRUE)) {
			throw new \InvalidArgumentException('The "driver" setting for Imagine must be one of Gd, Imagick, Gmagick.', 1316887156);
		}
	}

}

?>