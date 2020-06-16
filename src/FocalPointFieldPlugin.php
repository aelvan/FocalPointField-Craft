<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield;

use aelvan\focalpointfield\fields\FocalPointField;
use aelvan\focalpointfield\services\MigrationService;
use aelvan\focalpointfield\utilities\FocalPointFieldUtility;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\services\Fields;
use craft\services\Utilities;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class FocalPointField
 *
 * @property  MigrationService $migration
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 *
 */
class FocalPointFieldPlugin extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var FocalPointFieldPlugin
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '2.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        
        // Register services
        $this->setComponents([
            'migration' => MigrationService::class,
        ]);
        
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = FocalPointField::class;
            }
        );

        Event::on(
            Utilities::class,
            Utilities::EVENT_REGISTER_UTILITY_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = FocalPointFieldUtility::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'focal-point-field',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
