<?php get_header(); ?>

	<?php
        if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="full-screen scene_element scene_element--fadein">

            <?php
        		// the content (pretty self explanatory huh)
        		the_content();
        	?>

            <div id="contact" class="section contact">

                <div class="wrap">

                    <h1>Contact Us</h1>

                    <!-- <p>
                        We'd love to hear from you!
                    </p> -->

                    <?php
                        get_template_part( 'contact' );
                    ?>

                </div>

            </div>

        </div>

    <?php endwhile; else : ?>

        <article id="post-not-found" class="hentry cf">
                <header class="article-header">
                    <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
            </header>
                <section class="entry-content">
                    <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
            </section>
            <footer class="article-footer">
                    <p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
            </footer>
        </article>

    <?php endif; ?>

    <?php
        // get_template_part( 'footerbar' );
    ?>

<?php get_footer(); ?>
