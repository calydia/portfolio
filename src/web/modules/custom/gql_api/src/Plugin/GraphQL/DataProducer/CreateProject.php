<?php

namespace Drupal\gql_api\Plugin\GraphQL\DataProducer;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\graphql\Plugin\GraphQL\DataProducer\DataProducerPluginBase;
use Drupal\gql_api\GraphQL\Response\ProjectResponse;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Creates a new article entity.
 *
 * @DataProducer(
 *   id = "create_article",
 *   name = @Translation("Create Article"),
 *   description = @Translation("Creates a new article."),
 *   produces = @ContextDefinition("any",
 *     label = @Translation("Article")
 *   ),
 *   consumes = {
 *     "data" = @ContextDefinition("any",
 *       label = @Translation("Article data")
 *     )
 *   }
 * )
 */
class CreateArticle extends DataProducerPluginBase implements ContainerFactoryPluginInterface {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user')
    );
  }

  /**
   * CreateArticle constructor.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param array $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user.
   */
  public function __construct(array $configuration, string $plugin_id, array $plugin_definition, AccountInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
  }

  /**
   * Creates an article.
   *
   * @param array $data
   *   The submitted values for the article.
   *
   * @return \Drupal\gql_api\GraphQL\Response\ProjectResponse
   *   The newly created article.
   *
   * @throws \Exception
   */
  public function resolve(array $data) {
    $response = new ProjectResponse();
    if ($this->currentUser->hasPermission("create article content")) {
      $values = [
        'type' => 'article',
        'title' => $data['title'],
        'body' => $data['description'],
      ];
      $node = Node::create($values);
      $node->save();
      $response->setArticle($node);
    }
    else {
      $response->addViolation(
        $this->t('You do not have permissions to create articles.')
      );
    }
    return $response;
  }

}
