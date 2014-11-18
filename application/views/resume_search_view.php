<head>
	<meta charset="utf-8">
	<title>才库搜索</title>
</head>
<body>
	<div class="ui input">
		<input type="text" placeholder="关键字..." id ="search_wrod">
		<div class="ui dimmer" id="loader">
			<div class="ui loader"></div>
		</div>
	</div>

	<div class="ui selection dropdown" id='dropdown'>
		<input type="hidden" name="gender">
		<div class="default text">
			城市
		</div>
		<i class="dropdown icon"></i>
		<div class="menu" id='city'></div>
	</div>

	<div id="search" class="ui right labeled icon button">
		<i class="search icon"></i>
		搜索
	</div>
	<h4 class="ui red header" id ="error" style="visibility: hidden;" > Error: </div> </h4>

	<div class="ui selection list" id="resume_list"></div>

	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/javascript/semantic.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/semantic.min.css">
	<script type="text/javascript" src="/js/resume.js"></script>
</body>