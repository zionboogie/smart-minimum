<?php
/**
* 検索ページ用テンプレート
*
* @package WordPress
* @subpackage SMART-MINIMUM
*/
?>

<?php
// パンくずリストの出力
get_template_part( 'template-parts/breadcrumb' );
?>

	<!-- page-header -->
	<div class="page-header">
		<h1 class="title">Search</h1>
		<div class="pagemeta-container">
			ヒット：<?php echo $wp_query->found_posts; ?>件　<?php printf( __( '検索ワード: %s', 'yoko' ), '<span>' . get_search_query() . '</span>' ); ?>
		</div>
	</div>
	<!-- /page-header -->

<?php
// 検索コンテンツ
get_template_part( 'template-parts/content-category-tag' );
?>
