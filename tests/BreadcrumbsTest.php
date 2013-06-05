<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 */
class BreadcrumbsTest extends PHPUnit_Framework_TestCase {

    /**
     * @test
     * @group breadcrumbs
     */
    public function test_should_return_added_breadcrumbs()
    {
        $expected = array
            (
            Breadcrumb::factory()->set_title("Crumb 1")->set_url("http://example.com/"),
            Breadcrumb::factory()->set_title("Crumb 2")
        );

        Breadcrumbs::add(Breadcrumb::factory()->set_title("Crumb 1")->set_url("http://example.com/"));
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Crumb 2"));

        $actual = Breadcrumbs::get();
        $this->assertEquals($expected, $actual);
    }

    public function test_no_breadcrumbs_under_limit()
    {
        $expected = "<ul id=\"breadcrumbs\">
</ul>
";
        $i        = 0;
        $count    = Kohana::$config->load('breadcrumbs.min_depth');
        while ($i < $count - 1)
        {
            Breadcrumbs::add(array("Crumb " . $i, "http://example.com/"));
            $i++;
        }

        ob_start();
        Breadcrumbs::render();
        $actual = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @group breadcrumbs
     */
    public function test_should_validate_rendered_breadcrumbs()
    {
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Crumb 1")->set_url("http://example.com/"));
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Crumb 2"));

        $i = 0;

        $count = Kohana::$config->load('breadcrumbs.min_depth');
        $sep   = Kohana::$config->load('breadcrumbs.separator');

        $expected = "<ul id=\"breadcrumbs\">\n";
        if (count(Breadcrumbs::get()) >= $count)
        {
            $expected .= "\t<li><a href=\"http://example.com/\">Crumb 1</a> {$sep}</li>\n";
            $expected .= "\t<li>Crumb 2</li>\n";
        }
        $expected .= "</ul>\n";
        ob_end_clean();
        ob_start();
        Breadcrumbs::render();
        $actual = ob_get_contents();
        ob_end_clean();
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     * @group breadcrumbs
     * @expectedException Exception
     */
    public function test_should_not_allow_non_breadcrumb_objects_to_be_added()
    {
        Breadcrumbs::add("not a breadcrumb object");
    }

    /**
     * @test
     * @group breadcrumbs
     */
    public function test_should_allow_breadcrumb_objects_to_be_added()
    {
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Added Crumb")->set_url("http://example.com/"));
    }

    /**
     * @test
     * @group breadcrumbs
     */
    public function test_should_allow_breadcrumb_object_to_be_added()
    {
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Breadcrumb")->set_url("http://example.com/"));
    }

    /**
     * @test
     * @group breadcrumbs
     */
    public function test_should_clear_all_breadcrumbs()
    {
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Crumb 1")->set_url("http://example.com/"));
        Breadcrumbs::add(Breadcrumb::factory()->set_title("Crumb 2"));

        Breadcrumbs::clear();

        $this->assertSame(array(), Breadcrumbs::get());
    }

    /**
     * Tear Down after each test
     */
    public function tearDown()
    {
        Breadcrumbs::clear();
    }

}