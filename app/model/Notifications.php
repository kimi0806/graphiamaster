<?php
/**
 * 
 */
class Notifications extends Database
{
	public $id;
	public $from_user_id;
	public $to_user_id;
	public $module_primary_id;
	public $module_type;
	public $description;
	public $enable;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findByToUserId($to_user_id)
	{
		$sql = "SELECT * FROM notifications WHERE to_user_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $to_user_id);

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			$rows = array();

			while ($row = $stmt_result->fetch_assoc()) {
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
		$sql = "INSERT INTO notifications (from_user_id, to_user_id, module_primary_id, module_type, description, enable, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iiissis", $from_user_id, $to_user_id, $module_primary_id, $module_type, $description, $enable, $status);

		$from_user_id = $this->from_user_id;
		$to_user_id = $this->to_user_id;
		$module_primary_id = $this->module_primary_id;
		$module_type = $this->module_type;
		$description = $this->description;
		$enable = $this->enable;
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
			$sql = "UPDATE notifications SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}
}
?>