$().ready(init);

$("#search").click(function() {
	// search_51();
	search_self();
});

var tag_names = new Array('self_resume_list', '51_resume_list');
function watch_self() {
	console.log("watch_self");
	hide_all_tag();
	show_tag('self_resume_list');
}

function watch_51() {
	console.log("watch_51");
	hide_all_tag();
	show_tag('51_resume_list');
}

function hide_all_tag() {
	for (var index = 0; index < tag_names.length; index++) {
		$('#' + tag_names[index]).css("display", "none");
	}
}

function show_tag(name) {
	console.log("show " + name);
	$('#' + name).css("display", "inline");
}

function init() {
	// getAreaIDs
	initArea();
	$("#province_dropdown").dropdown({
		onChange : function(code, name) {
			console.log(code + " " + name);
			var cityArray = getAreaIDs(code);
			showCity(cityArray);
		}
	});

	$('#from_dropdown').dropdown();
	$('#to_dropdown').dropdown();

}

function search_51() {

	hiddenError();
	showLoader();

	var word = $("#search_wrod").val();
	var city = $("#city_dropdown").dropdown('get value');
	console.log("word " + word);
	console.log("city " + city);
	if (word == null || word == "" || city == null || city == "") {
		alert("need input");
		return;
	}
	var url = 'http://www.jian-yin.com/cgi/search.pl?keyword=' + encodeURI(word) + '&location=' + city + '&from_year=99&to_year=99';
	// var url = 'http://www.jian-yin.com/cgi/search.pl?keyword=' + word + '&location=' + city + '&from_year=99';
	console.log("url " + url);
	$.ajax({
		url : url,
		dataType : "json"
	}).done(function(data) {
		// console.log("done");
		// if (data.status > 0) {
		// show_resume_list(data.data);
		// } else if (data.status == 0) {
		// show_error("no data found");
		// } else {
		// show_error("need search word");
		// }
		if (data.c == 0) {
			show_resume_list_new(data.d);
		} else {
			console.log(data.m);
			showError(data.m);
		}

	}).fail(function(jqXHR, textStatus, errorThrown) {
		console.log(textStatus + " " + errorThrown);
		showError(errorThrown);
	}).always(function() {
		hiddenLoader();
	});
}

function search_self() {

	var word = $("#search_wrod").val();
	if (word == null || word == "") {
		alert("need input");
		return;
	}
	var url = 'http://www.jian-yin.com/resume_search/search?w=' + encodeURI(word);
	console.log("url " + url);
	$.ajax({
		url : url,
		dataType : "json"
	}).done(function(data) {
		// console.log("done");
		// if (data.status > 0) {
		// show_resume_list(data.data);
		// } else if (data.status == 0) {
		// show_error("no data found");
		// } else {
		// show_error("need search word");
		// }
		if (data.c == 0) {
			show_resume_list_self(data.d);
		} else {
			console.log(data.m);
			showError(data.m);
		}

	}).fail(function(jqXHR, textStatus, errorThrown) {
		console.log(textStatus + " " + errorThrown);
		showError(errorThrown);
	}).always(function() {
		hiddenLoader();
	});
}

function show_resume_list(resume_list) {
	var html = "";
	for (var index = 0; index < resume_list.length; index++) {
		html += '<div class="item">';
		html += '<div class="content">';
		// html += '<div class="header">姓名:' + resume_list[index].name + '</div>';tml += '性别:' + resume_list[index].sex + " ";
		html += '生日:' + resume_list[index].birth + " ";
		html += '住址:' + resume_list[index].location + " ";
		html += '</div>';
		html += '</div>';
		html += '</div>';
	}
	console.log(html);
	$("#51_resume_list").html(html);
}

function show_resume_list_new(resume_list) {
	var html = "";
	for (var index = 0; index < resume_list.length; index++) {
		html += '<div class="item">';
		html += '<div class="content">';
		html += '<div class="header">姓名:' + resume_list[index].name + '</div>';
		html += '学历:' + resume_list[index].degree + " ";
		html += '城市:' + resume_list[index].location + " ";
		html += '性别:' + resume_list[index].sex + " ";
		html += '年龄:' + resume_list[index].age + " ";
		html += '工作年限:' + resume_list[index].job_year + " ";
		html += '简历更新时间:' + resume_list[index].update_date + " ";
		html += 'id:' + resume_list[index].id + " ";
		html += '专业:' + resume_list[index].major + " ";
		html += 'keywords:' + resume_list[index].keywords + " ";
		html += 'appraise:' + resume_list[index].appraise + " ";
		html += 'addtype:' + resume_list[index].addtype + " ";
		html += '</div>';
		html += '</div>';
		html += '</div>';
	}
	console.log(html);
	$("#51_resume_list").html(html);
}

function show_resume_list_self(resume_list) {
	console.log("show_resume_list_self	");
	var html = "";
	for (var index = 0; index < resume_list.length; index++) {

		html += '<div class="item">';
		html += '<div class="content">';
		html += '<div class="header">姓名:' + resume_list[index].name + '</div>';
		html += '城市:' + resume_list[index].local + " ";
		html += '性别:' + resume_list[index].sex + " ";
		html += '年龄:' + resume_list[index].Age + " ";
		html += 'id:' + resume_list[index].IDNO + " ";
		html += 'keywords:' + resume_list[index].keywords + " ";
		html += 'appraise:' + resume_list[index].appraise + " ";
		html += 'addtype:' + resume_list[index].addtype + " ";
		html += '</div>';
		html += '</div>';
		html += '</div>';
	}
	$("#self_resume_list").html(html);
}

function show_error(msg) {
	$("#resume_list").html(msg);
}

function initArea() {

	console.log("initArea");
	var html = "";
	for (var index = 0; index < maincity.length; index++) {
		var cityCode = maincity[index];
		var cityName = ja[cityCode];
		if (isMainCity(cityCode)) {
			continue;
		}

		html += '<div class="item" data-value="';
		html += cityCode;
		html += '">';
		html += cityName;
		html += '</div>';
		index++;
	}
	$("#province").html(html);

	$('#province_dropdown').dropdown();
}

