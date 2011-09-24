<?php
namespace Imagine;

/*                                                                        *
 * This script belongs to the FLOW3 package "Imagine".                    *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Image factory for Imagine package
 *
 * @scope singleton
 */
class ImageFactory extends AbstractImagineFactory {

	/**
	 * Factory method which creates an Image instance.
	 *
	 * @return \Doctrine\ORM\EntityManager
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function create() {
		$implementationClassname = 'Imagine\\' . $this->settings['driver'] . '\Image';
		return new $implementationClassname();
	}

}

?>