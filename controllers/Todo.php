<?php


class Todo
{
	private $_params;

	public function __construct($params)
	{
		$this->_params = $params;
	}

	public function createAction()
	{
		//echo "from controller";
		$todo = new TodoItem();
		$todo->title = $this->_params['title'];		
		$todo->description = $this->_params['description'];
		$todo->due_date = $this->_params['due_date'];
		$todo->id_done = 'false';
		$todo->save($this->_params['username'], $this->_params['userpass']);

		return $todo->toArray();
	}

	public function readAction ()
	{

	}

	public function updateAcition()
	{

	}

	public function deleteAction()
	{

	}
}
?>