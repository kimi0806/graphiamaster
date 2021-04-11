<?php
/**
 * 
 */
class Users extends Database
{
	public $id;
	public $user_type_id;
	public $family_name;
	public $given_name;
	public $middle_name;
	public $email_address;
	public $password;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM users WHERE id=?";

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

	public function findByEmailAddress($email_address)
	{
		$sql = "SELECT * FROM users WHERE email_address=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("s", $email_address);

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
		$sql = "INSERT INTO users (user_type_id, family_name, given_name, middle_name, email_address, password, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("issssss", $user_type_id, $family_name, $given_name, $middle_name, $email_address, $password, $status);

		$user_type_id = $this->user_type_id;
		$family_name = $this->family_name;
		$given_name = $this->given_name;
		$middle_name = $this->middle_name;
		$email_address = $this->email_address;
		$password = $this->password;
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
			$sql = "UPDATE users SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function update_student_fullname($given_name, $middle_name, $family_name, $id)
	{
		$sql = "UPDATE users SET given_name = ?, middle_name = ?, family_name = ? WHERE id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("sssi", $given_name, $middle_name, $family_name, $id);

		if ($stmt->execute()) 
		{
			return 'updated';
		}else{
			return 'failed';
		}
	}
}
?>