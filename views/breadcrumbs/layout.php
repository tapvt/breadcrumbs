<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 */
?>
<? $c = count($breadcrumbs) ?>

<ul id="breadcrumbs">
<? if ($c > 1) : ?>
<? foreach ($breadcrumbs as $crumb) : ?>
<? if ($crumb->get_url() !== NULL && $c > 1) :  ?>
	<li><a href="<?=$crumb->get_url()?>"><?=$crumb->get_title()?></a> <?= ( $c != 1 ? '>' : '' ) ?></li>
<? else : ?>
	<li><?=$crumb->get_title()?></li>
<? endif; ?>
<? $c-- ?>
<? endforeach; ?>
<? endif; ?>
</ul>
