<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 获取客户端IP地址
function get_client_ip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
       $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
       $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
       $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
       $ip = $_SERVER['REMOTE_ADDR'];
   else
       $ip = "0.0.0.0";
   return(ip2long($ip));
}

// 浏览器友好的变量输出
function dump($var, $echo=true,$label=null, $strict=true)
{
    $label = ($label===null) ? '' : rtrim($label) . ' ';
    if(!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>".$label.htmlspecialchars($output,ENT_QUOTES)."</pre>";
        } else {
            $output = $label . " : " . print_r($var, true);
        }
    }else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if(!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>'. $label. htmlspecialchars($output, ENT_QUOTES). '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}

/*
 * 将整数转换到指定的区间
 * $num:需转换的整数
 * $min:最小值
 * $max:最大值
*/
function toLimitLng($num, $min, $max=0){
	$num = (int)($num);
	$min = (int)($min);
	$max = (int)($max);

	if ($num < $min){
		return $min;
	}

	if ($max > 0 && $num > $max){
		return $max;
	}
	return $num;
}

//获取时间
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty($time)) {
		return '';
	}
	$format = str_replace('#', ':', $format);
	return date($format, $time);
}

//获取日期
function toDay($time, $format = 'Y-m-d') {
	if (empty($time)) {
		return '';
	}
	$format = str_replace('#', ':', $format);
	return date($format, $time);
}

//截取utf8字符串
function leftStr($str, $len){
	$str = strip_tags2($str);
	for($i=0; $i < $len; $i++)
	{
		$temp_str = substr($str, 0 ,1);
		if(ord($temp_str) > 127){
			$i++;
			if ($i < $len){
				$new_str[]	= substr($str, 0, 3);
				$str		= substr($str, 3);
			}
		}else{
			$new_str[]	= substr($str, 0, 1);
			$str		= substr($str, 1);
		}
	}
	return join($new_str);
}

function leftStr2($str, $len){
	$len1	= strlen($str);
	$str = strip_tags2($str);
	for($i=0; $i < $len; $i++){
		$temp_str = substr($str, 0 ,1);
		if(ord($temp_str) > 127){
			$i++;
			if ($i < $len){
				$new_str[]	= substr($str, 0, 3);
				$str		= substr($str, 3);
			}
		}else{
			$new_str[]	= substr($str, 0, 1);
			$str		= substr($str, 1);
		}
	}
	$new_str = join($new_str);
	if (strlen($new_str) < $len1){
		$new_str .= "…";
	}
	return $new_str;
}

function strip_tags2($str){
	$str	= strip_tags($str);
	$str	= str_replace("&ldquo;","“",$str);
	$str	= str_replace("&rdquo;","”",$str);
	$str	= str_replace("&nbsp;","",$str);
	$str	= str_replace("&quot;","\"",$str);
	return $str;
}

/**
 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function rand_string($len=6,$type='',$addChars='') {
    $str ='';
    switch($type){
        case 0:
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 1:
            $chars= str_repeat('0123456789',3);
            break;
        case 2:
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
            break;
        case 3:
            $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 4:
            $chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借".$addChars;
            break;
        default :
            // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
            $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
            break;
    }
    if($len>10 ) {//位数过长重复字符串一定次数
        $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
    }
    if($type!=4) {
        $chars   =   str_shuffle($chars);
        $str     =   substr($chars,0,$len);
    }else{
        // 中文随机字
        for($i=0;$i<$len;$i++){
          $str.= msubstr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1);
        }
    }
    return $str;
}


/*
 *	生成静态页面
 *	$sourcePage 源文件
 *	$newPage 生成的文件
*/
function createHtml($sourcePage, $newPage){
	if ($sourcePage == "" || $newPage == "") return false;

	//读取源文件中的内容
	//	file 把一个文件内容读取到数组里去
	if (!$content = file($sourcePage)){
		echo "Failed to open the url " . $sourcePage . " !";
		return false;
	}

	$content = implode("", $content);

	//创建文件
	if (!$fp = fopen($newPage, "w")){
		echo "Failed to create the file ". $newPage ." !";
		return false;
	}

	//写入数据
	if(fwrite($fp, $content)){
		fclose($fp);
		return true;
	}else{
		fclose($fp);
		return false;
	}
}

//获取状态
function getState($state, $id){
	if ($state == 1) {
		return '<img src="'. app_url() .'images/accept.gif" class="hand" onclick="setState(this, '. $id .')" />';
	} else {
		return '<img src="'. app_url() .'images/cancel.gif" class="hand" onclick="setState(this, '. $id .')" />';
	}
}

//显示状态
function showState($state) {
	switch ($state) {
		case 0 :
			$info = '<img src="'. app_url() .'images/cancel.gif" />';
			break;
		case 1 :
			$info = '<img src="'. app_url() .'images/accept.gif" />';
			break;
		default :
			$info = '';
	}
	return $info;
}
function showState2($state) {
	switch ($state) {
		case 0 :
			$info = '<img src="'. app_url() .'images/icon_off.gif" />';
			break;
		case 1 :
			$info = '<img src="'. app_url() .'images/icon_on.gif" />';
			break;
		default :
			$info = '';
	}
	return $info;
}

//Ajax操作返回
function ajaxReturn($data, $info='', $status=1){
	$result	= array('data'=>$data, 'status'=>$status, "info"=>$info);
	header("Content-Type:text/html; charset=utf-8");
	exit(json_encode($result));
}

