<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>简音</title>
		<link rel="stylesheet" type="text/css" href="/css/help.css">
		<link rel="stylesheet" type="text/css" href="/css/header.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">
	</head>
	<body>
		<script>
		(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] ||
		function() {
		(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o), m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
		})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-42687248-1', 'jian-yin.com');
		ga('send', 'pageview');

		</script>

		<?php
		$this->load->view('head_view');
		?>

		<div id="container">
			<h1 id="title">感谢</h1>
			<h2>在这里您可以帮助完善我们的词汇库</h2>
		</div>
		<div width="100%" align="center">

			<input type="text" id="words" class="border_less input_text" style="color:#ccc" onfocus="cleanText(this);" value="短语 例: 七上八下"/>
			<input type="text" id="pinyin" class="border_less input_text" style="color:#ccc" onfocus="cleanText(this);" value="简化语 例: 738x"/>
			<input type="button" onclick="addNew()" class="blue_button" value="T J" id="addNew"/>
			</br>
			</br>
			<label id="message"></label>
		</div>
		<hr/>
		<br/>
		<h2>如果您发现了问题，或者有更好的建议，欢迎随时联系我们，邮箱地址: xiaohuidexinge#163.com。标题请注明 -简音- :)。</h2>
		<br/>
		<hr/>
		<br/>
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/main.js"></script>
		
	</body>
</html>