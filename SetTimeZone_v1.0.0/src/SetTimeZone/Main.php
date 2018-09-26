<?php

namespace SetTimeZone;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {


	public function onEnable() {

		$lang = $this->getServer()->getLanguage()->getLang();
		$this->setTimeZone($lang);
	}

	public function setTimeZone($lang) {

		switch($lang) {

			case "afr":
				$time_zone = 'Africa/Cairo';	//africa egypt
				break;

			case "ara":
				$time_zone = 'Asia/Riyadh';
				break;

			case "bul":
				$time_zone = 'Europe/Sofia';
				break;

			case "ces":
				$time_zone = 'Europe/Prague';
				break;

			case "chs":
				$time_zone = 'Asia/Shanghai';
				break;

			case "deu":
				$time_zone = 'Europe/Berlin';
				break;

			case "ell":
				$time_zone = '';
				break;

			case "eng":
				$time_zone = '';
				break;

			case "est":
				$time_zone = '';
				break;

			case "fin":
				$time_zone = '';
				break;

			case "fra":
				$time_zone = '';
				break;

			case "gle":
				$time_zone = '';
				break;

			case "heb":
				$time_zone = '';
				break;

			case "hrv":
				$time_zone = '';
				break;

			case "hun":
				$time_zone = '';
				break;

			case "ind":
				$time_zone = '';
				break;

			case "ita":
				$time_zone = '';
				break;

			case "jpn":
				$time_zone = 'Asia/Tokyo';
				break;

			case "kor":
				$time_zone = 'Asia/Seoul';
				break;

			case "lav":
				$time_zone = '';
				break;

			case "mlt":
				$time_zone = '';
				break;

			case "msa":
				$time_zone = '';
				break;

			case "nld":
				$time_zone = '';
				break;

			case "nor":
				$time_zone = '';
				break;

			case "pol":
				$time_zone = '';
				break;

			case "por":
				$time_zone = '';
				break;

			case "rus":
				$time_zone = '';
				break;

			case "spa":
				$time_zone = '';
				break;

			case "swe":
				$time_zone = '';
				break;

			case "tgl":
				$time_zone = '';
				break;

			case "tha":
				$time_zone = '';
				break;

			case "tlh":
				$time_zone = '';
				break;

			case "tur":
				$time_zone = '';
				break;

			case "ukr":
				$time_zone = '';
				break;

			case "vie":
				$time_zone = '';
				break;

			case "zho":
				$time_zone = '';
				break;


		}

		date_default_timezone_set($time_zone);

	}

}