//Ajax操作成功
function success($info){
	$result	= array('status'=>"1", "info"=>$info);
	header("Content-Type:text/html; charset=utf-8");
	exit(json_encode($result));
}

//Ajax操作失败
function error($info){
	$result	= array('status'=>"0", "info"=>$info);
	header("Content-Type:text/html; charset=utf-8");
	exit(json_encode($result));
}

/*
 * 判断ID是否合法
 * $id为待检查的id
 * $min_level为最小分类层次,默认为0 (0表示可以为空)
 * $max_level为最大分类层次,默认为5
*/
function isClassId($id, $min_level = 0, $max_level = 5){
	return preg_match("/^([1-9]\d{3}){" . $min_level . "," . $max_level . "}$/", $id);
}

/*
在左边用字符"0"填充以达到指定的总长度
*/
function PadLeft($str, $length){
	return str_pad($str, $length, "0", STR_PAD_LEFT);
}

/*
在右边用字符"0"填充以达到指定的总长度
*/
function PadRight($str, $length){
	return str_pad($str, $length, "0", STR_PAD_RIGHT);
}

//IP地理位置查询
function IP($ip = '', $file = 'UTFWry.dat') {
	$_ip = array ();
	if (isset ( $_ip [$ip] )) {
		return $_ip [$ip];
	} else {
		require_once("IpLocation.class.php");
		$iplocation = new IpLocation($file);
		$location = $iplocation->getlocation($ip);
		$_ip [$ip] = $location ['country'] . $location ['area'];
	}
	return $_ip[$ip];
}
function QQIP($ip) {
	return iconv('gb2312', 'UTF-8', IP(long2ip($ip), 'QQWry.Dat'));
}

//利用UNIX时间戳返回一个唯一的文件名，不含后缀
function getTmpName(){
	list($a, $b) = explode(' ', microtime());
	return (string)$b . (string)substr($a, 2);
}

// 得到指定文件的扩展名
function getFileExt($filename = ''){
	return substr($filename, strrpos($filename, '.') + 1);
}

// 得到不含路径的文件名
function getFileName($filename = ''){
	return substr($filename, strrpos($filename, '/') + 1);
}

//得到指定缩略图文件
function getThumbImg($filename){
	return substr($filename, 0, strrpos($filename, '.')) . "_s." . getFileExt($filename);
}

//判断是否为图片
function isImage($filename){
	$ext = getFileExt($filename);
	return ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" || $ext == "bmp");
}

//显示图片或Flash
function picShow($filename, $width=0, $height=0, $url='') {
	list($img_width, $img_height) = getimagesize($filename);

	if ($width == 0 && $height == 0){
		$width = $img_width;
		$height = $img_height;
	}elseif($width == 0){
		$width = $img_width * $height / $img_height;
	}elseif($height == 0){
		$height = $width * $img_height / $img_width;
	}

	$ext = getFileExt($filename);
	if ($ext == 'gif' || $ext == 'jpg' || $ext == 'png' || $ext == 'bmp'){
		if($url === ''){
			$picShow = '<img src="'. $filename .'" width="'. $width .'" height="'. $height .'" border="0" />';
		}else{
			$picShow = '<a href="'. $url .'" target="_blank"><img src="'. $filename .'" width="'. $width .'" height="'. $height .'" border="0" /></a>';
		}
	}elseif ($ext == 'swf'){
		if ($url === ''){
			$picShow = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="'. $width .'" height="'. $height .'"><param name="movie" value="'. $filename .'"><param name="quality" value="high"><param name="wmode" value="transparent"><embed src='. $filename .'" width="'. $width .'" height="'. $height .'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed></object>';
		}else{
			$picShow = '<div style="position:relative"><div style="z-index:99;position:absolute;top:0;left:0;"><a href="'. $url .'" target="_blank"><img src="/images/blank.gif" width="'. $width .'" height="'. $height .'" border="0" /></a></div><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="'. $width .'" height="'. $height .'"><param name="movie" value="'. $filename .'"><param name="quality" value="high"><param name="wmode" value="transparent"><embed src="'. $filename .'" width="'. $width .'" height="'. $height .'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed></object></div>';
		}
	}else{
		$picShow = "";
	}
	return $picShow;
}

/*
 * 功能：删除单个文件
 * 文件必须是绝对路径
*/
function deleteFile($file){
	if (empty($file)){
		return true;
	}
	$file = FCPATH . $file;
	if (file_exists($file)){
		return unlink($file);
	}else{
		return false;
	}
}

/*
 * 功能：删除多个文件
 * 文件必须是绝对路径
 * 多个文件间以逗号“,”隔开
*/
function deleteFiles($file){
	if (empty($file)){
		return true;
	}
	if (is_string($file)){
		$file = split(",", $file);
	}
	if (is_array($file)){
		foreach($file as $value){
			if ($value != "" && file_exists(FCPATH . $value)){
				unlink(FCPATH . $value);
			}
		}
		return true;
	}else{
		return false;
	}
}

//定义字符转换函数，解决mssql中文乱码问题
function convert2utf8($string)
    {
        return iconv("gbk","utf-8",$string);
    }
function convert2gbk($string)
    {
        return iconv("utf-8","gbk",$string);
    }

/* End of file common_helper.php */