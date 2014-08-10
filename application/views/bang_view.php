<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>状元榜</title>

	</head>
	<body>
		<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F27db24f232381606515635a17fe28cd2' type='text/javascript'%3E%3C/script%3E"));
</script>

		<div align="center">
		<h1>状元榜</h1>
		</div>
		<hr />
		<div align="center">
			<?php
			$index = 1;

			foreach ($todo_list as $item) {

				$pos = strpos($item -> spend_time, '.');
				$timestr = substr($item -> spend_time, 0, $pos + 2);

				echo "<h1>$index. " . $item -> click_times . "次 耗时" . $timestr . "秒";
				if( $index <= 3){
					echo " -- 华安一样的智商<br/></h1>";
				} else if ($index <= 10 ) {
					echo " -- 秋香一样的智商<br/></h1>";
				} else if ($index <= 15 ) {
					echo " -- 华太师一样的智商<br/></h1>";
				} else if ($index <= 30 ) {
					echo " -- 比华文华武略高那么一点点<br/></h1>";
				}
				$index++;
			}
			?>
		</div>
	</body>
</html>