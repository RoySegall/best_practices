<?php

/**
 * @file
 * Contains \Drupal\best_practices\Plugin\practice\Fonts.
 */

namespace Drupal\best_practices\Plugin\practice;

use Drupal\best_practices\PracticeBase;
use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;

/**
 * @Practice(
 *   id = "fonts",
 *   name = "Fonts",
 *   description = "Verify your theme include all the fonts formats"
 * )
 */
class Fonts extends PracticeBase {

  /**
   * {@inheritdoc}
   */
  public function validate() {
    $theme = variable_get('theme_default');
    $path = drupal_get_path('theme', $theme);
    $info_path = $path . '/' . $theme . '.info';
    $info = drupal_parse_info_file($info_path);

    $stylesheets = self::arrayFlatten($info['stylesheets']);

    foreach ($stylesheets as $stylesheet_path) {
      $this->checkFonts(file_get_contents($path . '/' . $stylesheet_path));
    }
  }

  /**
   * Validating the css content.
   *
   * @param $content
   *   The CSS content.
   */
  protected function checkFonts($content) {
  }

  /**
   * Flattens an array of allowed values.
   *
   * @param $array
   *   A single or multidimensional array.
   *
   * @return array
   *   A flattened array.
   *
   * @see options_array_flatten().
   */
  static public function arrayFlatten($array) {
    $result = array();

    if (is_array($array)) {
      foreach ($array as $key => $value) {
        if (is_array($value)) {
          $result += self::arrayFlatten($value);
        }
        else {
          $result[$key] = $value;
        }
      }
    }

    return $result;
  }

}
