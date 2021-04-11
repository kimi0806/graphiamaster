<?php
/**
 * 
 */
class LessonPresentations extends Database
{
	public $id;
	public $lesson_id;
	public $file_path;
	public $file_name;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM lesson_presentations WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			$result = ['execute' => 'success', 'num_rows' => $stmt_result->num_rows, 'fetch_assoc' => $stmt_result->fetch_assoc()];
		}
		else {
			$result = ['execute' => 'error'];
		}

		$stmt->close();

		return $result;
	}

	public function findBySetId($set_id)
	{
		$sql = "SELECT * FROM lesson_presentations WHERE set_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $set_id);

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			$rows = array();

			while ($row = $stmt_result->fetch_assoc()) 
			{
				$rows[] = $row;
			}

			$result = ['execute' => 'success', 'num_rows' => $stmt_result->num_rows, 'fetch_assoc' => $rows];
		}
		else {
			$result = ['execute' => 'error'];
		}

		$stmt->close();

		return $result;
	}

	public function save()
	{
		$sql = "INSERT INTO lesson_presentations (lesson_id, set_id, file_path, file_name, status) VALUES (?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iisss", $lesson_id, $set_id, $file_path, $file_name, $status);

		$lesson_id = $this->lesson_id;
		$set_id = $this->set_id;
		$file_path = $this->file_path;
		$file_name = $this->file_name;
		$status = $this->status;

		if ($stmt->execute()) {
			$result = ['execute' => 'success', 'insert_id' => $stmt->insert_id];
		}
		else {
			$result = ['execute' => 'error'];
		}

		$stmt->close();

		return $result;
	}

	public function update($id, $array = [])
	{
		$result = ['success' => 0, 'error' => 0];

		foreach ($array as $key => $value) {
			$sql = "UPDATE lesson_presentations SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM lesson_presentations WHERE id=?";
		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		if ($stmt->execute()) {
			$result = ['execute' => 'success'];
		}
		else {
			$result = ['execute' => 'error'];
		}

		return $result;

		$stmt->close();
	}
}
?>