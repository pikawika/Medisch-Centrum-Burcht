<?php
function icon_with_text_list_shortcode($atts)
{
    // Extract shortcode parameters
    extract(shortcode_atts(
        array(
            'items' => ''
        ), $atts));

    $items = vc_param_group_parse_atts($atts['items']);

    // Enqueue the style for the shortcode
    wp_enqueue_style('icon-with-text-style');

    // Start building HTML
    $html = '<div class="icon_with_text_list large">';

    if (!empty($items)) {
        foreach ($items as $item) {
            $icon = $item['icon'] ?? '';
            $text = $item['text'] ?? '';
            $href = $item['href'] ?? '';
            $newtab = $item['newtab'] ?? false;

            $html .= '<div class="icon_with_text_item">';
            $html .= '<div class="icon_with_text_icon"><i class="qode_icon_font_awesome fa ' . esc_attr($icon) . ' qode_icon_element"></i></div>';
            $html .= '<div class="icon_with_text_text">';
            if (!empty($href)) {
                $html .= '<a href="' . esc_url($href) . '"' . ($newtab ? ' target="_blank"' : '') . '>' . $text . '</a>';
            } else {
                $html .= $text;
            }
            $html .= '</div></div>';
        }
    }

    $html .= '</div>';

    return $html;
}

vc_map(
    array(
        'name' => 'Icon With Text List',
        'base' => 'icon_with_text_list',
        'category' => 'Net-Com',
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => 'Items',
                'param_name' => 'items',
                'description' => 'Add items to the icon with text list',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => 'Icon Class',
                        'param_name' => 'icon',
                        'description' => 'Enter Font Awesome icon class (e.g., fa-map-pin).',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Text',
                        'param_name' => 'text',
                        'description' => 'Enter the text to display.',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Link (optional)',
                        'param_name' => 'href',
                        'description' => 'Enter the optional link.',
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => 'Openen in nieuw tabblad',
                        'param_name' => 'newtab',
                        'description' => 'Vink aan om de link in een nieuw tabblad te openen.',
                    )
                )
            )
        )
    )
);

add_shortcode('icon_with_text_list', 'icon_with_text_list_shortcode');
