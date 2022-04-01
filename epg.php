<?php
header("Content-Type:application/json;chartset=uft-8");
include_once "curl.class.php";
include_once "caches.class.php";
$cname = !empty($_GET["ch"]) ? $_GET["ch"] : exit(json_encode(["code" => 500, "msg" => "EPG频道参数不能为空!", "name" => $name, "date" => null, "data" => null], JSON_UNESCAPED_UNICODE));

//转换频道名称，C=CNTV，B=百度电视猫，5=51zmt，S=搜视网，Q=恰恰电视
$cgname = array(
"CCTV-1"=>"C@cctv1",
"CCTV-2"=>"C@cctv2",
"CCTV-3"=>"C@cctv3",
"CCTV-4"=>"C@cctv4",
"CCTV-5"=>"C@cctv5",
"CCTV-5⁺"=>"C@cctv5plus",
"CCTV-6"=>"C@cctv6",
"CCTV-7"=>"C@cctv7",
"CCTV-8"=>"C@cctv8",
"CCTV-9"=>"C@cctvjilu",
"CCTV-10"=>"C@cctv10",
"CCTV-11"=>"C@cctv11",
"CCTV-12"=>"C@cctv12",
"CCTV-13"=>"C@cctv13",
"CCTV-14"=>"C@cctvchild",
"CCTV-15"=>"C@cctv15",
"CCTV-16"=>"C@cctv16",
"CCTV-17"=>"C@cctv17",
"CCTV-4K"=>"C@cctv4k",
"CCTV-4欧洲"=>"C@cctveurope",
"CCTV-4美洲"=>"C@cctvamerica",
"电视指南"=>"C@zhinan",
"第一剧场"=>"C@diyijuchang",
"世界地理"=>"C@shijiedili",
"风云音乐"=>"C@fyyy",
"怀旧剧场"=>"C@hjjc",
"央视台球"=>"C@taiqiu",
"央视文化精品"=>"C@jingpin",
"女性时尚"=>"C@shishang",
""=>"",
"CETV-1"=>"B@教育1台",
""=>"",
"广东珠江"=>"B@广东珠江频道",
"广东新闻"=>"B@广东新闻频道",
"广东公共"=>"B@广东公共频道",
"广东体育"=>"B@广东体育频道",
"经济科教"=>"B@广东经济科教",
"广东影视"=>"B@广东影视频道",
"广东综艺4K"=>"B@广东综艺频道",
"广东国际"=>"B@广东国际频道",
"广东少儿"=>"B@广东少儿频道",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
"广州综合"=>"B@广州台",
"广州新闻"=>"B@广州新闻频道",
"广州法治"=>"B@广州法治频道",
""=>"",
""=>"",
""=>"",
""=>"",
"潮州综合"=>"Q@445100#WLxO",
"潮州公共"=>"Q@445100#QOxo",
"汕头综合"=>"Q@440500#WRDX",
"汕头经济生活"=>"Q@440500#Qo7m",
"汕头文旅体育"=>"Q@440500#k2E2",
"揭阳综合"=>"B@揭阳综合频道",
""=>"",
""=>"",
"纪实人文"=>"B@纪实人文频道",
"冬奥纪实"=>"B@BTV冬奥纪实",
"金鹰纪实"=>"B@金鹰纪实频道",
"无线新闻台"=>"5@无线新闻",
"无线财经·资讯台"=>"5@无线财经",
"国家地理"=>"5@国家地理频道",
"国学频道"=>"B@国学",
"欢笑剧场4K"=>"B@欢笑剧场",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
"凤凰电影"=>"S@4962322d",
"探索频道"=>"S@24f9d77c",
"星空卫视"=>"S@38638158",
"CGTN Doc"=>"S@2983827a",
"CGTN西班牙语"=>"S@5ce23afa",
"CGTN法语"=>"S@15e474b2",
"CGTN阿拉伯语"=>"S@d5a27a1e",
"CGTN俄语"=>"S@1e741cb1",
"动物星球"=>"5@动物星球",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
""=>"",
);



$id = !empty($cgname[$cname])?$cgname[$cname]:$cname;

