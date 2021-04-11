<?php
/**
 * 
 */
class StudentActivityPoints extends Database
{

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM student_activity_points WHERE id=?";

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

	public function findByStudentActivityId($student_activity_id)
	{
		$sql = "SELECT * FROM student_activity_points WHERE student_activity_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $student_activity_id);

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
		$sql = "INSERT INTO student_activity_points (student_activity_id, point, correction, recommendation, status) VALUES (?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iisss", $student_activity_id, $point, $correction, $recommendation, $status);

		$student_activity_id = $this->student_activity_id;
		$point = $this->point;
		$correction = $this->correction;
		$recommendation = $this->recommendation;
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
			$sql = "UPDATE student_activity_points SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM student_activity_points WHERE id=?";
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