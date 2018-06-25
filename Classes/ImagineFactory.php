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
 * Imagine factory for Imagine package
 *
 * @Flow\Scope("singleton")
 */
class ImagineFactory extends AbstractImagineFactory
{
    /**
     * @var \Neos\Flow\ObjectManagement\ObjectManagerInterface
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
     * @throws \ReflectionException
     * @api
     */
    public function create($className = 'Imagine')
    {
        $this->configureDriverSpecificSettings();

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

    /**
     * Set driver specific settings.
     *
     * @return void
     */
    protected function configureDriverSpecificSettings()
    {
        if ($this->settings['driver'] === 'Imagick') {
            $this->configureImagickSettings();
        }
    }

    /**
     * Sets limits for the Imagick driver.
     *
     * @return void
     */
    protected function configureImagickSettings()
    {
        if (!isset($this->settings['driverSpecific']['Imagick'])) {
            return;
        }

        $limits = $this->settings['driverSpecific']['Imagick']['limits'] ? $this->settings['driverSpecific']['Imagick']['limits'] : [];
        foreach ($limits as $resourceType => $limit) {
            \Imagick::setResourceLimit($resourceType, $limit);
        }
    }
}
