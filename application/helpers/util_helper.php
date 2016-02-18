<?

namespace Util;

function strToURL($str) {
	$str = preg_replace('/\s+/', ' ', $str);
	$str = strtolower(str_replace(' ', '-', trim($str)));
	$str = preg_replace('/[^a-zA-Z0-9\-]/', '', $str);
	return $str;
}

function getStatesArr() {
	return array(
		'AL'=>"Alabama",
		'AK'=>"Alaska",
		'AZ'=>"Arizona",
		'AR'=>"Arkansas",
		'CA'=>"California",
		'CO'=>"Colorado",
		'CT'=>"Connecticut",
		'DE'=>"Delaware",
		'DC'=>"District Of Columbia",
		'FL'=>"Florida",
		'GA'=>"Georgia",
		'HI'=>"Hawaii",
		'ID'=>"Idaho",
		'IL'=>"Illinois",
		'IN'=>"Indiana",
		'IA'=>"Iowa",
		'KS'=>"Kansas",
		'KY'=>"Kentucky",
		'LA'=>"Louisiana",
		'ME'=>"Maine",
		'MD'=>"Maryland",
		'MA'=>"Massachusetts",
		'MI'=>"Michigan",
		'MN'=>"Minnesota",
		'MS'=>"Mississippi",
		'MO'=>"Missouri",
		'MT'=>"Montana",
		'NE'=>"Nebraska",
		'NV'=>"Nevada",
		'NH'=>"New Hampshire",
		'NJ'=>"New Jersey",
		'NM'=>"New Mexico",
		'NY'=>"New York",
		'NC'=>"North Carolina",
		'ND'=>"North Dakota",
		'OH'=>"Ohio",
		'OK'=>"Oklahoma",
		'OR'=>"Oregon",
		'PA'=>"Pennsylvania",
		'RI'=>"Rhode Island",
		'SC'=>"South Carolina",
		'SD'=>"South Dakota",
		'TN'=>"Tennessee",
		'TX'=>"Texas",
		'UT'=>"Utah",
		'VT'=>"Vermont",
		'VA'=>"Virginia",
		'WA'=>"Washington",
		'WV'=>"West Virginia",
		'WI'=>"Wisconsin",
		'WY'=>"Wyoming"
	);
}

function stateToShort($longState) {
	if (strlen($longState) == 2) {
		return $longState;
	}

	$statesArr = getStatesArr();
	return array_search(strtolower($longState), array_map('strtolower', $statesArr));
}

function stateToLong($shortState) {
	if (strlen($shortState) != 2) {
		return $shortState;
	}

	$statesArr = getStatesArr();
	return $statesArr[strtoupper($shortState)];
}

function onlyNumeric($str) {
	return preg_replace('/[^0-9]/', '', $str);
}

function formatPhoneNumber($phoneNumber) {
	$phoneNumber1 = preg_replace('/[^\d]/', '', trim($phoneNumber));
	if (strlen($phoneNumber1) == 10) {
		return preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $phoneNumber1);
	} else if (strlen($phoneNumber1) == 7) {
		return preg_replace("/^(\d{3})(\d{4})$/", "$1-$2", $phoneNumber1);
	} else {
		return $phoneNumber;
	}
}