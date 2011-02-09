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
	 * @param Breadcrumb $crumb
	 * @return boolean TRUE | exception Breadcrumb_Exception
	 */
	public static function add(Breadcrumb $crumb)
	{
        if(is_a($crumb, 'Breadcrumb')){
    		array_push(self::$breadcrumbs, $crumb);
    		return TRUE;
        } else {
            throw new Breadcrumb_Exception("Not a breadcrumb object!");
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
		echo View::factory($template)
		  ->set('breadcrumbs', self::$breadcrumbs)
		  ->set('conf', $_config )
		  ->render();
	}
}