<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'header',
        'title'       => __( 'Header', 'youxi' )
      ),
      array(
        'id'          => 'footer',
        'title'       => __( 'Footer', 'youxi' )
      ),
      array(
        'id'          => 'blog_titles',
        'title'       => __( 'Blog Titles', 'youxi' )
      ),
      array(
        'id'          => 'blog_elements',
        'title'       => __( 'Blog Elements', 'youxi' )
      ),
      array(
        'id'          => 'blog_layout',
        'title'       => __( 'Blog Layout', 'youxi' )
      ),
      array(
        'id'          => 'sidebar',
        'title'       => __( 'Custom Sidebars', 'youxi' )
      ),
      array(
        'id'          => 'style',
        'title'       => __( 'Style', 'youxi' )
      ),
      array(
        'id'          => 'font',
        'title'       => __( 'Font', 'youxi' )
      ),
      array(
        'id'          => 'twitter',
        'title'       => __( 'Twitter', 'youxi' )
      ),
      array(
        'id'          => 'envato_credentials',
        'title'       => __( 'Envato Credentials', 'youxi' )
      ),
      array(
        'id'          => 'miscs',
        'title'       => __( 'Miscellaneous', 'youxi' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'main_logo',
        'label'       => __( 'Logo', 'youxi' ),
        'desc'        => __( 'Choose here the logo to display on the header.', 'youxi' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_style',
        'label'       => __( 'Header Style', 'youxi' ),
        'desc'        => __( 'Choose here the custom style to apply to the header.', 'youxi' ),
        'std'         => '0',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_layout',
        'label'       => __( 'Header Layout', 'youxi' ),
        'desc'        => __( 'Choose here the main header layout.', 'youxi' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'normal',
            'label'       => __( 'Normal', 'youxi' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_fixed',
            'label'       => __( 'Top Fixed', 'youxi' ),
            'src'         => ''
          ),
          array(
            'value'       => 'bottom_fixed',
            'label'       => __( 'Bottom Fixed', 'youxi' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'footer_text',
        'label'       => __( 'Footer Text', 'youxi' ),
        'desc'        => __( 'Type here the text to show at the bottom of the footer.', 'youxi' ),
        'std'         => 'Copyright © 2008-2014. <a href="#">Hydrogen Studio</a>. All Rights Reserved.',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_layout',
        'label'       => __( 'Footer Layout', 'youxi' ),
        'desc'        => __( 'Choose here the layout of the footer.', 'youxi' ),
        'std'         => 'logo_only',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'logo',
            'label'       => __( 'Logo', 'youxi' ),
            'src'         => ''
          ),
          array(
            'value'       => 'widgets',
            'label'       => __( 'Widgets', 'youxi' ),
            'src'         => ''
          ),
          array(
            'value'       => 'logo_widgets',
            'label'       => __( 'Logo - Widgets', 'youxi' ),
            'src'         => ''
          ),
          array(
            'value'       => 'widgets_logo',
            'label'       => __( 'Widgets - Logo', 'youxi' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'footer_logo',
        'label'       => __( 'Footer Logo', 'youxi' ),
        'desc'        => __( 'Choose here the logo to display on the footer.', 'youxi' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_layout:not(widgets)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_logo_width',
        'label'       => __( 'Footer Logo Width', 'youxi' ),
        'desc'        => __( 'Specify here the width of the footer logo.', 'youxi' ),
        'std'         => '100',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '60,160,10',
        'class'       => '',
        'condition'   => 'footer_layout:not(widgets)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_widgets_cols',
        'label'       => __( 'Footer Widgets Columns', 'youxi' ),
        'desc'        => __( 'Choose here the number of columns to show on the footer widget area.', 'youxi' ),
        'std'         => '',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,4,1',
        'class'       => '',
        'condition'   => 'footer_layout:not(logo)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_icons',
        'label'       => __( 'Footer Social Icons', 'youxi' ),
        'desc'        => __( 'Enter here a list of social profiles to display on the footer', 'youxi' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'url',
            'label'       => __( 'URL', 'youxi' ),
            'desc'        => __( 'Enter here the social profile URL.', 'youxi' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'icon',
            'label'       => __( 'Icon', 'youxi' ),
            'desc'        => __( 'Choose here the social profile icon.', 'youxi' ),
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'blog_title',
        'label'       => __( 'Index Title', 'youxi' ),
        'desc'        => __( 'Type here the blog index page title.', 'youxi' ),
        'std'         => 'Blog',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_subtitle',
        'label'       => __( 'Index Subtitle', 'youxi' ),
        'desc'        => __( 'Type here the blog index page subtitle.', 'youxi' ),
        'std'         => 'Read here the stories of our daily life.',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_category_title',
        'label'       => __( 'Category Title', 'youxi' ),
        'desc'        => __( 'Type here the blog category archive page title. Use <strong>{category}</strong> for the category name.', 'youxi' ),
        'std'         => 'Category: {category}',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_category_subtitle',
        'label'       => __( 'Category Subtitle', 'youxi' ),
        'desc'        => __( 'Type here the blog category archive page subtitle. Use <strong>{category}</strong> for the category name.', 'youxi' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_tag_title',
        'label'       => __( 'Tag Title', 'youxi' ),
        'desc'        => __( 'Type here the blog tag archive page title. Use <strong>{tag}</strong> for the tag name.', 'youxi' ),
        'std'         => 'Posts Tagged ‘{tag}’',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_tag_subtitle',
        'label'       => __( 'Tag Subtitle', 'youxi' ),
        'desc'        => __( 'Type here the blog tag archive page subtitle. Use <strong>{tag}</strong> for the tag name.', 'youxi' ),
        'std'         => 'We are pleased to present below all posts tagged with ‘{tag}’.',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_author_title',
        'label'       => __( 'Author Title', 'youxi' ),
        'desc'        => __( 'Type here the blog author archive page title. Use <strong>{author}</strong> for the author name.', 'youxi' ),
        'std'         => 'Posts by {author}',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_author_subtitle',
        'label'       => __( 'Author Subtitle', 'youxi' ),
        'desc'        => __( 'Type here the blog author archive page subtitle. Use <strong>{author}</strong> for the author name.', 'youxi' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_date_title',
        'label'       => __( 'Date Title', 'youxi' ),
        'desc'        => __( 'Type here the blog date based archive page title. Use <strong>{date}</strong> for the date.', 'youxi' ),
        'std'         => 'Archive for {date}',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_date_subtitle',
        'label'       => __( 'Date Subtitle', 'youxi' ),
        'desc'        => __( 'Type here the blog date based archive page subtitle. Use <strong>{date}</strong> for the date.', 'youxi' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_search_title',
        'label'       => __( 'Search Title', 'youxi' ),
        'desc'        => __( 'Type here the blog search page title. Use <strong>{query}</strong> for the search query.', 'youxi' ),
        'std'         => 'Search',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_search_subtitle',
        'label'       => __( 'Search Subtitle', 'youxi' ),
        'desc'        => __( 'Type here the blog search page subtitle. Use <strong>{query}</strong> for the search query.', 'youxi' ),
        'std'         => 'Search results for ‘{query}’',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_time_format',
        'label'       => __( 'Time Format', 'youxi' ),
        'desc'        => __( 'Enter here the blog time format. Read this for reference: <a href="http://codex.wordpress.org/Function_Reference/the_time for reference">http://codex.wordpress.org/Function_Reference/the_time</a>', 'youxi' ),
        'std'         => 'F j, Y',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_index_meta_format',
        'label'       => __( 'Index Meta Format', 'youxi' ),
        'desc'        => __( 'Enter here the post index meta text by using the following placeholders:
<ul>
<li><strong>{author}:</strong> The post author name</li>
<li><strong>{datetime}:</strong> The post date and time as specified by Blog Time Format</li>
<li><strong>{comments}:</strong> The post\'s number of comments</li>
<li><strong>{categories}:</strong> The post categories</li>
<li><strong>{tags}:</strong> The post tags</li>
<li><strong>{dot}:</strong> A dot used as separator</li>
</ul>', 'youxi' ),
        'std'         => 'Posted by {author} on {datetime} with {comments}',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_post_meta_format',
        'label'       => __( 'Single Post Meta Format', 'youxi' ),
        'desc'        => __( 'Enter here the single post meta text by using the following placeholders:
<ul>
<li><strong>{author}:</strong> The post author name</li>
<li><strong>{datetime}:</strong> The post date and time as specified by Blog Time Format</li>
<li><strong>{comments}:</strong> The post\'s number of comments</li>
<li><strong>{categories}:</strong> The post categories</li>
<li><strong>{tags}:</strong> The post tags</li>
<li><strong>{dot}:</strong> A dot used as separator</li>
</ul>', 'youxi' ),
        'std'         => 'by {author} &dash; {datetime}',
        'type'        => 'text',
        'section'     => 'blog_titles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_show_addthis',
        'label'       => __( 'Show AddThis', 'youxi' ),
        'desc'        => __( 'Specify whether to show the AddThis sharing option below your blog post.', 'youxi' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'blog_elements',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_always_show_author',
        'label'       => __( 'Always Show Author', 'youxi' ),
        'desc'        => __( 'Specify whether to always show the post author even on single author blogs.', 'youxi' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'blog_elements',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_index_layout',
        'label'       => __( 'Index Layout', 'youxi' ),
        'desc'        => __( 'Choose here the layout of the blog index page.', 'youxi' ),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'blog_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'fullwidth',
            'label'       => __( 'Fulllwidth', 'youxi' ),
            'src'         => 'OT_THEME_URL/admin/assets/img/fullwidth.png'
          ),
          array(
            'value'       => 'left_sidebar',
            'label'       => __( 'Left Sidebar', 'youxi' ),
            'src'         => 'OT_THEME_URL/admin/assets/img/left-sidebar.png'
          ),
          array(
            'value'       => 'right_sidebar',
            'label'       => __( 'Right Sidebar', 'youxi' ),
            'src'         => 'OT_THEME_URL/admin/assets/img/right-sidebar.png'
          )
        )
      ),
      array(
        'id'          => 'blog_index_sidebar',
        'label'       => __( 'Index Sidebar', 'youxi' ),
        'desc'        => __( 'Choose here the sidebar to display on the blog index page.', 'youxi' ),
        'std'         => '',
        'type'        => 'sidebar-select',
        'section'     => 'blog_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'blog_index_layout:not(fullwidth)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_post_layout',
        'label'       => __( 'Single Post Layout', 'youxi' ),
        'desc'        => __( 'Choose here the layout of the blog post page (can be overriden on each individual post).', 'youxi' ),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'blog_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'fullwidth',
            'label'       => __( 'Fullwidth', 'youxi' ),
            'src'         => 'OT_THEME_URL/admin/assets/img/fullwidth.png'
          ),
          array(
            'value'       => 'left_sidebar',
            'label'       => __( 'Left Sidebar', 'youxi' ),
            'src'         => 'OT_THEME_URL/admin/assets/img/left-sidebar.png'
          ),
          array(
            'value'       => 'right_sidebar',
            'label'       => __( 'Right Sidebar', 'youxi' ),
            'src'         => 'OT_THEME_URL/admin/assets/img/right-sidebar.png'
          )
        )
      ),
      array(
        'id'          => 'blog_post_sidebar',
        'label'       => __( 'Single Post Sidebar', 'youxi' ),
        'desc'        => __( 'Choose here the sidebar to display on the blog post page.', 'youxi' ),
        'std'         => '',
        'type'        => 'sidebar-select',
        'section'     => 'blog_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'blog_post_layout:not(fullwidth)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_pagination',
        'label'       => __( 'Pagination', 'youxi' ),
        'desc'        => __( 'Choose here the type of the blog post pagination.', 'youxi' ),
        'std'         => 'arrows',
        'type'        => 'select',
        'section'     => 'blog_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'arrows',
            'label'       => __( 'Arrows', 'youxi' ),
            'src'         => ''
          ),
          array(
            'value'       => 'numbered',
            'label'       => __( 'Numbered', 'youxi' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'user_sidebars',
        'label'       => __( 'Sidebar', 'youxi' ),
        'desc'        => __( 'Enter here an unlimited number of sidebars to use throughout the theme.', 'youxi' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'description',
            'label'       => __( 'Sidebar Description', 'youxi' ),
            'desc'        => __( 'Type here the sidebar description.', 'youxi' ),
            'std'         => '',
            'type'        => 'textarea-simple',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'blog_style',
        'label'       => __( 'Blog Style', 'youxi' ),
        'desc'        => __( 'Choose here the base custom style to apply to all blog index pages.', 'youxi' ),
        'std'         => '0',
        'type'        => 'select',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_style',
        'label'       => __( 'Page Style', 'youxi' ),
        'desc'        => __( 'Choose here the base custom style to apply to all pages.', 'youxi' ),
        'std'         => '0',
        'type'        => 'select',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'portfolio_style',
        'label'       => __( 'Portfolio Style', 'youxi' ),
        'desc'        => __( 'Choose here the base custom style to apply to all portfolio pages.', 'youxi' ),
        'std'         => '0',
        'type'        => 'select',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'accent_color',
        'label'       => __( 'Accent Color', 'youxi' ),
        'desc'        => __( 'Pick here the general accent color to be applied throughout the site.', 'youxi' ),
        'std'         => '#ec005f',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_styles',
        'label'       => __( 'Custom Styles', 'youxi' ),
        'desc'        => __( 'Define here your own custom styles that can be applied and reused throughout the site.', 'youxi' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'header_bg',
            'label'       => __( 'Header Background Color', 'youxi' ),
            'desc'        => __( 'Specify the custom header background color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'header_nav_link_color',
            'label'       => __( 'Navigation Link Color', 'youxi' ),
            'desc'        => __( 'Specify the custom navigation link color.', 'youxi' ),
            'std'         => '#111',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'header_sub_nav_toggle_color',
            'label'       => __( 'Navigation Submenu Arrow Color', 'youxi' ),
            'desc'        => __( 'Specify the navigation submenu arrow color.', 'youxi' ),
            'std'         => '#777',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'footer_background',
            'label'       => __( 'Footer Background Color', 'youxi' ),
            'desc'        => __( 'Specify the footer background color.', 'youxi' ),
            'std'         => '#111',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'footer_color',
            'label'       => __( 'Footer Text Color', 'youxi' ),
            'desc'        => __( 'Specify the footer text color.', 'youxi' ),
            'std'         => '#666',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'footer_link_color',
            'label'       => __( 'Footer Link Color', 'youxi' ),
            'desc'        => __( 'Specify the color of links in footer.', 'youxi' ),
            'std'         => '#bbb',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'footer_link_hover_color',
            'label'       => __( 'Footer Link Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the hover color of links in footer.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'footer_social_list_background',
            'label'       => __( 'Footer Social List Background Color', 'youxi' ),
            'desc'        => __( 'Specify the footer social list background color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'theme_color',
            'label'       => __( 'Base Text Color', 'youxi' ),
            'desc'        => __( 'Specify the base text color.', 'youxi' ),
            'std'         => '#444',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'theme_muted_color',
            'label'       => __( 'Muted Text Color', 'youxi' ),
            'desc'        => __( 'Specify the muted text color.', 'youxi' ),
            'std'         => '#999',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'theme_headings_color',
            'label'       => __( 'Headings Text Color', 'youxi' ),
            'desc'        => __( 'Specify the headings text color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'theme_headings_small_color',
            'label'       => __( 'Headings Subtitle Text Color', 'youxi' ),
            'desc'        => __( 'Specify the headings subtitle text color.', 'youxi' ),
            'std'         => '#555',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'background_color',
            'label'       => __( 'Base Background Color', 'youxi' ),
            'desc'        => __( 'Specify the base background color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'module_hover_color',
            'label'       => __( 'Module Hover Text Color', 'youxi' ),
            'desc'        => __( 'Specify the modules hover background color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'icon_box_icon_hover_color',
            'label'       => __( 'Icon Box Icon Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the icon box shortcode icon hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'team_overlay_bg',
            'label'       => __( 'Team Overlay Background Color', 'youxi' ),
            'desc'        => __( 'Specify the team shortcode overlay background color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'team_overlay_bg_opacity',
            'label'       => __( 'Team Overlay Background Opacity', 'youxi' ),
            'desc'        => __( 'Specify the team shortcode overlay background opacity.', 'youxi' ),
            'std'         => '0.5',
            'type'        => 'numeric-slider',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '0,1,0.1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'team_popup_link_color',
            'label'       => __( 'Team Popup Link Color', 'youxi' ),
            'desc'        => __( 'Specify the team shortcode popup link color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'team_popup_link_hover_color',
            'label'       => __( 'Team Popup Link Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the team shortcode popup link hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'team_popup_link_hover_bg',
            'label'       => __( 'Team Popup Link Hover Background Color', 'youxi' ),
            'desc'        => __( 'Specify the team shortcode popup link hover background color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'counter_label_color',
            'label'       => __( 'Counter Label Text Color', 'youxi' ),
            'desc'        => __( 'Specify the counter shortcode label color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'testimonial_blockquote_color',
            'label'       => __( 'Testimonial Blockquote Text Color', 'youxi' ),
            'desc'        => __( 'Specify the testimonial shortcode text color.', 'youxi' ),
            'std'         => '#444',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'testimonial_author_color',
            'label'       => __( 'Testimonial Author Color', 'youxi' ),
            'desc'        => __( 'Specify the testimonial shortcode author name color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'tweet_text_color',
            'label'       => __( 'Twitter Text Color', 'youxi' ),
            'desc'        => __( 'Specify the twitter shortcode text color.', 'youxi' ),
            'std'         => '#444',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'tweet_time_color',
            'label'       => __( 'Twitter Time Text Color', 'youxi' ),
            'desc'        => __( 'Specify the twitter shortcode time text color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'testimonial_slider_icon_color',
            'label'       => __( 'Testimonial Slider Icon Color', 'youxi' ),
            'desc'        => __( 'Specify the testimonial slider shortcode icon color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'tweet_slider_icon_color',
            'label'       => __( 'Twitter Slider Icon Color', 'youxi' ),
            'desc'        => __( 'Specify the twitter slider shortcode icon color.', 'youxi' ),
            'std'         => '',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'service_icon_color',
            'label'       => __( 'Service Icon Color', 'youxi' ),
            'desc'        => __( 'Specify the service shortcode icon color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'recent_post_read_link_color',
            'label'       => __( 'Recent Post Read Link Color', 'youxi' ),
            'desc'        => __( 'Specify the recent post shortcode read more link color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'recent_post_read_link_hover_color',
            'label'       => __( 'Recent Post Read Link Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the recent post shortcode read more link hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'recent_post_read_link_hover_bg',
            'label'       => __( 'Recent Post Read Link Hover Background Color', 'youxi' ),
            'desc'        => __( 'Specify the recent post shortcode read more link hover background color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_filter_color',
            'label'       => __( 'Project Filter Text Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode filter text color.', 'youxi' ),
            'std'         => '#444',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_filter_hover_color',
            'label'       => __( 'Project Filter Text Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode filter text hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_overlay_bg',
            'label'       => __( 'Project Overlay Background Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode project overlay background color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_overlay_bg_opacity',
            'label'       => __( 'Project Overlay Background Opacity', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode project overlay background opacity.', 'youxi' ),
            'std'         => '0.5',
            'type'        => 'numeric-slider',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '0,1,0.1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_action_links_color',
            'label'       => __( 'Project Links Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode action links color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_action_links_hover_color',
            'label'       => __( 'Project Links Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode action links hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_action_links_hover_bg',
            'label'       => __( 'Project Links Hover Background Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode action links background color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_load_color',
            'label'       => __( 'Project Load Button Icon Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode load button icon color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'project_load_hover_color',
            'label'       => __( 'Project Load Button Icon Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the portfolio shortcode load button icon hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'media_overlay_bg',
            'label'       => __( 'Media Overlay Background Color', 'youxi' ),
            'desc'        => __( 'Specify the media overlay background color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'media_overlay_bg_opacity',
            'label'       => __( 'Media Overlay Background Opacity', 'youxi' ),
            'desc'        => __( 'Specify the media overlay background opacity.', 'youxi' ),
            'std'         => '0.4',
            'type'        => 'numeric-slider',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '0,1,0.1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'media_link_color',
            'label'       => __( 'Media Link Color', 'youxi' ),
            'desc'        => __( 'Specify the media link color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'media_link_bg',
            'label'       => __( 'Media Link Background Color', 'youxi' ),
            'desc'        => __( 'Specify the media link background color.', 'youxi' ),
            'std'         => '#000',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'media_link_hover_color',
            'label'       => __( 'Media Link Hover Color', 'youxi' ),
            'desc'        => __( 'Specify the media link hover color.', 'youxi' ),
            'std'         => '#fff',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'custom_google_fonts',
        'label'       => __( 'Custom Google Fonts', 'youxi' ),
        'desc'        => __( 'Below you can customize the fonts used on several elements throughout the site by choosing a font from the Google Fonts directory.<br>
Choose a font family and optionally choose the font-variant. If you do not choose a font-variant, then the regular (400) font will be used.<br>
Leave the option blank to use the theme default font which you can see noted beside each option. Some options defaults to another option, while others have independent default font.', 'youxi' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_font',
        'label'       => __( 'Body Font', 'youxi' ),
        'desc'        => __( 'Choose here the body font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'headings_default_font',
        'label'       => __( 'Headings Default Font', 'youxi' ),
        'desc'        => __( 'Choose here the default heading style font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'headings_alt_font',
        'label'       => __( 'Headings Alternate Font', 'youxi' ),
        'desc'        => __( 'Choose here the alternative heading style font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blockquote_font',
        'label'       => __( 'Blockquote Font', 'youxi' ),
        'desc'        => __( 'Choose here the blockquote font family.<br>
<strong>Default:</strong> "Droid Serif", Georgia, Times, "Times New Roman", serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'splash_intro_font',
        'label'       => __( 'Splash Intro Font', 'youxi' ),
        'desc'        => __( 'Choose here the splash slider intro text font family.<br>
<strong>Default:</strong> Headings Default Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'splash_headline_font',
        'label'       => __( 'Splash Headline Font', 'youxi' ),
        'desc'        => __( 'Choose here the splash slider headline text font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'splash_description_font',
        'label'       => __( 'Splash Description Font', 'youxi' ),
        'desc'        => __( 'Choose here the splash slider description text font family.<br>
<strong>Default:</strong> Body Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'splash_feedback_font',
        'label'       => __( 'Splash Feedback Font', 'youxi' ),
        'desc'        => __( 'Choose here the splash feedback text font family.<br>
<strong>Default:</strong> Body Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'section_title_font',
        'label'       => __( 'Section Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the section title font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'section_title_small_font',
        'label'       => __( 'Section Title Subtitle Font', 'youxi' ),
        'desc'        => __( 'Choose here the section title subtitle font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'section_subtitle_font',
        'label'       => __( 'Section Subtitle Font', 'youxi' ),
        'desc'        => __( 'Choose here the section subtitle font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'section_subtitle_small_font',
        'label'       => __( 'Section Subtitle Subtitle Font', 'youxi' ),
        'desc'        => __( 'Choose here the section subtitle subtitle font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'section_separator_title_font',
        'label'       => __( 'Section Separator Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the section separator title font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'section_separator_title_small_font',
        'label'       => __( 'Section Separator Title Subtitle Font', 'youxi' ),
        'desc'        => __( 'Choose here the section separator title subtitle font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_title_font',
        'label'       => __( 'Page Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the page title font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_title_small_font',
        'label'       => __( 'Page Title Subtitle Font', 'youxi' ),
        'desc'        => __( 'Choose here the page title subtitle font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_nav_anchor_font',
        'label'       => __( 'Main Navigation Font', 'youxi' ),
        'desc'        => __( 'Choose here the main navigation links font family.<br>
<strong>Default:</strong> Body Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_text_font',
        'label'       => __( 'Footer Text Font', 'youxi' ),
        'desc'        => __( 'Choose here the footer text font family.<br>
<strong>Default:</strong> Body Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_widget_title_font',
        'label'       => __( 'Footer Widget Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the footer widget title font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'btn_font',
        'label'       => __( 'Button Font', 'youxi' ),
        'desc'        => __( 'Choose here the button font family.<br>
<strong>Default:</strong> Body Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_title_font',
        'label'       => __( 'Post Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the post title font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_comments_reply_title_font',
        'label'       => __( 'Post Comments Reply Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the post comments reply title font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_comments_count_font',
        'label'       => __( 'Post Comments Count Font', 'youxi' ),
        'desc'        => __( 'Choose here the post comments count font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_comments_name_font',
        'label'       => __( 'Post Comments Name Font', 'youxi' ),
        'desc'        => __( 'Choose here the post comments author name font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'team_popup_name_font',
        'label'       => __( 'Team Popup Name Font', 'youxi' ),
        'desc'        => __( 'Choose here the team shortcode popup member name font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'team_popup_role_font',
        'label'       => __( 'Team Popup Role Font', 'youxi' ),
        'desc'        => __( 'Choose here the team shortcode popup member role font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pricing_table_name_font',
        'label'       => __( 'Pricing Table Name Font', 'youxi' ),
        'desc'        => __( 'Choose here the pricing table shortcode name font family.<br>
<strong>Default:</strong> Headings Default Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pricing_table_price_font',
        'label'       => __( 'Pricing Table Price Font', 'youxi' ),
        'desc'        => __( 'Choose here the pricing table shortcode price font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pricing_table_price_description_font',
        'label'       => __( 'Pricing Table Price Description Font', 'youxi' ),
        'desc'        => __( 'Choose here the pricing table shortcode price description font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'call_to_action_headline_font',
        'label'       => __( 'Call to Action Headline Font', 'youxi' ),
        'desc'        => __( 'Choose here the call to action shortcode headline font family.<br>
<strong>Default:</strong> Headings Default Font', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'counter_number_font',
        'label'       => __( 'Counter Number Font', 'youxi' ),
        'desc'        => __( 'Choose here the counter shortcode number font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'slider_media_caption_font',
        'label'       => __( 'Slider Media Caption Font', 'youxi' ),
        'desc'        => __( 'Choose here the slider media caption font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'recent_post_title_font',
        'label'       => __( 'Recent Post Title Font', 'youxi' ),
        'desc'        => __( 'Choose here the recent post title shortcode font family.<br>
<strong>Default:</strong> "Novecento Sans Wide", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'testimonial_font',
        'label'       => __( 'Testimonial Font', 'youxi' ),
        'desc'        => __( 'Choose here the testimonial shortcode text font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tweet_text_font',
        'label'       => __( 'Tweet Text Font', 'youxi' ),
        'desc'        => __( 'Choose here the twitter shortcode text font family.<br>
<strong>Default:</strong> "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif', 'youxi' ),
        'std'         => '',
        'type'        => 'google-font',
        'section'     => 'font',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'include_twttr_text',
        'label'       => __( 'Include Twitter Text Plugin', 'youxi' ),
        'desc'        => __( 'Choose whether to load the twitter-text.js (https://github.com/twitter/twitter-text-js) library used for proper autolinking and extraction for URLs, usernames, lists, and hashtags. This will add an additional 35 kilobytes of script to load on your page. Just leave it off if you\'re not sure what this is for, or you don\'t need international language support on your Tweets.', 'youxi' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twitter_api_keys',
        'label'       => __( 'Twitter API Keys', 'youxi' ),
        'desc'        => __( 'Before using Twitter widgets throughout the site, you need to register your API keys by following the instructions below.
<ol>
  <li>Go to <a>http://dev.twitter.com/apps</a> and sign in with your Twitter account.</li>
  <li>Create a new application by clicking the button on the right hand side.</li>
  <li>Once you\'ve created the app, scroll down the application\'s details page to find the OAuth section.</li>
  <li>Copy the consumer secret and consumer key into the fields below.</li>
  <li>Then click the Create Access Token button at the bottom of the page.</li>
  <li>Copy the Access token and Access token secret and paste it into the fields below.</li>
</ol>', 'youxi' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'consumer_key',
        'label'       => __( 'Twitter API Consumer Key', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'consumer_secret',
        'label'       => __( 'Twitter API Consumer Secret', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'access_token',
        'label'       => __( 'Twitter API Access Token', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'access_token_secret',
        'label'       => __( 'Twitter API Access Token Secret', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'envato_credentials',
        'label'       => __( 'Envato Credentials', 'youxi' ),
        'desc'        => __( 'Enter your Envato Market credentials below to access the demo content importer and get automatic theme update notifications directly from WordPress admin.', 'youxi' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'envato_credentials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'envato_username',
        'label'       => __( 'Envato Username', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'envato_credentials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'envato_api_key',
        'label'       => __( 'Envato API Key', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'envato_credentials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'item_purchase_code',
        'label'       => __( 'Item Purchase Code', 'youxi' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'envato_credentials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_preloader',
        'label'       => __( 'Show Preloader', 'youxi' ),
        'desc'        => __( 'Choose here whether to show the website preloader.', 'youxi' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'miscs',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'preloader_style',
        'label'       => __( 'Preloader Style', 'youxi' ),
        'desc'        => __( 'Choose here the custom style to apply to the preloader.', 'youxi' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'miscs',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'enable_preloader:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'favicon',
        'label'       => __( 'Favicon', 'youxi' ),
        'desc'        => __( 'Upload here your favicon. Recommended formats are PNG/ICO', 'youxi' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'miscs',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_css',
        'label'       => __( 'Custom CSS', 'youxi' ),
        'desc'        => __( 'Specify here your custom CSS styles to be used throughout the site.', 'youxi' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'miscs',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}