function showCity(cityArray) {

	console.log("cityArray " + cityArray.length);
	var html = "";
	var firstc = 0;
	var firstn = 0;
	for (var index = 0; index < cityArray.length; index++) {
		var cityCode = cityArray[index];
		if (index == 0) {
			firstc = cityCode;
		}
		var cityName = ja[cityCode];
		console.log("cityArray " + cityName);
		if (index == 0) {
			firstn = cityName;
		}
		console.log(cityName);
		if (isMainCity(cityCode)) {
			continue;
		}

		html += '<div class="item" data-value="';
		html += cityCode;
		html += '">';
		html += cityName;
		html += '</div>';
		index++;
	}
	$("#city").html(html);

	$('#city_dropdown').dropdown();
	$('#city_dropdown').dropdown("set text", firstn);
	$('#city_dropdown').dropdown("set value", firstc);

}

function isMainCity() {
	return false;
}

function showError(error) {
	$('#error').css("visibility", "visible");
	$('#error').html("Error:" + error);
}

function hiddenError() {
	$('#error').css("visibility", "hidden");
}

function showLoader() {
	$('#loader').addClass("active");
}

function hiddenLoader() {
	$('#loader').removeClass("active");
}

var ja = [];
ja['010000'] = '北京';
ja['010100'] = '东城区';
ja['010200'] = '西城区';
ja['010300'] = '崇文区';
ja['010400'] = '宣武区';
ja['010500'] = '朝阳区';
ja['010600'] = '丰台区';
ja['010700'] = '石景山区';
ja['010800'] = '海淀区';
ja['010900'] = '门头沟区';
ja['011000'] = '房山区';
ja['011100'] = '通州区';
ja['011200'] = '顺义区';
ja['011300'] = '昌平区';
ja['011400'] = '大兴区';
ja['011500'] = '怀柔区';
ja['011600'] = '平谷区';
ja['011700'] = '密云县';
ja['011800'] = '延庆县';
ja['020000'] = '上海';
ja['020100'] = '黄浦区';
ja['020200'] = '卢湾区';
ja['020300'] = '徐汇区';
ja['020400'] = '长宁区';
ja['020500'] = '静安区';
ja['020600'] = '普陀区';
ja['020700'] = '闸北区';
ja['020800'] = '虹口区';
ja['020900'] = '杨浦区';
ja['021000'] = '浦东新区';
ja['021100'] = '闵行区';
ja['021200'] = '宝山区';
ja['021300'] = '嘉定区';
ja['021400'] = '金山区';
ja['021500'] = '松江区';
ja['021600'] = '青浦区';
ja['021800'] = '奉贤区';
ja['021900'] = '崇明县';
ja['030000'] = '广东省';
ja['030200'] = '广州';
ja['030201'] = '越秀区';
ja['030202'] = '荔湾区';
ja['030203'] = '海珠区';
ja['030204'] = '天河区';
ja['030205'] = '白云区';
ja['030206'] = '黄埔区';
ja['030207'] = '番禺区';
ja['030208'] = '花都区';
ja['030209'] = '南沙区';
ja['030210'] = '萝岗区';
ja['030211'] = '增城';
ja['030212'] = '从化';
ja['030300'] = '惠州';
ja['030400'] = '汕头';
ja['030500'] = '珠海';
ja['030600'] = '佛山';
ja['030700'] = '中山';
ja['030800'] = '东莞';
ja['030801'] = '莞城街道';
ja['030802'] = '南城街道';
ja['030803'] = '东城街道';
ja['030804'] = '万江街道';
ja['030805'] = '石碣镇';
ja['030806'] = '石龙镇';
ja['030807'] = '茶山镇';
ja['030808'] = '石排镇';
ja['030809'] = '企石镇';
ja['030810'] = '横沥镇';
ja['030811'] = '桥头镇';
ja['030812'] = '谢岗镇';
ja['030813'] = '东坑镇';
ja['030814'] = '常平镇';
ja['030815'] = '寮步镇';
ja['030816'] = '大朗镇';
ja['030817'] = '麻涌镇';
ja['030818'] = '中堂镇';
ja['030819'] = '高埗镇';
ja['030820'] = '樟木头镇';
ja['030821'] = '大岭山镇';
ja['030822'] = '望牛墩镇';
ja['030823'] = '黄江镇';
ja['030824'] = '洪梅镇';
ja['030825'] = '清溪镇';
ja['030826'] = '沙田镇';
ja['030827'] = '道滘镇';
ja['030828'] = '塘厦镇';
ja['030829'] = '虎门镇';
ja['030830'] = '厚街镇';
ja['030831'] = '凤岗镇';
ja['030832'] = '长安镇';
ja['031400'] = '韶关';
ja['031500'] = '江门';
ja['031700'] = '湛江';
ja['031800'] = '肇庆';
ja['031900'] = '清远';
ja['032000'] = '潮州';
ja['032100'] = '河源';
ja['032200'] = '揭阳';
ja['032300'] = '茂名';
ja['032400'] = '汕尾';
ja['032500'] = '顺德';
ja['032600'] = '梅州';
ja['032700'] = '开平';
ja['032800'] = '阳江';
ja['032900'] = '云浮';
ja['040000'] = '深圳';
ja['040100'] = '福田区';
ja['040200'] = '罗湖区';
ja['040300'] = '南山区';
ja['040400'] = '盐田区';
ja['040500'] = '宝安区';
ja['040600'] = '龙岗区';
ja['040700'] = '光明新区';
ja['040800'] = '坪山新区';
ja['040900'] = '大鹏新区';
ja['041000'] = '龙华新区';
ja['050000'] = '天津';
ja['050100'] = '和平区';
ja['050200'] = '河东区';
ja['050300'] = '河西区';
ja['050400'] = '南开区';
ja['050500'] = '河北区';
ja['050600'] = '红桥区';
ja['050700'] = '东丽区';
ja['050800'] = '西青区';
ja['050900'] = '津南区';
ja['051000'] = '北辰区';
ja['051100'] = '武清区';
ja['051200'] = '宝坻区';
ja['051300'] = '滨海新区';
ja['051400'] = '宁河县';
ja['051500'] = '静海县';
ja['051600'] = '蓟县';
ja['060000'] = '重庆';
ja['060100'] = '渝中区';
ja['060200'] = '大渡口区';
ja['060300'] = '江北区';
ja['060400'] = '沙坪坝区';
ja['060600'] = '合川区';
ja['060700'] = '渝北区';
ja['060800'] = '永川区';
ja['060900'] = '巴南区';
ja['061000'] = '南川区';
ja['061100'] = '九龙坡区';
ja['061200'] = '万州区';
ja['061300'] = '涪陵区';
ja['061400'] = '黔江区';
ja['061500'] = '南岸区';
ja['061600'] = '北碚区';
ja['061700'] = '长寿区';
ja['061900'] = '江津区';
ja['062000'] = '綦江区';
ja['062100'] = '潼南县';
ja['062200'] = '铜梁县';
ja['062300'] = '大足区';
ja['062400'] = '荣昌县';
ja['062500'] = '璧山县';
ja['062600'] = '垫江县';
ja['062700'] = '丰都县';
ja['062800'] = '忠县';
ja['062900'] = '石柱县';
ja['063000'] = '城口县';
ja['063100'] = '彭水县';
ja['063200'] = '梁平县';
ja['063300'] = '酉阳县';
ja['063400'] = '开县';
ja['063500'] = '秀山县';
ja['063600'] = '巫溪县';
ja['063700'] = '巫山县';
ja['063800'] = '奉节县';
ja['063900'] = '武隆县';
ja['064000'] = '云阳县';
ja['070000'] = '江苏省';
ja['070200'] = '南京';
ja['070201'] = '玄武区';
ja['070202'] = '白下区';
ja['070203'] = '秦淮区';
ja['070204'] = '建邺区';
ja['070205'] = '鼓楼区';
ja['070206'] = '下关区';
ja['070207'] = '浦口区';
ja['070208'] = '六合区';
ja['070209'] = '栖霞区';
ja['070210'] = '雨花台区';
ja['070211'] = '江宁区';
ja['070212'] = '溧水县';
ja['070213'] = '高淳县';
ja['070300'] = '苏州';
ja['070301'] = '姑苏区';
ja['070302'] = '虎丘区';
ja['070303'] = '吴中区';
ja['070304'] = '相城区';
ja['070305'] = '吴江区';
ja['070306'] = '工业园区';
ja['070307'] = '高新区';
ja['070400'] = '无锡';
ja['070401'] = '崇安区';
ja['070402'] = '南长区';
ja['070403'] = '北塘区';
ja['070404'] = '滨湖区';
ja['070405'] = '无锡新区';
ja['070406'] = '惠山区';
ja['070407'] = '锡山区';
ja['070408'] = '宜兴市';
ja['070409'] = '江阴市';
ja['070500'] = '常州';
ja['070501'] = '天宁区';
ja['070502'] = '钟楼区';
ja['070503'] = '戚墅堰区';
ja['070504'] = '新北区';
ja['070505'] = '武进区';
ja['070506'] = '金坛市';
ja['070507'] = '溧阳市';
ja['070600'] = '昆山';
ja['070700'] = '常熟';
ja['070800'] = '扬州';
ja['070900'] = '南通';
ja['071000'] = '镇江';
ja['071100'] = '徐州';
ja['071200'] = '连云港';
ja['071300'] = '盐城';
ja['071400'] = '张家港';
ja['071600'] = '太仓';
ja['071800'] = '泰州';
ja['071900'] = '淮安';
ja['072000'] = '宿迁';
ja['072100'] = '丹阳';
ja['072300'] = '泰兴';
ja['072500'] = '靖江';
// delete by linsendu 072400，07150020140713 移至无锡分区内，072200移至常州分区内
ja['080000'] = '浙江省';
ja['080200'] = '杭州';
ja['080201'] = '拱墅区';
ja['080202'] = '上城区';
ja['080203'] = '下城区';
ja['080204'] = '江干区';
ja['080205'] = '西湖区';
ja['080206'] = '滨江区';
ja['080207'] = '余杭区';
ja['080208'] = '萧山区';
ja['080209'] = '临安市';
ja['080210'] = '富阳市';
ja['080211'] = '建德市';
ja['080212'] = '桐庐县';
ja['080213'] = '淳安县';
ja['080300'] = '宁波';
ja['080301'] = '海曙区';
ja['080302'] = '江东区';
ja['080303'] = '江北区';
ja['080304'] = '北仑区';
ja['080305'] = '镇海区';
ja['080306'] = '鄞州区';
ja['080307'] = '慈溪市';
ja['080308'] = '余姚市';
ja['080309'] = '奉化市';
ja['080310'] = '宁海县';
ja['080311'] = '象山县';
ja['080400'] = '温州';
ja['080500'] = '绍兴';
ja['080600'] = '金华';
ja['080700'] = '嘉兴';
ja['080800'] = '台州';
ja['080900'] = '湖州';
ja['081000'] = '丽水';
ja['081100'] = '舟山';
ja['081200'] = '衢州';
ja['081400'] = '义乌';
ja['081600'] = '海宁';
ja['090000'] = '四川省';
ja['090200'] = '成都';
ja['090201'] = '青羊区';
ja['090202'] = '锦江区';
ja['090203'] = '金牛区';
ja['090204'] = '武侯区';
ja['090205'] = '成华区';
ja['090206'] = '龙泉驿区';
ja['090207'] = '青白江区';
ja['090208'] = '新都区';
ja['090209'] = '温江区';
ja['090210'] = '都江堰市';
ja['090211'] = '彭州市';
ja['090212'] = '邛崃市';
ja['090213'] = '崇州市';
ja['090214'] = '金堂县';
ja['090215'] = '双流县';
ja['090216'] = '郫县';
ja['090217'] = '大邑县';
ja['090218'] = '蒲江县';
ja['090219'] = '新津县';
ja['090220'] = '高新区';
ja['090300'] = '绵阳';
ja['090400'] = '乐山';
ja['090500'] = '泸州';
ja['090600'] = '德阳';
ja['090700'] = '宜宾';
ja['090800'] = '自贡';
ja['090900'] = '内江';
ja['091000'] = '攀枝花';
ja['091100'] = '南充';
ja['091200'] = '眉山';
ja['091300'] = '广安';
ja['091400'] = '资阳';
ja['091500'] = '遂宁';
ja['091600'] = '广元';
ja['091700'] = '达州';
ja['091800'] = '雅安';
ja['091900'] = '西昌';
ja['092000'] = '巴中';
ja['092100'] = '甘孜';
ja['092200'] = '阿坝';
ja['092300'] = '凉山';
ja['100000'] = '海南省';
ja['100200'] = '海口';
ja['100300'] = '三亚';
ja['100400'] = '洋浦经济开发区';
ja['100500'] = '文昌';
ja['100600'] = '琼海';
ja['100700'] = '万宁';
ja['100800'] = '儋州';
ja['100900'] = '东方';
ja['101000'] = '五指山';
ja['101100'] = '定安';
ja['101200'] = '屯昌';
ja['101300'] = '澄迈';
ja['101400'] = '临高';
ja['101500'] = '三沙';
ja['110000'] = '福建省';
ja['110200'] = '福州';
ja['110201'] = '鼓楼区';
ja['110202'] = '台江区';
ja['110203'] = '仓山区';
ja['110204'] = '马尾区';
ja['110205'] = '晋安区';
ja['110206'] = '闽侯县';
ja['110207'] = '连江县';
ja['110208'] = '罗源县';
ja['110209'] = '闽清县';
ja['110210'] = '永泰县';
ja['110211'] = '平潭县';
ja['110212'] = '福清市';
ja['110213'] = '长乐市';
ja['110300'] = '厦门';
ja['110400'] = '泉州';
ja['110500'] = '漳州';
ja['110600'] = '莆田';
ja['110700'] = '三明';
ja['110800'] = '南平';
ja['110900'] = '宁德';
ja['111000'] = '龙岩';
ja['120000'] = '山东省';
ja['120200'] = '济南';
ja['120201'] = '历下区';
ja['120202'] = '市中区';
ja['120203'] = '槐荫区';
ja['120204'] = '天桥区';
ja['120205'] = '历城区';
ja['120206'] = '长清区';
ja['120207'] = '平阴县';
ja['120208'] = '济阳县';
ja['120209'] = '商河县';
ja['120210'] = '章丘市';
ja['120211'] = '高新区';
ja['120300'] = '青岛';
ja['120301'] = '市南区';
ja['120302'] = '市北区';
ja['120303'] = '黄岛区';
ja['120304'] = '崂山区';
ja['120305'] = '城阳区';
ja['120306'] = '李沧区';
ja['120307'] = '胶州市';
ja['120308'] = '即墨市';
ja['120309'] = '平度市';
ja['120310'] = '莱西市';
ja['120400'] = '烟台';
ja['120500'] = '潍坊';
ja['120600'] = '威海';
ja['120700'] = '淄博';
ja['120800'] = '临沂';
ja['120900'] = '济宁';
ja['121000'] = '东营';
ja['121100'] = '泰安';
ja['121200'] = '日照';
ja['121300'] = '德州';
ja['121400'] = '菏泽';
ja['121500'] = '滨州';
ja['121600'] = '枣庄';
ja['121700'] = '聊城';
ja['121800'] = '莱芜';
ja['130000'] = '江西省';
ja['130200'] = '南昌';
ja['130300'] = '九江';
ja['130400'] = '景德镇';
ja['130500'] = '萍乡';
ja['130600'] = '新余';
ja['130700'] = '鹰潭';
ja['130800'] = '赣州';
ja['130900'] = '吉安';
ja['131000'] = '宜春';
ja['131100'] = '抚州';
ja['131200'] = '上饶';
ja['140000'] = '广西';
ja['140200'] = '南宁';
ja['140300'] = '桂林';
ja['140400'] = '柳州';
ja['140500'] = '北海';
ja['140600'] = '玉林';
ja['140700'] = '梧州';
ja['140800'] = '防城港';
ja['140900'] = '钦州';
ja['141000'] = '贵港';
ja['141100'] = '百色';
ja['141200'] = '河池';
ja['141300'] = '来宾';
ja['141400'] = '崇左';
ja['141500'] = '贺州';
ja['150000'] = '安徽省';
ja['150200'] = '合肥';
ja['150201'] = '瑶海区';
ja['150202'] = '庐阳区';
ja['150203'] = '蜀山区';
ja['150204'] = '包河区';
ja['150205'] = '经开区';
ja['150206'] = '滨湖新区';
ja['150207'] = '新站区';
ja['150208'] = '高新区';
ja['150209'] = '政务区';
ja['150210'] = '北城新区';
ja['150211'] = '巢湖市';
ja['150300'] = '芜湖';
ja['150400'] = '安庆';
ja['150500'] = '马鞍山';
ja['150600'] = '蚌埠';
ja['150700'] = '阜阳';
ja['150800'] = '铜陵';
ja['150900'] = '滁州';
ja['151000'] = '黄山';
ja['151100'] = '淮南';
ja['151200'] = '六安';
ja['151400'] = '宣城';
ja['151500'] = '池州';
ja['151600'] = '宿州';
ja['151700'] = '淮北';
ja['151800'] = '亳州';
// delete by linsendu 151300移至合肥分区内
ja['160000'] = '河北省';
ja['160200'] = '石家庄';
ja['160300'] = '廊坊';
ja['160400'] = '保定';
ja['160500'] = '唐山';
ja['160600'] = '秦皇岛';
ja['160700'] = '邯郸';
ja['160800'] = '沧州';
ja['160900'] = '张家口';
ja['161000'] = '承德';
ja['161100'] = '邢台';
ja['161200'] = '衡水';
ja['161300'] = '燕郊开发区';
ja['170000'] = '河南省';
ja['170200'] = '郑州';
ja['170201'] = '中原区';
ja['170202'] = '二七区';
ja['170203'] = '管城回族区';
ja['170204'] = '金水区';
ja['170205'] = '上街区';
ja['170206'] = '惠济区';
ja['170207'] = '中牟县';
ja['170208'] = '巩义市';
ja['170209'] = '荥阳市';
ja['170210'] = '新密市';
ja['170211'] = '新郑市';
ja['170212'] = '登封市';
ja['170300'] = '洛阳';
ja['170400'] = '开封';
ja['170500'] = '焦作';
ja['170600'] = '南阳';
ja['170700'] = '新乡';
ja['170800'] = '周口';
ja['170900'] = '安阳';
ja['171000'] = '平顶山';
ja['171100'] = '许昌';
ja['171200'] = '信阳';
ja['171300'] = '商丘';
ja['171400'] = '驻马店';
ja['171500'] = '漯河';
ja['171600'] = '濮阳';
ja['171700'] = '鹤壁';
ja['171800'] = '三门峡';
ja['171900'] = '济源';
ja['172000'] = '邓州';
ja['180000'] = '湖北省';
ja['180200'] = '武汉';
ja['180201'] = '江岸区';
ja['180202'] = '江汉区';
ja['180203'] = '硚口区';
ja['180204'] = '汉阳区';
ja['180205'] = '武昌区';
ja['180206'] = '青山区';
ja['180207'] = '洪山区';
ja['180208'] = '东西湖区';
ja['180209'] = '汉南区';
ja['180210'] = '蔡甸区';
ja['180211'] = '江夏区';
ja['180212'] = '黄陂区';
ja['180213'] = '新洲区';
ja['180300'] = '宜昌';
ja['180400'] = '黄石';
ja['180500'] = '襄阳';
ja['180600'] = '十堰';
ja['180700'] = '荆州';
ja['180800'] = '荆门';
ja['180900'] = '孝感';
ja['181000'] = '鄂州';
ja['181100'] = '黄冈';
ja['181200'] = '随州';
ja['181300'] = '咸宁';
ja['181400'] = '仙桃';
ja['181500'] = '潜江';
ja['181600'] = '天门';
ja['181700'] = '神农架';
ja['181800'] = '恩施';
ja['190000'] = '湖南省';
ja['190200'] = '长沙';
ja['190201'] = '芙蓉区';
ja['190202'] = '天心区';
ja['190203'] = '岳麓区';
ja['190204'] = '开福区';
ja['190205'] = '雨花区';
ja['190206'] = '望城区';
ja['190207'] = '长沙县';
ja['190208'] = '宁乡县';
ja['190209'] = '浏阳市';
ja['190300'] = '株洲';
ja['190400'] = '湘潭';
ja['190500'] = '衡阳';
ja['190600'] = '岳阳';
ja['190700'] = '常德';
ja['190800'] = '益阳';
ja['190900'] = '郴州';
ja['191000'] = '邵阳';
ja['191100'] = '怀化';
ja['191200'] = '娄底';
ja['191300'] = '永州';
ja['191400'] = '张家界';
ja['191500'] = '湘西';
ja['200000'] = '陕西省';
ja['200200'] = '西安';
ja['200201'] = '莲湖区';
ja['200202'] = '新城区';
ja['200203'] = '碑林区';
ja['200204'] = '灞桥区';
ja['200205'] = '未央区';
ja['200206'] = '雁塔区';
ja['200207'] = '阎良区';
ja['200208'] = '临潼区';
ja['200209'] = '长安区';
ja['200210'] = '蓝田县';
ja['200211'] = '周至县';
ja['200212'] = '户县';
ja['200213'] = '高陵县';
ja['200214'] = '高新技术产业开发区';
ja['200215'] = '经济技术开发区';
ja['200216'] = '曲江文化新区';
ja['200217'] = '浐灞生态区';
ja['200218'] = '国家民用航天产业基地';
ja['200219'] = '西咸新区';
ja['200300'] = '咸阳';
ja['200400'] = '宝鸡';
ja['200500'] = '铜川';
ja['200600'] = '延安';
ja['200700'] = '渭南';
ja['200800'] = '榆林';
ja['200900'] = '汉中';
ja['201000'] = '安康';
ja['201100'] = '商洛';
ja['201200'] = '杨凌';
ja['210000'] = '山西省';
ja['210200'] = '太原';
ja['210300'] = '运城';
ja['210400'] = '大同';
ja['210500'] = '临汾';
ja['210600'] = '长治';
ja['210700'] = '晋城';
ja['210800'] = '阳泉';
ja['210900'] = '朔州';
ja['211000'] = '晋中';
ja['211100'] = '忻州';
ja['211200'] = '吕梁';
ja['220000'] = '黑龙江省';
ja['220200'] = '哈尔滨';
ja['220201'] = '道里区';
ja['220202'] = '南岗区';
ja['220203'] = '道外区';
ja['220204'] = '平房区';
ja['220205'] = '松北区';
ja['220206'] = '香坊区';
ja['220207'] = '呼兰区';
ja['220208'] = '阿城区';
ja['220209'] = '依兰县';
ja['220210'] = '方正县';
ja['220211'] = '宾县';
ja['220212'] = '巴彦县';
ja['220213'] = '木兰县';
ja['220214'] = '通河县';
ja['220215'] = '延寿县';
ja['220216'] = '双城市';
ja['220217'] = '尚志市';
ja['220218'] = '五常市';
ja['220300'] = '伊春';
ja['220400'] = '绥化';
ja['220500'] = '大庆';
ja['220600'] = '齐齐哈尔';
ja['220700'] = '牡丹江';
ja['220800'] = '佳木斯';
ja['220900'] = '鸡西';
ja['221000'] = '鹤岗';
ja['221100'] = '双鸭山';
ja['221200'] = '黑河';
ja['221300'] = '七台河';
ja['221400'] = '大兴安岭';
ja['230000'] = '辽宁省';
ja['230200'] = '沈阳';
ja['230201'] = '大东区';
ja['230202'] = '东陵区（浑南新区）';
ja['230203'] = '康平县';
ja['230204'] = '和平区';
ja['230205'] = '皇姑区';
ja['230206'] = '沈北新区';
ja['230207'] = '沈河区';
ja['230208'] = '苏家屯区';
ja['230209'] = '铁西区';
ja['230210'] = '于洪区';
ja['230211'] = '法库县';
ja['230212'] = '辽中县';
ja['230213'] = '新民市';
ja['230300'] = '大连';
ja['230301'] = '西岗区';
ja['230302'] = '中山区';
ja['230303'] = '沙河口区';
ja['230304'] = '甘井子区';
ja['230305'] = '旅顺口区';
ja['230306'] = '金州区';
ja['230307'] = '瓦房店市';
ja['230308'] = '普兰店市';
ja['230309'] = '庄河市';
ja['230310'] = '长海县';
ja['230311'] = '开发区';
ja['230312'] = '高新园区';
ja['230313'] = '长兴岛';
ja['230400'] = '鞍山';
ja['230500'] = '营口';
ja['230600'] = '抚顺';
ja['230700'] = '锦州';
ja['230800'] = '丹东';
ja['230900'] = '葫芦岛';
ja['231000'] = '本溪';
ja['231100'] = '辽阳';
ja['231200'] = '铁岭';
ja['231300'] = '盘锦';
ja['231400'] = '朝阳';
ja['231500'] = '阜新';
ja['240000'] = '吉林省';
ja['240200'] = '长春';
ja['240201'] = '朝阳区';
ja['240202'] = '南关区';
ja['240203'] = '宽城区';
ja['240204'] = '二道区';
ja['240205'] = '绿园区';
ja['240206'] = '双阳区';
ja['240207'] = '经济技术开发区';
ja['240208'] = '高新技术产业开发区';
ja['240209'] = '净月经济开发区';
ja['240210'] = '汽车产业开发区';
ja['240211'] = '榆树市';
ja['240212'] = '九台市';
ja['240213'] = '德惠市';
ja['240214'] = '农安县';
ja['240300'] = '吉林';
ja['240400'] = '辽源';
ja['240500'] = '通化';
ja['240600'] = '四平';
ja['240700'] = '松原';
ja['240800'] = '延吉';
ja['240900'] = '白山';
ja['241000'] = '白城';
ja['241100'] = '延边';
ja['250000'] = '云南省';
ja['250200'] = '昆明';
ja['250201'] = '五华区';
ja['250202'] = '盘龙区';
ja['250203'] = '官渡区';
ja['250204'] = '西山区';
ja['250205'] = '东川区';
ja['250206'] = '呈贡区';
ja['250207'] = '晋宁县';
ja['250208'] = '富民县';
ja['250209'] = '宜良县';
ja['250210'] = '石林彝族自治县';
ja['250211'] = '嵩明县';
ja['250212'] = '禄劝县';
ja['250213'] = '寻甸县';
ja['250214'] = '安宁市';
ja['250300'] = '曲靖';
ja['250400'] = '玉溪';
ja['250500'] = '大理';
ja['250600'] = '丽江';
ja['251000'] = '红河州';
ja['251100'] = '普洱';
ja['251200'] = '保山';
ja['251300'] = '昭通';
ja['251400'] = '文山';
ja['251500'] = '西双版纳';
ja['251600'] = '德宏';
ja['251700'] = '楚雄';
ja['251800'] = '临沧';
ja['251900'] = '怒江';
ja['252000'] = '迪庆';
ja['260000'] = '贵州省';
ja['260200'] = '贵阳';
ja['260300'] = '遵义';
ja['260400'] = '六盘水';
ja['260500'] = '安顺';
ja['260600'] = '铜仁';
ja['260700'] = '毕节';
ja['260800'] = '黔西南';
ja['260900'] = '黔东南';
ja['261000'] = '黔南';
ja['270000'] = '甘肃省';
ja['270200'] = '兰州';
ja['270300'] = '金昌';
ja['270400'] = '嘉峪关';
ja['270500'] = '酒泉';
ja['270600'] = '天水';
ja['270700'] = '武威';
ja['270800'] = '白银';
ja['270900'] = '张掖';
ja['271000'] = '平凉';
ja['271100'] = '定西';
ja['271200'] = '陇南';
ja['271300'] = '庆阳';
ja['271400'] = '临夏';
ja['271500'] = '甘南';
ja['280000'] = '内蒙古';
ja['280200'] = '呼和浩特';
ja['280300'] = '赤峰';
ja['280400'] = '包头';
ja['280700'] = '通辽';
ja['280800'] = '鄂尔多斯';
ja['280900'] = '巴彦淖尔';
ja['281000'] = '乌海';
ja['281100'] = '呼伦贝尔';
ja['281200'] = '乌兰察布';
ja['281300'] = '兴安盟';
ja['281400'] = '锡林郭勒盟';
ja['281500'] = '阿拉善盟';
ja['290000'] = '宁夏';
ja['290200'] = '银川';
ja['290300'] = '吴忠';
ja['290400'] = '中卫';
ja['290500'] = '石嘴山';
ja['290600'] = '固原';
ja['300000'] = '西藏';
ja['300200'] = '拉萨';
ja['300300'] = '日喀则';
ja['300400'] = '林芝';
ja['300500'] = '山南';
ja['300600'] = '昌都';
ja['300700'] = '那曲';
ja['300800'] = '阿里';
ja['310000'] = '新疆';
ja['310200'] = '乌鲁木齐';
ja['310300'] = '克拉玛依';
ja['310400'] = '喀什地区';
ja['310500'] = '伊犁';
ja['310600'] = '阿克苏';
ja['310700'] = '哈密';
ja['310800'] = '石河子';
ja['310900'] = '阿拉尔';
ja['311000'] = '五家渠';
ja['311100'] = '图木舒克';
ja['311200'] = '昌吉';
ja['311300'] = '阿勒泰';
ja['311400'] = '吐鲁番';
ja['311500'] = '塔城';
ja['311600'] = '和田';
ja['311700'] = '克孜勒苏柯尔克孜';
ja['311800'] = '巴音郭楞';
ja['311900'] = '博尔塔拉';
ja['320000'] = '青海省';
ja['320200'] = '西宁';
ja['320300'] = '海东';
ja['320400'] = '海西';
ja['320500'] = '海北';
ja['320600'] = '黄南';
ja['320700'] = '海南';
ja['320800'] = '果洛';
ja['320900'] = '玉树';
ja['330000'] = '香港';
ja['340000'] = '澳门';
ja['350000'] = '台湾';
ja['360000'] = '国外';

