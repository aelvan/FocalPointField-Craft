<?php

namespace aelvan\focalpointfield\migrations;

use Craft;
use aelvan\focalpointfield\fields\FocalPointField;
use craft\db\Migration;

/**
 * m190813_110339_updatefieldclass migration.
 */
class m190813_110339_updatefieldclass extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        echo "m190813_110339_updatefieldclass running. Updating field class.\n";
        
        // Migrate the old field
        $this->update('{{%fields}}', [
            'type' => FocalPointField::class
        ], ['type' => 'FocalPointField_FocalPoint']);

        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190813_110339_updatefieldclass cannot be reverted.\n";
        return false;
    }
}
