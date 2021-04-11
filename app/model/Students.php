<?php  
/**
 * 
 */
class Students extends Database
{
	public $id;
	public $user_id;
	public $teacher_user_id;
	public $section_id;
	public $profile_photo_id;
	public $sex;
	public $date_of_birth;
	public $mobile_number;
	public $educational_attainment;
	public $school_attended;
	public $status;
	public $created_at;
	public $updated_at;
	
	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function findById($id)
	{
		$sql = "SELECT * FROM students WHERE id=?";

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
		$sql = "INSERT INTO students (user_id, teacher_user_id, section_id, profile_photo_id, sex, date_of_birth, mobile_number, educational_attainment, school_attended, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iiiissssss", $user_id, $teacher_user_id, $section_id, $profile_photo_id, $sex, $date_of_birth, $mobile_number, $educational_attainment, $school_attended, $status);

		$user_id = $this->user_id;
		$teacher_user_id = $this->teacher_user_id;
		$section_id = $this->section_id;
		$profile_photo_id = $this->profile_photo_id;
		$sex = $this->sex;
		$date_of_birth = $this->date_of_birth;
		$mobile_number = $this->mobile_number;
		$educational_attainment = $this->educational_attainment;
		$school_attended = $this->school_attended;
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
			$sql = "UPDATE students SET $key=? WHERE id=?";

			$stmt = $this->mysql->prepare($sql);
			$stmt->bind_param("si", $value, $id);
			$stmt->execute() === true ? $result['success']++ : $result['error']++;
			$stmt->close();
		}

		return $result;
	}

	public function update_student_class($sections_id, $status, $students_id)
	{
		$sql = "UPDATE students LEFT JOIN sections ON students.section_id = sections.id SET students.section_id = ?, students.status = ? WHERE students.id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("isi", $sections_id, $status, $students_id);

		if ($stmt->execute()) 
		{
			return 'success';
		}else{
			return 'failed';
		}
		$stmt->close();
	}

	public function change_section($section_id, $students_id)
	{
		$sql = "UPDATE students SET section_id = ? WHERE id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("ii", $section_id, $students_id);

		if ($stmt->execute()) 
		{
			return 'transfered';
		}else{
			return 'failed';
		}
	}

	public function update_student_info($sex, $date_of_birth, $mobile_number, $id)
	{
		$sql = "UPDATE students SET sex = ?, date_of_birth = ?, mobile_number = ? WHERE id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("ssii", $sex, $date_of_birth, $mobile_number, $id);

		if ($stmt->execute()) 
		{
			return 'updated';
		}else{
			return 'failed';
		}
	}
}
?>