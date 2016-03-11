<?php

/**
 * @file
 * Contains \Drupal\best_practices\PracticeInterface.
 */

namespace Drupal\best_practices;

interface PracticeInterface {

  /**
   * Will hold the best practice validation logic.
   *
   * @return mixed
   */
  public function validate();

}
