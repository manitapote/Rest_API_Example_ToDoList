<?php

ini_set('display_errors',1);
error_reporting(-1);

class Todo
{
	private $_params;
	private $_toddo;
	public function __construct($params)
	{
		$this->_params = $params;
		$this->_toddo = new TodoItem();
		
	}

	public function createAction()
	{
		//echo "from controller";
		$todo = new TodoItem();
		$todo->title = $this->_params['title'];		
		$todo->description 	= $this->_params['description'];
		$todo->due_date = $this->_params['due_date'];
		$todo->id_done = $this->_params['is_done'];
		$todo->save($this->_params['username'],$this->_params['userpass']);
		//return json_encode($todo);
		return $todo->toArray();
	}

	public function readAction () 
	{
		//echo "readaction\n";
		$todo = new TodoItem();
		$status = $todo->read($this->_params['username'],$this->_params['userpass']);
		return $status;
	}

	public function updateAction()
	{
		$result = $this->_toddo->get_update($this->_params['id'], $this->_params['username'], $this->_params['userpass']);
		return $result;
	}

	public function deleteAction()
	{

	}
}
?>