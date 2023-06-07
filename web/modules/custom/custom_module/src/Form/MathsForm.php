<?php
/**
 * @file
 * Contains
 */
namespace Drupal\custom_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class MathsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'calculator_form';
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['num1'] = [
      '#type' => 'number',
      '#title' => t('Number 1'),
      '#required' => TRUE,
    ];
    $form['num2'] = [
      '#type' => 'number',
      '#title' => t('Number 2'),
      '#required' => TRUE,
    ];
    
    $form['actions']['#type'] = 'action';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('calculate'),
      '#button_type' => 'primary',
      '#axax' => [
        'callback' => '::calculate',
        'event' => 'click',
      ],
    ];
    $form['result'] = [
        '#type' => 'markup',
        '#prefix' => '<div id ="calculator-result">',
        '#suffix' => '</div>',
        '#markup' => $this->t('Result:'),
      ];

    return $form;
  }
  
  public function calculate(array &$form, FormStateInterface $form_state) {
    $num1 = $form_state->getValue('num1');
    $num2 = $form_state->getValue('num2');
    $result = $num1 + $num2;
    
    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand('#calculator-result', $this->t('Result: @result', ['@result' => $result]) ));

    return $response;
    
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}