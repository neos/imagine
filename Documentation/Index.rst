===========================
TYPO3 Imagine Documentation
===========================

*This version of the documentation has been rendered at:* |today|

Description
===========

TYPO3 Imagine is wrapper package around the Imagine_ PHP library. The Imagine library offer advanced methods to
manipulate images with an object oriented API.

Change the default driver
=========================

By default, we use the Gd driver, require PHP GD extension.

You can change this driver by editing the package settings "driver" with the following values:

* Imagick, based on the PECL Imagick_ extension
* Gmagick, based on the PECL Gmagick_ extension

Please read the document on the PECL website on how to install one of those two extensions.

.. _Imagine: https://github.com/avalanche123/Imagine
.. _Imagick: http://pecl.php.net/package/imagick
.. _Gmagick: http://pecl.php.net/package/gmagick

ICC Profile support
===================

Imagine has support for ICC profile, you can change the default ICC profile by editing the following settings::

    TYPO3:
        Imagine:
            profile:
                'RGB': 'color.org/sRGB_IEC61966-2-1_black_scaled.icc'
                'CMYK': 'Adobe/CMYK/USWebUncoated.icc'
                'Grayscale': 'colormanagement.org/ISOcoated_v2_grey1c_bas.ICC'

Available profile are located in the following directory: "Packages/Libraries/imagine/imagine/lib/Imagine/resources"

Use custom ICC profile
----------------------

You can use a profile located in your own package, with the following settings::

    TYPO3:
        Imagine:
            profile:
                'RGB': 'resource://Your.Package/Private/Profile/my-custom-profile-rgb.icc'

