<?php

declare(strict_types = 1);

namespace Drupal\gql_api\Wrappers\Response;

use Drupal\Core\Entity\EntityInterface;
use Drupal\graphql\GraphQL\Response\Response;

/**
 * Type of response used when an project is returned.
 */
class ProjectResponse extends Response {

  /**
   * The project to be served.
   *
   * @var \Drupal\Core\Entity\EntityInterface|null
   */
  protected $project;

  /**
   * Sets the content.
   *
   * @param \Drupal\Core\Entity\EntityInterface|null $project
   *   The project to be served.
   */
  public function setProject(?EntityInterface $project): void {
    $this->project = $project;
  }

  /**
   * Gets the project to be served.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The project to be served.
   */
  public function project(): ?EntityInterface {
    return $this->project;
  }

}