//echo $id;
$date = $_GET['date'];
$cachedir = "./cache/" . $date;
if (!is_dir($cachedir)) {
    @mkdir($cachedir, 0755, true) or die ('创建文件夹失败');
}
$out = out_epg($id, $date);
if(!empty($out) && !strpos($out,"暂未提供节目表") && !strpos($out,"错误")){
	echo $out;
}else{
	echo '{"channel_name":"空节目表，可用以回看定位","date":"","epg_data":[{"title":"精彩节目","start":"00:00","end":"01:00"},{"title":"精彩节目","start":"01:00","end":"02:00"},{"title":"精彩节目","start":"02:00","end":"03:00"},{"title":"精彩节目","start":"03:00","end":"04:00"},{"title":"精彩节目","start":"04:00","end":"05:00"},{"title":"精彩节目","start":"05:00","end":"06:00"},{"title":"精彩节目","start":"06:00","end":"07:00"},{"title":"精彩节目","start":"07:00","end":"08:00"},{"title":"精彩节目","start":"08:00","end":"09:00"},{"title":"精彩节目","start":"09:00","end":"10:00"},{"title":"精彩节目","start":"10:00","end":"11:00"},{"title":"精彩节目","start":"11:00","end":"12:00"},{"title":"精彩节目","start":"12:00","end":"13:00"},{"title":"精彩节目","start":"13:00","end":"14:00"},{"title":"精彩节目","start":"14:00","end":"15:00"},{"title":"精彩节目","start":"15:00","end":"16:00"},{"title":"精彩节目","start":"16:00","end":"17:00"},{"title":"精彩节目","start":"17:00","end":"18:00"},{"title":"精彩节目","start":"18:00","end":"19:00"},{"title":"精彩节目","start":"19:00","end":"20:00"},{"title":"精彩节目","start":"20:00","end":"21:00"},{"title":"精彩节目","start":"21:00","end":"22:00"},{"title":"精彩节目","start":"22:00","end":"23:00"},{"title":"精彩节目","start":"23:00","end":"00:00"}]}';
}
exit;
//输出EPG节目地址
function out_epg($id, $date)
{
    $tvid = $id;
    $epgid = $id;
    $cache_path = "./cache/" . date('Y-m-d', strtotime("-7 day")) . "/";
    // 删除除当前目录缓存文件
    delDirAndFile($cache_path, true);
    $ejson = cache($tvid, $date, "get_epg_data", [$tvid, $epgid, $id, $date]);
    return $ejson;
}

//缓存EPG节目数据
function cache($key, $date, $f_name, $ff = [])
{
    //var_dump($key);
    Cache::$cache_path = "./cache/" . $date . "/";
	$cfile = Cache::$cache_path.md5($key);
	
	//处理已存在的缓存文件
	if(file_exists($cfile))
	{
		//已存在较小的缓存可能为错误信息，对该缓存执行删除操作
		if(filesize($cfile)<400)
		{
			unlink($cfile);
		}elseif($date==date("Y-m-d",time()) && filemtime("$cfile")<strtotime(date("Y-m-d"),time()))	//刷新今日节目表，即删除非今日获取的今日节目表缓存，
		{
			unlink($cfile);
		}
	}
    $val = Cache::gets($key);
    if (!$val) {
        $data = call_user_func_array($f_name, $ff);
        Cache::put($key, $data);
        return $data;
    } else {
        return $val;
    }
}

//请求频道的EPG数据
function get_epg_data($tvid, $epgid, $name = "", $date = "")
{
    if ($epgid == '') {
        return false;
    }
	
	preg_match('/([\s\S]*)(?=@)/', $tvid, $sourceid);
	preg_match('/(?<=@)([\s\S]*)/', $tvid, $tvida);

	
	switch ($sourceid[0]){
		case C://cctv.com	
			return cntv_epg($tvida[0], $date);
			break;
	
		case B://百度到电视猫
			return BDtvmao_epg($tvida[0], $date);
			break;

		case 5://51zmt
			$zmturl = "http://epg.51zmt.top:8000/api/diyp/?ch=".$tvida[0]."&date=".$date;
			return file_get_contents($zmturl);
			break;
	
		case S://搜视网
			return tvsou_epg($tvida[0],$date);
			break;
			
		case Q://恰恰电视
			$tvid = str_replace("#","/",$tvida[0]);
			return tvcha_epg($tvid,$date);
			break;
		
		default:
			$zmturl = "http://epg.51zmt.top:8000/api/diyp/?ch=".$tvid."&date=".$date;
			return !empty(BDtvmao_epg($tvid, $date))?BDtvmao_epg($tvid, $date):file_get_contents($zmturl);

	}
	
}



//cntv源码


//百度电视猫源码


//搜视网源码


//恰恰电视源码



/**
 * 删除目录及目录下所有文件或删除指定文件
 * @param str $path 待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
 * @return bool 返回删除状态
 */
function delDirAndFile($path, $delDir = 1)
{
    if (!is_dir($path)) {
        return FALSE;
    }
    $handle = opendir($path);
    if ($handle) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    } else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}

　

?>
