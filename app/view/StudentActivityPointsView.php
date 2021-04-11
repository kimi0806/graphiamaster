<?php  
/**
 * 
 */
class StudentActivityPointsView extends Database
{
	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function activity_evaluation()
	{
		$sqlone = "SELECT *, student_activity_points.student_activity_id AS student_activity_id FROM student_activity_points";

		$stmtone = $this->mysql->prepare($sqlone);

		$html = '';

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			while ($dataone = $resultone->fetch_assoc())
			{
				extract($dataone);

				$html .= <<<HTML
				<div class="modal fade" id="modal_activity_points_$student_activity_id">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="height: 60px;">
								<h4 class="modal-title">Activity Evaluation</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h2>Correction</h2>
								<p>$correction</p>
								<hr>
								<h2>Score: $point <small style="font-size: 20px;">points</small></h2>
								<hr>
								<h2>Recommendation</h2>
								<p>$recommendation</p>
							</div>
							<div class="modal-footer justify-content-between" style="height: 60px;">
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">_</button>
								<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Ok</button>
							</div>
						</div>
					</div>
				</div>
				HTML;
			}
		}

		$stmtone->close();

		return $html;
	}
}
?>