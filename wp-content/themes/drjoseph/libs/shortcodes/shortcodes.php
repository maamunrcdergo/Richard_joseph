<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */

class illusiveShortcodes {

    function __construct() {
        add_shortcode('heading', array($this, 'heading'));
        add_shortcode('row', array($this, 'row'));
        add_shortcode('col', array($this, 'col'));
        add_shortcode('thumbs', array($this, 'thumbs'));
        add_shortcode('list', array($this, 'liststyle'));
        add_shortcode('featured_list', array($this, 'featured_list'));
        add_shortcode('font_strong', array($this, 'font_strong'));
        add_shortcode('faq', array($this, 'faq'));
    }

    public function heading($attrs, $contents) {
        $attrs = shortcode_atts(array(
            'type' => '1',
            'size' => '28px',
            'weight' => '700',
            'position' => '',
            'left' => '',
            'top' => '',
            'right' => '',
            'bottom' => '',
            'border' => '',
            'margin' => '0',
            'color' => '#000',
            'class' => '',
            'align'=>'left',
                ), $attrs, 'heading');
        $style = '';
        $style .=!empty($attrs['weight']) ? 'font-weight:' . $attrs['weight'] . ';' : '';
        $style .=!empty($attrs['position']) ? 'position:' . $attrs['position'] . ';' : '';
        $style .=!empty($attrs['left']) ? 'left:' . $attrs['left'] . ';' : '';
        $style .=!empty($attrs['top']) ? 'top:' . $attrs['top'] . ';' : '';
        $style .=!empty($attrs['right']) ? 'right:' . $attrs['right'] . ';' : '';
        $style .=!empty($attrs['bottom']) ? 'bottom:' . $attrs['bottom'] . ';' : '';
        $style .=!empty($attrs['border']) ? 'border:' . $attrs['border'] . ';' : '';
        $style .=!empty($attrs['margin']) ? 'margin:' . $attrs['margin'] . ';' : '';
        $style .=!empty($attrs['color']) ? 'color:' . $attrs['color'] . ';' : '';
        $style .=!empty($attrs['size']) ? 'font-size:' . $attrs['size'] . ';' : '';
        $style .=!empty($attrs['align']) ? 'text-align:' . $attrs['align'] . ';' : '';

        $class = 'ist-heading';
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;

        return sprintf('<h%1$s style="%2$s" class="%4$s">%3$s</h%1$s>', $attrs['type'], $style, $contents, $class);
    }

    public function row($attrs, $contents) {
        $attrs = shortcode_atts(array('class' => '',), $attrs, 'heading');
        $class = 'row ist-row';
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
        $contents = do_shortcode($contents);
        return sprintf('<div class="%1$s">%2$s</div>', $class, $contents);
    }

    public function col($attrs, $contents) {
        $attrs = shortcode_atts(
                array('class' => '', 'xs' => '', 'sm' => '', 'md' => '', 'lg' => '')
                , $attrs, 'heading');
        $class = 'ist-col';
        $class .=!empty($attrs['xs']) ? ' col-xs-' . $attrs['xs'] : '';
        $class .=!empty($attrs['sm']) ? ' col-sm-' . $attrs['sm'] : '';
        $class .=!empty($attrs['md']) ? ' col-md-' . $attrs['md'] : '';
        $class .=!empty($attrs['lg']) ? ' col-lg-' . $attrs['lg'] : '';

        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
        $contents = do_shortcode($contents);
        return sprintf('<div class="%1$s">%2$s</div>', $class, $contents);
    }

    public function thumbs($attrs, $contents) {
        $attrs = shortcode_atts(
                array('class' => '', 'src' => '', 'caption' => '', 'link' => '', 'title' => '')
                , $attrs, 'heading');
        $class = 'ist-thumbs thumbnail';
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
        if (empty($attrs['link'])) {
            $title = sprintf('<div class="caption"><h3>%s</h3></div>', $attrs['title']);
            $img = sprintf('<figure class="img-wrap"><img src="%1$s" alt="%2$s"/></figure>', $attrs['src'], $attrs['title']);
        } else {
            $title = sprintf('<h3><a class="img-wrap" href="%2$s" title="%1$s">%1$s</a></h3>', $attrs['title'], $attrs['link']);
            $img = sprintf('<a href="%3$s" title="%1$s"><img src="%2$s" alt="%1$s"/></a>', $attrs['title'], $attrs['src'], $attrs['link']);
        }
        $contents = wpautop($contents);
        $caption = sprintf('<div class="caption">%1$s %2$s</div>', $title, $contents);
        return sprintf('<div class="%1$s">%2$s %3$s </div>', $class, $img, $caption);
    }

