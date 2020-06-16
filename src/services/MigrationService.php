<?php

namespace aelvan\focalpointfield\services;

use Craft;
use craft\base\Component;
use craft\db\Query;

/**
 * @author    André Elvan
 * @package   FocalPointField
 * @since     2.0.0
 *
 * @property int $unmigratedCount
 */
class MigrationService extends Component
{
    public function updateAssetFocalPoint($assetData)
    {
        $fieldHandle = $this->getFocalPointFieldName();
        $asset = Craft::$app->assets->getAssetById($assetData['elementId']);
        $oldFocalPoint = $this->convertFocalPointFormat($assetData['field_'.$fieldHandle]);
        
        if (!$asset) {
            return false;
        }
        
        $asset->focalPoint = $oldFocalPoint;
        $result = Craft::$app->elements->saveElement($asset);
        
        if (!$result) {
            return false;
        }
        
        $this->wipeOldFocalPoint($assetData);
        
        return true;
    }
    
    
    public function getUnmigratedAssets()
    {
        $fieldHandle = $this->getFocalPointFieldName();
        
        if ($fieldHandle===null) {
            return null;
        }
        
        $assets = (new Query())
            ->from(['{{%content}}'])
            ->where(['<>', 'field_'.$fieldHandle, 'null'])
            ->andWhere(['<>', 'field_'.$fieldHandle, '50% 50%'])
            ->andWhere(['<>', 'field_'.$fieldHandle, ''])
            ->groupBy('elementId')
            ->limit(null)
            ->all();
        
        return $assets;
    }

    /**
     * @return int
     */
    public function getFocalPointFieldCount(): int 
    {
        return (new Query())
            ->from(['{{%fields}}'])
            ->where(['type' => 'aelvan\focalpointfield\fields\FocalPointField'])
            ->limit(null)
            ->count();
    }
    
    /**
     * @return int
     */
    public function getUnmigratedCount(): int 
    {
        $fieldHandle = $this->getFocalPointFieldName();
        
        if ($fieldHandle===null) {
            return 0;
        }
        
        return (new Query())
            ->from(['{{%content}}'])
            ->where(['<>', 'field_'.$fieldHandle, 'null'])
            ->andWhere(['<>', 'field_'.$fieldHandle, '50% 50%'])
            ->andWhere(['<>', 'field_'.$fieldHandle, ''])
            ->groupBy('elementId')
            ->limit(null)
            ->count();
    }

    /**
     * @return string|null
     */
    public function getFocalPointFieldName() 
    {
        $field = (new Query())
            ->from(['{{%fields}}'])
            ->where(['type' => 'aelvan\focalpointfield\fields\FocalPointField'])
            ->one();
        
        if ($field) {
            return $field['handle'];
        }
        
        return null;
    }

    private function convertFocalPointFormat($oldFocalPoint)
    {
        $oldArr = explode(' ', str_replace('%', '', $oldFocalPoint));
        
        if (count($oldArr)!==2) {
            return null;
        }
        
        return [
            'x' => floatval($oldArr[0])/100,
            'y' => floatval($oldArr[1])/100
        ];
    }
    
    private function wipeOldFocalPoint($assetData)
    {
        $db = Craft::$app->getDb();
        $db->createCommand()->update('{{%content}}', ['field_focalPoint' => null], ['elementId' => $assetData['elementId']])->execute();
    }
}
