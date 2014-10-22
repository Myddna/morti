<?php
	$MORTI_body_class = 'reader';
	$MORTI_load_scripts = true;
	include '../dao/mysql.php';
	include '../dao/user.php';
	include '../dao/files.php';
	include '../common/header.php';
?>

		<div id="side-menu">
			<div id="current_chapter_options" class="side-menu-section">
			</div>

			<div id="chapter_list" class="side-menu-section">
				<div class="side-menu-title">
					Cap&iacute;tulos
				</div>
				<ul>
<?php
	$list = get_chapter_list();
	for ($i=0; $i<sizeof($list); $i++) {
?>
					<li>
						<a href='#' onClick='openChapter(<?=$list[$i][0]?>)'><?=$list[$i][2]?></a>
					</li>
<?php
	}
?>
				</ul>
			</div>

			<div id="static_options" class="side-menu-section">
				<div class="side-menu-title">
					Opciones
				</div>
				<ul>
					<li>
						<a href="#" onClick="export()">Exportar</a>
					</li>
					<li>
						<a href="logout.php">Logout</a>
					</li>
				</ul>
			</div>

			<div id="toggle_button">
				<a href="#" onClick="toggle_side_menu()">&lt;&lt;</a>
			</div>

		</div>
		<div id="content-container">
			<div id="chapter">
			</div>

			<div id="comments">
			</div>
		</div>

<?php	
	include '../common/footer.php';
?>