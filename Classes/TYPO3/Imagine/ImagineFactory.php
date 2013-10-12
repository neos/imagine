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
 * Imagine factory for Imagine package
 *
 * @Flow\Scope("singleton")
 */
class ImagineFactory extends AbstractImagineFactory {

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 * @Flow\Inject
	 */
	protected $objectManager;

	/**
	 * Factory method which creates an Imagine instance.
	 *
	 * By default this factory creates an Imagine service according to the currently configured driver (for example GD
	 * or ImageMagick).
	 *
	 * You may alternatively specify a class name of a driver-dependent class you need an instance of. For example,
	 * specifying "Image" with the currently configured driver "Gd" will return an instance of the class
	 * \Imagine\Gd\Image.
	 *
	 * @param string $className If specified, this factory will create an instance of the driver dependent class
	 * @return \Imagine\Image\ImagineInterface
	 * @api
	 */
	public function create($className = 'Imagine') {
		$className = 'Imagine\\' . $this->settings['driver'] . '\\' . $className;
		$arguments = array_slice(func_get_args(), 1);

		switch (count($arguments)) {
			case 0: $object = new $className(); break;
			case 1: $object = new $className($arguments[0]); break;
			case 2: $object = new $className($arguments[0], $arguments[1]); break;
			case 3: $object = new $className($arguments[0], $arguments[1], $arguments[2]); break;
			case 4: $object = new $className($arguments[0], $arguments[1], $arguments[2], $arguments[3]); break;
			case 5: $object = new $className($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4]); break;
			case 6: $object = new $className($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5]); break;
			default:
				$class = new \ReflectionClass($className);
				$object =  $class->newInstanceArgs($arguments);
		}
		return $object;
	}

}
