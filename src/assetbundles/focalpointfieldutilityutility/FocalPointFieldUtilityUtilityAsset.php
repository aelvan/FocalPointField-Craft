<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield\assetbundles\focalpointfieldutilityutility;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 */
class FocalPointFieldUtilityUtilityAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@aelvan/focalpointfield/assetbundles/focalpointfieldutilityutility/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/FocalPointFieldUtility.js',
        ];

        $this->css = [
            'css/FocalPointFieldUtility.css',
        ];

        parent::init();
    }
}
