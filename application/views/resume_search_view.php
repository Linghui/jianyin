<head>
	<meta charset="utf-8">
	<title>才库搜索</title>
</head>
<body>
	<div class="ui input">
		<input type="text" placeholder="关键字..." id ="search_wrod">
		<div class="ui inverted dimmer" id="loader">
			<div class="ui loader"></div>
		</div>
	</div>

	<div class="ui selection dropdown" id='province_dropdown'>
		<input type="hidden" name="province">
		<div class="text">
			北京
		</div>
		<i class="dropdown icon"></i>
		<div class="menu" id='province'></div>
	</div>

	<div class="ui selection dropdown" id='city_dropdown'>
		<input type="hidden" name="city">
		<div class="text">
			城市
		</div>
		<i class="dropdown icon"></i>
		<div class="menu" id='city'></div>
	</div>

	<div class="ui selection dropdown" id='from_dropdown'>
		<input type="hidden" name="from" value＝"99">
		<div class="text">
			工作年限
		</div>
		<i class="dropdown icon"></i>
		<div class="menu">

			<div class="item" data-value="99">
				不限
			</div>
			<div class="item " data-value="1">
				一年
			</div>
			<div class="item " data-value="2">
				三年
			</div>
			<div class="item " data-value="3">
				五年
			</div>
			<div class="item " data-value="4">
				八年
			</div>
		</div>
	</div>

	<div class="ui selection dropdown" id='to_dropdown'>
		<input type="hidden" name="to" value＝"99">
		<div class="text">
			工作年限
		</div>
		<i class="dropdown icon"></i>
		<div class="menu">

			<div class="item" data-value="99">
				不限
			</div>
			<div class="item " data-value="1">
				一年
			</div>
			<div class="item " data-value="2">
				三年
			</div>
			<div class="item " data-value="3">
				五年
			</div>
			<div class="item " data-value="4">
				八年
			</div>
		</div>
	</div>

	<div id="search" class="ui right labeled icon button">
		<i class="search icon"></i>
		搜索
	</div>
	<h4 class="ui red header" id ="error" style="visibility: hidden;" > Error: </div> </h4>

	<div class="ui tabular menu">
		<a class="active item" onclick="watch_self()" id="self_title"> 才库 (0) </a>
		<a class="item" onclick="watch_51()" id="51_title"> 51 (0)</a>
	</div>

	<div class="ui selection list" id="self_resume_list"></div>
	<div class="ui selection list" id="51_resume_list" style="display:none"></div>

	<div id="context1">
		<div class="ui pointing secondary menu">
			<a class="item" data-tab="first">First</a>
			<a class="item active" data-tab="second">Second</a>
		</div>
		<div class="ui tab segment" data-tab="first">
			<div class="ui top attached tabular menu">
				<a class="active item" data-tab="first/a">1A</a>
				<a class="item" data-tab="first/b">1B</a>
				<a class="item" data-tab="first/c">1C</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="first/a">
				1A
			</div>
			<div class="ui bottom attached tab segment" data-tab="first/b">
				1B
			</div>
			<div class="ui bottom attached tab segment" data-tab="first/c">
				1C
			</div>
		</div>
		<div class="ui tab segment active" data-tab="second">
			<div class="ui top attached tabular menu">
				<a class="item" data-tab="second/a">2A</a>
				<a class="item" data-tab="second/b">2B</a>
				<a class="item active" data-tab="second/c">2C</a>
			</div>
			<div class="ui bottom attached tab segment" data-tab="second/a">
				2A
			</div>
			<div class="ui bottom attached tab segment" data-tab="second/b">
				2B
			</div>
			<div class="ui bottom attached tab segment active" data-tab="second/c">
				2C
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/javascript/semantic.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/semantic.min.css">
	<script type="text/javascript" src="/js/resume.js"></script>
</body>