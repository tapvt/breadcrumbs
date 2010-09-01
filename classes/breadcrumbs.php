<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 */
class Breadcrumbs
{
	/**
	 * Breadcrumbs
	 */
	private static $breadcrumbs = array();
	
	/**
	 * Clear
	 */
	public static function clear()
	{
		self::$breadcrumbs = array();
	}
	
	/**
	 * Get
	 *
	 * @return array Breadcrumbs
	 */
	public static function get()
	{
		return self::$breadcrumbs;
	}
	
	/**
	 * Add
	 */
	public static function add(Breadcrumb $crumb)
	{
		array_push(self::$breadcrumbs, $crumb);
	}
	
	/**
	 * Render
	 */
	public static function render($template = "breadcrumbs/layout")
	{
	   $_config = array(
	       'sep' => Kohana::config('breadcrumbs.separator'),
   	       'min_depth' => Kohana::config('breadcrumbs.min_depth'),
   	       'last' => Kohana::config('breadcrumbs.after_last'),
	   );
	   
		echo View::factory($template)
		  ->set('breadcrumbs', self::$breadcrumbs)
		  ->set('conf', $_config )
		  ->render();
	}
}