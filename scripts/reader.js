function openChapter(id) {
	$.get("../actions/chapter-loader.php?identifier=" + id,
		function(data) {
			$("#chapter").html(data);
			$.get("../actions/comment-loader.php?chapterId=" + id,
				function(data) {
					$("#comments").html(data);
				}
			);
		}
	);
}

function submitComment(chapterId) {
	var text = $('#new_comment').value();
	$.post("../actions/chapter-loader.php",
		{chapter: chapterId, comment: text},
		function(data) {
}

function toggle_side_menu() {
	if ($("body").hasClass("folded")) {
		$("body").removeClass("folded");
	} else {
		$("body").addClass("folded");
	}
}

function show_export() {
	$.get("../actions/export.php",
		function(data) {
			$("#chapter").html(data);
		}
	);
} 

function selectAllChapters() {
	$(".chapter-check").attr("checked", true);
}

function exportPDF() {
	// TODO: gather parameters
	window.location = "../actions/pdf-loader.php?"; //TODO: pass parameters
}