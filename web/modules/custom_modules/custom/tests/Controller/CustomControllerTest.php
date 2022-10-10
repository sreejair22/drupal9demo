<?php

namespace Drupal\custom\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the custom module.
 */
class CustomControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "custom CustomController's controller functionality",
      'description' => 'Test Unit for module custom and controller CustomController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests custom functionality.
   */
  public function testCustomController() {
    // Check that the basic functions of module custom.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
