<?php
/**
* カテゴリページ用テンプレート
*
* @package WordPress
* @subpackage SMART-MINIMUM
*/

if ( have_posts() ) : ?>

<!-- entrylist-contaier -->
<article class="entrylist-contaier">

<?php

while ( have_posts() ) {
	the_post();
	// 記事の出力
	get_template_part( 'template-parts/contentheader' );
}
// ページネーションの出力
get_template_part( 'template-parts/pagination' );

?>

</article>
<!-- /entrylist-contaier -->

<?php endif; ?>
