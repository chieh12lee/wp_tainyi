<?php
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr)
{
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'div',
        'columns'    => 1,
        'size'       => 'medium',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order)
        $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif (!empty($exclude)) {
        $exclude = preg_replace('/[^0-9,]+/', '', $exclude);
        $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    } else {
        $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    }

    if (empty($attachments))
        return '';

    if (is_feed()) {
        $output = "\n";
        foreach ($attachments as $att_id => $attachment)
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "
        <style type='text/css'>
           
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' data-gene='init:gallery.init' class='w-full  overflow-hidden gee gallery galleryid-{$id}'>");
    $i = 0;
    $groups = array_chunk($attachments, 3);
    $output .= '<div class="slider gee --grid "
                    data-nav="true"
                    data-ah="true"
                    data-loop="false"
                    data-cols="[1,1,1]"
                    data-dots="false"
                    data-margin="30"
                    data-gene="init:slider.init">';

    foreach ($groups as $key => $group) {
        $output .= "<div class='slide grid-" . count($group) . "'>";
        foreach ($group as  $attachment) {

            // $img =  wp_get_attachment_image_src($attachment->ID, $size);

            $link = wp_get_attachment_link($attachment->ID, $size, false, false);
                if ($captiontag && trim($attachment->post_excerpt)) { 
                $link = str_replace("<a","<a title='".wptexturize($attachment->post_excerpt)."'", $link);

                 };

            // $link = isset($attr['link']) && 'file' == $attr['link'] 
            // ? wp_get_attachment_link($attachment->ID, $size, false, false) 
            // : wp_get_attachment_link($attachment->ID, $size, true, false);
            $output .= "<{$itemtag} class='item'>";
            $output .= $link;

            // $output .= $link;
       
            if ($captiontag && trim($attachment->post_excerpt)) {
                $output .= "
                <{$captiontag} class='item-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
                
            }
            $output .= "</{$itemtag}>";
        }
        $output .= "</div>";
    }
    $output .= "</div></div>\n";


    return $output;
}