<?php
/**
 * The template file for the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Highlights
 */

get_header();
?>
<?php
// ----------------------------------------
//  # ACF FIELDS
// ----------------------------------------
if( function_exists( 'get_field' ) ){
    // ----------------------------------------
    //  # SPLASH PAGE
    // ----------------------------------------
    $splashPageACF = get_field( 'splash_page' );

    if( $splashPageACF ){
        $splashPage = array (
            'heading'   => $splashPageACF[ 'text' ][ 'heading' ],
            'subeading' => $splashPageACF[ 'text' ][ 'subheading' ],
            'image'     => $splashPageACF[ 'image']
        );
    }

    // ----------------------------------------
    //  # FEATURED PROJECTS
    // ----------------------------------------
    $featuredProjectsACF = get_field( 'featured_projects' );

    if( $featuredProjectsACF ){
        $featuredProjects = array (
            'title'             => $featuredProjectsACF[ 'text' ][ 'title' ],
            'description'       => $featuredProjectsACF[ 'text' ][ 'description' ],
            // featured_project subfields in #featured-projects
            'featured_project'  => $featuredProjectsACF[ 'featured_project' ]
        );
    }

    // ----------------------------------------
    //  # ABOUT
    // ----------------------------------------
    $aboutACF = get_field( 'about' );

    if( $aboutACF ){
        $about = array (
            'title'             => $aboutACF[ 'title' ],
            'description'       => $aboutACF[ 'text' ],
            'image'             => $aboutACF[ 'image' ]
        );
    }
}
// ----------------------------------------
?>

<main id="main" class="site-main">

    <h1 class="title page-title screen-reader-text"><?php the_title();?></h1>

    <section id="splash-page" class="splash-page main-section">
        <h2 class="section-title screen-reader-text">Splash Page</h2>
        <div class="content">
            <?php if( $splashPage[ 'heading' ] ): ?>
                <h2 class="section-heading"><?php echo $splashPage[ 'heading' ];?></h2>
            <?php endif; ?>

            <?php if( $splashPage[ 'subheading' ] ): ?>
                <h3 class="section-subheading"><?php echo $splashPage[ 'subheading' ];?></h3>
            <?php endif; ?>

            <?php if( $splashPage[ 'image' ] ) {
                echo wp_get_attachment_image( $splashPage[ 'image' ], 'full' );
            } ?>
        </div><!--.content-->
    </section><!--#splash-page.main-section-->

    <section id="featured-projects" class="featured-projects main-section">
        <?php if( $featuredProjects[ 'title' ] ): ?>
            <h2 class="section-title"><?php echo $featuredProjects[ 'title' ];?></h2>
        <?php endif; ?>

        <?php if( $featuredProjects[ 'description' ] ): ?>
            <p class="section-description"><?php echo $featuredProjects[ 'description' ];?></p>
        <?php endif; ?>

        <?php if( $featuredProjects[ 'featured_project' ] ) : ?>
            <ul>
                <?php
                foreach ( $featuredProjects[ 'featured_project' ] as $post ) {
                    setup_postdata( $post );
                    get_template_part( 'content', 'featured-project' );
                }
                wp_reset_postdata();
                ?>
            </ul>
        <?php endif; ?>
    </section><!--#featured-projects.main-section-->

    <section id="about" class="about main-section">
        <h2 class="section-title"><?php  $about[ 'title' ]?></h2>
        <figure class="headshot">
            <?php 
            if( $about[ 'image' ] ) {
                echo wp_get_attachment_image( $about[ 'image' ], 'full' );
            }
            ?>
        </figure>
        
        <?php if( $about[ 'text' ] ): ?>
            <article><?php echo $about[ 'text' ]; ?></article>
        <?php endif;?>
    </section><!--#about.main-section-->

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
