<?php
/**
 * Template part for displaying the overview section in single project pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Highlights
 */

?>

<?php
// ----------------------------------------
//  # TAXONOMIES
// ----------------------------------------

$projectType    = highlights_get_terms_in_subcategory( 'type', 'project' );
// Get the most specific project type
while( highlights_get_terms_in_subcategory( 'type', $projectType[0], 'name' ) ){
    $projectType = highlights_get_terms_in_subcategory( 'type', $projectType[0], 'name' );
}
$projectType    = $projectType[0];

$devTools       = highlights_get_terms_in_subcategory( 'type', 'development' );
$desTools       = highlights_get_terms_in_subcategory( 'type', 'design' );
$projTools      = highlights_get_terms_in_subcategory( 'type', 'project-management' );
// ----------------------------------------
?>
<span class="full-width background"></span>
<div class="content">
    <aside class="content-section aside">
        <?php if( $overview[ 'image' ] ):?>
            <img src="<?php echo esc_url( $overview[ 'image' ]['url'] ); ?>" alt="<?php echo esc_attr( $overview[ 'image' ]['alt'] ); ?>" />
        <?php endif; ?>
    </aside><!--.content-section-->
    
    <div class="content-section text">
        <div class="heading">
            <h2 class="project-title"><?php the_title(); ?></h2>
            <div class="project-info">
                <h3 class="project-type"><?php echo $projectType; ?></h3>
                <span class="links">
                    <?php if( $overview[ 'link_github' ] ): ?>
                        <a class="icon-link" href="<?php echo esc_url( $overview[ 'link_github' ] ); ?>" target="_blank">
                            <span class="icon icon-github">
                                <span class="screen-reader-text">GitHub</span>
                            </span>
                        </a><!--.icon-link-->
                    <?php endif; ?>

                    <?php if( $overview[ 'link_live_site' ] ): ?>
                        <a class="live-site button button-link" href="<?php echo esc_url( $overview[ 'link_live_site' ] );?>" target="_blank">Live Site</a>
                    <?php endif; ?>
                </span><!--.links-->
            </div><!--.project-info-->
        </div><!--.heading-->

        <p class="description"><?php echo $overview[ 'description' ]; ?></p>

        <div class="tools">
            <ul class="development tools-list">
                <span class="tool-type icon-link">
                    <span class="icon icon-development">
                        <span class="screen-reader-text">Project Management Tools</span>
                    </span>
                </span><!--.tool-type-->
                <?php if( $devTools ): ?>
                    <?php foreach( $devTools as $devTool ): ?>
                        <li class="tool"><?php echo $devTool; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.development.tools-list-->

            <ul class="design tools-list">
                <span class="tool-type icon-link">
                    <span class="icon icon-design">
                        <span class="screen-reader-text">Project Management Tools</span>
                    </span>
                </span><!--.tool-type-->
                <?php if( $desTools ): ?>
                    <?php foreach( $desTools as $desTool ): ?>
                        <li class="tool"><?php echo $desTool ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.design.tools-list-->

            <ul class="project tools-list">
                <span class="tool-type icon-link">
                    <span class="icon icon-project-management">
                        <span class="screen-reader-text">Project Management Tools</span>
                    </span>
                </span><!--.tool-type-->
                <?php if( $projTools ): ?>
                    <?php foreach( $projTools as $projTool ): ?>
                        <li class="tool"><?php echo $projTool ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.project.tools-list-->

        </div><!--.tools-->
    </div><!--.content-section.text-->
</div><!--.content-->
