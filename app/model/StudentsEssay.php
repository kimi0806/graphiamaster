,<?php  
/**
 * 
 */
class StudentsEssay extends Database
{	
	// var

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function save_my_essay($lesson_id, $activity_id, $essay, $status)
	{
		$sql = "INSERT INTO students_essay (lesson_id, activity_id, essay, status) VALUES (?,?,?,?)";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("iiss", $lesson_id, $activity_id, $essay, $status);

		if ($stmt->execute()) 
		{
			return 'saved';
		}else{
			return 'failed';
		}
	}
}
?>