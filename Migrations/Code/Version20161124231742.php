<?php
namespace Neos\Flow\Core\Migrations;

/*
 * This file is part of the Neos.Flow package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

/**
 * Adjusts code to Imagine Renaming
 */
class Version20161124231742 extends AbstractMigration
{

    public function getIdentifier()
    {
        return 'Neos.Imagine-20161124231742';
    }

    /**
     * @return void
     */
    public function up()
    {
        $this->searchAndReplace('TYPO3\Imagine', 'Neos\Imagine');
        $this->searchAndReplace('TYPO3.Imagine', 'Neos.Imagine');
    }
}
