<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 * @author Ben Weller
 */
class Breadcrumbs
{

	/**
	 * breadcrumbs
	 * 
	 * (default value: array())
	 * 
	 * @var array
	 * @access private
	 * @static
	 */
	private static $breadcrumbs = array();
	
	/**
	 * clear function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function clear()
	{
		self::$breadcrumbs = array();
	}
	

	/**
	 * get function.
	 * 
	 * @access public
	 * @static
	 * @return array Breadcrumbs
	 */
	public static function get()
	{
		return self::$breadcrumbs;
	}
	
	/**
	 * add function.
	 * 
	 * @access public
	 * @static
	 * @param array array({title}, {url})
	 * @return boolean TRUE | exception Breadcrumb_Exception
	 */
	public static function add(array $array)
	{

        if(is_array($array) && count($array) == 2){
    		array_push(self::$breadcrumbs, Breadcrumb::factory()->set_title($array[0])->set_url($array[1]));
    		return TRUE;
        } else {
            throw new Breadcrumb_Exception("Input to Breadcrumbs:add must be an array of 2 elements (array(title, url))!");
        }
	}

	/**
	 * render function.
	 * 
	 * @access public
	 * @static
	 * @param string $template (default: "breadcrumbs/layout")
	 * @return void
	 */
	public static function render($template = "breadcrumbs/layout")
	{
	   $_config = array(
	       'sep' => Kohana::config('breadcrumbs.separator'),
   	       'min_depth' => Kohana::config('breadcrumbs.min_depth'),
   	       'last' => Kohana::config('breadcrumbs.after_last'),
	   );
		return View::factory($template)
		  ->set('breadcrumbs', self::$breadcrumbs)
		  ->set('conf', $_config )
		  ->render();
	}
}