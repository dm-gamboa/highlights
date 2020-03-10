<?php
/**
 * Template part for displaying featured projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Highlights
 */

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

    if( $overviewACF ){
        $overview = array (
            'heading'   => $overviewACF[ 'text' ][ 'heading' ],
            'subeading' => $overviewACF[ 'text' ][ 'subheading' ],
            'image'     => $overviewACF[ 'image']
        );
    }
}
// ----------------------------------------
?>

<div class="featured-project">
    <aside class="content-aside">
        <figure class="preview"><!--ACF FIELD--></figure>
        <span class="links"><!--ACF FIELD--></span>
    </aside><!--.aside-->
    
    <div class="content-main">
        <h2 class="title"><!--ACF FIELD--></h3>
        <h3 class="type"><!--ACF FIELD--></h3>

        <div class="tools">
            <ul class="development">
                <li class="tool"></li>
            </ul><!--.development-->
        </div><!--.tools-->    
    </div><!--.content-main-->

    <div class="content-hover">
        <p class="description"><!--ACF FIELD--></p>
    </div><!--.content-hover-->
</div><!--.featured-project-->
