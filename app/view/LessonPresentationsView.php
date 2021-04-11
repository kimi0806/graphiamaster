<?php  
/**
 * 
 */
class LessonPresentationsView extends Database
{
	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function get_last_no_set()
	{
		$sql = "SELECT * FROM lesson_presentations ORDER BY set_id DESC";

		$stmt = $this->mysql->prepare($sql);

		if ($stmt->execute()) 
		{
			$results = $stmt->get_result();

			$data = $results->fetch_assoc();

		 	$set_id = $data['set_id'];
		}

		$stmt->close();

		return $set_id;
	}
}
?>