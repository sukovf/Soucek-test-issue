<?php

use Nette\Application\UI;

/**
 * CalcForm factory
 */
class CalcFormFactory extends Nette\Object
{
  public function create()
  {
    $form = new UI\Form;
    
    $form->addTextArea("value", "Value")
      ->setAttribute("placeholder", "Value...");
    
    $form->addSubmit("submit", "Calculate");
    
    return $form;
  }
}