$("#search").click(function() {
	search();
});

function search() {

	$.ajax({
		url : "resume_search/search?w=2",
		dataType : "json"
	}).done(function(data) {
		console.log("done");
		if (data.status > 0) {
			var resume_list = data.data;
			for (var index = 0; index < resume_list.length; index++) {
				console.log(index + " " + resume_list[index].name);
			}
		} else if (data.status == 0) {
			console.log("no data found");
		} else {
			console.log("need search word");
		}

	}).fail(function(data) {
		console.log("failed " + data);
	});
}
