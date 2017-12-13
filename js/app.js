// Initialize App
MobiBible.init("#books", "#chap", "#verse");

var type = $( "input:checked" ).val();

$( "input.type" ).on( "click", function() {
	type = $( "input:checked" ).val();
	MobiBible.refreshBooks("#books",type);
});

$( "#books" ).change(function() {
  MobiBible.refreshChapters("#chap", $(this).val(), type);

});

$( "#chap" ).change(function() {
	var book = $('#books').val();
  	MobiBible.refreshVerses("#verse", $(this).val() , book, type );
});

$('#filterForm').submit(function(event) {
	event.preventDefault();

	var type = $( "input.type:checked" ).val();
	console.log(type);

	var book = $( "#books" ).val();
	var chap = $( "#chap" ).val();
	var verse = $( "#verse" ).val();
	refreshBibleCanvas("#bible_canvas", type, book, chap, verse);
})

loadmore = function() {

	event.preventDefault();

	var type = $( "input:checked" ).val();
	var book = $( "#books" ).val();
	var chap = $( "#chap" ).val();

	refreshBibleCanvas("#bible_canvas", type, book, chap);
}


// Mobichurch.loadChurches(0,10);
