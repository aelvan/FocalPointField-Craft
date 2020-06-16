<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield\controllers;

use aelvan\focalpointfield\FocalPointFieldPlugin as Plugin;

use aelvan\focalpointfield\jobs\FocalPointFieldTask;
use Craft;
use craft\db\Query;
use craft\web\Controller;

/**
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = true;

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionCreateTasks()
    {
        $assets = Plugin::$plugin->migration->getUnmigratedAssets();
        $queue = Craft::$app->getQueue();

        foreach ($assets as $assetData) {
            $jobId = $queue->push(new FocalPointFieldTask([
                'description' => Craft::t('focal-point-field', 'Migrating focal point'),
                'assetData' => $assetData,
            ]));
        }
        
        return $this->asJson(['success' => true]);
    }
}
