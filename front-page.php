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
            'subheading' => $splashPageACF[ 'text' ][ 'subheading' ],
            'image'     => $splashPageACF[ 'image' ]
        );
    }

    // ----------------------------------------
    //  # FEATURED PROJECTS
    // ----------------------------------------
    $featuredProjectsACF = get_field( 'featured_projects' );

    if( $featuredProjectsACF ){
        $featuredProjects = array (
            'title'             => $featuredProjectsACF[ 'title' ],
            'description'       => $featuredProjectsACF[ 'description' ],
            // featured_project subfields in #featured-projects
            'the_projects'  => $featuredProjectsACF[ 'featured_projects' ]
        );
    }

    // ----------------------------------------
    //  # ABOUT
    // ----------------------------------------
    $aboutACF = get_field( 'about' );

    if( $aboutACF ){
        $about = array (
            'title'             => $aboutACF[ 'title' ],
            'text'              => $aboutACF[ 'text' ],
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
            <div class="text">
                <?php if( $splashPage[ 'heading' ] ): ?>
                    <h2 class="section-heading"><?php echo $splashPage[ 'heading' ]; ?></h2>
                <?php endif; ?>
            
                <?php if( $splashPage[ 'subheading' ] ): ?>
                    <h3 class="section-subheading"><?php echo $splashPage[ 'subheading' ]; ?></h3>
                <?php endif; ?>
            </div><!--.text-->

            <?php if( $splashPage[ 'image' ] ) {
                echo wp_get_attachment_image( $splashPage[ 'image' ], 'full' );
            } ?>

            <span class="scroll-down icon-link">
                <span class="icon icon-down"></span>
            </span><!--.icon-link-->
        </div><!--.content-->
    </section><!--#splash-page.main-section-->

    <section id="featured-projects" class="featured-projects main-section">
        <?php if( $featuredProjects[ 'title' ] ): ?>
            <h2 class="section-title"><?php echo $featuredProjects[ 'title' ]; ?></h2>
        <?php endif; ?>

        <?php if( $featuredProjects[ 'the_projects' ] ) : ?>
            <ul>
                <?php
                foreach ( $featuredProjects[ 'the_projects' ] as $post ) {
                    setup_postdata( $post );
                    get_template_part( 'template-parts/content', 'featured-project' );
                }
                wp_reset_postdata();
                ?>
            </ul>
        <?php endif; ?>
    </section><!--#featured-projects.main-section-->

    <section id="about" class="about main-section">
        <h2 class="section-title"><?php echo $about[ 'title' ]; ?></h2>
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
