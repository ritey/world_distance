<?php
class WorldDistance {

	public $type = "km"; // or "miles"
	public $latitude1, $latitude2, $longitude1, $longitude2;

	// Convert the distance to miles
	function from_km_to_miles($value) {
		$mile = 0.621371192;
		$convertion = $value * $mile;

		return $this->format_the_measure(round($convertion,3));
	}

	// add "km" or "miles" at the end of the value and return the string
	function format_the_measure($value) {
		return $value." ".$this->type;
	}

	// calculate the distance in kilometers
	public function getDistance() {

		$latitude1 		= $this->latitude1;
		$longitude1 	= $this->longitude1;
		$latitude2 		= $this->latitude2;
		$longitude2 	= $this->longitude2;
		$type 			= $this->type;


		$earth_radius = 6371;
		
		$dLat = deg2rad($latitude2 - $latitude1);
		$dLon = deg2rad($longitude2 - $longitude1);
		
		$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
		$c = 2 * asin(sqrt($a));
		$d = $earth_radius * $c;
		
		$result = round($d, 1);

		// If the type is set to miles, the class will do the convertion automatically
		if($type == "miles") {
			return $this->from_km_to_miles($result);
		} else {
			return $this->format_the_measure($result);
		}
	}

}
?>