$("#search").click(function() {
	search();
});

function search() {

$.ajax({
		url : "index.php/pinyin?words=" + allWords,
		dataType : "json"
	}).done(function(data) {
		console.log("done");

	}).fail(function(data) {
		console.log("failed " + data);
	});
}
