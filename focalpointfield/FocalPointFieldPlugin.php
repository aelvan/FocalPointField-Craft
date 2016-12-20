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

class FocalPointFieldPlugin extends BasePlugin
{
    protected $_version = '1.0.2',
      $_schemaVersion = null,
      $_name = 'Focal Point Field',
      $_url = 'https://github.com/aelvan/FocalPointField-Craft',
      $_releaseFeedUrl = 'https://raw.githubusercontent.com/aelvan/FocalPointField-Craft/master/releases.json',
      $_documentationUrl = 'https://github.com/aelvan/FocalPointField-Craft/blob/master/README.md',
      $_description = 'Give your assets a focal point. They deserve it.',
      $_developer = 'André Elvan',
      $_developerUrl = 'http://vaersaagod.no/',
      $_minVersion = '2.5';

    public function getName()
    {
        return Craft::t($this->_name);
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getVersion()
    {
        return $this->_version;
    }

    public function getDeveloper()
    {
        return $this->_developer;
    }

    public function getDeveloperUrl()
    {
        return $this->_developerUrl;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getDocumentationUrl()
    {
        return $this->_documentationUrl;
    }

    public function getSchemaVersion()
    {
        return $this->_schemaVersion;
    }

    public function getReleaseFeedUrl()
    {
        return $this->_releaseFeedUrl;
    }

    public function getCraftRequiredVersion()
    {
        return $this->_minVersion;
    }

    /**
     * Init function
     */
    public function init()
    {

    }
    

}