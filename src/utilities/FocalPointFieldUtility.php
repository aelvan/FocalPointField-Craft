<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield\utilities;

use aelvan\focalpointfield\FocalPointFieldPlugin as Plugin;
use aelvan\focalpointfield\assetbundles\focalpointfieldutilityutility\FocalPointFieldUtilityUtilityAsset;

use Craft;
use craft\base\Utility;
use craft\db\Query;

/**
 * Focal Point Field Utility
 *
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 */
class FocalPointFieldUtility extends Utility
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('focal-point-field', 'Focal point migration');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'focalpointfield-focal-point-field-utility';
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias("@aelvan/focalpointfield/assetbundles/focalpointfieldutilityutility/dist/img/FocalPointFieldUtility-icon.svg");
    }

    /**
     * @inheritdoc
     */
    public static function badgeCount(): int
    {
        return 1;
    }

    /**
     * @inheritdoc
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(FocalPointFieldUtilityUtilityAsset::class);
        
        $fieldCount = Plugin::$plugin->migration->getFocalPointFieldCount();
        $unmigratedCount = Plugin::$plugin->migration->getUnmigratedCount();
        
        return Craft::$app->getView()->renderTemplate(
            'focal-point-field/_components/utilities/FocalPointFieldUtility_content',
            [
                'fieldCount' => $fieldCount,
                'unmigratedCount' => $unmigratedCount
            ]
        );
    }
    
}
