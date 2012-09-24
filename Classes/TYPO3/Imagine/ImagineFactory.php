<?php
namespace TYPO3\Imagine;

/*                                                                        *
 * This script belongs to the FLOW3 package "Imagine".                    *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Imagine factory for Imagine package
 *
 * @FLOW3\Scope("singleton")
 */
class ImagineFactory extends AbstractImagineFactory {

	/**
	 * Factory method which creates an Imagine instance.
	 *
	 * @return \Imagine\Image\ImagineInterface
	 */
	public function create() {
		$implementationClassName = 'Imagine\\' . $this->settings['driver'] . '\Imagine';
		return new $implementationClassName();
	}

}

?>