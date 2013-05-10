{$c = count($breadcrumbs)}

<ul id="breadcrumbs">
    {if ($c > ($conf['min_depth'] - 1))}

        {foreach $breadcrumbs as $crumb}

            {if ($crumb instanceof Breadcrumb)}
                {if ($crumb->get_url() !== NULL AND count($breadcrumbs > 1))}
                    <li>
                        <a href="{$crumb->get_url()}">
                            {__($crumb->get_title())}
                        </a>
                        {if $c != 1}
                            {if $conf['sep'] == TRUE}
                                {$conf['sep']}
                            {/if}
                        {/if}
                    </li>
                {else}
                    <li>{__($crumb->get_title())}</li>
                    {/if}
                {/if}

            {$c = $c - 1}
        {/foreach}

    {/if}
</ul>