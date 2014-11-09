<head>
	<meta charset="utf-8">
	<title>才库搜索</title>
</head>
<body>
	<div class="ui input">
		<input type="text" placeholder="搜索..." id ="search_wrod">
	</div>
	<div id="search" class="ui right labeled icon button">
		<i class="search icon"></i>
		搜索
	</div>
	<div class="ui selection dropdown">
		<input type="hidden" name="gender">
		<div class="default text">
			城市
		</div>
		<i class="dropdown icon"></i>
		<div class="menu" id='city'></div>
	</div>

	<div class="ui selection list" id="resume_list"></div>

	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/javascript/semantic.min.js"></script>
	<script type="text/javascript" src="/js/resume.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/semantic.min.css">
</body>