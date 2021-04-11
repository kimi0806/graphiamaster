<?php
/**
 * 
 */
class Activities extends Database
{

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM activities WHERE id=?";

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

	public function findByLessonId($user_id, $lesson_id)
	{
		$sql = "SELECT * FROM activities WHERE user_id=? AND lesson_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ii", $user_id, $lesson_id);

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

	public function findByTitle($user_id, $lesson_id, $title)
	{
		$sql = "SELECT * FROM activities WHERE user_id=? AND lesson_id=? AND title=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iis", $user_id, $lesson_id, $title);

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

	public function save()
	{
		$sql = "INSERT INTO activities (user_id, lesson_id, title, description, instruction, status) VALUES (?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iissss", $user_id, $lesson_id, $title, $description, $instruction, $status);

		$user_id = $this->user_id;
		$lesson_id = $this->lesson_id;
		$title = $this->title;
		$description = $this->description;
		$instruction = $this->instruction;
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
			$sql = "UPDATE activities SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM activities WHERE id=?";
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