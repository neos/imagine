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
 * Font factory for Imagine package
 *
 * @scope singleton
 */
class FontFactory extends AbstractImagineFactory {

	/**
	 * Factory method which creates a Font instance.
	 *
	 * @return \Doctrine\ORM\EntityManager
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function create() {
		$implementationClassname = 'Imagine\\' . $this->settings['driver'] . '\Font';
		return new $implementationClassname();
	}

}

?>