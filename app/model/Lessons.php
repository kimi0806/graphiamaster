<?php  
/**
 * 
 */
class Lessons extends Database
{
	// Variables

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM lessons WHERE id=?";

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
		$sql = "SELECT * FROM lessons WHERE user_id=? AND name=?";

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
			$sql = "UPDATE lessons SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM lessons WHERE id=?";
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

	public function save()
	{
		$sql = "INSERT INTO lessons (user_id, photo_id, name, description, video_desc, presentation_desc, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iisssss", $user_id, $photo_id, $name, $description, $video_desc, $presentation_desc, $status);

		$user_id = $this->user_id;
		$photo_id = $this->photo_id;
		$name = $this->name;
		$description = $this->description;
		$video_desc = $this->video_desc;
		$presentation_desc = $this->presentation_desc;
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

	public function update_category_lesson($lessons_name, $lessons_desc, $lessons_status, $updated_at, $id)
	{
		$query = "UPDATE lessons SET name=?, description=?, status=?, updated_at=? WHERE id=?";

		$stmt = $this->mysql->prepare($query);

		$stmt->bind_param("ssssi", $lessons_name, $lessons_desc, $lessons_status, $updated_at, $id);

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