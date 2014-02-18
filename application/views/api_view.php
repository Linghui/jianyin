<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>简音</title>
		<link rel="stylesheet" type="text/css" href="/css/view.css">
		<link rel="stylesheet" type="text/css" href="/css/header.css">

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

		<!-- <div id="header">
		<a href="/">HOME</a>
		<a href="/index.php/api">API</a>
		<a href="/index.php/help">HELP US</a>
		<a href="http://t.cn/zQS2J6s" target="_blank">Chrome 插件</a>
		<a href="index.php/info" target="_blank">个人无聊1111</a>
		</div>
		-->
		<?php
		$this->load->view('head_view');
		?>
		<div id="container">
			<h1 id="title">API 说明文档</h1>
			<h2>所有API访问方式均为GET，返回均为JSON格式，结构都很简单，具体信息尝试点击下面的实例就清楚了，说多了就乱了 ;P。</h2>
			<h3>郑重承诺，您使用下列API不需要承担任何费用跟责任，我们会努力的保证服务的稳定性。</h3>
			<h3>当出现任何形式的访问异常，请及时联系我们，我们会尽快解决，联系方式在<a href="/index.php/help" target="_blank">HELP US</a>中可以找到。</h3>
			<h2>1): index.php/pinyin</h2>
			<h3>参数: words</h3>
			<h3>说明: a) 输入文字短语时候，取得文字的首字母简化拼音；b) 输入缩写时候，取得输入缩写对应的文字短语。</h3>
			<h3>实例: </h3>
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php/pinyin?words=7456" target="_blank">/index.php/pinyin?words=7456</a></h3>
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php/pinyin?words=哦大白痴" target="_blank">/index.php/pinyin?words=哦大白痴</a></h3>
			</br>
			<h2>2): index.php/pinyin/getShortUrl</h2>
			<h3>参数: url</h3>
			<h3>说明: 取得输入url的新浪short url。这里完全没有约束要求翻译的url内容，可以随便使用。</h3>
			<h3>实例: </h3>
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php/pinyin/getShortUrl?url=http://www.jian-yin.com/" target="_blank">/index.php/pinyin/getShortUrl?url=http://www.jian-yin.com/</a></h3>
			<h2>3): index.php/pinyin/addNew</h2>
			<h3>参数: words and pinyin</h3>
			<h3>说明: 添加新的词语翻译，帮助我们完善词语库:)。</h3>
			<h3>实例: </h3>
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php/pinyin/addNew?words=哦上帝&pinyin=OMG" target="_blank">/index.php/pinyin/addNew?words=哦上帝&pinyin=OMG</a></h3>
		</div>
	</body>
</html>