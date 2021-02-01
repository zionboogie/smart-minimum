<?php
/*
詳細用テンプレート
*/
// ヘッダの出力
get_header();
?>

<h2>single.php</h2>


<!-- main -->
<main class="main-container">

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
		get_template_part( 'template-parts/content-single', get_post_format() );
	}
	?>
	</article>
	<!-- /entrylist-contaier -->

	<?php
	// ページネーションの出力
	get_template_part( 'template-parts/pagination' );
	?>

		<?php endif; ?>

<?php
// サイドバーの出力
get_sidebar();
?>

</main>
<!-- /main -->

<?php
// フッタの出力
get_footer();
?>
�出力
get_footer();
?>
