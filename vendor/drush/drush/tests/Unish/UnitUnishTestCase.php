<?php

namespace Unish;

/**
 * Base class for Drush unit tests
 *
 * Those tests will run in a bootstrapped Drush environment
 *
 * This should be ran in separate processes, which the following
 * annotation should do in 3.6 and above:
 *
 * @runTestsInSeparateProcesses
 */
abstract class UnitUnishTestCase extends UnishTestCase {

  /**
   * Minimally bootstrap drush
   *
   * This is equivalent to the level DRUSH_BOOTSTRAP_NONE, as we
   * haven't run drush_bootstrap() yet. To do anything, you'll need to
   * bootstrap to some level using drush_bootstrap().
   *
   * @see drush_bootstrap()
   */
  public static function set_up_before_class() {
    parent::set_up_before_class();
    require_once(__DIR__ . '/../../includes/preflight.inc');
    drush_preflight_prepare();
    // Need to set DRUSH_COMMAND so that drush will be called and not phpunit
    if (!defined('DRUSH_COMMAND')) {
      define('DRUSH_COMMAND', UNISH_DRUSH);
    }
  }

  public static function tear_down_after_class() {
    parent::tear_down_after_class();
    \drush_postflight();
  }

  function drush_major_version() {
    return DRUSH_MAJOR_VERSION;
  }
}
