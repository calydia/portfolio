<?php

namespace Drupal\gql_api\Plugin\GraphQL\Schema;

use Drupal\graphql\Plugin\GraphQL\Schema\ComposableSchema;

/**
 * @Schema(
 *   id = "composable",
 *   name = "Blog schema",
 *   extensions = "composable",
 * )
 */
class BlogSchema extends ComposableSchema {

}
