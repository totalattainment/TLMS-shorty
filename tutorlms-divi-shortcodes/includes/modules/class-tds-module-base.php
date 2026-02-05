<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('ET_Builder_Module')) {
    return;
}

class TDS_Divi_Module_Base extends ET_Builder_Module {
    protected $definition = [];

    public function init() {
        $this->name = $this->definition['label'] ?? 'Tutor LMS Module';
        $this->slug = 'tds_' . ($this->definition['id'] ?? 'module');
        $this->vb_support = 'partial';
    }

    public function get_fields() {
        $fields = [];

        foreach ($this->definition['fields'] ?? [] as $field_key => $default_value) {
            $fields[$field_key] = [
                'label' => ucwords(str_replace('_', ' ', $field_key)),
                'type' => 'text',
                'option_category' => 'basic_option',
                'default' => $default_value,
            ];
        }

        return $fields;
    }

    public function render($attrs, $content = null, $render_slug = null) {
        $shortcode = $this->definition['shortcode'] ?? '';

        if ($shortcode === '') {
            return '';
        }

        $attributes = [];
        foreach ($this->definition['fields'] ?? [] as $field_key => $default_value) {
            if (isset($attrs[$field_key]) && $attrs[$field_key] !== '') {
                $attributes[$field_key] = $attrs[$field_key];
            }
        }

        $builder = new TDS_Shortcodes();
        $shortcode_string = $builder->build_shortcode($shortcode, $attributes, $content ?? '');

        return do_shortcode($shortcode_string);
    }
}
