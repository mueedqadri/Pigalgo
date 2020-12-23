<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('hoverex_storage_get')) {
	function hoverex_storage_get($var_name, $default='') {
		global $HOVEREX_STORAGE;
		return isset($HOVEREX_STORAGE[$var_name]) ? $HOVEREX_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('hoverex_storage_set')) {
	function hoverex_storage_set($var_name, $value) {
		global $HOVEREX_STORAGE;
		$HOVEREX_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('hoverex_storage_empty')) {
	function hoverex_storage_empty($var_name, $key='', $key2='') {
		global $HOVEREX_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($HOVEREX_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($HOVEREX_STORAGE[$var_name][$key]);
		else
			return empty($HOVEREX_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('hoverex_storage_isset')) {
	function hoverex_storage_isset($var_name, $key='', $key2='') {
		global $HOVEREX_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($HOVEREX_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($HOVEREX_STORAGE[$var_name][$key]);
		else
			return isset($HOVEREX_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('hoverex_storage_inc')) {
	function hoverex_storage_inc($var_name, $value=1) {
		global $HOVEREX_STORAGE;
		if (empty($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = 0;
		$HOVEREX_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('hoverex_storage_concat')) {
	function hoverex_storage_concat($var_name, $value) {
		global $HOVEREX_STORAGE;
		if (empty($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = '';
		$HOVEREX_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('hoverex_storage_get_array')) {
	function hoverex_storage_get_array($var_name, $key, $key2='', $default='') {
		global $HOVEREX_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($HOVEREX_STORAGE[$var_name][$key]) ? $HOVEREX_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($HOVEREX_STORAGE[$var_name][$key][$key2]) ? $HOVEREX_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('hoverex_storage_set_array')) {
	function hoverex_storage_set_array($var_name, $key, $value) {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if ($key==='')
			$HOVEREX_STORAGE[$var_name][] = $value;
		else
			$HOVEREX_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('hoverex_storage_set_array2')) {
	function hoverex_storage_set_array2($var_name, $key, $key2, $value) {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if (!isset($HOVEREX_STORAGE[$var_name][$key])) $HOVEREX_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$HOVEREX_STORAGE[$var_name][$key][] = $value;
		else
			$HOVEREX_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('hoverex_storage_merge_array')) {
	function hoverex_storage_merge_array($var_name, $key, $value) {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if ($key==='')
			$HOVEREX_STORAGE[$var_name] = array_merge($HOVEREX_STORAGE[$var_name], $value);
		else
			$HOVEREX_STORAGE[$var_name][$key] = array_merge($HOVEREX_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('hoverex_storage_set_array_after')) {
	function hoverex_storage_set_array_after($var_name, $after, $key, $value='') {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if (is_array($key))
			hoverex_array_insert_after($HOVEREX_STORAGE[$var_name], $after, $key);
		else
			hoverex_array_insert_after($HOVEREX_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('hoverex_storage_set_array_before')) {
	function hoverex_storage_set_array_before($var_name, $before, $key, $value='') {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if (is_array($key))
			hoverex_array_insert_before($HOVEREX_STORAGE[$var_name], $before, $key);
		else
			hoverex_array_insert_before($HOVEREX_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('hoverex_storage_push_array')) {
	function hoverex_storage_push_array($var_name, $key, $value) {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($HOVEREX_STORAGE[$var_name], $value);
		else {
			if (!isset($HOVEREX_STORAGE[$var_name][$key])) $HOVEREX_STORAGE[$var_name][$key] = array();
			array_push($HOVEREX_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('hoverex_storage_pop_array')) {
	function hoverex_storage_pop_array($var_name, $key='', $defa='') {
		global $HOVEREX_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($HOVEREX_STORAGE[$var_name]) && is_array($HOVEREX_STORAGE[$var_name]) && count($HOVEREX_STORAGE[$var_name]) > 0) 
				$rez = array_pop($HOVEREX_STORAGE[$var_name]);
		} else {
			if (isset($HOVEREX_STORAGE[$var_name][$key]) && is_array($HOVEREX_STORAGE[$var_name][$key]) && count($HOVEREX_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($HOVEREX_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('hoverex_storage_inc_array')) {
	function hoverex_storage_inc_array($var_name, $key, $value=1) {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if (empty($HOVEREX_STORAGE[$var_name][$key])) $HOVEREX_STORAGE[$var_name][$key] = 0;
		$HOVEREX_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('hoverex_storage_concat_array')) {
	function hoverex_storage_concat_array($var_name, $key, $value) {
		global $HOVEREX_STORAGE;
		if (!isset($HOVEREX_STORAGE[$var_name])) $HOVEREX_STORAGE[$var_name] = array();
		if (empty($HOVEREX_STORAGE[$var_name][$key])) $HOVEREX_STORAGE[$var_name][$key] = '';
		$HOVEREX_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('hoverex_storage_call_obj_method')) {
	function hoverex_storage_call_obj_method($var_name, $method, $param=null) {
		global $HOVEREX_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($HOVEREX_STORAGE[$var_name]) ? $HOVEREX_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($HOVEREX_STORAGE[$var_name]) ? $HOVEREX_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('hoverex_storage_get_obj_property')) {
	function hoverex_storage_get_obj_property($var_name, $prop, $default='') {
		global $HOVEREX_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($HOVEREX_STORAGE[$var_name]->$prop) ? $HOVEREX_STORAGE[$var_name]->$prop : $default;
	}
}
?>