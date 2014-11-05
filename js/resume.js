$("#search").click(function() {
	search();
});

function search() {

	var word = $("#search_wrod").val();

	$.ajax({
		url : "resume_search/search?w=" + word,
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
	var html = "";
	for (var index = 0; index < resume_list.length; index++) {
		html += '<div class="item">';
		html += '<div class="content">';
		html += '<div class="header">姓名:' + resume_list[index].name + '</div>';
		html += '性别:' + resume_list[index].sex + " ";
		html += '生日:' + resume_list[index].birth + " ";
		html += '住址:' + resume_list[index].location + " ";
		html += '</div>';
		html += '</div>';
		html += '</div>';
	}
	console.log(html);
	$("#resume_list").html(html);
}

function show_error(msg) {
	$("#resume_list").html(msg);
}
