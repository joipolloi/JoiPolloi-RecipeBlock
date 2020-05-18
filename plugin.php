<?php
/**
 * Plugin Name: Gutenberg Recipe Block
 * Description: Custom recipe block for the Gutenberg editor using Advanced Custom Fields
 * Author: Joi Polloi
 * Version: 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register custom category
function joipolloi_custom_category( $categories, $post ) {

    // Check if custom category has already been created
    $custom_category_exists = false;
    foreach ($categories as $key => $category) {
        if ($category['slug'] === 'joipolloi-blocks') {
            $custom_category_exists = true;
        }
    }

    if ( $custom_category_exists) {
        return $categories;
    } else {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'joipolloi-blocks',
                    'title' => 'Joi Polloi Custom Blocks',
                ),
            )
        );
    }
}
add_filter( 'block_categories', 'joipolloi_custom_category', 10, 2);

// Register block
function register_recipe_block_and_fields() {

    acf_register_block_type(array(
        'name'              => 'recipe',
        'title'             => 'Recipe',
        'render_template'   => plugin_dir_path( __FILE__ ) . 'recipe.php',
        'category'          => 'joipolloi-blocks',
        'icon'              => 'buddicons-community',
        'mode'              => 'edit',
        'supports'          => array('mode' => false),
        'enqueue_style'     => plugin_dir_url( __FILE__ ) . 'recipe.css',
    ));

    require_once plugin_dir_path( __FILE__ ) . 'functions/register-fields.php';

    wp_enqueue_script('recipe', plugin_dir_url( __FILE__ ) . 'main.js', [], '1.0.0', true);
}

add_action('acf/init', 'register_recipe_block_and_fields');