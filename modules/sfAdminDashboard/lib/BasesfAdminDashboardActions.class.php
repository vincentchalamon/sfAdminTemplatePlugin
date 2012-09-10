<?php

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Vincent CHALAMON <vincentchalamon@gmail.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class BasesfAdminDashboardActions extends sfActions
{
  public function executeDashboard(sfWebRequest $request)
  {
    return $this->redirect('@article');
    try
    {
      $this->ga = new gapi(sfConfig::get('google_analytics_login'), sfConfig::get('google_analytics_password'), sfConfig::get('google_analytics_profile'));
    }
    catch(Exception $e)
    {
      $this->ga = false;
    }
  }
}
