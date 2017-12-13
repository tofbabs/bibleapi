<?php 

include_once 'bible-be.php';

$action = isset($_GET['action']) ? $_GET['action'] : exit(503);
$book_type = isset($_GET['book_type']) ? $_GET['book_type'] : "ot";

if($action == "books"){
	echo get_all_books($book_type);
}

if ($action == "chapters") {
	# code...
	$book = isset($_GET['book']) ? $_GET['book'] : 'Genesis';
	echo get_all_chapters($book_type, $book);
}

if ($action == "verses") {
	# code...
	$book = isset($_GET['book']) ? $_GET['book'] : 'Genesis';
	$chap = isset($_GET['chap']) ? $_GET['chap'] : 1;

	echo get_all_verses($book_type, $book, $chap);

}

if ($action == "load_bible") {

	$book = isset($_GET['book']) ? $_GET['book'] : 'Genesis';
	$chap = isset($_GET['chap']) ? $_GET['chap'] : 1;
	$verse = isset($_GET['verse']) ? $_GET['verse'] : '';

	echo fetch_bible_word($book_type, $book, $chap, $verse);
}

if($action == "navigate"){

	$resp = array();

	$book = isset($_GET['book']) ? $_GET['book'] : 'Genesis';
	$chap = isset($_GET['chap']) ? $_GET['chap'] : 1;
	$dir = isset($_GET['dir']) ? $_GET['dir'] : 'next';

	echo $book_type;

	$book_type = get_book_type($book);

	if ($dir == "next") {

		// Check if not last Chapter in Book
		$arrChap = json_decode(get_all_chapters($book_type, $book), true);
		$key = array_search($chap, $arrChap);

		if ($key >= count($arrChap) - 1 || !$key) {

			// Check if not last Book in Testament
			$arrBook = json_decode(get_all_books($book_type), true);
			$key = array_search($book, $arrBook);

			if ($key >= count($arrBook) || !$key ) {
				$resp = ($book_type == "nt") ? array( "type" => "ot" ,"book" => "Genesis","chap" => 1) : array( "type" => "nt" ,"book" => "Matthew","chap" => 1);
				echo json_encode($resp);
				exit();
			}

			$resp = array( "type" => $book_type ,"book" => $arrBook[$key],"chap" => 1);
			echo json_encode($resp);
			exit();

		}

		$resp = array( "type" => $book_type ,"book" => $book,"chap" => $chap + 1);
		echo json_encode($resp);
		exit();

	}

}


?>