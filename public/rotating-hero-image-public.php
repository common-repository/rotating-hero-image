<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    rotating-hero-image
 * @subpackage rotating-hero-image/public
 * @author     Webstix <testing@webstix.com>
 */

class display_rotating_hero_image{

    public function __construct($atts) {

        //add_action( 'wp_enqueue_scripts', 'wsxhi_custom_style',99 );

        RHI_FrontStyle();
        RHI_HeroImage($atts);

    }
}

/**
 * Frontend custom stylesheet.
*/
function RHI_FrontStyle(){
    wp_enqueue_style( 'custom_wsxhi_wp_public', plugin_dir_url( __FILE__ ).'css/custom.css', array(), '1.0.0' );
}

/**
 *  Create hero_image custom post type
*/

function RHI_HeroImage($atts){
    
    $rhi_show_banner_title      = get_option( 'rhi_show_banner_title');
    $rhi_show_banner_text       = get_option( 'rhi_show_banner_text');
    $rhi_show_banner_button     = get_option( 'rhi_show_banner_button');
    $rhi_width                  = get_option( 'rhi_width');
    $rhi_height                 = get_option( 'rhi_height');
    $rhi_title_font_style       = get_option( 'rhi_title_font_style');
    $rhi_banner_text_font_style = get_option( 'rhi_banner_text_font_style');
    $rhi_button_color           = get_option( 'rhi_button_color');
    $rhi_button_text_color      = get_option( 'rhi_button_text_color');
    $rhi_title_font_color       = get_option( 'rhi_title_font_color');
    $rhi_banner_text_font_color = get_option( 'rhi_banner_text_font_color');
    $rhi_opacity                = get_option( 'rhi_opacity');
    $text_align                 = get_option( 'rhi_banner_text_align');
    $a = shortcode_atts( array(
        'catid' => 'catid',
    ), $atts );

     
      $args= array(
        'post_type'      => 'hero_image',
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'asc',
        'posts_per_page' => -1,
        'orderby'        => 'asc'
    );

    if($a['catid'] != 'catid'):
        $args['tax_query'] = array(
            array (
                'taxonomy' => 'wsxhi_categories',
                'field' => 'id',
                'terms' => array($a['catid']),
            )
        );
    endif;
    $loop= new WP_Query( $args);
    
    while ( $loop->have_posts() ) : $loop->the_post(); global $post;
    $hero_postid[]=$post->ID;
    endwhile;
    if (empty($hero_postid)) {
        if(!empty($a['catid'])){
            if($a['catid']=='catid'){
                echo wp_kses_post("<p class='clsRHINoCat'>No hero image found</p>");
            }
            else{
                echo wp_kses_post("<p class='clsRHINoCat'>No hero image found for the category id: ".esc_attr($a['catid'])."</p>");
            }
        }
    }
    else
    {
    $current_postid = function ($hour) use ($hero_postid) {
        $index = $hour / get_option('rhi_time_interval') % count($hero_postid);
        return $hero_postid[$index];
    };

    $currentHour = date('G');
    
    $post = get_post($current_postid($currentHour)); //assuming $id has been initialized
    setup_postdata($post);
    $featured_img_url = get_the_post_thumbnail_url();
    $button_text = get_post_meta($post->ID, 'button_text', true);
    $button_link = get_post_meta($post->ID, 'button_link', true);
    $link_type   = get_post_meta($post->ID, 'link_type', true);
    $the_title=get_the_title();
    $the_content=get_the_content();
    $target = '';
    if($link_type == 'clsExternal') {
        $target = "target='_blank'";
    }

    $image_id = get_post_thumbnail_id();
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
    
    $close_banner_title = '';
    $close_banner_text = '';
    $open_banner_title ='<';
    if(!empty($rhi_title_font_style))
    {
        $open_banner_title .=$rhi_title_font_style;
    }
    if(!empty($rhi_title_font_color))
    {
        $open_banner_title .=' style="color:'.$rhi_title_font_color.'"';
    }
    $open_banner_title .='>';
    $close_banner_title .='</'.$rhi_title_font_style.'>';

    $open_banner_text ='<';
    if(!empty($rhi_banner_text_font_style))
    {
        $open_banner_text .=$rhi_banner_text_font_style;
    }
    if(!empty($rhi_banner_text_font_color))
    {
        $open_banner_text .=' style="color:'.$rhi_banner_text_font_color.'"';
    }
    $open_banner_text .='>';
    $close_banner_text .='</'.$rhi_banner_text_font_style.'>';

    $open_banner_button ='<a';
    if(!empty($button_link))
    {
        $open_banner_button .=' href="'.esc_url($button_link).'" class="Herobtn" style="text-decoration: none;';
    }
    else{
        $open_banner_button .=' href="#" class="Herobtn" style="text-decoration: none;';
    }

    if(!empty($rhi_button_color))
    {
        $open_banner_button .='background:'.$rhi_button_color.';';
    }

    if(!empty($rhi_button_text_color))
    {
        $open_banner_button .='color:'.$rhi_button_text_color.';';
    }
    if(!empty($target))
    {
        $open_banner_button .='" '.$target;
    }
    else{
    $open_banner_button .='"';
    }
    $open_banner_button .='>';
    $close_banner_button ='</a>';

            ?>
        
        <div class="clsHeroImage" style="background-image: url(<?php  if(!empty($featured_img_url)) echo esc_url($featured_img_url);?>);background-color: rgba(255, 255, 255, <?php  if(!empty($rhi_opacity)) echo esc_attr($rhi_opacity); ?>); background-size: cover;background-repeat:no-repeat;background-blend-mode: overlay;height:<?php if(!empty($rhi_height)) echo esc_attr($rhi_height); ?>px; width:<?php if(!empty($rhi_width)) echo esc_attr($rhi_width); ?>%;text-align: <?php if(!empty(get_option('rhi_banner_text_align'))) echo esc_attr(get_option('rhi_banner_text_align'));?>;">
            
            <div class="Bannercontainer">
                  <?php 
                  if($rhi_show_banner_title == 'Yes'): 
                    if(!empty($open_banner_title)) echo wp_kses_post($open_banner_title); 
                    if(!empty($the_title)) echo wp_kses_post($the_title); 
                    if(!empty($close_banner_title)) echo wp_kses_post( $close_banner_title); 
                  endif; 
                  
                  if($rhi_show_banner_text == 'Yes'): 
                    if(!empty($open_banner_text)) echo wp_kses_post($open_banner_text); 
                    if(!empty($the_content)) echo wp_kses_post($the_content); 
                    if(!empty($close_banner_text)) echo wp_kses_post( $close_banner_text);
                  endif; 
                  
                  if($rhi_show_banner_button == 'Yes'): 
                    if(!empty($open_banner_button)) echo wp_kses_post( $open_banner_button); 
                    if(!empty($button_text)) echo wp_kses_post($button_text); 
                    if(!empty($close_banner_button)) echo wp_kses_post($close_banner_button);
                  endif; 
                  ?>
            </div>
        </div>
            
            <?php
    }
    wp_reset_postdata();
}

