<?php

namespace Drupal\custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Link;
use Drupal\Core\Cache\CacheTagsInvalidatorInterface;
/**
 * Class CustomForm.
 */
class CustomForm extends FormBase {

 
  protected $serviceContainer;
  protected $session;
  protected $cacheTagInvalidator;

  public function __construct(SessionInterface $session, CacheTagsInvalidatorInterface $invalidator) {
    $this->session = $session;
    $this->cacheTagInvalidator = $invalidator;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('session'),
      $container->get('cache_tags.invalidator')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
     $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>'
    ];
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Name'),
      '#default_value' => $this->session->get('session_example.name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
      '#prefix' => '<div id="user-email-result"></div>',
      '#ajax' => [
        'callback' => '::validateName',
        // Set focus to the textfield after hitting enter.
        'disable-refocus' => FALSE,
        // Trigger when user hits enter key.
        'event' => 'change',
        // Trigger after each key press.
        // 'event' => 'keyup'
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('validating ...'),
        ],
      ],
    ];
    $form['email_address'] = [
      '#type' => 'email',
      '#title' => $this->t('Email Address'),
      '#description' => $this->t('Email Address'),
      '#weight' => '0',
       '#prefix' => '<div id="email-result"></div>',
        '#default_value' => $this->session->get('session_example.email_address'),
      '#ajax' => [
        'callback' => '::validateEmail',
        // Set focus to the textfield after hitting enter.
        'disable-refocus' => FALSE,
        // Trigger when user hits enter key.
        'event' => 'change',
        // Trigger after each key press.
        // 'event' => 'keyup'
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Validating ...'),
        ],
      ],
    ];
    $form['mobile_number'] = [
      '#type' => 'number',
      '#title' => $this->t('Mobile Number'),
      '#description' => $this->t('Mobile Number'),
      '#weight' => '0',
       '#default_value' => $this->session->get('session_example.mobile_number'),
    ];
    /*$form['submit'] = array(
    '#type' => 'button',
    '#value' => t('Submit'),
    '#prefix' => '<div id="form_result"></div>',
    '#ajax' => array(
     
      'callback' => '::validateForm',
      'wrapper' => 'validated_form'
    )
);*/

$form['save'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];
    $form['reset'] = [
      '#type' => 'submit',
      '#value' => $this->t('Clear Session'),
      '#submit' => ['::submitClearSession'],
    ];


 $form['#theme'] = 'customer_add_form';

     return $form;
  }
 protected function setSessionValue($key, $value) {
    if (empty($value)) {
      // If the value is an empty string, remove the key from the session.
      $this->session->remove($key);
    }
    else {
      $this->session->set($key, $value);
    }
  }


  public function setMessage(array $form, FormStateInterface $form_state) {
 $ajax_response = new AjaxResponse();
 $error_message ="";
  // Check if User or email exists or not
   if (user_load_by_name($form_state->getValue('name')) || user_load_by_mail($form_state->getValue('name'))) {
     $text = 'User or Email is exists';
   } else {
     $text = 'User or Email does not exists';
   }
   $ajax_response->addCommand(new HtmlCommand('#user-email-result', $text));
   return $ajax_response;

    /*$response = new AjaxResponse();
    $response->addCommand(
      new HtmlCommand(
        'formresult',
        '<div class="my_top_message">The result is ' . t('The results is ') . ($form_state->getValue('number_1') + $form_state->getValue('number_2')) . '</div>')
    );
    return $response;*/

   }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
     
    $ajax_response = new AjaxResponse();
 $error_message ="";
  // Check if User or email exists or not

   if($form_state->getValue('name')=='') {
      $error_message = 'Please enter your name';
    }
     else if($form_state->getValue('email_address')=='') {
      $error_message = 'Please enter your email_address';
    }
     else if($form_state->getValue('mobile_number')=='') {
      $error_message = 'Please enter your mobile_number';
    }
    else if (user_load_by_name($form_state->getValue('name')) || user_load_by_mail($form_state->getValue('name'))) {
     $error_message = 'User or Email is exists';
   } 
   $ajax_response->addCommand(new HtmlCommand('.result_message', $error_message));
   return $ajax_response;

    //parent::validateForm($form, $form_state);
  }
  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->setSessionValue('session_example.name',$form_state->getValue('name'));
    $this->setSessionValue('session_example.email_address',$form_state->getValue('email_address'));
    $this->setSessionValue('session_example.mobile_number',$form_state->getValue('mobile_number'));
    $this->messenger()->addMessage($this->t('The session has been saved successfully. @link',['@link' => Link::CreateFromRoute('Click here','custom.view_session')->toString()]));
/*
      $this->messenger()->addMessage($this->t('The session has been saved successfully. @link', [
      '@link' => Link::createFromRoute('Check here.', 'session_example.view')->toString(),
    ]));*/

       $this->invalidateCacheTag();
    // Display result.
   /* foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }*/
  }

  
  public function validateName(array $form, FormStateInterface $form_state) {
   $ajax_response = new AjaxResponse();
 
  // Check if User or email exists or not
   if (user_load_by_name($form_state->getValue('name')) || user_load_by_mail($form_state->getValue('name'))) {
     $text = 'User or Email is exists';
   } else {
     $text = 'User or Email does not exists';
   }
   $ajax_response->addCommand(new HtmlCommand('#user-email-result', $text));
   return $ajax_response;
   }

   public function validateEmail(array $form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    $mail = $form_state->getValue('email_address');
    $text ="Valid Email Address";

     if ($mail !== '' && !\Drupal::service('email.validator')->isValid($mail)) {
       $text = t('The email address appears to be invalid.');

    }

    $ajax_response->addCommand(new HtmlCommand('#email-result', $text));
    return $ajax_response;
   }


 public function submitClearSession(array &$form, FormStateInterface $form_state) {
    $items = [
      'session_example.name',
      'session_example.email_address',
      'session_example.mobile_number',
     
    ];
    foreach ($items as $item) {
      $this->session->remove($item);
    }
    $this->messenger()->addMessage($this->t('Session is cleared.'));
    // Since we might have changed the session information, we will invalidate
    // the cache tag for this session.
    $this->invalidateCacheTag();
  }

   protected function invalidateCacheTag() {
    $this->cacheTagInvalidator->invalidateTags(['session_example:' . $this->session->getId()]);
  }


}
