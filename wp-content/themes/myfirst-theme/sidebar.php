<div class="widget-box">
    <?php if(!dynamic_sidebar('Sidebar Widgets')):?>
    <aside id="search-box" class="widget">
        <?php get_search_form(); ?>
    </aside>
    <aside id="archive" class="widget">
        <h3>글 보관함</h3>
        <ul>
            <?php wp_get_archives('type=monthly&limit=12'); ?>
        </ul>
    </aside>
    <?php endif; ?>
    <aside id="archive2" class="widget">
        <h3>글 보관함</h3>
        <ul>
			<?php wp_get_archives('type=yearly&limit=12'); ?>
        </ul>
    </aside>
</div><!--close widget-->