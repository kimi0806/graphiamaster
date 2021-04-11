<?php  
/**
 * 
 */
class Sections extends Database
{
	// variables
	public $id;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM sections WHERE id=?";

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

	public function findByName($user_id, $name)
	{
		$sql = "SELECT * FROM sections WHERE user_id=? AND name=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $name);

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

	public function update($id, $array = [])
	{
		$result = ['success' => 0, 'error' => 0];

		foreach ($array as $key => $value) {
			$sql = "UPDATE sections SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM sections WHERE id=?";
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

	public function save_new_section($user_id, $section_name, $section_desc, $section_status)
	{
		$query = "INSERT INTO sections (user_id, name, description, status) VALUES (?,?,?,?)";

		$stmt = $this->mysql->prepare($query);

		$stmt->bind_param("isss", $user_id, $section_name, $section_desc, $section_status);

		if ($stmt->execute()) 
		{
			return 'saved';
		} else {
			return 'failed';
		}
		$stmt->close();
	}

	public function update_section($section_name, $section_desc, $section_status, $id)
	{
		$query = "UPDATE sections SET name=?, description=?, status=? WHERE id=?";

		$stmt = $this->mysql->prepare($query);

		$stmt->bind_param("sssi", $section_name, $section_desc, $section_status, $id);

		if ($stmt->execute()) 
		{
			return 'updated';
		}else{
			return 'failed';
		}
		$stmt->close();
	}
}
?>