<?php


/**
 * This function formats the currency as per the currency format in account settings
 *
 * $input format is xxxxxxx.xx
 */
function curreny_format($input) {
	switch (Configure::read('Account.currency_format')) {
		case 'none':
			return $input;
		case '##,###.##':
			return _currency_2_3_style($input);
			break;
		case '##,##.##':
			return _currency_2_2_style($input);
			break;
		case "###,###.##":
			return _currency_3_3_style($input);
			break;
		default:
			die("Invalid curreny format selected.");
	}
}

/*********************** ##,###.## FORMAT ***********************/
function _currency_2_3_style($num)
{
	$decimal_places = Configure::read('Account.decimal_places');

	$pos = strpos((string)$num, ".");
	if ($pos === false) {
		if ($decimal_places == 2) {
			$decimalpart = "00";
		} else {
			$decimalpart = "000";
		}
	} else {
		$decimalpart = substr($num, $pos + 1, $decimal_places);
		$num = substr($num, 0, $pos);
	}

	if (strlen($num) > 3) {
		$last3digits = substr($num, -3);
		$numexceptlastdigits = substr($num, 0, -3 );
		$formatted = _currency_2_3_style_makecomma($numexceptlastdigits);
		$stringtoreturn = $formatted . "," . $last3digits . "." . $decimalpart ;
	} elseif (strlen($num) <= 3) {
		$stringtoreturn = $num . "." . $decimalpart;
	}

	if (substr($stringtoreturn, 0, 2) == "-,") {
		$stringtoreturn = "-" . substr($stringtoreturn, 2);
	}
	return $stringtoreturn;
}

function _currency_2_3_style_makecomma($input)
{
	if (strlen($input) <= 2) {
		return $input;
	}
	$length = substr($input, 0, strlen($input) - 2);
	$formatted_input = _currency_2_3_style_makecomma($length) . "," . substr($input, -2);
	return $formatted_input;
}

/*********************** ##,##.## FORMAT ***********************/
function _currency_2_2_style($num)
{
	$decimal_places = Configure::read('Account.decimal_places');

	$pos = strpos((string)$num, ".");
	if ($pos === false) {
		if ($decimal_places == 2) {
			$decimalpart = "00";
		} else {
			$decimalpart = "000";
		}
	} else {
		$decimalpart = substr($num, $pos + 1, $decimal_places);
		$num = substr($num, 0, $pos);
	}

	if (strlen($num) > 2) {
		$last2digits = substr($num, -2);
		$numexceptlastdigits = substr($num, 0, -2);
		$formatted = _currency_2_2_style_makecomma($numexceptlastdigits);
		$stringtoreturn = $formatted . "," . $last2digits . "." . $decimalpart;
	} elseif (strlen($num) <= 2) {
		$stringtoreturn = $num . "." . $decimalpart ;
	}

	if (substr($stringtoreturn, 0, 2) == "-,") {
		$stringtoreturn = "-" . substr($stringtoreturn, 2);
	}
	return $stringtoreturn;
}

function _currency_2_2_style_makecomma($input)
{
	if (strlen($input) <= 2) {
		return $input;
	}
	$length = substr($input, 0, strlen($input) - 2);
	$formatted_input = _currency_2_2_style_makecomma($length) . "," . substr($input, -2);
	return $formatted_input;
}

/*********************** ###,###.## FORMAT ***********************/
function _currency_3_3_style($num)
{
	$decimal_places = Configure::read('Account.decimal_places');
	return number_format($num,$decimal_places,'.',',');
}