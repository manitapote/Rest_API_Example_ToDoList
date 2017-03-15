<?php
ini_set('display_errors',1);
error_reporting(-1);

class TodoItem
{
	public $todo_id;
	public $title;
	public $description;
	public $due_date;
	public $is_done;

	public function save($username, $userpass)
	{
		$userhash = $username.'_'.$userpass;
		if(is_dir(DATA_PATH."/{$userhash}") === false)
		{
			//error_log('message in dfd');
			//alert('in todo items');
			if(mkdir(DATA_PATH."/{$userhash}",0777))
				error_log('message in dfd');
		}


		if (is_null($this->todo_id)|| !is_numeric($this->todo_id))
		{
			$this->todo_id = time();
		}	

		$todo_item_array = $this->toArray();
		//print_r($todo_item_array);

		$success = file_put_contents(DATA_PATH."/{$userhash}/{$this->todo_id}.txt", serialize($todo_item_array));
		//echo $success;

		if($success === false)
		{
			throw new Exception ("Failed to save todo item");
		}

		return $todo_item_array;
	}

	public function toArray()
	{
		return array(
			'todo_id'=>$this->todo_id,
			'title'=>$this->title,
			'description'=>$this->description,
			'due_date'=>$this->due_date,
			'is_done'=>$this->is_done,

			);
	}

	public function read($username,$userpass)
	{

		$userhash= $username."_".$userpass;
		$data= '';
		$i = 0;
		//echo "read called";
		if(is_dir(DATA_PATH."/{$userhash}") === true)
		{
			
			
			foreach (glob(DATA_PATH."/{$userhash}/*.txt") as $key => $value) 
			{
				//echo "\n $key:"."$value \n</br>";
				$data[$i] = file_get_contents($value);
				//echo $value;
				//$data = unserialize($f);
				$i = $i + 1;
				//var_dump($data);
			}
			
		}
		else
		{
			return true;
		}
		return $data;
	}

	public function get_update($id, $username, $userpass)
	{
		$data = file_get_contents(DATA_PATH."/{$username}_{$userpass}/{$id}.txt");
		return $data;
	}

	public function do_update($id, $username, $userpass, $data)
	{
		$success = file_put_contents(DATA_PATH."/{$username}_{$userpass}/{$id}.txt", serialize($data));
		return $success;
	}
}
?>