<?php
// source: D:\web_Dev\php_tets\php_test\app\presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Templatefd0d183e37 extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'title' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('title', get_defined_vars());
?>

<?php
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
?>  <title>Calculator</title>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
		if (isset($result)) {
			?>    <?php echo LR\Filters::escapeHtmlText($result) /* line 7 */ ?><br>
<?php
		}
		/* line 9 */
		$this->createTemplate("..\components\CalcForm.latte", $this->params, "include")->renderToContentType('html');
		
	}

}
