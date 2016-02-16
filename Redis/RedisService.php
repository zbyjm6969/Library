<?php
if(!defined('ROOT_DIR')){
	die('ROOT_DIR');
}
require ROOT_DIR.'/predis/autoload.php';

class RedisService
{
	protected static $_instance = null;
	protected $redis_handle = null;

	public function setValue($data){
		if(empty($data) || !is_array($data)){
			return false;
		}
		/*if(!$this->checkMultipleArray($data)){
			$data = array($data);
		}*/
		$this->redis_handle->mset($data);
//		foreach($data as $key => $value){
//		}
		$this->redis_handle->hmset('car',array('color'=>1, 'model'=>2));
		return true;
	}


	public function getValueByKey($key){
		$value = $this->redis_handle->get($key);
		return $value;
	}

	public function setHashMap($key, $field, $value){

	}


	/**
	 * If $array is multiple array ,return true.
	 * @param $array
	 *
	 * @return bool
	 */
	public function checkMultipleArray($array){
		$boolean = true;
		if(count($array) == count($array, COUNT_RECURSIVE)){
			$boolean = false;
		}
		return $boolean;
	}

	function __construct(){
		if($this->redis_handle !== null){
			throw new Exception('new!!!');
		}
		$single_server = array(
			'host'     => '127.0.0.1',
			'port'     => 6379,
			'password' => '',
			'database' => 0
		);

		if($this->redis_handle === null){
			$this->redis_handle = new Predis\Client($single_server);
		}
	}

	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new RedisService();
		}
		return self::$_instance;
	}


}