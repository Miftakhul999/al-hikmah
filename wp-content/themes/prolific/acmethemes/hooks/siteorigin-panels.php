<?php
/**
 * Adds Prolific Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
function prolific_widgets($widgets) {
    $theme_widgets = array(
        'Prolific_about',
        'Prolific_client',
        'Prolific_posts_col',
        'Prolific_contact',
        'Prolific_featured',
        'Prolific_service',
        'Prolific_team',
        'Prolific_testimonial'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('prolific');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'prolific_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
function prolific_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => __('AT Prolific Widgets', 'prolific'),
        'filter' => array(
            'groups' => array('prolific')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'prolific_widgets_tab', 20);