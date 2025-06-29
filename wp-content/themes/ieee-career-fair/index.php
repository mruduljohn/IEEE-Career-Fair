<?php
/**
 * The main template file
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    <div class="container my-5">
        <?php if (have_posts()) : ?>
            
            <header class="page-header mb-4">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header><!-- .page-header -->

            <div class="row">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-img-top">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('event-thumbnail', array('class' => 'card-img-top')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body d-flex flex-column">
                                <header class="entry-header">
                                    <?php
                                    if (is_singular()) :
                                        the_title('<h1 class="entry-title card-title">', '</h1>');
                                    else :
                                        the_title('<h2 class="entry-title card-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                    endif;

                                    if ('post' === get_post_type()) :
                                        ?>
                                        <div class="entry-meta text-muted mb-2">
                                            <?php
                                            echo '<time class="published" datetime="' . esc_attr(get_the_date('c')) . '">';
                                            echo get_the_date();
                                            echo '</time>';
                                            ?>
                                        </div><!-- .entry-meta -->
                                        <?php
                                    endif;
                                    ?>
                                </header><!-- .entry-header -->

                                <div class="entry-summary card-text flex-grow-1">
                                    <?php
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        echo wp_trim_words(get_the_content(), 20, '...');
                                    }
                                    ?>
                                </div><!-- .entry-summary -->

                                <footer class="entry-footer mt-auto">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
                                        <?php _e('Read More', 'ieee-career-fair'); ?>
                                    </a>
                                </footer><!-- .entry-footer -->
                            </div><!-- .card-body -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                    </div><!-- .col -->
                    <?php
                endwhile;
                ?>
            </div><!-- .row -->

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('&laquo; Previous', 'ieee-career-fair'),
                'next_text' => __('Next &raquo;', 'ieee-career-fair'),
                'class'     => 'pagination-wrapper my-5',
            ));

        else :
            ?>
            <div class="text-center py-5">
                <h2><?php _e('Nothing here', 'ieee-career-fair'); ?></h2>
                <p class="lead"><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'ieee-career-fair'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        endif;
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?> 