var maincity = new Array('010000', '020000', '040000', '030200', '070200', '180200', '200200', '080200', '090200', '060000', '050000', '070300', '080300', '120300', '230200', '230300', '030800', '110200', '120200', '150200', '170200', '190200', '220200', '240200', '250200', '070400', '070500', '030000', '070000', '080000', '090000', '100000', '110000', '120000', '130000', '140000', '150000', '160000', '170000', '180000', '190000', '200000', '210000', '220000', '230000', '240000', '250000', '260000', '270000', '280000', '290000', '300000', '310000', '320000', '330000', '340000', '350000', '360000');

function getAreaIDs(idx) {
	console.log("getAreaIDs '" + idx + "'");
	var code = String(idx);
	switch(code) {
	case '010000':
		return new Array('010000', '010100', '010200', '010300', '010400', '010500', '010600', '010700', '010800', '010900', '011000', '011100', '011200', '011300', '011400', '011500', '011600', '011700', '011800');
	case '020000':
		return new Array('020000', '020100', '020200', '020300', '020400', '020500', '020600', '020700', '020800', '020900', '021000', '021100', '021200', '021300', '021400', '021500', '021600', '021800', '021900');
	case '030000':
		return new Array('030000', '030200', '040000', '030300', '030400', '030500', '030600', '030700', '030800', '031400', '031500', '031700', '031800', '031900', '032000', '032100', '032200', '032300', '032400', '032500', '032600', '032700', '032800', '032900');
	case '030200':
		return new Array('030200', '030201', '030202', '030203', '030204', '030205', '030206', '030207', '030208', '030209', '030210', '030211', '030212');
	case '030800':
		// add by linsendu 20140713 新增东莞(030800)分区
		return new Array('030800', '030801', '030802', '030803', '030804', '030805', '030806', '030807', '030808', '030809', '030810', '030811', '030812', '030813', '030814', '030815', '030816', '030817', '030818', '030819', '030820', '030821', '030822', '030823', '030824', '030825', '030826', '030827', '030828', '030829', '030830', '030831', '030832');
	case '040000':
		// modify by peggy 20130508 增加深圳分区
		return new Array('040000', '040100', '040200', '040300', '040400', '040500', '040600', '040700', '040800', '040900', '041000');
	case '050000':
		return new Array('050000', '050100', '050200', '050300', '050400', '050500', '050600', '050700', '050800', '050900', '051000', '051100', '051200', '051300', '051400', '051500', '051600');
	case '060000':
		return new Array('060000', '060100', '060200', '060300', '060400', '060600', '060700', '060800', '060900', '061000', '061100', '061200', '061300', '061400', '061500', '061600', '061700', '061900', '062000', '062100', '062200', '062300', '062400', '062500', '062600', '062700', '062800', '062900', '063000', '063100', '063200', '063300', '063400', '063500', '063600', '063700', '063800', '063900', '064000');
	case '070000':
		// modify by peggy 20130508 删除'071700'
		return new Array('070000', '070200', '070300', '070400', '070500', '070600', '070700', '070800', '070900', '071000', '071100', '071200', '071300', '071400', '071600', '071800', '071900', '072000', '072100', '072300', '072500');
	// delete by linsendu 072400，07150020140713 移至无锡分区内，072200移至常州分区内
	case '070200':
		return new Array('070200', '070201', '070202', '070203', '070204', '070205', '070206', '070207', '070208', '070209', '070210', '070211', '070212', '070213');
	case '070300':
		// add by peggy 20130508 新增苏州(070300)分区
		return new Array('070300', '070301', '070302', '070303', '070304', '070305', '070306', '070307');
	case '070400':
		// add by linsendu 20140713 新增无锡(070400)分区
		return new Array('070400', '070401', '070402', '070403', '070404', '070405', '070406', '070407', '070408', '070409');
	case '070500':
		// add by linsendu 20140713 新增常州(070500)分区
		return new Array('070500', '070501', '070502', '070503', '070504', '070505', '070506', '070507');
	case '080000':
		// modify by peggy 20130508 删除'081300','081500'
		return new Array('080000', '080200', '080300', '080400', '080500', '080600', '080700', '080800', '080900', '081000', '081100', '081200', '081400', '081600');
	case '080200':
		return new Array('080200', '080201', '080202', '080203', '080204', '080205', '080206', '080207', '080208', '080209', '080210', '080211', '080212', '080213');
	case '080300':
		// add by peggy 20130508 新增宁波(080300)分区
		return new Array('080300', '080301', '080302', '080303', '080304', '080305', '080306', '080307', '080308', '080309', '080310', '080311');
	case '090000':
		return new Array('090000', '090200', '090300', '090400', '090500', '090600', '090700', '090800', '090900', '091000', '091100', '091200', '091300', '091400', '091500', '091600', '091700', '091800', '091900', '092000', '092100', '092200', '092300');
	case '090200':
		return new Array('090200', '090201', '090202', '090203', '090204', '090205', '090206', '090207', '090208', '090209', '090210', '090211', '090212', '090213', '090214', '090215', '090216', '090217', '090218', '090219', '090220');
	case '100000':
		// add by linsendu 20140713 海南新加城市
		return new Array('100000', '100200', '100300', '100400', '100500', '100600', '100700', '100800', '100900', '101000', '101100', '101200', '101300', '101400', '101500');
	case '110000':
		return new Array('110000', '110200', '110300', '110400', '110500', '110600', '110700', '110800', '110900', '111000');
	case '110200':
		// add by linsendu 20140713 新增福州(110200)分区
		return new Array('110200', '110201', '110202', '110203', '110204', '110205', '110206', '110207', '110208', '110209', '110210', '110211', '110212', '110213');
	case '120000':
		return new Array('120000', '120200', '120300', '120400', '120500', '120600', '120700', '120800', '120900', '121000', '121100', '121200', '121300', '121400', '121500', '121600', '121700', '121800');
	case '120200':
		// add by linsendu 20140713 新增济南(120200)分区
		return new Array('120200', '120201', '120202', '120203', '120204', '120205', '120206', '120207', '120208', '120209', '120210', '120211');
	case '120300':
		// add by peggy 20130508 新增青岛(120300)分区
		return new Array('120300', '120301', '120302', '120303', '120304', '120305', '120306', '120307', '120308', '120309', '120310');
	case '130000':
		return new Array('130000', '130200', '130300', '130400', '130500', '130600', '130700', '130800', '130900', '131000', '131100', '131200');
	case '140000':
		return new Array('140000', '140200', '140300', '140400', '140500', '140600', '140700', '140800', '140900', '141000', '141100', '141200', '141300', '141400', '141500');
	case '150000':
		return new Array('150000', '150200', '150300', '150400', '150500', '150600', '150700', '150800', '150900', '151000', '151100', '151200', '151400', '151500', '151600', '151700', '151800');
	// delete by linsendu 151300移至合肥分区内
	case '150200':
		// add by linsendu 20140713 新增合肥(150200)分区
		return new Array('150200', '150201', '150202', '150203', '150204', '150205', '150206', '150207', '150208', '150209', '150210', '150211');
	case '160000':
		// add by peggy 20130508 新增'161300'
		return new Array('160000', '160200', '160300', '160400', '160500', '160600', '160700', '160800', '160900', '161000', '161100', '161200', '161300');
	case '170000':
		// add by linsendu 20140713 新增邓州
		return new Array('170000', '170200', '170300', '170400', '170500', '170600', '170700', '170800', '170900', '171000', '171100', '171200', '171300', '171400', '171500', '171600', '171700', '171800', '171900', '172000');
	case '170200':
		// add by linsendu 20140713 新增郑州(170200)分区，新增邓州
		return new Array('170200', '170201', '170202', '170203', '170204', '170205', '170206', '170207', '170208', '170209', '170210', '170211', '170212');
	case '180000':
		return new Array('180000', '180200', '180300', '180400', '180500', '180600', '180700', '180800', '180900', '181000', '181100', '181200', '181300', '181400', '181500', '181600', '181700', '181800');
	case '180200':
		return new Array('180200', '180201', '180202', '180203', '180204', '180205', '180206', '180207', '180208', '180209', '180210', '180211', '180212', '180213');
	case '190000':
		return new Array('190000', '190200', '190300', '190400', '190500', '190600', '190700', '190800', '190900', '191000', '191100', '191200', '191300', '191400', '191500');
	case '190200':
		// add by linsendu 20140713 新增长沙(190200)分区
		return new Array('190200', '190201', '190202', '190203', '190204', '190205', '190206', '190207', '190208', '190209');
	case '200000':
		return new Array('200000', '200200', '200300', '200400', '200500', '200600', '200700', '200800', '200900', '201000', '201100', '201200');
	case '200200':
		// add by linsendu 20140713 西安(200200)增加分区
		return new Array('200200', '200201', '200202', '200203', '200204', '200205', '200206', '200207', '200208', '200209', '200210', '200211', '200212', '200213', '200214', '200215', '200216', '200217', '200218', '200219');
	case '210000':
		return new Array('210000', '210200', '210300', '210400', '210500', '210600', '210700', '210800', '210900', '211000', '211100', '211200');
	case '220000':
		return new Array('220000', '220200', '220300', '220400', '220500', '220600', '220700', '220800', '220900', '221000', '221100', '221200', '221300', '221400');
	case '220200':
		// add by linsendu 20140713 新增哈尔滨(220200)分区
		return new Array('220200', '220201', '220202', '220203', '220204', '220205', '220206', '220207', '220208', '220209', '220210', '220211', '220212', '220213', '220214', '220215', '220216', '220217', '220218');
	case '230000':
		return new Array('230000', '230200', '230300', '230400', '230500', '230600', '230700', '230800', '230900', '231000', '231100', '231200', '231300', '231400', '231500');
	case '230200':
		// add by peggy 20130508 新增沈阳(230200)分区
		return new Array('230200', '230201', '230202', '230203', '230204', '230205', '230206', '230207', '230208', '230209', '230210', '230211', '230212', '230213');
	case '230300':
		// add by peggy 20130508 新增大连(230300)分区
		return new Array('230300', '230301', '230302', '230303', '230304', '230305', '230306', '230307', '230308', '230309', '230310', '230311', '230312', '230313');
	case '240000':
		return new Array('240000', '240200', '240300', '240400', '240500', '240600', '240700', '240800', '240900', '241000', '241100');
	case '240200':
		// add by linsendu 20140713 新增长春(240200)分区
		return new Array('240200', '240201', '240202', '240203', '240204', '240205', '240206', '240207', '240208', '240209', '240210', '240211', '240212', '240213', '240214');
	case '250000':
		return new Array('250000', '250200', '250300', '250400', '250500', '250600', '251000', '251100', '251200', '251300', '251400', '251500', '251600', '251700', '251800', '251900', '252000');
	case '250200':
		// add by linsendu 20140713 新增昆明(250200)分区
		return new Array('250200', '250201', '250202', '250203', '250204', '250205', '250206', '250207', '250208', '250209', '250210', '250211', '250212', '250213', '250214');
	case '260000':
		return new Array('260000', '260200', '260300', '260400', '260500', '260600', '260700', '260800', '260900', '261000');
	case '270000':
		return new Array('270000', '270200', '270300', '270400', '270500', '270600', '270700', '270800', '270900', '271000', '271100', '271200', '271300', '271400', '271500');
	case '280000':
		return new Array('280000', '280200', '280300', '280400', '280700', '280800', '280900', '281000', '281100', '281200', '281300', '281400', '281500');
	case '290000':
		return new Array('290000', '290200', '290300', '290400', '290500', '290600');
	case '300000':
		return new Array('300000', '300200', '300300', '300400', '300500', '300600', '300700', '300800');
	case '310000':
		return new Array('310000', '310200', '310300', '310400', '310500', '310600', '310700', '310800', '310900', '311000', '311100', '311200', '311300', '311400', '311500', '311600', '311700', '311800', '311900');
	case '320000':
		return new Array('320000', '320200', '320300', '320400', '320500', '320600', '320700', '320800', '320900');
	case '330000':
		return new Array('330000');
	case '340000':
		return new Array('340000');
	case '350000':
		return new Array('350000');
	case '360000':
		return new Array('360000');
	default:
		return new Array();
	}
}