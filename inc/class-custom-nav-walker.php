<?php
class Custom_Nav_Walker extends Walker_Nav_Menu {
    
    // Start Level (Submenu)
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"ch-nav-links-ul\">\n";
    }

    // Start Element (Menu Item)
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // Add 'has-submenu' class if the item has children
        if (in_array("menu-item-has-children", $classes)) {
            $class_names .= ' has-submenu';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="nav-links-li ' . esc_attr( $class_names ) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty( $item->title ) ? $item->title : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        $atts['class']  = 'ch-link';

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    // End Element (Closing <li>)
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }

    // End Level (Closing </ul>)
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }
}