<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\helpers;

use yii\helpers\BaseArrayHelper;
use yii\helpers\BaseStringHelper;


/**
 * ArrayHelper provides additional array functionality that you can use in your
 * application.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class StringHelper extends BaseStringHelper
{
    /**
     * 校验日期格式是否正确
     *
     * @param string $date 日期
     * @param string $formats 需要检验的格式数组
     * @return boolean
     */
    static public function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d", "Y-n-j", "Y/n/j"))
    {
        $unixTime = strtotime($date);
        if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
            return false;
        }

        //校验日期的有效性，只要满足其中一个格式就OK
        foreach ($formats as $format) {
            if (date($format, $unixTime) == $date) {
                return true;
            }
        }
        return false;
    }

    // 计算中文字符串长度
    static public function utf8_strlen($string = null)
    {
        // 将字符串分解为单元
        preg_match_all("/./us", $string, $match);
        // 返回单元个数
        return count($match[0]);
    }

    /**
     * md5加密
     * @param $str
     * @return string
     */
    static public function MyMd5($str)
    {
        return strtolower(md5($str));
    }

    static public function tonow(&$v, $k)
    {
        if ($v === null) {
            $v = '';
        }
        if (gettype($v) == 'integer') {
            $v = (string)$v;
        }
        if ($k == 'working_time') {
            $v = static::DiffDate(date('Y-m-d H:i:s'), $v);
        }
    }

    static public function addgoodstype(&$v, $k, $data)
    {
        $v['goods_type'] = $data;
    }

    /* 用户视频浏览记录地址过滤
     * */
//	static public function videoUrl(&$v, $k){
//		if($v === null){
//			$v = '';
//		}
//		if(gettype($v) == 'integer'){
//			$v = (string)$v;
//		}
//		if($k == 'working_time'){
//			$v = static::DiffDate(date('Y-m-d H:i:s'),$v);
//		}
//	}

    static function DiffDate($date1, $date2)
    {
        if (empty($date2)) {
            return '';
        }
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $year = 365 * 24 * 3600;
        if ($time1 > $time2) {
            $plan_times = $time1 - $time2;
            $plan_years = (int)($plan_times / $year);
        } else {
            $plan_years = 0;
        }
        return $plan_years;
    }

    static public function videoTime(&$v, $k)
    {
        if ($v === null) {
            $v = '';
        }
        if (gettype($v) == 'integer') {
            $v = (string)$v;
        }
        if ($k == 'create_time') {
            $v = static::checktime(strtotime($v));
        }
    }


    static public function courseTime(&$v, $k)
    {
        if ($v === null) {
            $v = '';
        }
        if (gettype($v) == 'integer') {
            $v = (string)$v;
        }
        if ($k == 'create_time') {
            $v = static::checktime(strtotime($v));
        }
    }

    /*
     * 获取时间戳与现在的时间差
     * $created_time 时间戳
     * */
    static function checktime($created_time)
    {
        $date1_stamp = time();
        $date2_stamp = $created_time;
        list($date_1['Y'], $date_1['m'], $date_1['d']) = explode("-", date('Y-m-d', $date1_stamp));
        list($date_1['H'], $date_1['i'], $date_1['s']) = explode(":", date('H:i:s', $date1_stamp));

        list($date_2['Y'], $date_2['m'], $date_2['d']) = explode("-", date('Y-m-d', $date2_stamp));
        list($date_2['H'], $date_2['i'], $date_2['s']) = explode(":", date('H:i:s', $date2_stamp));
        $year = $date_1['Y'] - $date_2['Y'];
        $month = $date_1['m'] - $date_2['m'];
        $day = $date_1['d'] - $date_2['d'];
//        $hour = $date_1['H'] - $date_2['H'];
//        $minute = $date_1['i'] - $date_2['i'];
//        $second = $date_1['s'] - $date_2['s'];
        if ($year > 0) {
            return $year . '年前';
        }
        if ($month > 0) {
            return $month . '月前';
        }
        if ($day > 0) {
            return $day . '天前';
        }
        //时间根据时间差来
        $time = $date1_stamp - $date2_stamp;
        if ($time > 3600) {
            return (int)($time / 3600) . '小时前';
        }
        if ($time > 60) {
            return (int)($time / 60) . '分钟前';
        } else {
            return '刚刚';
        }
    }


    static public function foo(&$v, $k, $kname)
    {
        $v = array_combine($kname, array_slice($v, 0));
    }


    //0年前

    static public function explodeLocations($str)
    {
        $arr = explode('|', trim($str, '|'));
        array_walk($arr, function (&$val, $key) {
            $val = explode(',', $val);
        });
        return $arr;
    }


    static function gmt_iso8601($time)
    {
        $dtStr = date("c", $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration . "Z";
    }

    //去除字符串结尾的省,市,区,县字符
    public static function rtrimCityName($name)
    {
        return rtrim(rtrim(rtrim(rtrim($name, '省'), '市'), '区'), '县');
    }

    public static function age($birthday)
    {
        if (strtotime($birthday) > 0) {
            return (int)((time() - strtotime($birthday)) / (86400 * 365));
        } else {
            return '-';
        }
    }

    /**
     * 生成GUID（UUID）
     * @access public
     * @return string
     * @author knight
     */
    public static function createGuid()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
           // $hyphen = chr(45);// "-"
            $hyphen ='';
            $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);
            return $uuid;
        }
    }

    /*
     * 获取IP
     */
    public static function get_real_ip(){
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip); $ip = FALSE; }
                for ($i = 0; $i < count($ips); $i++) {
                    if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                        $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    /*
     * 计算某一日期是周几
     */
    public static function wk($date1) {
        $datearr = explode("-",$date1);     //将传来的时间使用“-”分割成数组
        $year = $datearr[0];       //获取年份
        $month = sprintf('%02d',$datearr[1]);  //获取月份
        $day = sprintf('%02d',$datearr[2]);      //获取日期
        $hour = $minute = $second = 0;   //默认时分秒均为0
        $dayofweek = mktime($hour,$minute,$second,$month,$day,$year);    //将时间转换成时间戳
        $shuchu = date("w",$dayofweek);      //获取星期值
        $weekarray=array("0","1","2","3","4","5","6");
        return $weekarray[$shuchu];
    }

}