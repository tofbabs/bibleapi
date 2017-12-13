<?php 

function fetch_bible_word($type, $book,$chap, $verse=''){
	$file = "data/{$type}/{$book}/{$chap}.json";

	$bible = file_get_contents($file);
	$objBible = json_decode($bible);

	if ($verse == '') {
			# code...
		return json_encode($objBible->verses);
	}
	return json_encode($objBible->verses[$verse - 1]);
}

function get_all_books($testament="ot"){
	$books = array();
	$file = "data/{$testament}.csv";
		// echo $file;
	$books_Arr = preg_split("/[\\n,]+/", file_get_contents($file));
	return json_encode($books_Arr);
}

function get_all_chapters($testament, $book){
	$chap = array();
	$folder = "data/{$testament}/$book";
	$chap = scandir($folder);

		// Crude way to remove first 2 element
	$buf = array_shift($chap);
	$buf = array_shift($chap);

	$result = array_map('remove_excess', $chap);

	sort($result, 1);
		// print_r($result);
	return json_encode($result);
}

function get_all_verses($testament, $book, $chap){

	$verses = array();
	$file = "data/{$testament}/{$book}/{$chap}.json";

	$bible = file_get_contents($file);
	$objBible = json_decode($bible);
		// print_r($bible);

	$verse = array_keys($objBible->verses);
	$length = count($verse);
	sort($verse);
	array_shift($verse);
	array_push($verse,$length);

	return json_encode($verse);
}

/*
**	@desc Get book type from book
*/
function get_book_type($book){

	$ot = json_decode(get_all_books("ot"));
	$nt = json_decode(get_all_books("nt"));

	if (array_search($book, $ot) !== null ) return "ot";
	if (array_search($book, $nt) !== null ) return "nt";

	return 503;
}

function remove_excess($elem){
	return explode('.', $elem)[0];
}

	// Fallback for Non supporting Javascript Client
function get_books_select_options($testament){

	$books_Arr = get_all_books($testament);

		// String output for book
	$books = "";

	if ($format == "select_options" && !empty($books_Arr)) {
			# code...
		foreach ($books_Arr as $key => $value) {
				# code...
			$books.= "<option>" . $value . "</option>";
		}
	}

	return $books;
}

?>
