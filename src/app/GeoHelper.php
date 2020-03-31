<?php

namespace App;

use Illuminate\Support\Facades\Redis;


class GeoHelper
{
	public $zipMap = NULL;
	public function __construct() {
		//echo ":D";
		$this->loadZipMap();

	}

	//load zip map into cache
	private function loadZipMap() {
		$zipMap = Redis::get('zip-data');

		if ($zipMap == NULL) {
			$zipMap = file_get_contents('./us-zip-code-latitude-and-longitude.json');
			Redis::set('zip-data', $zipMap);
		}
		$this->zipMap = json_decode($zipMap);
	}

	/**
		Look for zip code of a given query, if found store it in redis 
	*/
	public function findZip($query) {

		$location = json_decode(Redis::get('search:'.$query));

		if ($location != NULL) {
			return $location;
		}

		//attempt a city and state search
		$query = strtolower($query);

		//lets separate search terms like "city,  state zip"
		$searchTerms = preg_split('/[\ \n\,\|\+\-\_\:\;]+/', $query);

		//search city, state, zip
		$matchFound = FALSE;
		$match = NULL;
		foreach ($searchTerms as $q) {
			foreach ($this->zipMap as $l) {
				if ($q == strtolower($l->fields->city))
				{
					$matchFound = TRUE;
					$match = $l->fields;
					break;
				}

				if ($q == $l->fields->zip)
				{
					$matchFound = TRUE;
					$match = $l->fields;
					break;
				}

				if ($q == strtolower($l->fields->state))
				{
					$matchFound = TRUE;
					$match = $l->fields;
					break;
				}
			}
			if ($matchFound)
				break;
		}

		if ( ! is_null($match)) {
			Redis::set(sprintf("search:%s", $query), json_encode($match));
		}
		
		return $match;
	}
}
