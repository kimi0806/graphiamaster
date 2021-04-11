<?php
/**
 * 
 */
class Teachers extends Database
{
	public $id;
	public $user_id;
	public $profile_photo_id;
	public $identity_photo_id;
	public $sex;
	public $date_of_birth;
	public $mobile_number;
	public $type_of_school;
	public $school_name;
	public $school_address;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM teachers WHERE id=?";

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

	public function findByUserId($user_id)
	{
		$sql = "SELECT * FROM teachers WHERE user_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $user_id);

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
		$sql = "INSERT INTO teachers (user_id, profile_photo_id, identity_photo_id, sex, date_of_birth, mobile_number, type_of_school, school_name, school_address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iiisssssss", $user_id, $profile_photo_id, $identity_photo_id, $sex, $date_of_birth, $mobile_number, $type_of_school, $school_name, $school_address, $status);

		$user_id = $this->user_id;
		$profile_photo_id = $this->profile_photo_id;
		$identity_photo_id = $this->identity_photo_id;
		$sex = $this->sex;
		$date_of_birth = $this->date_of_birth;
		$mobile_number = $this->mobile_number;
		$type_of_school = $this->type_of_school;
		$school_name = $this->school_name;
		$school_address = $this->school_address;
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
			$sql = "UPDATE teachers SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}
}
?>