<?php

namespace Drupal\gql_api\GraphQL\Response;

use Drupal\Core\Entity\EntityInterface;
use Drupal\graphql\GraphQL\Response\Response;

/**
 * Type of response used when a course is returned.
 */
class CourseResponse extends Response {

  /**
   * The course to be served.
   *
   * @var \Drupal\Core\Entity\EntityInterface|null
   */
  protected $course;

  /**
   * Sets the content.
   *
   * @param \Drupal\Core\Entity\EntityInterface|null $course
   *   The course to be served.
   */
  public function setCourse(?EntityInterface $course): void {
    $this->course = $course;
  }

  /**
   * Gets the course to be served.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The course to be served.
   */
  public function course(): ?EntityInterface {
    return $this->course;
  }

}
