<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield\jobs;

use aelvan\focalpointfield\FocalPointFieldPlugin as Plugin;

use Craft;
use craft\queue\BaseJob;
use yii\base\Exception;

/**
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 */
class FocalPointFieldTask extends BaseJob
{
    // Public Properties
    // =========================================================================

    /**
     * @var null|array
     */
    public $assetData = null;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        // Do work here
        $result = Plugin::$plugin->migration->updateAssetFocalPoint($this->assetData);
        
        if ($result) {
            return true;
        } else {
            throw new Exception('An error occured for job "' . $this->getDescription() . '", asset not found.');
        }
        
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function defaultDescription(): string
    {
        return Craft::t('focal-point-field', 'Focal Point migration job');
    }
}
