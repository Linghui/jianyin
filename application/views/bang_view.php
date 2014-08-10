<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>榜单</title>

	</head>
	<body>
		<h1>状元榜</h1>
		<hr />
		<div align="center">
			<?php
			$index = 1;

			foreach ($todo_list as $item) {

				$pos = strpos($item -> spend_time, '.');
				$timestr = substr($item -> spend_time, 0, $pos + 2);

				echo "<h2>$index. " . $item -> click_times . "次 耗时" . $timestr . "秒<br/></h2>";
				$index++;
			}
			?>
		</div>
	</body>
</html>