<?php

/**
 * @file
 * Contains \Drupal\best_practices\Annotation\Practice.
 */

namespace Drupal\best_practices\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Practice annotation object.
 *
 * @Annotation
 */
class Practice extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the practice plugin.
   *
   * @var string
   */
  public $name;

}
