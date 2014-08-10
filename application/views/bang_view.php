<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>榜单</title>

	</head>
	<body>
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