<?php

namespace aelvan\focalpointfield\migrations;

use aelvan\focalpointfield\fields\FocalPointField;

use craft\db\Migration;

/**
 * @author    nystudio107
 * @package   SEOmatic
 * @since     3.0.0
 */
class Install extends Migration
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        echo "Install updating.\n";

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }

    // Protected Methods
    // =========================================================================

}
