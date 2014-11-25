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

	<div class="ui top attached tabular menu">
		<a class="active item"> Bio </a>
		<a class="item"> Pics </a>
	</div>
	<div class="ui bottom attached segment">
		This is the content of the tab.
	</div>

	<div class="ui selection list" id="self_resume_list"></div>
	<div class="ui selection list" id="51_resume_list" style="display:none"></div>

	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/javascript/semantic.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/semantic.min.css">
	<script type="text/javascript" src="/js/resume.js"></script>
</body>