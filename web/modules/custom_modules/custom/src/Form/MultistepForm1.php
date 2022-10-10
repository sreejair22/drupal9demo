<?php

namespace Drupal\custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Class MultistepForm1.
 */
class MultistepForm1 extends FormBase {
  protected $step=1;
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_form1';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#prefix'] = '<div id="ajax_form_multistep_form">';
    $form['#suffix'] = '</div>';

    if($this->step ==1){

      $form['message-step'] =[
        '#markup' => '<div class="step">' . $this->t('Step 1 of 2') . '</div>',
      ];

      $form['message-title'] =[
          '#markup' => '<h2>' . $this->t('Who are you?') . '</h2>', 
      ];

      $form['first_name'] = [
        '#type' =>'textfield',
         '#title' => $this->t('First name'),
         '#placeholder' => $this->t('First name'),
         '#required' => TRUE,
      ];

       $form['last_name'] = [
        '#type' =>'textfield',
         '#title' => $this->t('Last name'),
         '#placeholder' => $this->t('Last name'),
         '#required' => TRUE,
      ];

    }

    if ($this->step == 2) {

      $terms_url = Url::fromRoute('custom.custom_controller_index');
      $policy_url = Url::fromRoute('custom.custom_controller_index');
      

      $form['message-step'] = [
        '#markup' => '<div class="step">' . $this->t('Step 2 of 2') . '</div>',
      ];
      $form['message-title'] = [
        '#markup' => '<h2>' . $this->t('Please enter your contact details below:') . '</h2>',
      ];
      $form['phone'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Phone'),
        '#placeholder' => $this->t('Phone'),
        '#required' => TRUE,
      ];
      $form['email'] = [
        '#type' => 'email',
        '#title' => $this->t('Email address'),
        '#placeholder' => $this->t('Email address'),
        '#attributes' => array('class' => array('mail-first-step')),
        '#required' => TRUE,
      ];
      $form['subscribe'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Subscribe to newsletter'),
      ];
      $form['agree'] = [
        '#markup' => '<p class="agree">' . $this->t(' By signing up you agree to the <a href="@terms">Terms and Conditions</a> and <a href="@policy">Privacy Policy</a>',
            array('@terms' => Link::fromTextAndUrl(t('Open modal'), $terms_url)->toString(), '@policy' => Link::fromTextAndUrl(t('Open modal'), $policy_url)->toString())) . '</p>',
      ];
    }

    if ($this->step == 3) {
      $form['message-step'] = [
        '#markup' => '<p class="complete">' . $this->t('- Complete -') . '</p>',
      ];
      $form['message-title'] = [
        '#markup' => '<h2>' . $this->t('Thank you') . '</h2>',
      ];

    }
     if ($this->step == 1) {
      $form['buttons']['forward'] = array(
        '#type' => 'submit',
        '#value' => t('Next'),
        '#prefix' => '<div class="step1-button">',
        '#suffix' => '</div>',
        '#ajax' => array(
          // We pass in the wrapper we created at the start of the form
          'wrapper' => 'ajax_form_multistep_form',
          // We pass a callback function we will use later to render the form for the user
          'callback' => '::ajax_form_multistep_form_ajax_callback',
          'event' => 'click',
        ),
      );
    }
    if ($this->step == 2) {
      $form['buttons']['forward'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
        '#ajax' => array(
          // We pass in the wrapper we created at the start of the form
          'wrapper' => 'ajax_form_multistep_form',
          // We pass a callback function we will use later to render the form for the user
          'callback' => '::ajax_form_multistep_form_ajax_callback',
          'event' => 'click',
        ),
      );
    }
    $form['#attached']['library'][] = 'custom/myjs';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($this->step == 2) {
      $values = $form_state->getValues();
      $email = $values['email'];
      // Save data or send email here.
    }

    $this->step++;
    $form_state->setRebuild();
  }
 
 public function ajax_form_multistep_form_ajax_callback(array &$form, FormStateInterface $form_state) {
    return $form;
  }

}
