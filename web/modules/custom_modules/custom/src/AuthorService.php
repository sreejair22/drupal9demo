<?php

namespace Drupal\custom;
use \Drupal\Core\Database\Connection;
/**
 * Class AuthorService.
 */
class AuthorService {
protected $database;
  /**
   * Constructs a new AuthorService object.
   */
  public function __construct(Connection $connection) {
      $this->database = $connection;
  }

  public function showAuthor($nid){ 
      $query = $this->database->select('node_field_data','nfd');
      $query->condition('nfd.nid',$nid);
      $query->fields('nfd',['uid']);

      $result = $query->execute()->fetchAll();
        if(!empty($result)){
          return $result[0]->uid;
        }
      }

  

}
