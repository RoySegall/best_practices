<?php

/**
 * @file
 * best_practices.drush.inc
 */
use Drupal\best_practices\BestPractices;
use Drupal\best_practices\BestPracticesException;

/**
 * Implements hook_drush_command().
 */
function best_practices_drush_command() {
  return [
    'best-practices-list' => [
      'description' => dt('Get list of all the available plugins.'),
      'aliases' => ['bpl'],
    ],
    'best-practices-invoke' => [
      'description' => dt('Invoking validation plugin'),
      'aliases' => ['bpi'],
      'arguments' => [
        'id' => dt('The plugin id'),
      ],
      'example' => [
        'drush bpi font' => dt('Trigger the font validation plugin.'),
      ],
    ],
  ];
}

/**
 * Drush command; Get the list of the available plugins.
 */
function drush_best_practices_list() {
  $plugins = BestPractices::getPlugins();

  foreach ($plugins as $plugin) {
    drush_print($plugin['id'] . ': ' . $plugin['description']);
  }
}

/**
 * Drush command; Trigger a validation plugin.
 */
function drush_best_practices_invoke($id) {
  if (!$plugin = BestPractices::instantiatePlugin($id)) {
    throw new BestPracticesException(format_string('The plugin with the ID @id was not found', ['@id' => $id]));
  }

  $plugin->validate();
}