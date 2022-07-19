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

use Imagine\Image\ImagineInterface;
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
     * @param mixed ...$arguments
     * @return \Imagine\Image\ImagineInterface This is not necessarily true depending if you give another className
     * @api
     * @deprecated Use createDriver or createImagineClass as needed
     * @see createDriver
     * @see createImagineClass
     */
    public function create($className = 'Imagine', ...$arguments)
    {
        $this->configureDriverSpecificSettings($this->settings['driver']);
        return $this->createImagineClass($this->settings['driver'], $className, ...$arguments);
    }

    /**
     * Factory method to create a ImagineInterface driver instance, if you just want the currently configured one,
     * inject the \Imagine\Image\ImagineInterface which will use this factory method with the configured driver class.
     *
     * This will also apply driver specific settings.
     *
     * @param string $driverName
     * @param string $className
     * @param mixed ...$arguments
     * @return \Imagine\Image\ImagineInterface
     * @api
     */
    public function createDriver(string $driverName, ...$arguments): ImagineInterface
    {
        $this->configureDriverSpecificSettings($driverName);
        $className = $this->buildImagineClassName($driverName);

        return new $className(...$arguments);
    }

    /**
     * Create an instance of a driver-dependent imagine class. For example, specifying
     * "Image" with a driverName "Gd" will return an instance of the class
     * \Imagine\Gd\Image.
     *
     * This will not set any driver specific settings.
     *
     * @param string $driverName
     * @param string $className
     * @param mixed ...$arguments
     * @return object
     * @api
     */
    public function createImagineClass(string $driverName, $className, ...$arguments): object
    {
        $className = $this->buildImagineClassName($driverName, $className);
        return new $className(...$arguments);
    }

    /**
     * @param string $driverName
     * @return bool
     * @api
     */
    public function isDriverAvailable(string $driverName): bool
    {
        return class_exists($this->buildImagineClassName($driverName));
    }

    /**
     * @param string $driverName
     * @param string $className This should be a class that any imagine implementation provides, and defaults to the primary driver className
     * @return string
     */
    private function buildImagineClassName(string $driverName, $className = 'Imagine'): string
    {
        return 'Imagine\\' . $driverName . '\\' . $className;
    }

    /**
     * Set driver specific settings.
     *
     * @return void
     */
    protected function configureDriverSpecificSettings(string $driverName)
    {
        if ($driverName === 'Imagick') {
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
