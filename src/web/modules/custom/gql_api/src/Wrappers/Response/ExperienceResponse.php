<?php

declare(strict_types = 1);

namespace Drupal\gql_api\Wrappers\Response;

use Drupal\Core\Entity\EntityInterface;
use Drupal\graphql\GraphQL\Response\Response;

/**
 * Type of response used when a experience is returned.
 */
class ExperienceResponse extends Response {

  /**
   * The experience to be served.
   *
   * @var \Drupal\Core\Entity\EntityInterface|null
   */
  protected $experience;

  /**
   * Sets the content.
   *
   * @param \Drupal\Core\Entity\EntityInterface|null $experience
   *   The experience to be served.
   */
  public function setExperience(?EntityInterface $experience): void {
    $this->experience = $experience;
  }

  /**
   * Gets the experience to be served.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The experience to be served.
   */
  public function experience(): ?EntityInterface {
    return $this->experience;
  }

}
