<?php

/**
 * @file
 * Contains \Drupal\best_practices\BestPractices
 */

namespace Drupal\best_practices;

class BestPractices {

  /**
   * Get all the available plugins.
   *
   * @return array
   */
  static public function getPlugins() {
    $plugins_manager = PracticePluginManager::create();
    return $plugins_manager->getDefinitions();
  }

  /**
   * get a specific plugin.
   *
   * @param $id
   *   The plugin ID.
   *
   * @return PracticeBase
   *   The plugin information.
   */
  static public function getPlugin($id) {
    $plugins_manager = PracticePluginManager::create();
    return $plugins_manager->getDefinition($id);
  }

  /**
   * Instantiate a plugin
   *
   * @param $id
   *   The plugin ID.
   *
   * @return PracticeBase
   */
  static public function instantiatePlugin($id) {
    $plugins_manager = PracticePluginManager::create();
    return $plugins_manager->createInstance($id);
  }

}
