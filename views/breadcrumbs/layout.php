<?php
defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 * @author Ben Weller
 */
?>
<? $c = count($breadcrumbs) ?>

<ul id="breadcrumbs">
    <? if ($c > ($conf['min_depth'] - 1)) : ?>

        <? foreach ($breadcrumbs as $crumb) : ?>

            <? if ($crumb->get_url() !== NULL AND count($breadcrumbs > 1)) : ?>
                <li><a href="<?= $crumb->get_url() ?>"><?= __($crumb->get_title()) ?></a> <?= ( $c != 1 ? $conf['sep'] : ($conf['last'] == TRUE ? $conf['sep'] : '' ) ) ?></li>
            <? else : ?>
                <li><?= __($crumb->get_title()) ?></li>
            <? endif; ?>

            <? $c-- ?>
        <? endforeach; ?>

    <? endif; ?>
</ul>
