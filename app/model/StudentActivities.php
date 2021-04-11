<?php
/**
 * 
 */
class StudentActivities extends Database
{

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM student_activities WHERE id=?";

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

	public function findByActivityId($user_id, $activity_id)
	{
		$sql = "SELECT * FROM student_activities WHERE user_id=? AND activity_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ii", $user_id, $activity_id);

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
		$sql = "INSERT INTO student_activities (user_id, activity_id, activity_item_id, answer, checked, status) VALUES (?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iiisis", $user_id, $activity_id, $activity_item_id, $answer, $checked, $status);

		$user_id = $this->user_id;
		$activity_id = $this->activity_id;
		$activity_item_id = $this->activity_item_id;
		$answer = $this->answer;
		$checked = $this->checked;
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
			$sql = "UPDATE student_activities SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM student_activities WHERE id=?";
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