    public function liststyle($attrs, $contents) {
        $attrs = shortcode_atts(
                array('style' => 'circle', 'class' => '')
                , $attrs, 'heading');
        $class = 'ist-list fa-ul';
        //$class = !empty($attrs['style']) ? $class . ' fa-' . $attrs['style'] : $class;
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
        //$contents = wpautop($contents);
        $li = '';
        if (!empty($contents)) {
            $contents = str_replace(array('<br>','<br />'), PHP_EOL, $contents);
            $list_array = explode(PHP_EOL, $contents);            
            foreach ($list_array as $list) {
                $list = trim($list);
                $li .=!empty($list) ? sprintf('<li><i class="fa-li fa fa-%2$s"></i> %1$s</li>', $list, $attrs['style']) : '';
            }
        }
        return sprintf('<ul class="%1$s">%2$s</ul>', $class, $li);
    }
    public function font_strong($attrs, $contents) {
        $attrs = shortcode_atts(
                array('size' => '', 'class' => '')
                , $attrs, 'heading');
        $class = 'ist-strong';
        //$class = !empty($attrs['style']) ? $class . ' fa-' . $attrs['style'] : $class;
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
       $contents = wpautop($contents);
       $style = (empty($attrs['size']))? '':'style="font-size:'.$attrs['size'].'"';
        return sprintf('<div class="%1$s" %3$s>%2$s</div>', $class, $contents, $style);
    }

    public function featured_list($attrs, $contents) {
        $attrs = shortcode_atts(
                array('title' => 'none', 'icon' => '', 'size' => '3x','align'=>'icon-left')
                , $attrs, 'heading');
        $class = 'ist-featured-list';
        //$class = !empty($attrs['style']) ? $class . ' fa-' . $attrs['style'] : $class;
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
        $contents = do_shortcode($contents);
        $coutput = '';
        $align_class = (empty($attrs['align']))? 'pull-left':$attrs['align'];
        if (!empty($attrs['icon']) && !filter_var($attrs['icon'], FILTER_VALIDATE_URL) === FALSE) {
            $coutput .= sprintf('<figure class="col-xs-12 col-sm-3 col-md-3 icon-wrp %3$s"><img src="%1$s" alt="%2$s" /></figure>', $attrs['icon'], $attrs['title'],$align_class);
            $coutput .= sprintf('<div class="col-xs-12 col-sm-9 col-md-9 ft-conttent"><h2 class="featured-title">%1$s</h2>%2$s</div>',$attrs['title'], $contents);
        } elseif (!empty($attrs['icon']) && filter_var($attrs['icon'], FILTER_VALIDATE_URL) === FALSE) {
            $coutput .= sprintf('<figure class="col-xs-12 col-sm-3 col-md-3 icon-wrp %3$s"><span class="fa %1$s %2$s"></span></figure>', $attrs['icon'], $attrs['size'], $align_class);
            $coutput .= sprintf('<div class="col-xs-12 col-sm-9 col-md-9 ft-conttent"><h2 class="featured-title">%1$s</h2>%2$s</div>', $attrs['title'], $contents);
        } else {
            $coutput .= sprintf('<div class="col-xs-12 col-sm-12 col-md-12 ft-conttent"><h2 class="featured-title">%1$s</h2>%2$s</div>', $attrs['title'], $contents);
        }
        return sprintf('<div class="row %1$s">%2$s</div>', $class, $coutput);
    }
    public function faq($attrs, $contents) {
        $attrs = shortcode_atts(
                array('ques' => '', 'open' => '0','class'=>'')
                , $attrs, 'heading');
        $class = 'ist-faq';
        //$class = !empty($attrs['style']) ? $class . ' fa-' . $attrs['style'] : $class;
        $class = !empty($attrs['class']) ? $class . ' ' . $attrs['class'] : $class;
        
       $is_open = !empty($attrs['open']) ? 'inactive':'active';
       $contents = wpautop($contents);
       
       $html = "";
       $html .= "<div class=\"{$class} ist-faq-wrap\">";
       $html .= "<div class=\"panel faq-panel panel-{$is_open}\">";
       $html .= "<div class=\"panel-heading\"><a href=\"javascript:void(0)\" class=\"panel-title\">{$attrs['ques']}</a></div>";
       $html .= "<div class=\"panel-body\">";
       $html .= do_shortcode($contents);
       $html .= "</div>";
       $html .= "</div>";
       $html .= "</div>";
       return $html;
    }
}

new illusiveShortcodes();
