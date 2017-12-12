<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Demo Content Importer
============================================================================= */

if( ! function_exists( 'hydrogen_demo_content' ) ):

function hydrogen_demo_content( $demo ) {

	return array_merge( $demo, array(
		'default' => array(
			'screenshot' => get_template_directory_uri() . '/demo/default.png', 
			'name' => __( 'Default', 'youxi' ), 
			'content' => array(
				'wp' => array( 'xml' => get_template_directory() . '/demo/hydrogen.wordpress.2014-08-20.xml' ), 
				'widgets' => '{"custom-blogsidebar":{"search-3":{"title":""},"text-4":{"title":"Text Widget","text":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.","filter":true},"categories-3":{"title":"Categories","count":1,"hierarchical":0,"dropdown":0},"flickr-widget-3":{"title":"Flickr Photos","flickr_id":"","limit":10},"tweets-widget-3":{"title":"Latest Tweets","username":"envato","count":2}},"custom-contactsidebar":{"text-2":{"title":"","text":"<strong>Hydrogen Digital Agency<\/strong>\r\n111 Fifth Avenue, 34th Floor\r\nNew York\r\nUnited States","filter":true},"text-3":{"title":"","text":"<p class=\"lead\">\r\n\t<strong>E:<\/strong> hello@hydrogendigital.com\r\n\t<strong>P:<\/strong> 0987 6543 2100\r\n<\/p>","filter":true}}}', 
				'theme-options' => 'YTo4NTp7czo5OiJtYWluX2xvZ28iO3M6MDoiIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6MToiMCI7czoxMzoiaGVhZGVyX2xheW91dCI7czo2OiJub3JtYWwiO3M6MTE6ImZvb3Rlcl90ZXh0IjtzOjc3OiJDb3B5cmlnaHQgwqkgMjAwOC0yMDE0LiA8YSBocmVmPSIjIj5IeWRyb2dlbiBTdHVkaW88L2E+LiBBbGwgUmlnaHRzIFJlc2VydmVkLiI7czoxMzoiZm9vdGVyX2xheW91dCI7czo0OiJsb2dvIjtzOjExOiJmb290ZXJfbG9nbyI7czowOiIiO3M6MTc6ImZvb3Rlcl9sb2dvX3dpZHRoIjtzOjM6IjEwMCI7czoxOToiZm9vdGVyX3dpZGdldHNfY29scyI7czowOiIiO3M6MTk6ImZvb3Rlcl9zb2NpYWxfaWNvbnMiO2E6NTp7aTowO2E6Mzp7czo1OiJ0aXRsZSI7czo4OiJGYWNlYm9vayI7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tIjtzOjQ6Imljb24iO3M6MjQ6InNvY2ljb24gc29jaWNvbi1mYWNlYm9vayI7fWk6MTthOjM6e3M6NToidGl0bGUiO3M6NzoiVHdpdHRlciI7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly93d3cudHdpdHRlci5jb20iO3M6NDoiaWNvbiI7czoyMzoic29jaWNvbiBzb2NpY29uLXR3aXR0ZXIiO31pOjI7YTozOntzOjU6InRpdGxlIjtzOjk6Ikluc3RhZ3JhbSI7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cuaW5zdGFncmFtLmNvbSI7czo0OiJpY29uIjtzOjI1OiJzb2NpY29uIHNvY2ljb24taW5zdGFncmFtIjt9aTozO2E6Mzp7czo1OiJ0aXRsZSI7czo3OiJHb29nbGUrIjtzOjM6InVybCI7czoyMjoiaHR0cDovL3BsdXMuZ29vZ2xlLmNvbSI7czo0OiJpY29uIjtzOjIyOiJzb2NpY29uIHNvY2ljb24tZ29vZ2xlIjt9aTo0O2E6Mzp7czo1OiJ0aXRsZSI7czo2OiJHaXRIdWIiO3M6MzoidXJsIjtzOjIxOiJodHRwOi8vd3d3LmdpdGh1Yi5jb20iO3M6NDoiaWNvbiI7czoyMjoic29jaWNvbiBzb2NpY29uLWdpdGh1YiI7fX1zOjEwOiJibG9nX3RpdGxlIjtzOjQ6IkJsb2ciO3M6MTM6ImJsb2dfc3VidGl0bGUiO3M6NDA6IlJlYWQgaGVyZSB0aGUgc3RvcmllcyBvZiBvdXIgZGFpbHkgbGlmZS4iO3M6MTk6ImJsb2dfY2F0ZWdvcnlfdGl0bGUiO3M6MjA6IkNhdGVnb3J5OiB7Y2F0ZWdvcnl9IjtzOjIyOiJibG9nX2NhdGVnb3J5X3N1YnRpdGxlIjtzOjA6IiI7czoxNDoiYmxvZ190YWdfdGl0bGUiO3M6MjQ6IlBvc3RzIFRhZ2dlZCDigJh7dGFnfeKAmSI7czoxNzoiYmxvZ190YWdfc3VidGl0bGUiO3M6NjY6IldlIGFyZSBwbGVhc2VkIHRvIHByZXNlbnQgYmVsb3cgYWxsIHBvc3RzIHRhZ2dlZCB3aXRoIOKAmHt0YWd94oCZLiI7czoxNzoiYmxvZ19hdXRob3JfdGl0bGUiO3M6MTc6IlBvc3RzIGJ5IHthdXRob3J9IjtzOjIwOiJibG9nX2F1dGhvcl9zdWJ0aXRsZSI7czowOiIiO3M6MTU6ImJsb2dfZGF0ZV90aXRsZSI7czoxODoiQXJjaGl2ZSBmb3Ige2RhdGV9IjtzOjE4OiJibG9nX2RhdGVfc3VidGl0bGUiO3M6MDoiIjtzOjE3OiJibG9nX3NlYXJjaF90aXRsZSI7czo2OiJTZWFyY2giO3M6MjA6ImJsb2dfc2VhcmNoX3N1YnRpdGxlIjtzOjMyOiJTZWFyY2ggcmVzdWx0cyBmb3Ig4oCYe3F1ZXJ5feKAmSI7czoxNjoiYmxvZ190aW1lX2Zvcm1hdCI7czo2OiJGIGosIFkiO3M6MjI6ImJsb2dfaW5kZXhfbWV0YV9mb3JtYXQiO3M6NDg6IlBvc3RlZCBieSB7YXV0aG9yfSBvbiB7ZGF0ZXRpbWV9IHdpdGgge2NvbW1lbnRzfSI7czoyMToiYmxvZ19wb3N0X21ldGFfZm9ybWF0IjtzOjI5OiJieSB7YXV0aG9yfSAmZGFzaDsge2RhdGV0aW1lfSI7czoxNzoiYmxvZ19zaG93X2FkZHRoaXMiO3M6Mjoib24iO3M6MjM6ImJsb2dfYWx3YXlzX3Nob3dfYXV0aG9yIjtzOjI6Im9uIjtzOjE3OiJibG9nX2luZGV4X2xheW91dCI7czoxMzoicmlnaHRfc2lkZWJhciI7czoxODoiYmxvZ19pbmRleF9zaWRlYmFyIjtzOjE4OiJjdXN0b20tYmxvZ3NpZGViYXIiO3M6MTY6ImJsb2dfcG9zdF9sYXlvdXQiO3M6MTM6InJpZ2h0X3NpZGViYXIiO3M6MTc6ImJsb2dfcG9zdF9zaWRlYmFyIjtzOjE4OiJjdXN0b20tYmxvZ3NpZGViYXIiO3M6MTU6InBvc3RfcGFnaW5hdGlvbiI7czo2OiJhcnJvd3MiO3M6MTM6InVzZXJfc2lkZWJhcnMiO2E6Mjp7aToxO2E6Mjp7czo1OiJ0aXRsZSI7czoxMjoiQmxvZyBTaWRlYmFyIjtzOjExOiJkZXNjcmlwdGlvbiI7czoyNToiVGhpcyBpcyB0aGUgYmxvZyBzaWRlYmFyLiI7fWk6MDthOjI6e3M6NToidGl0bGUiO3M6MTU6IkNvbnRhY3QgU2lkZWJhciI7czoxMToiZGVzY3JpcHRpb24iO3M6NDI6IlRoaXMgaXMgdGhlIHNpZGViYXIgZm9yIGNvbnRhY3QgcGFnZSBibG9jayI7fX1zOjEwOiJibG9nX3N0eWxlIjtzOjE6IjAiO3M6MTA6InBhZ2Vfc3R5bGUiO3M6MToiMCI7czoxNToicG9ydGZvbGlvX3N0eWxlIjtzOjE6IjAiO3M6MTI6ImFjY2VudF9jb2xvciI7czo3OiIjZWMwMDVmIjtzOjk6ImJvZHlfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjIxOiJoZWFkaW5nc19kZWZhdWx0X2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxNzoiaGVhZGluZ3NfYWx0X2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxNToiYmxvY2txdW90ZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTc6InNwbGFzaF9pbnRyb19mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjA6InNwbGFzaF9oZWFkbGluZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjM6InNwbGFzaF9kZXNjcmlwdGlvbl9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjA6InNwbGFzaF9mZWVkYmFja19mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTg6InNlY3Rpb25fdGl0bGVfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjI0OiJzZWN0aW9uX3RpdGxlX3NtYWxsX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMToic2VjdGlvbl9zdWJ0aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6Mjc6InNlY3Rpb25fc3VidGl0bGVfc21hbGxfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjI4OiJzZWN0aW9uX3NlcGFyYXRvcl90aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MzQ6InNlY3Rpb25fc2VwYXJhdG9yX3RpdGxlX3NtYWxsX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxNToicGFnZV90aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjE6InBhZ2VfdGl0bGVfc21hbGxfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjIwOiJtYWluX25hdl9hbmNob3JfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE2OiJmb290ZXJfdGV4dF9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjQ6ImZvb3Rlcl93aWRnZXRfdGl0bGVfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjg6ImJ0bl9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTU6InBvc3RfdGl0bGVfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjMwOiJwb3N0X2NvbW1lbnRzX3JlcGx5X3RpdGxlX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyNDoicG9zdF9jb21tZW50c19jb3VudF9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjM6InBvc3RfY29tbWVudHNfbmFtZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjA6InRlYW1fcG9wdXBfbmFtZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjA6InRlYW1fcG9wdXBfcm9sZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjM6InByaWNpbmdfdGFibGVfbmFtZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjQ6InByaWNpbmdfdGFibGVfcHJpY2VfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjM2OiJwcmljaW5nX3RhYmxlX3ByaWNlX2Rlc2NyaXB0aW9uX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyODoiY2FsbF90b19hY3Rpb25faGVhZGxpbmVfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE5OiJjb3VudGVyX251bWJlcl9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjU6InNsaWRlcl9tZWRpYV9jYXB0aW9uX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMjoicmVjZW50X3Bvc3RfdGl0bGVfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE2OiJ0ZXN0aW1vbmlhbF9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTU6InR3ZWV0X3RleHRfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE4OiJpbmNsdWRlX3R3dHRyX3RleHQiO3M6Mzoib2ZmIjtzOjEyOiJjb25zdW1lcl9rZXkiO3M6MDoiIjtzOjE1OiJjb25zdW1lcl9zZWNyZXQiO3M6MDoiIjtzOjEyOiJhY2Nlc3NfdG9rZW4iO3M6MDoiIjtzOjE5OiJhY2Nlc3NfdG9rZW5fc2VjcmV0IjtzOjA6IiI7czoxNToiZW52YXRvX3VzZXJuYW1lIjtzOjA6IiI7czoxNDoiZW52YXRvX2FwaV9rZXkiO3M6MDoiIjtzOjE4OiJpdGVtX3B1cmNoYXNlX2NvZGUiO3M6MDoiIjtzOjE2OiJlbmFibGVfcHJlbG9hZGVyIjtzOjI6Im9uIjtzOjE1OiJwcmVsb2FkZXJfc3R5bGUiO3M6MToiMCI7czoyMzoiZW5hYmxlX3Ntb290aF9zY3JvbGxpbmciO3M6Mjoib24iO3M6MjM6InNtb290aF9zY3JvbGxpbmdfYW1vdW50IjtzOjM6IjMwMCI7czo3OiJmYXZpY29uIjtzOjA6IiI7czoxMDoiY3VzdG9tX2NzcyI7czowOiIiO30=', 
				'frontpage_displays' => array(
					'show_on_front'  => 'page', 
					'page_on_front'  => 15, 
					'page_for_posts' => 92
				), 
				'nav_menu_locations' => array(
					'main-menu' => 'the-menu'
				)
			)
		), 
		'dark' => array(
			'screenshot' => get_template_directory_uri() . '/demo/dark.png', 
			'name' => __( 'Dark', 'youxi' ), 
			'content' => array(
				'wp' => array( 'xml' => get_template_directory() . '/demo/hydrogen-dark.wordpress.2014-08-23.xml' ), 
				'widgets' => '{"custom-blogsidebar":{"search-3":{"title":""},"text-4":{"title":"Text Widget","text":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.","filter":true},"categories-3":{"title":"Categories","count":1,"hierarchical":0,"dropdown":0},"flickr-widget-3":{"title":"Flickr Photos","flickr_id":"","limit":10},"tweets-widget-3":{"title":"Latest Tweets","username":"envato","count":2}},"custom-contactsidebar":{"text-2":{"title":"","text":"<strong>Hydrogen Digital Agency<\/strong>\r\n111 Fifth Avenue, 34th Floor\r\nNew York\r\nUnited States","filter":true},"text-3":{"title":"","text":"<p class=\"lead\">\r\n\t<strong>E:<\/strong> hello@hydrogendigital.com\r\n\t<strong>P:<\/strong> 0987 6543 2100\r\n<\/p>","filter":true}}}', 
				'theme-options' => 'YTo4Mzp7czo5OiJtYWluX2xvZ28iO3M6NjE6Imh0dHA6Ly93cC55b3V4aXRoZW1lcy5jb20vcGxhY2Vob2xkZXJzL2h5ZHJvZ2VuL2xvZ28tZGFyay5wbmciO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo0OiJkYXJrIjtzOjEzOiJoZWFkZXJfbGF5b3V0IjtzOjY6Im5vcm1hbCI7czoxMToiZm9vdGVyX3RleHQiO3M6Nzc6IkNvcHlyaWdodCDCqSAyMDA4LTIwMTQuIDxhIGhyZWY9IiMiPkh5ZHJvZ2VuIFN0dWRpbzwvYT4uIEFsbCBSaWdodHMgUmVzZXJ2ZWQuIjtzOjEzOiJmb290ZXJfbGF5b3V0IjtzOjQ6ImxvZ28iO3M6MTE6ImZvb3Rlcl9sb2dvIjtzOjA6IiI7czoxNzoiZm9vdGVyX2xvZ29fd2lkdGgiO3M6MzoiMTAwIjtzOjE5OiJmb290ZXJfd2lkZ2V0c19jb2xzIjtzOjA6IiI7czoxOToiZm9vdGVyX3NvY2lhbF9pY29ucyI7YTo1OntpOjA7YTozOntzOjU6InRpdGxlIjtzOjg6IkZhY2Vib29rIjtzOjM6InVybCI7czoyMzoiaHR0cDovL3d3dy5mYWNlYm9vay5jb20iO3M6NDoiaWNvbiI7czoyNDoic29jaWNvbiBzb2NpY29uLWZhY2Vib29rIjt9aToxO2E6Mzp7czo1OiJ0aXRsZSI7czo3OiJUd2l0dGVyIjtzOjM6InVybCI7czoyMjoiaHR0cDovL3d3dy50d2l0dGVyLmNvbSI7czo0OiJpY29uIjtzOjIzOiJzb2NpY29uIHNvY2ljb24tdHdpdHRlciI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6OToiSW5zdGFncmFtIjtzOjM6InVybCI7czoyNDoiaHR0cDovL3d3dy5pbnN0YWdyYW0uY29tIjtzOjQ6Imljb24iO3M6MjU6InNvY2ljb24gc29jaWNvbi1pbnN0YWdyYW0iO31pOjM7YTozOntzOjU6InRpdGxlIjtzOjc6Ikdvb2dsZSsiO3M6MzoidXJsIjtzOjIyOiJodHRwOi8vcGx1cy5nb29nbGUuY29tIjtzOjQ6Imljb24iO3M6MjI6InNvY2ljb24gc29jaWNvbi1nb29nbGUiO31pOjQ7YTozOntzOjU6InRpdGxlIjtzOjY6IkdpdEh1YiI7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly93d3cuZ2l0aHViLmNvbSI7czo0OiJpY29uIjtzOjIyOiJzb2NpY29uIHNvY2ljb24tZ2l0aHViIjt9fXM6MTA6ImJsb2dfdGl0bGUiO3M6NDoiQmxvZyI7czoxMzoiYmxvZ19zdWJ0aXRsZSI7czo0MDoiUmVhZCBoZXJlIHRoZSBzdG9yaWVzIG9mIG91ciBkYWlseSBsaWZlLiI7czoxOToiYmxvZ19jYXRlZ29yeV90aXRsZSI7czoyMDoiQ2F0ZWdvcnk6IHtjYXRlZ29yeX0iO3M6MjI6ImJsb2dfY2F0ZWdvcnlfc3VidGl0bGUiO3M6MDoiIjtzOjE0OiJibG9nX3RhZ190aXRsZSI7czoyNDoiUG9zdHMgVGFnZ2VkIOKAmHt0YWd94oCZIjtzOjE3OiJibG9nX3RhZ19zdWJ0aXRsZSI7czo2NjoiV2UgYXJlIHBsZWFzZWQgdG8gcHJlc2VudCBiZWxvdyBhbGwgcG9zdHMgdGFnZ2VkIHdpdGgg4oCYe3RhZ33igJkuIjtzOjE3OiJibG9nX2F1dGhvcl90aXRsZSI7czoxNzoiUG9zdHMgYnkge2F1dGhvcn0iO3M6MjA6ImJsb2dfYXV0aG9yX3N1YnRpdGxlIjtzOjA6IiI7czoxNToiYmxvZ19kYXRlX3RpdGxlIjtzOjE4OiJBcmNoaXZlIGZvciB7ZGF0ZX0iO3M6MTg6ImJsb2dfZGF0ZV9zdWJ0aXRsZSI7czowOiIiO3M6MTc6ImJsb2dfc2VhcmNoX3RpdGxlIjtzOjY6IlNlYXJjaCI7czoyMDoiYmxvZ19zZWFyY2hfc3VidGl0bGUiO3M6MzI6IlNlYXJjaCByZXN1bHRzIGZvciDigJh7cXVlcnl94oCZIjtzOjE2OiJibG9nX3RpbWVfZm9ybWF0IjtzOjY6IkYgaiwgWSI7czoyMjoiYmxvZ19pbmRleF9tZXRhX2Zvcm1hdCI7czo0ODoiUG9zdGVkIGJ5IHthdXRob3J9IG9uIHtkYXRldGltZX0gd2l0aCB7Y29tbWVudHN9IjtzOjIxOiJibG9nX3Bvc3RfbWV0YV9mb3JtYXQiO3M6Mjk6ImJ5IHthdXRob3J9ICZkYXNoOyB7ZGF0ZXRpbWV9IjtzOjE3OiJibG9nX3Nob3dfYWRkdGhpcyI7czoyOiJvbiI7czoyMzoiYmxvZ19hbHdheXNfc2hvd19hdXRob3IiO3M6Mjoib24iO3M6MTc6ImJsb2dfaW5kZXhfbGF5b3V0IjtzOjEzOiJyaWdodF9zaWRlYmFyIjtzOjE4OiJibG9nX2luZGV4X3NpZGViYXIiO3M6MTg6ImN1c3RvbS1ibG9nc2lkZWJhciI7czoxNjoiYmxvZ19wb3N0X2xheW91dCI7czoxMzoicmlnaHRfc2lkZWJhciI7czoxNzoiYmxvZ19wb3N0X3NpZGViYXIiO3M6MTg6ImN1c3RvbS1ibG9nc2lkZWJhciI7czoxNToicG9zdF9wYWdpbmF0aW9uIjtzOjY6ImFycm93cyI7czoxMzoidXNlcl9zaWRlYmFycyI7YToyOntpOjE7YToyOntzOjU6InRpdGxlIjtzOjEyOiJCbG9nIFNpZGViYXIiO3M6MTE6ImRlc2NyaXB0aW9uIjtzOjI1OiJUaGlzIGlzIHRoZSBibG9nIHNpZGViYXIuIjt9aTowO2E6Mjp7czo1OiJ0aXRsZSI7czoxNToiQ29udGFjdCBTaWRlYmFyIjtzOjExOiJkZXNjcmlwdGlvbiI7czo0MjoiVGhpcyBpcyB0aGUgc2lkZWJhciBmb3IgY29udGFjdCBwYWdlIGJsb2NrIjt9fXM6MTA6ImJsb2dfc3R5bGUiO3M6NDoiZGFyayI7czoxMDoicGFnZV9zdHlsZSI7czo0OiJkYXJrIjtzOjE1OiJwb3J0Zm9saW9fc3R5bGUiO3M6NDoiZGFyayI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiNlYzAwNWYiO3M6OToiYm9keV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjE6ImhlYWRpbmdzX2RlZmF1bHRfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE3OiJoZWFkaW5nc19hbHRfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE1OiJibG9ja3F1b3RlX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxNzoic3BsYXNoX2ludHJvX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMDoic3BsYXNoX2hlYWRsaW5lX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMzoic3BsYXNoX2Rlc2NyaXB0aW9uX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMDoic3BsYXNoX2ZlZWRiYWNrX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxODoic2VjdGlvbl90aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjQ6InNlY3Rpb25fdGl0bGVfc21hbGxfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjIxOiJzZWN0aW9uX3N1YnRpdGxlX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyNzoic2VjdGlvbl9zdWJ0aXRsZV9zbWFsbF9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6Mjg6InNlY3Rpb25fc2VwYXJhdG9yX3RpdGxlX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czozNDoic2VjdGlvbl9zZXBhcmF0b3JfdGl0bGVfc21hbGxfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjE1OiJwYWdlX3RpdGxlX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMToicGFnZV90aXRsZV9zbWFsbF9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MjA6Im1haW5fbmF2X2FuY2hvcl9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTY6ImZvb3Rlcl90ZXh0X2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyNDoiZm9vdGVyX3dpZGdldF90aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6ODoiYnRuX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxNToicG9zdF90aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MzA6InBvc3RfY29tbWVudHNfcmVwbHlfdGl0bGVfZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjI0OiJwb3N0X2NvbW1lbnRzX2NvdW50X2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMzoicG9zdF9jb21tZW50c19uYW1lX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMDoidGVhbV9wb3B1cF9uYW1lX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMDoidGVhbV9wb3B1cF9yb2xlX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyMzoicHJpY2luZ190YWJsZV9uYW1lX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyNDoicHJpY2luZ190YWJsZV9wcmljZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MzY6InByaWNpbmdfdGFibGVfcHJpY2VfZGVzY3JpcHRpb25fZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjI4OiJjYWxsX3RvX2FjdGlvbl9oZWFkbGluZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTk6ImNvdW50ZXJfbnVtYmVyX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoyNToic2xpZGVyX21lZGlhX2NhcHRpb25fZm9udCI7YToyOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO3M6MTI6ImZvbnQtdmFyaWFudCI7czowOiIiO31zOjIyOiJyZWNlbnRfcG9zdF90aXRsZV9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTY6InRlc3RpbW9uaWFsX2ZvbnQiO2E6Mjp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjt9czoxNToidHdlZXRfdGV4dF9mb250IjthOjI6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMjoiZm9udC12YXJpYW50IjtzOjA6IiI7fXM6MTg6ImluY2x1ZGVfdHd0dHJfdGV4dCI7czozOiJvZmYiO3M6MTI6ImNvbnN1bWVyX2tleSI7czowOiIiO3M6MTU6ImNvbnN1bWVyX3NlY3JldCI7czowOiIiO3M6MTI6ImFjY2Vzc190b2tlbiI7czowOiIiO3M6MTk6ImFjY2Vzc190b2tlbl9zZWNyZXQiO3M6MDoiIjtzOjE1OiJlbnZhdG9fdXNlcm5hbWUiO3M6MDoiIjtzOjE0OiJlbnZhdG9fYXBpX2tleSI7czowOiIiO3M6MTg6Iml0ZW1fcHVyY2hhc2VfY29kZSI7czowOiIiO3M6MTY6ImVuYWJsZV9wcmVsb2FkZXIiO3M6Mjoib24iO3M6MTU6InByZWxvYWRlcl9zdHlsZSI7czo0OiJkYXJrIjtzOjc6ImZhdmljb24iO3M6MDoiIjtzOjEwOiJjdXN0b21fY3NzIjtzOjA6IiI7fQ==', 
				'frontpage_displays' => array(
					'show_on_front'  => 'page', 
					'page_on_front'  => 15, 
					'page_for_posts' => 92
				), 
				'nav_menu_locations' => array(
					'main-menu' => 'the-menu'
				)
			)
		)
	));
}
endif;
add_filter( 'youxi_demo_importer_demos', 'hydrogen_demo_content' );

if( ! function_exists( 'hydrogen_demo_importer_tasks' ) ):

function hydrogen_demo_importer_tasks( $tasks ) {
	unset( $tasks['customizer-options'] );
	return $tasks;
}
endif;
add_filter( 'youxi_demo_importer_tasks', 'hydrogen_demo_importer_tasks' );