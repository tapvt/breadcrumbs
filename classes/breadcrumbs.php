<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 * @author Ben Weller
 */
class Breadcrumbs {

    /**
     * which urls to exclude
     * @var type
     * @access private
     * @static
     */
    private static $exclude_urls_haystack = array();

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

        if (is_array($array) && count($array) == 2)
        {
            $exclude_urls = Kohana::$config->load('breadcrumbs.exclude_duplicate_urls');

            if ($exclude_urls && !in_array($array[1], self::$exclude_urls_haystack))
                array_push(self::$breadcrumbs, Breadcrumb::factory()->set_title($array[0])->set_url($array[1]));

            return TRUE;
        }
        else
        {
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
//        Debug::vars(__METHOD__, self::$breadcrumbs);

        $_config = array(
            'sep'       => Kohana::$config->load('breadcrumbs.separator'),
            'min_depth' => Kohana::$config->load('breadcrumbs.min_depth'),
            'last'      => Kohana::$config->load('breadcrumbs.after_last'),
        );

        return View::factory($template)
                        ->set('breadcrumbs', self::$breadcrumbs)
                        ->set('conf', $_config)
                        ->render();
    }

    /**
     * generate crumbs from request
     * @param Request $request
     * @return type
     */
    public static function generate_from_request(Request $request)
    {
        $exclude      = Kohana::$config->load('breadcrumbs.exclude');
        $exclude_urls = Kohana::$config->load('breadcrumbs.exclude_duplicate_urls');
        $exclude_num  = Kohana::$config->load('breadcrumbs.exclude_numeric');
        $segments     = explode('/', $request->uri());

        foreach ($segments as $key => $page)
        {
            $url = implode('/', array_slice($segments, 0, ($key + 1)));

            $pages[] = array(
                'title' => $page,
                'url'   => URL::site($url)
            );
        }

        self::$exclude_urls_haystack = array();

        foreach ($pages as $page)
        {
            if (in_array($page['title'], $exclude))
                continue;

            if ($exclude_num && is_numeric($page['title']))
                continue;

            if ($exclude_urls && in_array($page['url'], self::$exclude_urls_haystack))
                continue;

            Breadcrumbs::add(array($page['title'], $page['url']));

            if ($exclude_urls)
                self::$exclude_urls_haystack[] = $page['url'];
        }

        return self::render();
    }

}
