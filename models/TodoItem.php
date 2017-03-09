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
		$userhash = $username.'_'.$userpass;//sha1("{$username}_{$userpass}");
		//echo  $userhash;

		// //file_put_contents("log.txt","inside save funcstioon");
		// if(file_exists("log.txt"))
		// {
		// 	$myfile = fopen("log.txt", "w");
		// 	$txt = "Jane Doe\n";
		// 	fwrite($myfile, $txt);
		// 	fclose($myfile);
		// }



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
		echo $success;

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
}
?>