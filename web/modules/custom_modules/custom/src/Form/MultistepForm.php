<?php

namespace Drupal\custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MultistepForm.
 */
class MultistepForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if($form_state->has('page') && $form_state->get('page')==2){
        return self::formpageTwo($form,$form_state);
    }
    $form_state->set('page',1);
    $form['description']=[
      '#type' => 'item',
      '#title' => $this->t('Page @page',['@page'=>$form_state->get('page')]),
    ];

    $form['first_name'] = [
    '#type' => 'textfield',
    '#title' => $this->t('First Name'),
    '#default_value' => $form_state->getValue('first_name', ''),
    '#required' => TRUE,
  ];

   $form['last_name'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Last Name'),
    '#default_value' => $form_state->getValue('last_name', ''),
    '#required' => TRUE,
  ];
   $form['actions'] = [
    '#type' => 'actions',
  ];

  $form['actions']['next'] = [
    '#type' => 'submit',
    '#button_type' => 'primary',
    '#value' => $this->t('Next'),
    '#submit' => ['::submitPageOne'],
    '#validate' => ['::validatePageOne'],
  ];


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validatePageOne(array &$form, FormStateInterface $form_state) {

    $firstname = $form_state->getValue('first_name');
    if(strlen($firstname)<5){
      $form_state->setErrorByName('first_name',t('Name should contain at least 5 characters. Try again.'));
    }
  
  }

  /**
   * {@inheritdoc}
   */
  public function submitPageOne(array &$form, FormStateInterface $form_state) {
    $form_state->set('page_values',[
      'first_name' => $form_state->getValue('first_name'),
      'last_name' => $form_state->getValue('last_name'),
    ])
    ->set('page',2)
    ->setRebuild(TRUE);

   
  }
  public function formPageTwo(array &$form, FormStateInterface $form_state) {

  $form['description'] = [
    '#type' => 'item',
    '#title' => $this->t('Page @page',['@page'=>$form_state->get('page')]),
  ];

  $form['color'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Favorite color'),
    '#required' => TRUE,
    '#default_value' => $form_state->getValue('color', ''),
  ];
  $form['back'] = [
    '#type' => 'submit',
    '#value' => $this->t('Back'),
    '#submit' => ['::pageTwoBack'],
    '#limit_validation_errors' => [],
  ];
  $form['submit'] = [
    '#type' => 'submit',
    '#button_type' => 'primary',
    '#value' => $this->t('Submit'),
  ];
  return $form;
}
public function pageTwoBack(array &$form, FormStateInterface $form_state) {
  $form_state
    ->setValues($form_state->get('page_values'))
    ->set('page', 1)
    ->setRebuild(TRUE);
}
    public function validateForm(array &$form, FormStateInterface $form_state) {
        
    }
    public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
      foreach ($form_state->getValues() as $key => $value) {
       \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
      }
    }
    
}
