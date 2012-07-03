<?php use_helper('I18N', 'Date') ?>
<?php $sf_response->addMeta('title', __("Administration | Dashboard", null, "sf_admin")) ?>
<?php slot('breadcrumb', array(array('url' => '@sf_admin_dashboard', 'label' => 'Tableau de bord'))) ?>
<?php slot('menu', 'sf_admin_dashboard') ?>
<?php use_stylesheet(public_path('/sfAdminTemplatePlugin/css/dashboard.css')) ?>
<?php include_partial('sfAdminDashboard/flashes') ?>

<div class="contentcontainer">
  <div class="headings">
    <h2><?php echo __('Dashboard', null, 'sf_admin') ?></h2>
  </div>
  <div class="contentbox">
    <div id="dashboard">
      <?php if($ga): ?>
        <div class="element visits">
          <h2><?php echo __("Visits", null, "sf_admin") ?></h2>
          <div class="gapistats">
            <?php echo $ga->getRawValue()->getGapiAreaChart(array("date"), array("visits"), "date", null, date('Y-m-d', strtotime("-20 days"))) ?>
          </div>
          <div class="access">
            <a target="_blank" href="<?php echo $ga->getLinkToReport() ?>"><?php echo __("View on GoogleAnalytics", null, "sf_admin") ?></a>
          </div>
        </div>
        <div class="element frequentation">
          <h2><?php echo __("Popularity", null, "sf_admin") ?></h2>
          <div class="gapistats">
            <?php $ga->getRawValue()->requestReportData(sfConfig::get('google_analytics_profile'), array('visitCount'), array('bounces', 'pageviews', 'visits', 'timeOnSite', 'newVisits')) ?>
            <table style="width: 100%">
              <thead>
                <tr>
                  <th><?php echo __("Visitors", null, "sf_admin") ?></th>
                  <th><?php echo __("Page views", null, "sf_admin") ?></th>
                  <th><?php echo __("Average page views", null, "sf_admin") ?></th>
                  <th><?php echo __("Bouncing rate", null, "sf_admin") ?></th>
                  <th><?php echo __("Average time on site", null, "sf_admin") ?></th>
                  <th><?php echo __("New visits", null, "sf_admin") ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $ga->getRawValue()->getVisits() ?></td>
                  <td><?php echo $ga->getRawValue()->getPageviews() ?></td>
                  <td><?php echo $ga->getRawValue()->getPageviews() > 0 && $ga->getRawValue()->getVisits() > 0 ? round($ga->getRawValue()->getPageviews() / $ga->getRawValue()->getVisits()) : 0 ?></td>
                  <td><?php echo round(($ga->getRawValue()->getBounces() * 100) / $ga->getRawValue()->getVisits(), 2) ?>%</td>
                  <td><?php echo gmdate("H:i:s", round($ga->getRawValue()->getTimeOnSite() / $ga->getRawValue()->getVisits(), 0)) ?></td>
                  <td><?php echo $ga->getRawValue()->getNewVisits() ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="access">
            <a target="_blank" href="<?php echo $ga->getLinkToReport() ?>"><?php echo __("View on GoogleAnalytics", null, "sf_admin") ?></a>
          </div>
        </div>
        <div class="element left sources">
          <h2><?php echo __("Incoming sources", null, "sf_admin") ?></h2>
          <div class="gapistats">
            <?php echo $ga->getRawValue()->getGapiPieChart(array("source"), array("visits"), "-visits", null, null, null, 1, 5) ?>
          </div>
          <div class="access">
            <a target="_blank" href="<?php echo $ga->getLinkToReport() ?>"><?php echo __("View on GoogleAnalytics", null, "sf_admin") ?></a>
          </div>
        </div>
        <div class="element right origine">
          <h2><?php echo __("Geografic synthesis", null, "sf_admin") ?></h2>
          <div class="gapistats">
            <?php echo $ga->getRawValue()->getGapiMap(array("country"), array("visits")) ?>
          </div>
          <div class="access">
            <a target="_blank" href="<?php echo $ga->getLinkToReport() ?>"><?php echo __("View on GoogleAnalytics", null, "sf_admin") ?></a>
          </div>
        </div>
        <div class="clear"></div>
      <?php else: ?>
        <p class="alert"><?php echo __("Unable to find website statistics. Maybe your GoogleAnalytics account is disabled or not accessible.", null, "sf_admin") ?></p>
      <?php endif ?>
    </div>
  </div>
</div>