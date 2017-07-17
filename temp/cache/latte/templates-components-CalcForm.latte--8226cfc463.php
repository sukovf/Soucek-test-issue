<?php
// source: D:\web_Dev\php_tets\php_test\app\presenters\templates\components\CalcForm.latte

use Latte\Runtime as LR;

class Template8226cfc463 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["calcForm"];
		?><form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), FALSE) ?>>
<?php
		if ($form->ownErrors) {
?>  <ul>
<?php
			$iterations = 0;
			foreach ($form->ownErrors as $error) {
				?>		<li><?php echo LR\Filters::escapeHtmlText($error) /* line 3 */ ?></li>
<?php
				$iterations++;
			}
?>
	</ul>
<?php
		}
?>
  
  <textarea cols="75" rows="3"<?php
		$_input = end($this->global->formsStack)["value"];
		echo $_input->getControlPart()->addAttributes(array (
		'cols' => NULL,
		'rows' => NULL,
		))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea><br>
  <input<?php
		$_input = end($this->global->formsStack)["submit"];
		echo $_input->getControlPart()->attributes() ?>>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), FALSE);
		?></form><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['error'])) trigger_error('Variable $error overwritten in foreach on line 3');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
