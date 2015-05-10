<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>简音</title>
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/header.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
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
		<script type="text/javascript">
			var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
			document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F27db24f232381606515635a17fe28cd2' type='text/javascript'%3E%3C/script%3E"));
		</script>

		<?php
		$this -> load -> view('head_view');
		?>

		<div id="container">
			<h1 id="title">JY - PYZCDSJ</h1>
		</div>

		<div align="left">
			<textarea id="t1" rows="10"><?php
			if ($pinyin) {
				echo $pinyin;
			} else {
				echo "如果您第一次来到这里，不知道如何使用，请阅读页面下放的说明。";
			}
		?></textarea>
			<textarea id="t2" rows="10" disabled="true">
<?php
if ($words) {
	if (count($words) > 0) {

		for ($index = 0; $index < count($words); $index++) {
			echo($index + 1) . ". " . $words[$index];
			echo "\n";
		}
	}
} else {
	echo "RGNDYCLDZL，BZDRHSY，QYDYMXFDYM。";
}
			?>
</textarea>
		</div>
		<div id="btnLine1" align="left">
			<input type="button" value="F Y" class="blue_button" id="btn">
		</div>
		<div id="btnLine2" >

			<div id="facebookG">
				<div id="blockG_1" class="facebook_blockG"></div>
				<div id="blockG_2" class="facebook_blockG"></div>
				<div id="blockG_3" class="facebook_blockG"></div>
			</div>

			<a id="share" class="shareto_button" href="http://shareto.com.cn/share.html">
			<input type="button" value="F X" class="blue_button" id="btn2">
			</a>

			<a href="http://t.cn/zQ6WJrt" id="href" target="_blank">http://t.cn/zQ6WJrt</a>
		</div>

		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<div id="google">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- jy -->
			<ins class="adsbygoogle"
			style="display:inline-block;width:336px;height:280px"
			data-ad-client="ca-pub-1246566438770912"
			data-ad-slot="8591423980"></ins>
			<script>
				( adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		<div id="box">

			<div id="leaveword" style="top:290px;" onmouseover="clear_to(this,1);" onmouseout="clear_to(this,0);">
				<hr/>
				<div class="div_title">
					<h2>使用说明(点击展开)</h2>
				</div>
				<div class="div_content">

					<h3>功能1: 翻译简化词或者拼音缩写短语，例: <a href="/index.php?pinyin=7456" target="_blank">7456</a>, <a href="/index.php?pinyin=PPMM" target="_blank">PPMM</a></h3>
					<h3>功能2: 把输入的文字转换成首字母，可以通过 <a id="share" class="shareto_button" href="http://shareto.com.cn/share.html">
					<input type="button" value="F X" class="blue_button" id="btn3">
					</a>按钮分享简化内容；或者直接分享可以跳转到翻译页面的短链接。扩展使用方式请自行联想:)。</h3>

					<h3>功能3: 通过<a href="/index.php/help" target="_blank">HELP US</a>页添加功能，添加您自己的流行词汇 ：）。</h3>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

		<script type="text/javascript" src="js/shareto_button.js" charset="utf-8"></script>
		<!-- ShareTo Button END -->

	</body>
</html>