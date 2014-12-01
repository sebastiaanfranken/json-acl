<?php

/**
 * A simple JSON based ACL class for PHP projects
 * @author Sebatiaan Franken <sebastiaan@sebastiaanfranken.nl>
 * @package ACL
 */

class ACL
{
	/**
	 * @var stdClass $rules
	 */
	protected $rules;

	public function __construct()
	{
		if(file_exists(ROOT . DS . 'acl.json'))
		{
			$this->rules = json_decode( file_get_contents( ROOT . DS . 'acl.json' ) );
		}
		else
		{
			trigger_error('The <em>acl.json</em> file could not be found in <em>' . ROOT . DS . '</em>', E_USER_ERROR);
		}
	}

	public function can($role, $resource, $action)
	{
		return ($this->rules->$role->$resource->$action) ? true : false;
	}

	public function cannot($role, $resource, $action)
	{
		return !$this->can($role, $resource, $action);
	}

	public function test($role, $resource, $action)
	{
		return ('A <em>'. $role . '</em> <strong>' . ($this->can($role, $resource, $action) ? 'can' : 'cannot') . '</strong> <em>' . $action . '</em> a <em>' . $resource . '</em>') . PHP_EOL;
	}
}
