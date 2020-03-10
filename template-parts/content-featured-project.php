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
            'description'       => $overviewACF[ 'description' ],
            'link_github'       => $overviewACF[ 'link' ][ 'github' ],
            'link_live_site'    => $overviewACF[ 'link' ][ 'live_site' ]
        );
    }
}
// ----------------------------------------

// ----------------------------------------
//  # TAXONOMIES
// ----------------------------------------

if( !function_exists( 'get_terms_in_subcategory' ) ){
    function get_terms_in_subcategory( $taxonomy, $subcategory, $subcategoryField = 'slug' ){
        // Get all the terms attached to the post
        $postTerms = get_the_terms( $post->ID, $taxonomy );
        foreach( $postTerms as $term ){
            // Get an array of all the post term names
            $postTermNames[] = $term->name;
        }

        // Get the subcategory as a WP term object
        // So we can grab the ID and pass it as an arg later
        $subcategory = get_term_by( $subcategoryField, $subcategory, $taxonomy );

        // Get all the terms under the subcategory
        $subcategoryChildren = get_terms( array( 
            'taxonomy' => $taxonomy,
            'parent' => $subcategory->term_id ) );
        
        // If the subcategory has child terms
        if( $subcategoryChildren ){
            // Loop through all the terms under subcategory
            foreach( $subcategoryChildren as $child ){
                // Get the subcategory terms that are also attached to the post
                if( in_array( $child->name, $postTermNames ) ){
                    $termsInSubcategory[] = $child->name;
                }
            }
            return $termsInSubcategory;
        }
        return;
    }
}

$projectType    = get_terms_in_subcategory( 'type', 'project' );
// Get the most specific project type
while( get_terms_in_subcategory( 'type', $projectType[0], 'name' ) ){
    $projectType = get_terms_in_subcategory( 'type', $projectType[0], 'name' );
}
$projectType    = $projectType[0];

$devTools       = get_terms_in_subcategory( 'type', 'development' );
$desTools       = get_terms_in_subcategory( 'type', 'design' );
$projTools      = get_terms_in_subcategory( 'type', 'project-management' );
// ----------------------------------------
?>

<div class="featured-project">
    <aside class="content-aside">
        <figure class="preview"><?php the_post_thumbnail(); ?></figure>
        <span class="links">
            <?php if( $overview[ 'link_github' ] ): ?>
                <a class="github" href="<?php echo esc_url( $overview[ 'link_github' ] ); ?>">GitHub</a>
            <?php endif; ?>

            <?php if( $overview[ 'link_github' ] ): ?>
                <a class="live-site" href="<?php echo esc_url( $overview[ 'link_live_site' ] );?>">Live Site</a>
            <?php endif; ?>
        </span><!--.links-->
    </aside><!--.aside-->
    
    <div class="content-main">
        <h2 class="title"><?php the_title(); ?></h3>
        <h3 class="type"><?php echo $projectType; ?></h3>

        <div class="tools">
            <ul class="development tools-list">
                <h3>Development Tools</h3>
                <?php if( $devTools ): ?>
                    <?php foreach( $devTools as $devTool ): ?>
                        <li class="tool"><?php echo $devTool; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.development.tools-list-->

            <ul class="design tools-list">
                <h3>Design Tools</h3>
                <?php if( $desTools ): ?>
                    <?php foreach( $desTools as $desTool ): ?>
                        <li class="tool"><?php echo $desTool ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.design.tools-list-->

            <ul class="project tools-list">
                <h3>Project Management Tools</h3>
                <?php if( $projTools ): ?>
                    <?php foreach( $projTools as $projTool ): ?>
                        <li class="tool"><?php echo $projTool ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.project.tools-list-->
        </div><!--.tools-->

        <a class="button button-link" href="<?php the_permalink(); ?>">Read More</a>
    </div><!--.content-main-->

    <div class="content-hover">
        <p class="description"><?php echo $overview[ 'description' ]; ?></p>
    </div><!--.content-hover-->
</div><!--.featured-project-->
