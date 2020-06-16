<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield\assetbundles\focalpointfieldfieldfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 */
class FocalPointFieldFieldFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@aelvan/focalpointfield/assetbundles/focalpointfieldfieldfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/FocalPointFieldField.js',
        ];

        $this->css = [
            'css/FocalPointFieldField.css',
        ];

        parent::init();
    }
}
