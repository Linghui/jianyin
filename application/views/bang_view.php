<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>榜单</title>

	</head>
	<body>
		<?php
		$index = 0;

		foreach ($todo_list as $item) {

			$pos = strpos($item -> spend_time, '.');
			$timestr = substr($item -> spend_time, 0, $pos + 1);

			echo "$index. " . $item -> click_times . "次 耗时" . $timestr . "秒<br/>";
			$index++;
		}
		?>
	</body>
</html>