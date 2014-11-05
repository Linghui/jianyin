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
			show_resume_list(data.data);
		} else if (data.status == 0) {
			show_error("no data found");
		} else {
			show_error("need search word");
		}

	}).fail(function(data) {
		console.log("failed " + data);
	});
}

function show_resume_list(resume_list) {
	$("#resume_list").html("found " + resume_list.length + " 个");
}

function show_error(msg) {
	$("#resume_list").html(msg);
}
