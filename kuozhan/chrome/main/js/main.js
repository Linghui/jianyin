

$("#btn").click(function(){
	sendPinyinReq();
});

$("#title").click(function(){
	window.open('http://www.jian-yin.com')
});

function onChange() {
	console.log("success");

}

function sendPinyinReq() {
	
	var head = "http://www.jian-yin.com/index.php/";
	
	console.log("sendPinyinReq");

	var allWords = $('#t1').val();

	console.log("before:'" + allWords + "'");

	$.ajax({
		url : head + "pinyin?words=" + allWords,
		dataType : "json"
	}).done(function(data) {
		console.log("done");
		console.log("'" + data.words + "'");


		if ( data.status != 0 ) {
			$('#t2').val(data.error);
			$('#href').css("display", "none");
			// $('#btn2').css("display", "none");
			return;
		}

		// $('#t2').val(data.pinyin);
		var text = "";
		
		if (data.pinyin == null) {

			for (var index = 0; index < data.words.length; index++) {
				text += (index + 1 ) + ". " + data.words[index] + "\n";
			}
			$('#href').css("display", "none");
			// $('#btn2').css("display", "none");
		} else {
			text = data.pinyin;
			
			$('#href').css("display", "none");
			// $('#btn2').css("display", "none");
			// $('#facebookG').css("display", "inline");
			$('#loading').css("display", "inline");
			
			
			$.ajax({
					url : head + "pinyin/getShortUrl?url=" + data.url,
					dataType : "json"
				}).done(function(data) {
					console.log("done");
					$('#href').attr('href', data.short_url);
					$('#href').html(data.short_url);
					$('#href').css("display", "inline");
					// $('#btn2').css("display", "inline");
				}).always( function(){
					console.log("always");
					// $('#facebookG').css("display", "none");
					$('#loading').css("display", "none");
				});
		}
		
		$('#t2').val(text);

	}).fail(function(data) {
		console.log("failed " + data);
	});
}
