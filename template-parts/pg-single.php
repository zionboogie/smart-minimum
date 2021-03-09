<?php
/**
* シングルページ用テンプレート
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

	<!-- entrylist-contaier -->
	<article class="entrylist-contaier">

	<?php
	while ( have_posts() ) {
		the_post();
		// 記事の出力
		get_template_part( 'template-parts/content', get_post_format() );
	}
	?>

	</article>
	<!-- /entrylist-contaier -->

	<?php
	// ページネーションの出力
	get_template_part( 'template-parts/pagination' );
	?>

<?php endif; ?>
