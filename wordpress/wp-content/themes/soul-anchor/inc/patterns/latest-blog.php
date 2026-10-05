<?php
/**
 * Latest Blogs
 */
return array(
	'title'      => esc_html__( 'Latest Blogs', 'soul-anchor' ),
	'categories' => array( 'soul-anchor', 'Latest Blogs' ),
	'content'    => '<!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query {"queryId":38,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":true},"metadata":{"categories":["posts"],"patternName":"core/query-grid-posts","name":"Grid"}} -->
<div class="wp-block-query"><!-- wp:group {"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"40px"}},"fontFamily":"soul-anchor-Poppins"} -->
<h3 class="wp-block-heading has-text-align-center has-soul-anchor-poppins-font-family" style="font-size:40px">Latest Blogs</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"#747474"}}},"color":{"text":"#747474"}},"fontFamily":"soul-anchor-Poppins"} -->
<p class="has-text-align-center has-text-color has-link-color has-soul-anchor-poppins-font-family" style="color:#747474">Many desktop publishing packages and web page editors now use<br>Lorem Ipsum as their default model text,<br></p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":59,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"metadata":{"categories":["posts"],"patternName":"core/query-grid-posts","name":"Grid"},"className":"blog-area","layout":{"type":"default"}} -->
<div class="wp-block-query blog-area"><!-- wp:post-template {"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<!-- wp:group {"className":"post-main-area wow fadeInUp","style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}},"border":{"radius":"5px","color":"#e7e7e7","width":"1px"},"shadow":"var:preset|shadow|deep"},"layout":{"inherit":false}} -->
<div class="wp-block-group post-main-area wow fadeInUp has-border-color" style="border-color:#e7e7e7;border-width:1px;border-radius:5px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;box-shadow:var(--wp--preset--shadow--deep)"><!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"22px"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary","fontFamily":"soul-anchor-Poppins"} /-->

<!-- wp:post-excerpt {"excerptLength":20,"style":{"elements":{"link":{"color":{"text":"#747474"}}},"color":{"text":"#747474"},"typography":{"fontSize":"15px"}},"fontFamily":"soul-anchor-Poppins"} /-->

<!-- wp:post-date {"style":{"color":{"text":"var(--wp--preset--color--extra-primary)"},"elements":{"link":{"color":{"text":"var(--wp--preset--color--extra-primary)"}}}}} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></div>
<!-- /wp:query -->

<!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->',
);