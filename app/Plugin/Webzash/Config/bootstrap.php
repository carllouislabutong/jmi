<?php

/* Application name and url */
Configure::write('Webzash.AppName',"JMI");
Configure::write('Webzash.AppVersion', "3.0");
Configure::write('Webzash.AppDatabaseVersion', "6");
Configure::write('Webzash.AppURL', "https://jmiaccounting.online/");
// jan sya binabago
/* Include curreny functions */
require_once('currency.php');

/**
 * Perform a decimal level calculations on two numbers
 *
 * Multiply the float by 100, convert it to integer,
 * Perform the integer operation and then divide the result
 * by 100 and return the result
 *
 * @param1 float number 1
 * @param2 float number 2
 * @op string operation to be performed
 * @return float result of the operation
*/

function calculate($param1 = 0, $param2 = 0, $op = '') {

	$decimal_places = Configure::read('Account.decimal_places');

	if (extension_loaded('bcmath')) {
		switch ($op)
		{
			case '+':
				return bcadd($param1, $param2, $decimal_places);
				break;
			case '-':
				return bcsub($param1, $param2, $decimal_places);
				break;
			case '==':
				if (bccomp($param1, $param2, $decimal_places) == 0) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '!=':
				if (bccomp($param1, $param2, $decimal_places) == 0) {
					return FALSE;
				} else {
					return TRUE;
				}
				break;
			case '<':
				if (bccomp($param1, $param2, $decimal_places) == -1) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '>':
				if (bccomp($param1, $param2, $decimal_places) == 1) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '>=':
				$temp = bccomp($param1, $param2, $decimal_places);
				if ($temp == 1 || $temp == 0) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case 'n':
				return bcmul($param1, -1, $decimal_places);
				break;
			default:
				die();
				break;
		}
	} else {
		$result = 0;

		if ($decimal_places == 2) {
			$param1 = $param1 * 100;
			$param2 = $param2 * 100;
		} else if ($decimal_places == 3) {
			$param1 = $param1 * 1000;
			$param2 = $param2 * 1000;
		}

		$param1 = (int)round($param1, 0);
		$param2 = (int)round($param2, 0);
		switch ($op)
		{
			case '+':
				$result = $param1 + $param2;
				break;
			case '-':
				$result = $param1 - $param2;
				break;
			case '==':
				if ($param1 == $param2) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '!=':
				if ($param1 != $param2) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '<':
				if ($param1 < $param2) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '>':
				if ($param1 > $param2) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case '>=':
				if ($param1 >= $param2) {
					return TRUE;
				} else {
					return FALSE;
				}
				break;
			case 'n':
				$result = -$param1;
				break;
			default:
				die();
				break;
		}

		if ($decimal_places == 2) {
			$result = $result/100;
		} else if ($decimal_places == 3) {
			$result = $result/100;
		}

		return $result;
	}
}

/**
 * Perform a calculate with Debit and Credit Values
 *
 * @param1 float number 1
 * @param2 char nuber 1 debit or credit
 * @param3 float number 2
 * @param4 float number 2 debit or credit
 * @return array() result of the operation
*/
function calculate_withdc($param1, $param1_dc, $param2, $param2_dc) {
	$result = 0;
	$result_dc = 'D';

	if ($param1_dc == 'D' && $param2_dc == 'D') {
		$result = calculate($param1, $param2, '+');
		$result_dc = 'D';
	} else if ($param1_dc == 'C' && $param2_dc == 'C') {
		$result = calculate($param1, $param2, '+');
		$result_dc = 'C';
	} else {
		if (calculate($param1, $param2, '>')) {
			$result = calculate($param1, $param2, '-');
			$result_dc = $param1_dc;
		} else {
			$result = calculate($param2, $param1, '-');
			$result_dc = $param2_dc;
		}
	}

	return array('amount' => $result, 'dc' => $result_dc);
}


/**
 * This function converts the date and time string to valid SQL datetime value
 */
function dateToSql($indate) {
	$unixTimestamp = strtotime($indate . ' 00:00:00');
	if (!$unixTimestamp) {
		return false;
	}
	return date("Y-m-d", $unixTimestamp);
}

/**
 * This function converts the SQL datetime value to PHP date and time string
 */
function dateFromSql($sqldate) {
	$unixTimestamp = strtotime($sqldate . ' 00:00:00');
	if (!$unixTimestamp) {
		return false;
	}
	return date(Configure::read('Account.dateformatPHP'), $unixTimestamp);
}

/**
 * This function converts the SQL datetime value to PHP date and time string
 */
function datetimeFromSqlDateTime($sqldatetime) {
	$unixTimestamp = strtotime($sqldatetime);
	if (!$unixTimestamp) {
		return false;
	}
	return date(Configure::read('Account.dateformatPHP') . ' h:i:s A', $unixTimestamp);
}

function toCurrency($dc, $amount) {

	$decimal_places = Configure::read('Account.decimal_places');

	if (calculate($amount, 0, '==')) {
		return curreny_format(number_format(0, $decimal_places, '.', ''));
	}

	if ($dc == 'D') {
		if (calculate($amount, 0, '>')) {
			return 'Dr ' . curreny_format(number_format($amount, $decimal_places, '.', ''));
		} else {
			return 'Cr ' . curreny_format(number_format(calculate($amount, 0, 'n'), $decimal_places, '.', ''));
		}
	} else if ($dc == 'C') {
		if (calculate($amount, 0, '>')) {
			return 'Cr ' . curreny_format(number_format($amount, $decimal_places, '.', ''));
		} else {
			return 'Dr ' . curreny_format(number_format(calculate($amount, 0, 'n'), $decimal_places, '.', ''));
		}
	} else if ($dc == 'X') {
		/* Dr for positive and Cr for negative value */
		if (calculate($amount, 0, '>')) {
			return 'Dr ' . curreny_format(number_format($amount, $decimal_places, '.', ''));
		} else {
			return 'Cr ' . curreny_format(number_format(calculate($amount, 0, 'n'), $decimal_places, '.', ''));
		}
	} else {
		return curreny_format(number_format($amount, $decimal_places, '.', ''));
	}
	return __d('webzash', 'ERROR');
}

/**
 * This function counts the number of decimal places in a given amount
 */
function countDecimal($amount) {
	return strlen(substr(strrchr($amount, "."), 1));
}

/**
 * This function formats the the entry number as per prefix, suffix and zero
 * padding for that entry type
 */
function toEntryNumber($number, $entrytype_id) {
	if (Configure::read('Account.ET.' . $entrytype_id . '.zero_padding') > 0) {
		return Configure::read('Account.ET.' . $entrytype_id . '.prefix') .
			str_pad($number, Configure::read('Account.ET.' . $entrytype_id . '.zero_padding'), '0', STR_PAD_LEFT) .
			Configure::read('Account.ET.' . $entrytype_id . '.suffix');
	} else {
		return Configure::read('Account.ET.' . $entrytype_id . '.prefix') .
			$number .
			Configure::read('Account.ET.' . $entrytype_id . '.suffix');
	}
}

/**
 * This function returns the ledger or group name with code if present
 */
function toCodeWithName($code, $name) {
	if (strlen($code) <= 0) {
		return $name;
	} else {
		return '[' . $code . '] ' . $name;
	}
}
