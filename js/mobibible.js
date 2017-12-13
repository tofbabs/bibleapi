var MobiBible = (function(Utils, jQuery) {

	var _count = 0;
	var base_url = "http://localhost/bible/api.php";
	var active_user;

	// Initialize Module
	var init = function(book_sel, chap_sel, verse_sel){
		refreshBooks(book_sel);
		refreshChapters(chap_sel);
		refreshVerses(verse_sel);
	}

	buildSelectOption = function(elem) {
		var html = '<option value="' + elem + '">' + elem + '</option>';
		return html;
	};

	loadSelectEntry = function (data,elem="#books") {
		// Populate Select Input
		var _select = '';
		_book_list = data;

		for (var i = 0; i < _book_list.length; i++) {
			_select += buildSelectOption(_book_list[i]);
		}
		jQuery(elem).html(_select);
	};

	buildVerse = function(data){
		var html = '<p><span>' + data.verse + '</span> ' + data.text + '</p>';
		return html;
	};

	loadBibleCanvas = function(data, elem){
		_verse = '';

		if(data[0] === undefined) {
			_verse = buildVerse(data);
			_verse += '<a href="#" onClick="loadmore()">Read Entire Chapter</a>';
		}
		else{
			for (var i = 0; i < data.length; i++) {
				_verse += buildVerse(data[i]);
			}
			_verse += '<a href="#" onClick="prev('+ data[0].book_name +', ' + data[0].chapter + ')">Prev Chapter</a>';
			_verse += '<a href="#" onClick="next('+ data[0].book_name +', ' + data[0].chapter + ')">Next Chapter</a>';
		}


		jQuery(elem).html(_verse);
	};

	refreshBibleCanvas = function(elem, type, book, chap, verse = '' ){

		var url = base_url+'?action=load_bible&book_type='+ type +'&book='+ book + '&chap=' + chap+ '&verse=' + verse;
		Utils.getData(url, loadBibleCanvas, elem);

	};

	refreshBooks = function(elem, type='ot'){
		Utils.getData(base_url+'?action=books&book_type='+type, loadSelectEntry, elem);
	};

	refreshChapters = function(elem, book='Genesis', type='ot'){

		// Check Testament is NT
		if (type == "nt" && book == "Genesis") {
			book = "Matthew";
		}
		var url = base_url+'?action=chapters&book_type='+type+'&book=' + book;
		Utils.getData(url , loadSelectEntry, elem);
	}

	refreshVerses = function(elem, chap='1', book='Genesis', type='ot' ){
		var url = base_url+'?action=verses&book_type='+ type +'&book='+ book + '&chap=' + chap;
		Utils.getData(url, loadSelectEntry, elem);
	}

	return{
		refreshBooks: refreshBooks,
		refreshChapters: refreshChapters,
		refreshVerses: refreshVerses,
		refreshBibleCanvas: refreshBibleCanvas,
		init: init
	};

})(Utils, $);