<?php
defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 * @author Ben Weller
 */
?>
<?php $c = count($breadcrumbs) ?>

<ul id="breadcrumbs">
    <?php if ($c > ($conf['min_depth'] - 1)) : ?>

        <?php foreach ($breadcrumbs as $crumb) : ?>

            <?php if ($crumb->get_url() !== NULL AND count($breadcrumbs > 1)) : ?>
                <li><a href="<?= $crumb->get_url() ?>"><?= __($crumb->get_title()) ?></a> <?= ( $c != 1 ? $conf['sep'] : ($conf['last'] == TRUE ? $conf['sep'] : '' ) ) ?></li>
            <?php else : ?>
                <li><?= __($crumb->get_title()) ?></li>
            <?php endif; ?>

            <?php $c-- ?>
        <?php endforeach; ?>

    <?php endif; ?>
</ul>
