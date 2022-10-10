<?php

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


/**
 * Class CustomController.
 */
class CustomController extends ControllerBase {

protected $database;
protected $serviceContainer;
  protected $session;
public static function create(ContainerInterface $container) {
    $controller = new static(
      $container->get('database')
    );
    $controller->setStringTranslation($container->get('string_translation'));
    return $controller;
  }
public function __construct(Connection $database) {
    $this->database = $database;
  }


  /**
   * Index.
   *
   * @return string
   *   Return Hello string.
   */
  public function index() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: index')
    ];
  }
  /**
   * Add.
   *
   * @return string
   *   Return Hello string.
   */
  public function add() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: add')
    ];
  }
  /**
   * Update.
   *
   * @return string
   *   Return Hello string.
   */
  public function update() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: update')
    ];
  }
  /**
   * List.
   *
   * @return string
   *   Return Hello string.
   */
  public function list() {
    $build =[];
    $items = [
      $this->t('Item 1'),
      $this->t('Item 2'),
      $this->t('Item 3'),
      $this->t('Item 4'),
      $this->t('Item 5'),
      $this->t('Item 6'),
    ];
    $title = $this->t('Example of list using theme.');
    $build['our_theme_function'] = array(
      '#title' => $title,
      '#items' => $items,
      '#theme' => 'custom_item_list',
     // '#attached' => ['library' => 'custom/myjs',],
    //  '#attributes' => ['class' => 'item_list'],
    );
  //  $build['#attached']['library'][] = 'custom/myjs';
    return $build;
  }

 /* public function render_list() {
   $items = [
      $this->t('First item'),
      $this->t('Second item'),
      $this->t('Third item'),
      $this->t('Fourth item'),
    ];

    // First we'll create a render array that simply uses theme_item_list.
    $title = $this->t("A list returned to be rendered using theme('item_list')");
    $build['render_version'] = [
      // We use #theme here instead of #theme_wrappers because theme_item_list()
      // is the classic type of theme function that does not just assume a
      // render array, but instead has its own properties (#type, #title, #items).
      '#theme' => 'item_list',
      // '#type' => 'ul',  // The default type is 'ul'
      // We can easily make sure that a css or js file is present using #attached.
      '#attached' => ['library' => ['theming_example/list']],
      '#title' => $title,
      '#items' => $items,
      '#attributes' => ['class' => ['render-version-list']],
    ];

   
    $title = $this->t("The same list rendered by theme('theming_example_list')");
    $build['our_theme_function'] = array(
      '#theme' => 'theming_example_list',
      '#attached' => ['library' => ['theming_example/list']],
      '#title' => $title,
      '#items' => $items,
    );
    return $build;
  }
*/
  public function render_list() {
    //$build =[];
    $items = [
      $this->t('Item 1'),
      $this->t('Item 2'),
      $this->t('Item 3'),
      $this->t('Item 4'),
      $this->t('Item 5'),
      $this->t('Item 6'),
    ];
   
    $title = $this->t('Example of list using theme.');

     $build['our_theme_function'] = array(
      '#theme' => 'custom_item_list',
      '#attached' => ['library' => ['theming_example/list']],
      '#title' => $title,
      '#items' => $items,
    );
 

    return $build; 
  }

  /**
   * Delete
   *
   * @return string
   *   Return Hello string.
   */
  public function delte() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: delte')
    ];
  }

  public function showtabledata(){
      $header = [
          ['data' => t('Numbers'),'field' => 'numbers'],
          ['data' => t('Alpha'),'field' => 'alpha'],
          ['data' => t('Random'),'field' => 'random'],
    ];

    $query = $this->database->select('tablesort_example','t')->extend('Drupal\Core\Database\Query\TableSortExtender');
    $query->fields('t');

    

    $result = $query->orderByHeader($header)->execute();

    $rows =[];
    foreach($result as $row){

      $rows[] = ['data' => (array) $row];
    }

    $build = [
      '#markup' => '<p>' . t('Custom module table example.') . '</p>',
    ];

     $build['tablesort_table'] = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $build;
  }
public function showSession(Request $request) {
    
    $session = $request->getSession();
    $row = [];
    foreach (['name', 'email_address', 'mobile_number',] as $item) {
        $key = "session_example.$item";
        $row[0][$item] = $session->get($key, $this->t('No @type', ['@type' => $item]));
    }

    return [
      // Since this page will be cached, we have to manage the caching. We'll
      // use a cache tag and manage it within the session helper. We use the
      // session ID to guarantee a unique tag per session. The submission form
      // will manage invalidating this tag.
      '#cache' => [
        'tags' => ['session_example:' . $session->getId()],
      ],
      'description' => [
        '#type' => 'item',
        '#title' => $this->t('Saved Session Keys'),
        '#markup' => $this->t('The example form lets you set some session keys.  This page lists their current values.'),
      ],
      'session_status' => [
        '#type' => 'table',
        '#header' => [
          $this->t('Name'),
          $this->t('Email'),
          $this->t('MobileNumber'),
         
        ],
        '#rows' => $row,
      ],
    ];
  }

  function arguments($first=0,$second=0){
    if (!is_numeric($first) || !is_numeric($second)) {
      // We will just show a standard "access denied" page in this case.
      throw new AccessDeniedHttpException();
    }

    $list[] = t('First number is @first',['@first' => $first]);
    $list[] = t('First number is @second',['@second' => $second]);

    $render['render_arg'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => t('Listing of arguments'),
    ];

    return $render;
  }

  public function showAccordion(){
    $title = $this->t('Example Accordion.');

    $build['accordion'] = [
      '#theme' => 'custom_theme_accordion',
      '#title' =>$title,
    ];
    $build['#attached']['library'][] = 'custom/custom.accordian';
    return $build;
  }

  public function showWeights(){

    $weights = [
      'red' => -4,
      'blue' => -2,
      'green' => -1,
      'brown' => -2,
      'black' => -1,
      'purple' => -5,
    ];

    $build = [];

    $build['content'] = [
      '#markup' => '<div id="js-weights" class="js-weights"></div>',
    ];
    $build['#attached']['library'][] = 'custom/custom.weights';
    $build['#attached']['drupalSettings']['custom']['js_weights'] = $weights;

    return $build;
  }
}
