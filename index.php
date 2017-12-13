<?php include 'bible-be.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Mobichurch - Bible</title>
</head>
<body>

<form id="filterForm">
	<p>
		<input class="type" type="radio" name="book_type" value="ot" checked="checked"> Old
		<input class="type" type="radio" name="book_type" value="nt"> New
	</p>
	<p>
		<select name="book" id="books">
			<option>Select Book</option>
		</select>

		<select name="chap" id="chap">
			<option>Select Chapter</option>
		</select>

		<select name="verse" id="verse">
			<option>Select Verse</option>
		</select>
		<input type="submit" name="filterBtn" value="Go To">
	</p>
</form>


<form id="searchForm">
	<p>
		<input type="text" name="search">
		<input type="submit" name="searchBtn" value="Search Bible">
	</p>
</form>

	<div id="bible_canvas">

	</div>

	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/mobibible.js"></script>
	<script type="text/javascript" src="js/app.js"></script>


</body>
</html>