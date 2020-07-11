<?php

namespace Drupal\build_hooks\Plugin;

use Drupal\Component\Plugin\ConfigurableInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Defines an interface for Frontend environment plugins.
 */
interface FrontendEnvironmentInterface extends ConfigurableInterface, PluginFormInterface, PluginInspectionInterface {

  /**
   * Get the info to trigger the hook based on the configuration of the plugin.
   *
   * @return \Drupal\build_hooks\BuildHookDetails
   *   An object containing the details to trigger the hook.
   */
  public function getBuildHookDetails();

  /**
   * Allows the plugin to add elements to the deployment form.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current form state.
   *
   * @return array
   *   A form array to add to the deployment form.
   */
  public function getAdditionalDeployFormElements(FormStateInterface $form_state);

}
