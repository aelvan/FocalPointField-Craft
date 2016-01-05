<?php
namespace Craft;

/**
 * Focal Point Field by André Elvan
 *
 * @author      André Elvan <http://vaersaagod.no>
 * @package     Focal Point Field
 * @copyright   Copyright (c) 2016, André Elvan
 * @license     http://opensource.org/licenses/mit-license.php MIT License
 * @link        https://github.com/aelvan/Focal-Point-Field-Craft
 */

class FocalPointField_FocalPointFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('Focal Point');
    }

    public function getInputHtml($name, $value)
    {
        $elementType = strtolower($this->element->getElementType());
        $inputId = craft()->templates->formatInputId($name);
        $namespacedId = craft()->templates->namespaceInputId($inputId);
        
        // Include css
        craft()->templates->includeCssResource('focalpointfield/css/focalpoint.css');

				// Include Javascript
				craft()->templates->includeJsResource('focalpointfield/js/jquery.waitforimages.min.js');
				craft()->templates->includeJsResource('focalpointfield/js/focalpoint.js');

        // JS to kickstart leaflet field
        craft()->templates->includeJs("
            $(document).ready(function(){
                com.craftcms.FocalPointField('#$namespacedId-field');
            });
        ");
        
        return craft()->templates->render('focalpointfield/input', array(
          'name' => $name,
          'value' => $value,
          'elementType' => $elementType,
          'element' => $this->element
        ));
    }
    
    protected function defineSettings()
    {
        return array(
            'defaultFocalPoint' => array(AttributeType::String)
        );
    }
    
    public function getSettingsHtml()
    {
        return craft()->templates->render('focalpointfield/settings', array(
            'settings' => $this->getSettings()
        ));
    }
    
    
    public function prepValue($value)
    {
        if ($value=="") {
            $settings = $this->getSettings();
            return $settings['defaultFocalPoint'];
        }
        return $value;
    }

}