<?php

class ConsoleCommand extends CConsoleCommand
{
	/**
	 * Converts unnamed arguments to named.
	 * Uses current action params as names.
	 */
	public function run($args)
	{
		list($action, $options, $args)=$this->resolveRequest($args);
		
		$methodName='action'.$action;
		if(!preg_match('/^\w+$/',$action) || !method_exists($this,$methodName))
			$this->usageError("Unknown action: ".$action);

		$method=new ReflectionMethod($this,$methodName);
		
		foreach ($method->getParameters() as $i => $param) {
			if (!empty($args))
				$options[$param->getName()] = array_shift($args);
		}
		
		$args2 = array($action);
		
		foreach ($options as $key => $value) {
			$args2[] = '--' . $key . ($value !== true ? '=' . $value : '');
		}
		
		$args2 = array_merge($args2, $args);
		
		return parent::run($args2);
	}
}
