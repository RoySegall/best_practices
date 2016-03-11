<?php

/**
 * @file
 * Contains \Drupal\best_practices\PracticePluginManager.
 */

namespace Drupal\best_practices;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\plug\Util\Module;

/**
 * Name plugin manager.
 */
class PracticePluginManager extends DefaultPluginManager {

  /**
   * Constructs PracticePluginManager.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \DrupalCacheInterface $cache_backend
   *   Cache backend instance to use.
   */
  public function __construct(\Traversable $namespaces, \DrupalCacheInterface $cache_backend) {

    parent::__construct('Plugin/practice', $namespaces, 'Drupal\best_practices\PracticeInterface', '\Drupal\best_practices\Annotation\Practice');
    $this->setCacheBackend($cache_backend, 'practice_plugins');
    $this->alterInfo('practice_plugin');
  }

  /**
   * NamePluginManager factory method.
   *
   * @param string $bin
   *   The cache bin for the plugin manager.
   *
   * @return PracticePluginManager
   *   The created manager.
   */
  public static function create($bin = 'cache') {
    return new static(Module::getNamespaces(), _cache_get_object($bin));
  }

}
