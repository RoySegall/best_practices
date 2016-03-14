<?php

/**
 * @file
 * Contains \Drupal\best_practices\Plugin\practice\Fonts.
 */

namespace Drupal\best_practices\Plugin\practice;

use Drupal\best_practices\BestPracticesException;
use Drupal\best_practices\PracticeBase;

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
    $theme_name = variable_get('theme_default');
    $themes = list_themes();
    $theme = $themes[$theme_name];
    $stylesheets = self::arrayFlatten($theme->stylesheets);

    foreach ($stylesheets as $stylesheet_path) {
      $this->checkFonts(file_get_contents($stylesheet_path));
    }
  }

  /**
   * Validating the css content.
   *
   * @param $content
   *   The CSS content.
   * @throws BestPracticesException
   */
  protected function checkFonts($content) {
    if (!preg_match('/@font-face {(.|\n)*}/', $content)) {
      // No custom font declaration.
      return;
    }

    $fonts_types = ['eot', 'woff', 'ttf', 'svg'];

    foreach ($fonts_types as $type) {
      if (preg_match('/url\(.*.' . $type . '.\)/', $content) === 0) {
        throw new BestPracticesException(format_string('It seems that your font declaration did not contain @type format.', ['@type' => $type]));
      }
    }
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
