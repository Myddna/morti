<?php
	include_once '../common/session_protection.php';
	include_once '../dao/mysql.php';
	include_once '../dao/date.php';

	$bugReportChapter = $GLOBALS["bugReportChapter"];

	if (isset($_GET["chapterId"])) {
		// First case: getting comments from a chapter id
		$comments = get_comments_for_chapter($_GET["chapterId"]);
		if (sizeof($comments) != 0) {
			echo('<div class="comments_title">Comentarios</div>');
			echo('<div class="comment_list_container">');
			for ($i = 0; $i < sizeof($comments); $i++) {
				paint_comment($comments[$i]);
			}
			echo ('</div>');
		}
		echo('<div class="comments_title">Dejar un comentario</div>');
		echo('<div id="paragraph_container"/>');
		echo ('<textarea id="new_comment"></textarea>');
		echo ('<input class="button" type="button" value="Enviar" onClick="submitComment(' . $_GET["chapterId"] . ')">');
	} else if (isset($_POST["comment"])) {
		$commentText = $_POST["comment"];
		$chapterId = $_POST["chapter"];
		if (isset($_POST["paragraph"])) {
			$paragraph = $_POST["paragraph"];
		}
		$author = $_SESSION["MORTI-mail"];
		if ($chapterId == $_SESSION["MORTI-selected-chapter"] || $chapterId == $bugReportChapter) {
			if (!isset($paragraph) || $chapterId == $bugReportChapter) {
				insert_comment($chapterId, $commentText, $author);
			} else {
				insert_paragraph_comment($chapterId, $commentText, $author, $paragraph);
			}
		}
	} else {
		echo("error!");
	}

	function paint_comment($comment_structure) {
		$commentId = $comment_structure[0];
		$email = $comment_structure[1];
		$username = $comment_structure[2];
		$avatar = $comment_structure[3];
		$chapterId = $comment_structure[4];
		$text = $comment_structure[5];
		$date = $comment_structure[6];
		$paragraph = $comment_structure[7];
		$permissions = $comment_structure[8];

		$holderClass = '';
		if ($permissions == 1) {
			$holderClass = ' silver';
		} else if ($permissions == 2) {
			$holderClass = ' gold';
		}
		echo ('<div class="comment_wrapper' . $holderClass . '"><div class="avatar-holder"><img class="avatar" src="' . $avatar . '" height="66px" width="66px" align="top"/></div>');
		echo ('<div class="username"><a href="mailto:'.htmlspecialchars($email).'">'. htmlspecialchars($username) .'</a></div>');
		echo ('<div class="date">' . htmlspecialchars(pretty_date($date)) . '</div><br/>');
		if (isset($paragraph)) {
			// TODO: Set the link to the paragraph. (En referencia a este pàrrafo:)
			echo ('<div class="inreference">En referencia a <a href="#paragraph_' . $paragraph . '">este p&aacute;rrafo</a>:</div>');
		}
		echo ('<div class="comment">' . htmlspecialchars($text) . '</div></div>');
	}
?>