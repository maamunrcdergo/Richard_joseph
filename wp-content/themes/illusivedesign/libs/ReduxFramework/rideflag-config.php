<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
add_filter('add_illusive_theme_option', 'rideflag_theme_options');

function rideflag_theme_options($sections) {
    
    $sections[] = array(
        'title' => __('Join Form', ILLUSIVE_THEME),
        'id' => 'rideflag-join-form',
        'icon' => 'el el-group',
        'fields' => array(
            array(
                'id' => 'joinform_shortcode',
                'type' => 'text',
                'title' => __('Form Shortcode', ILLUSIVE_THEME),                
                'placeholder'    => '[contact-form-7 id="1" title="Join Us"]',
            ),    
            array(
                'id' => 'joinform_title',
                'type' => 'text',
                'title' => __('Block title', ILLUSIVE_THEME),                
                'placeholder'    => 'Join RideFlag',
            ),  
            array(
                'id' => 'joinform_prefix',
                'type' => 'textarea',
                'title' => __('Block Text', ILLUSIVE_THEME),                
                'placeholder'    => '',
            ),  
        )
    );
    $sections[] = array(
        'title' => __('Press Kit', ILLUSIVE_THEME),
        'id' => 'rideflag-press-kit',
        'icon' => 'el el-podcast',
        'fields' => array(
            array(
                'id' => 'press_kit_title',
                'type' => 'text',
                'title' => __('Press Kit Title', ILLUSIVE_THEME),                
                'default'    => 'Press Kit',
            ),  
            array(
                'id' => 'press_kit_desc',
                'type' => 'textarea',
                'title' => __('Press Kit Description', ILLUSIVE_THEME),                
                'default'    => '',
            ),   
            array(
                'id'       => 'press_kit_logo',
                'type'     => 'media',
                'mode'     =>'png',
                'title'    => __( 'RideFlag Logo', ILLUSIVE_THEME ), 
                'subtitle'=>__( '.png format', ILLUSIVE_THEME ), 
                'url'=>TRUE,
                 'preview' =>TRUE,
            ),
            array(
                'id'       => 'press_kit_graphice',
                'type'     => 'media',
                'url'=>TRUE,
                'preview' =>FALSE,
                'mode'     =>'zip',
                'title'    => __( 'RideFlag Graphics', ILLUSIVE_THEME ),               
            ),
            array(
                'id'       => 'press_kit_releases',
                'type'     => 'media',
                'url'=>TRUE,
                'preview' =>FALSE,
                'mode'     =>'pdf',
                'title'    => __( 'Press Releases', ILLUSIVE_THEME ),               
            ),
        )
    );
    $sections[] = array(
        'title' => __('Our Team', ILLUSIVE_THEME),
        'id' => 'rideflag-team-member',
        'icon' => 'el el-group-alt',
        'fields' => array(
            array(
                'id' => 'team_block_title',
                'type' => 'text',
                'title' => __('Block Title', ILLUSIVE_THEME),                
                'default'    => 'Our Team',
            ),
            array(
                'id' => 'team_post_type',
                'type' => 'select',
                'title' => __('Content Type', ILLUSIVE_THEME),                
                'data'    => 'post_type',
            ), 
            array(
                'id' => 'team_grid_col_sm',
                'type' => 'select',
                'title' => __('Grid Column Small Device', ILLUSIVE_THEME),
                'options'=>array(
                    '12'=>'One Column',
                    '6'=>'Two Column',
                    '4'=>'Three Column',
                    '3'=>'Four Column',
                    '2'=>'Six Column',
                ),
                'default'    => '4',
            ),
            array(
                'id' => 'team_grid_col',
                'type' => 'select',
                'title' => __('Grid Column', ILLUSIVE_THEME),
                'options'=>array(
                    '12'=>'One Column',
                    '6'=>'Two Column',
                    '4'=>'Three Column',
                    '3'=>'Four Column',
                    '2'=>'Six Column',
                ),
                'default'    => '4',
            ),
            array(
                'id' => 'team_block_content',
                'type' => 'editor',
                'title' => __('Block Content', ILLUSIVE_THEME),                
                'default'    => '',
            ),
        )
    );
    $sections[] = array(
        'title' => __('Cost Calculator', ILLUSIVE_THEME),
        'id' => 'rideflag-cost-calculator',
        'icon' => 'el el-car',
        'fields' => array(
            array(
                'id' => 'calculator_block_title',
                'type' => 'text',
                'title' => __('Block Title', ILLUSIVE_THEME),                
                'default'    => 'Commuting Cost Calculator',
            ),
            array(
                'id' => 'calculator_block_content',
                'type' => 'editor',
                'title' => __('Block Content', ILLUSIVE_THEME),                
                'default'    => '',
            ),
        )
    );
    return $sections;
}
