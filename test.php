<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="https://www.languagetool.org/js/jquery-1.7.0.min.js"></script>
	<script type="text/javascript" src="https://www.languagetool.org/online-check/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="https://www.languagetool.org/online-check/tiny_mce/plugins/atd-tinymce/editor_plugin2.js"></script>
	<script language="javascript" type="text/javascript">  
		tinyMCE.init({
			mode : "textareas",
			plugins : "AtD,paste",
			paste_text_sticky : true,
			setup : function(ed) {
				ed.onInit.add(function(ed) {
					ed.pasteAsPlainText = true;
				});
			},
			function() { return document.checkform.lang.value; },
			/* The URL of your LanguageTool server.
			If you use your own server here and it's not running on the same domain 
			as the text form, make sure the server gets started with '--allow-origin ...' 
			and use 'https://your-server/v2/check' as URL: */
			languagetool_rpc_url : "https://languagetool.org/api/v2/check",
			/* edit this file to customize how LanguageTool shows errors: */
			languagetool_css_url :
			"https://www.languagetool.org/online-check/" +
			"tiny_mce/plugins/atd-tinymce/css/content.css",
			/* this stuff is a matter of preference: */
			theme                              : "advanced",
			theme_advanced_buttons1            : "",
			theme_advanced_buttons2            : "",
			theme_advanced_buttons3            : "",
			theme_advanced_toolbar_location    : "none",
			theme_advanced_toolbar_align       : "left",
			theme_advanced_statusbar_location  : "bottom",
			theme_advanced_path                : false,
			theme_advanced_resizing            : true,
			theme_advanced_resizing_use_cookie : false,
			gecko_spellcheck                   : false
		});
	 
		function doit() {
			var langCode = document.checkform.lang.value;
			tinyMCE.activeEditor.execCommand("mceWritingImprovementTool", langCode);
		}
	</script>
</head>
<body>
	<form name="checkform" action="http://community.languagetool.org" method="post">
		<p id="checktextpara">
			<textarea id="checktext" name="text" style="width: 100%"
			rows="5"></textarea>
		</p>
		<div>
			<select name="lang" id="lang">
				<option value="en-US">English</option>
			</select>
			<input type="submit" name="_action_checkText"
			value="Check Text" onClick="doit();return false;"> Powered by <a href="https://languagetool.org">languagetool.org</a>
			<div id="feedbackErrorMessage" style="color: red;"></div>
		</div>
	</form>
</body>
</html>