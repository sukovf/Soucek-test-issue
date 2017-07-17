<?php

namespace App\Presenters;

use Nette;
use CalcFormFactory;
use App\Services\Calculator;

/**
 * Homepage presenter
 */
class HomepagePresenter extends BasePresenter
{
  /** @var CalcForm factory */
  private $calcFormFactory;
  
  /** @var calculator service */
  private $calculator;
  
  public function injectCalcFormFactory(CalcFormFactory $calcFormFactory)
  {
    $this->calcFormFactory = $calcFormFactory;
  }
  
  public function injectCalculator(Calculator $calculator)
  {
    $this->calculator = $calculator;
  }
  
  public function actionDefault()
  {
    $value=$this->getParameter("value");
    if(isset($value))
      $this->template->result = $this->calculator->calculate($value);
  }
  
  protected function createComponentCalcForm()
  {
    $form = $this->calcFormFactory->create();
    $form->onSuccess[] = [$this, "processCalcForm"];
    
    return $form;
  }
  
  public function processCalcForm($form)
  {
    if(strlen($form->values["value"]) > 0)
      $this->redirect("this", array("value" => $form->values["value"]));
    else
      $this->redirect("this");
  }
}
