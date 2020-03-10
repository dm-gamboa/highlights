<?php
/**
 * The template for displaying single posts of the Project CPT
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
    //  # OVERVIEW
    // ----------------------------------------
    $overviewACF = get_field( 'overview' );

    $overview = array (
        'description'       => $overviewACF[ 'description' ],
        'link_github'       => $overviewACF[ 'link' ][ 'github' ],
        'link_live_site'    => $overviewACF[ 'link' ][ 'live_site' ],
        'analytics'         => $overviewACF[ 'analytics' ]
    );

    // ----------------------------------------
    //  # HIGHLIGHTS
    // ----------------------------------------
    if( have_rows( 'highlights' ) ){
        while( have_rows( 'highlights' ) ){
            the_row();

            if( have_rows( 'section' ) ){
                while( have_rows( 'section' ) ){
                    the_row();

                    $section = array (
                        'for'   => 'highlight',
                        'title'     => get_sub_field( 'title' ),
                        'text'      => get_sub_field( 'text' ),
                        'image'     => get_sub_field( 'image' )
                    );
        
                    if( have_rows( 'code' ) ){
                        while( have_rows( 'code' ) ){
                            the_row();
                            
                            $codeSnippet = array (
                                'language'  => get_sub_field( 'language' ),
                                'snippet'   => get_sub_field( 'snippet' )
                            );

                            $section[ 'code' ][] = $codeSnippet;
                        }
                    }

                    $highlights[] = $section;
                }
            }
        }
    }

    // // ----------------------------------------
    // //  # PROCESS
    // // ----------------------------------------
    if( have_rows( 'process' ) ){
        while( have_rows( 'process' ) ){
            the_row();
            
            if( have_rows( 'section' ) ){
                while( have_rows( 'section' ) ){
                    the_row();

                    $section = array (
                        'for'   => 'process',
                        'type'      => get_sub_field( 'type' ),
                        'title'     => get_sub_field( 'title' ),
                        'text'      => get_sub_field( 'text' ),
                        'image'     => get_sub_field( 'image' )
                    );
                    
                    if( !$section[ 'title' ] ){
                        $section[ 'title' ] = $section[ 'type' ];
                    }

                    $process[] = $section;
                }
            }
        }
    }
}
// ----------------------------------------
?>

<main id="main" class="site-main">
    <section id="overview" class="overview main-section">
        <?php get_template_part( 'template-parts/content', 'project-overview' ); ?>
    </section><!--#overview.main-section-->

    <nav id="tabs" class="highlights main-section">
        <button class="tab">Highlights</button>
        <button class="tab">Process</button>
    </nav>

    <section id="highlights" class="highlights main-section">
        <h2>Highlights</h2>
        <?php
        if( $highlights ){
            foreach( $highlights as $highlight ){
                set_query_var( 'section', $highlight );
                get_template_part( 'template-parts/content', 'project-section' );
                set_query_var( 'section', false );
            }
        }
        ?>
    </section><!--#highlights.main-section-->

    <section id="process" class="process main-section">
        <h2>Process</h2>
        <?php
        if( $process ){
            foreach( $process as $aProcess ){
                set_query_var( 'section', $aProcess );
                get_template_part( 'template-parts/content', 'project-section' );
                set_query_var( 'section', false );
            }
        }
        ?>
    </section><!--#process.main-section-->

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
