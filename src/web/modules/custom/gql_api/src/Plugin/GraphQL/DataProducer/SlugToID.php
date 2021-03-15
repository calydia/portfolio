<?php

namespace Drupal\gql_api\Plugin\GraphQL\DataProducer;

use Drupal\Core\Cache\RefinableCacheableDependencyInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\graphql\Plugin\GraphQL\DataProducer\DataProducerPluginBase;
use Drupal\gql_api\Wrappers\QueryConnection;
use GraphQL\Error\UserError;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @DataProducer(
 *   id = "query_slug",
 *   name = @Translation("Query Slug"),
 *   description = @Translation("Queries a slug, returns an ID"),
 *   produces = @ContextDefinition("any",
 *     label = @Translation("Slug to id")
 *   ),
 *   consumes = {
 *     "slug" = @ContextDefinition("string",
 *       label = @Translation("Slug"),
 *       required = TRUE
 *     )
 *   }
 * )
 */
class Slugtoid extends DataProducerPluginBase implements ContainerFactoryPluginInterface {


  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityManager;

  /**
   * {@inheritdoc}
   *
   * @codeCoverageIgnore
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * listings constructor.
   *
   * @param array $configuration
   *   The plugin configuration.
   * @param string $pluginId
   *   The plugin id.
   * @param mixed $pluginDefinition
   *   The plugin definition.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityManager
   *
   * @codeCoverageIgnore
   */
  public function __construct(
    array $configuration,
    $pluginId,
    $pluginDefinition,
    EntityTypeManagerInterface $entityManager
  ) {
    parent::__construct($configuration, $pluginId, $pluginDefinition);
    $this->entityManager = $entityManager;
  }

  /**
   * @param $slug
   * @param \Drupal\Core\Cache\RefinableCacheableDependencyInterface $metadata
   *
   * @return $node
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function resolve($slug, RefinableCacheableDependencyInterface $metadata) {

    $storage = $this->entityManager->getStorage('node');
    $type = $storage->getEntityType();

    $slug_slash = '/' . $slug;

    $node_url = \Drupal::service('path_alias.manager')->getPathByAlias($slug_slash);
    $nid = str_replace('/node/', '', $node_url);
    $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);

    $metadata->addCacheTags($type->getListCacheTags());
    $metadata->addCacheContexts($type->getListCacheContexts());

    return $node;
  }
}
