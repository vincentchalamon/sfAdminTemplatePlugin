<?php

/**
 * sfAdminTemplatePlugin configuration.
 * 
 * @package    sfAdminTemplatePlugin
 * @subpackage config
 * @author     Vincent CHALAMON <vincentchalamon@gmail.com>
 */
class sfAdminTemplatePluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $config = sfConfig::get('app_sf_admin_template_google_analytics', array());
    foreach($config as $key => $value) {
      sfConfig::set('google_analytics_'.$key, $value);
    }
  }
}
