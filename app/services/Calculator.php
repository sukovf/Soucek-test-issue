<?php

namespace App\Services;

/**
 * Simple calculator
 */
class Calculator
{
  	/** @var string to be evaluated */
	private $inputString;
  
  	/** @var int index of currently processed character in input string */
	private $currCharIndex = 0;

	/** self-explanatory
	 * @return bool
	 */
	private function isStringEndReached()
	{
		if ($this->currCharIndex >= strlen($this->inputString))
			return true;

		return false;
	}

	/** Return an ASCII character number in $inputString on $currCharIndex
	 *  position
	 * @return integer
	 */
	private function get()
	{
		if ($this->isStringEndReached())
			return 0;

		return ord($this->inputString[$this->currCharIndex]);
	}

	/** Return an ASCII character number in $inputString on $currCharIndex
	 *  position and increments $currCharIndex pointer 
	 * @return integer
	 */
	private function eat()
	{
		if ($this->isStringEndReached())
			return 0;

		return ord($this->inputString[$this->currCharIndex++]);
	}

	/** Following four functions (number, factor, term and expression) recursively
	 *  travel down the input string and evaluate it part by part while respecting
	 *  priority of arithmetic operations
	 */
	private function number()
	{
		$result = $this->eat() - ord("0");
		while ($this->get() >= ord("0") && $this->get() <= ord("9"))
			$result = 10 * $result + $this->eat() - ord("0");

		return $result;
	}

	private function factor()
	{
		if ($this->get() >= ord("0") && $this->get() <= ord("9"))
		{
			return $this->number();
		}
		else if ($this->get() == ord("("))// evaluate a (...) block
		{
			$this->eat();// "("
			$result = $this->expression();
			$this->eat();// ")"

			return $result;
		}
		else if ($this->get() == ord("-"))// invert following value
		{
			$this->eat();// "-"
			return -($this->factor());
		}

		return 0;
	}

	private function term()
	{
		$result = $this->factor();
		while ($this->get() == ord("*") || $this->get() == ord("/"))
		{
			if ($this->eat() == ord("*"))
				$result *= $this->factor();
			else
				$result /= $this->factor();
		}

		return $result;
	}

	private function expression()
	{
		/** first try to find any multiplication or division operations on the same
		 *  level as they have a higher priority than addition and subtraction
		 */
		$result = $this->term();
    
		while ($this->get() == ord("+") || $this->get() == ord("-"))
		{
			if ($this->eat() == ord("+"))
				$result += $this->term();
			else
				$result -= $this->term();
		}

		return $result;
	}

	/** Remove all white spaces and check for possible invalid characters
	 *  occurrence
	 * @param string
	 * @return bool
	 */
	private function processInputString($string)
	{
		$string = preg_replace("/\s+/", "", $string);
		if (preg_match("/[^0-9\+\-\*\/\(\)]/", $string))
			return false;

		$this->inputString = $string;

		return true;
	}

	/** Evaluate an input string
	 * @param string
	 * @return string evaluated number or an error string in the case of failure
	 */
	public function calculate($string)
	{
		if (!$this->processInputString($string))
			return "Invalid input. Only following chars are allowed: 0-9+-*/()";

		return $this->inputString." = ".$this->expression();
	}
}
