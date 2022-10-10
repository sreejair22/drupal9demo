<?php

namespace Drupal\custom;

use Drupal\Core\Session\AccountInterface;
/**
 * Class DefaultService.
 */
class DefaultService implements custom {

  protected $currentUser;

  /**
   * Constructs a new DefaultService object.
   */
  public function __construct(AccountInterface $currentUser) {

    $this->currentUser = $currentUser;

  }

  public function getData(){
      return $this->currentUser->getDisplayName();
  }

}
