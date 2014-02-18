$("#btn").click(function() {
	sendPinyinReq();
});

function onChange() {
	console.log("success");

}

function sendPinyinReq() {
	console.log("sendPinyinReq");

	var allWords = $('#t1').val();

	console.log("before:'" + allWords + "'");

	$.ajax({
		url : "index.php/pinyin?words=" + allWords,
		dataType : "json"
	}).done(function(data) {
		console.log("done");
		console.log("'" + data.words + "'");

		if (data.status != 0) {
			$('#t2').val(data.error);
			$('#href').css("display", "none");
			$('#btn2').css("display", "none");
			return;
		}

		// $('#t2').val(data.pinyin);
		var text = "";

		if (data.pinyin == null) {

			for (var index = 0; index < data.words.length; index++) {
				text += (index + 1 ) + ". " + data.words[index] + "\n";
			}
			$('#href').css("display", "none");
			$('#btn2').css("display", "none");
		} else {
			text = data.pinyin;

			$('#href').css("display", "none");
			$('#btn2').css("display", "none");
			$('#facebookG').css("display", "inline");

			$.ajax({
				url : "index.php/pinyin/getShortUrl?url=" + data.url,
				dataType : "json"
			}).done(function(data) {

				$('#href').attr('href', data.short_url);
				$('#href').html(data.short_url);
				$('#href').css("display", "inline");
				$('#btn2').css("display", "inline");
			}).always(function() {
				$('#facebookG').css("display", "none");
			});
		}

		$('#t2').val(text);

	}).fail(function(data) {
		console.log("failed " + data);
	});
}

function addNew() {

	var words = $('#words').val();
	var pinyin = $('#pinyin').val();

	if (words == null || words == "") {
		$('#message').html("短语不可以为空。");
		return;
	}

	if (pinyin == null || pinyin == "") {
		$('#message').html("简化语不可以为空。");
		return;
	}

	$.ajax({
		url : "pinyin/addNew?words=" + words + "&pinyin=" + pinyin,
		dataType : "json"
	}).done(function(data) {
		console.log("status " + data.status);
		var message;
		if (data.status == 0) {
			message = "非常感谢您的协助:)";
		} else {
			message = data.error;
			if (data.status == 5) {
				message = "已经有好心人添加过这个简化翻译了，不过还是非常感谢您的支持:)";
			}
		}

		$('#message').html(message);

	}).always(function() {

	});

}

function cleanText(inputText) {
	inputText.value = "";
	inputText.style.color = '#000';
}

function leaveword_over(obj) {
	var t = parseInt(obj.style.top);
	if (t > 0) {
		obj.timer = setTimeout(function() {
			leaveword_over(obj);
		}, 10);
		obj.style.top = (t-=5) + "px";
	}
}

function leaveword_out(obj) {
	var t = parseInt(obj.style.top);
	if (t < 290) {
		obj.timer = setTimeout(function() {
			leaveword_out(obj);
		}, 10);
		obj.style.top = (t+=5) + "px";
	}
}

function clear_to(obj, n) {
	clearTimeout(obj.timer);
	if (n)
		leaveword_over(obj);
	else
		leaveword_out(obj);
}
