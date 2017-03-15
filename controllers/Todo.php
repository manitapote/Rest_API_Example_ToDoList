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
		$todo->is_done = $this->_params['is_done'];
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

	public function do_updateAction()
	{
		//echo "from server";
		$this->_toddo->title =  $this->_params['title'];
		$this->_toddo->description = $this->_params['description'];
		$this->_toddo->due_date = $this->_params['due_date'];
		$this->_toddo->is_done = $this->_params['is_done'];
		$this->_toddo->todo_id = $this->_params['todo_id'];
		$data = $this->_toddo->toArray();
		// print_r($data);
		$result = $this->_toddo->do_update($this->_params['todo_id'], $this->_params['username'], $this->_params['userpass'],$data);
		return $result;
	}

	public function deleteAction()
	{
		return "delete section";
	}
}
?>