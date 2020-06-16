<?php
/**
 * Focal Point Field plugin for Craft CMS 3.x
 *
 * A utility plugin for migrating the Craft 2 focal point field to the native Craft 3 functionality.
 *
 * @link      http://www.vaersaagod.no
 * @copyright Copyright (c) 2019 André Elvan
 */

namespace aelvan\focalpointfield\fields;

use aelvan\focalpointfield\FocalPointFieldPlugin;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 */
class FocalPointField extends Field
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $defaultFocalPoint = '';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('focal-point-field', 'FocalPointField');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_STRING;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'focal-point-field/_components/fields/FocalPointField_settings',
            [
                'field' => $this,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);
        
        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'focal-point-field/_components/fields/FocalPointField_input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
            ]
        );
    }
}
