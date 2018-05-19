<?php

namespace KillTarget;

class KillTargetAPI {

public static $config, $EconomyAPI;

	public function __construct($config, $EconomyAPI){

		self::$config = $config;
		self::$EconomyAPI = $EconomyAPI;

	}

/*----------------------------------------------------------------------*/

	public static function getTarget() {

		$target = self::$config->get("ターゲット");
		return $target;
	}


	public static function setTarget($name) {

		self::$config->set("ターゲット", $name);
		self::$config->save();//設定を保存
	}

/*----------------------------------------------------------------------*/

	public static function getPrize() {

		$prize = self::$config->get("ターゲットの賞金");
		return $prize;
	}


	public static function setPrize($value) {

		self::$config->set("ターゲットの賞金", $value);
		self::$config->save();//設定を保存
	}

/*----------------------------------------------------------------------*/

	public static function getMoney() {

		$money = self::$config->get("お金");
		return $money;
	}


	public static function setMoney($value) {

		self::$config->set("お金", $value);
		self::$config->save();//設定を保存
	}

/*----------------------------------------------------------------------*/

	public static function giveMoney($name, $money){

		self::$EconomyAPI->addMoney($name, $money);

	}


}
