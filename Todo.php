<?php

ini_set('display_errors',1);
error_reporting(-1);

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
		$todo->title = 'sunday';		
		$todo->description = $this->_params['description'];
		$todo->due_date = $this->_params['due_date'];
		$todo->id_done = $this->_params['is_done'];
		$todo->save('manoj','mm');

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

	public function index(){
		Todo todo = new Todo();
		todo.createAction();
	}
}
?>