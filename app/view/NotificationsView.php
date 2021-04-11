<?php
/**
 * 
 */
class NotificationsView extends Database
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

	public function load_notifications($to_user_id)
	{
		$sql = "SELECT *, notifications.created_at AS notification_created_at FROM notifications LEFT JOIN users ON notifications.from_user_id=users.id WHERE notifications.to_user_id=? ORDER BY notifications.created_at DESC LIMIT 10";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $to_user_id);

		$html = '';
		$count = 0;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();
			$num_rows = $stmt_result->num_rows;

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$notification_message = (strlen("$given_name $family_name $description") > 35) ? substr("$given_name $family_name $description", 0, 35) . '...' : "$given_name $family_name $description";
				$enable_text_type = ($enable > 0) ? 'text-success' : 'text-secondary';
				$count = ($enable > 0) ? $count + 1 : $count;

				$html .= <<<HTML
					<a href="$module_type.php?id=$module_primary_id" class="dropdown-item">
						<div class="d-flex justify-content-between align-items-center">
							<span>
								<i class="fas fa-landmark mr-2"></i>
								<span>$notification_message</span>
							</span>
							<i class="far fa-circle float-right $enable_text_type"></i>
						</div>
					</a>
					<div class="dropdown-divider"></div>
				HTML;
			}
		}

		$stmt->close();

		return ['html' => $html, 'count' => $count];
	}
}
?>