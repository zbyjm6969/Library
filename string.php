<meta charset="utf-8">

<?php

class String
{
	protected $_encoding_sorting=array('UTF-8','ASCII','EUC-CN','CP936','BIG-5','GB2312','GBK');
	
	protected $_utf8='UTF-8';

	public function getStrEncoding($str)
	{
		if(empty($str)) return false;

		return  mb_detect_encoding($str,$this->_encoding_sorting);
	}

	public function subString($str,$start=0,$end=0,$dot=false,$out_encoding='UTF-8')
	{
		if(empty($str)) return '';
		$str=$this->changeEncoding($str);
		$str=mb_substr($str,$start,$end,$this->_utf8);
		if($dot)
		{
			$str=$str.'...';
		}
		if($out_encoding!=$this->_utf8)
		{
			$str=$this->changeEncoding($str,$out_encoding);
		}
		return $str;
	}

	public function changeEncoding($str,$encoding='UTF-8')
	{
		if(empty($str)) return '';
		if($this->getStrEncoding($str)!=$encoding)
		{
			$str=mb_convert_encoding($str,$encoding,$this->_encoding_sorting);
		}
		return $str;
	}
}

$string = new String();
$file_context = file_get_contents('1.txt');
// echo $file_context;
$charset = $string->getStrEncoding($file_context);
var_dump($charset);
echo $string->changeEncoding($file_context);

