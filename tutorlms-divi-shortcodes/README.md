# Tutor LMS Divi Shortcodes

This plugin provides a Divi module for each Tutor LMS shortcode definition, along with a prefixed shortcode alias that can be used anywhere WordPress shortcodes are accepted.

## Features
- Registers a module per Tutor LMS shortcode definition (for example: Courses, Course, Instructor, Dashboard).
- Adds prefixed shortcode aliases (ex: `[tds_tutor_courses]`) that map to the Tutor LMS shortcode.
- Filterable definition list via `tds_tutor_shortcodes` for customization.

## Usage
1. Install Tutor LMS and Divi.
2. Activate this plugin.
3. In the Divi builder, add the corresponding Tutor LMS module and configure the fields.
4. Or use the prefixed shortcodes directly in the editor:

```
[tds_tutor_courses per_page="6" column="3"]
```

## Customizing Shortcodes
Use the `tds_tutor_shortcodes` filter to adjust attributes or add new modules.

```php
add_filter('tds_tutor_shortcodes', function ($definitions) {
    $definitions[] = [
        'id' => 'my_custom_shortcode',
        'label' => 'Tutor Custom',
        'shortcode' => 'tutor_custom',
        'alias' => 'tds_tutor_custom',
        'fields' => [
            'example' => '',
        ],
    ];

    return $definitions;
});
```
