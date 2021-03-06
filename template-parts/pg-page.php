<?php
/**
* 固定ページ用テンプレート
*
* @package WordPress
* @subpackage SMART-MINIMUM
*/
?>

<?php
// パンくずリストの出力
get_template_part( 'template-parts/breadcrumb' );
?>

<?php if ( have_posts() ) : ?>

	<!-- entry-content -->
	<section class="entry-container">

	<?php the_content(); ?>

	</section>
	<!-- /entry-content -->

<?php endif; ?>
