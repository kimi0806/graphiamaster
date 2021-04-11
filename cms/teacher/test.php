<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- Title -->
	<?php include 'dist/layout/title.php'; ?>
	<!-- Link -->
	<?php include 'dist/layout/link.php'; ?>
</head>
<body>
	<form class="m-5">
		<div class="form-group">
			<textarea name="text" class="form-control"></textarea>
		</div>
		<button type="button" name="submit" class="btn btn-block btn-success">Submit</button>
	</form>

	<div class="card m-5">
		<div class="card-header">
			<h4 class="mb-0">Corrections</h4>
		</div>
		<div id="correction-box" class="card-body">
			
			
			
		</div>
	</div>

	<!-- Script -->
  	<?php include 'dist/layout/script.php'; ?>
  	<!-- Custom -->
	<script type="text/javascript">
		$('button[name=submit]').on('click', function () {
			$.ajax({
				url: 'https://www.abbreviations.com/services/v2/grammar.php',
				method: 'get',
				data: {
					uid: '7904',
					tokenid: 'u2k98lXk6IHi9pou',
					text: $('textarea[name=text]').val(),
					lang: 'en-US',
					format: 'json'
				},
				success: function (response) {
					var i = 1;
					var response = JSON.parse(response);
					var matches = response.matches;

					$.each(matches, function(matchesIndex, matchesValue) {
						$('#correction-box').append('<h5>'+i+'.) Error</h5>');

						$('#correction-box').append('<p>Sentence: <span id="sentence-'+i+'">'+matches[matchesIndex].sentence+'</span></p>');

						$('#correction-box').append('<p>Message: <span id="message-'+i+'">'+matches[matchesIndex].message+'</span></p>');

						$('#correction-box').append('<h6>Replacement(s)</h6>');

						$.each(matches[matchesIndex].replacements, function(replacementIndex, replacementValue) {
							$('#correction-box').append('<p>'+matches[matchesIndex].replacements[replacementIndex].value+'</p>');
						});

						i = i + 1;
					});

					console.log(response);
				}
			});
		});
	</script>
</body>
</html>