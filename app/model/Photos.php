<?php
/**
 * 
 */
class Photos extends Database
{
	public $id;
	public $file_path;
	public $file_name;
	public $type;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM photos WHERE id=?";

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

	public function save()
	{
		$sql = "INSERT INTO photos (file_path, file_name, type, status) VALUES (?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ssss", $file_path, $file_name, $type, $status);

		$file_path = $this->file_path;
		$file_name = $this->file_name;
		$type = $this->type;
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
			$sql = "UPDATE photos SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}
}
?>