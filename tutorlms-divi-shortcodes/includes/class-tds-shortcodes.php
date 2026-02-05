<?php

if (!defined('ABSPATH')) {
    exit;
}

class TDS_Shortcodes {
    public function get_definitions() {
        $definitions = [
            [
                'id' => 'courses',
                'label' => 'Tutor Courses',
                'shortcode' => 'tutor_courses',
                'alias' => 'tds_tutor_courses',
                'fields' => [
                    'course_style' => '',
                    'per_page' => '',
                    'column' => '',
                    'order' => '',
                    'orderby' => '',
                    'category' => '',
                    'difficulty_level' => '',
                    'tag' => '',
                    'include' => '',
                    'exclude' => '',
                    'pagination' => '',
                    'search' => '',
                    'filter' => '',
                ],
            ],
            [
                'id' => 'course',
                'label' => 'Tutor Course',
                'shortcode' => 'tutor_course',
                'alias' => 'tds_tutor_course',
                'fields' => [
                    'id' => '',
                    'content' => '',
                ],
            ],
            [
                'id' => 'course_filter',
                'label' => 'Tutor Course Filter',
                'shortcode' => 'tutor_course_filter',
                'alias' => 'tds_tutor_course_filter',
                'fields' => [
                    'show_search' => '',
                    'show_category' => '',
                    'show_level' => '',
                    'show_price' => '',
                    'show_sort' => '',
                ],
            ],
            [
                'id' => 'instructor',
                'label' => 'Tutor Instructor',
                'shortcode' => 'tutor_instructor',
                'alias' => 'tds_tutor_instructor',
                'fields' => [
                    'id' => '',
                ],
            ],
            [
                'id' => 'instructors',
                'label' => 'Tutor Instructors',
                'shortcode' => 'tutor_instructors',
                'alias' => 'tds_tutor_instructors',
                'fields' => [
                    'per_page' => '',
                    'column' => '',
                    'order' => '',
                    'orderby' => '',
                ],
            ],
            [
                'id' => 'dashboard',
                'label' => 'Tutor Dashboard',
                'shortcode' => 'tutor_dashboard',
                'alias' => 'tds_tutor_dashboard',
                'fields' => [
                    'page' => '',
                    'courses_page' => '',
                    'settings_page' => '',
                ],
            ],
            [
                'id' => 'login',
                'label' => 'Tutor Login',
                'shortcode' => 'tutor_login',
                'alias' => 'tds_tutor_login',
                'fields' => [
                    'redirect_to' => '',
                ],
            ],
            [
                'id' => 'student_registration',
                'label' => 'Tutor Student Registration',
                'shortcode' => 'tutor_student_registration',
                'alias' => 'tds_tutor_student_registration',
                'fields' => [
                    'redirect_to' => '',
                ],
            ],
            [
                'id' => 'instructor_registration',
                'label' => 'Tutor Instructor Registration',
                'shortcode' => 'tutor_teacher_registration',
                'alias' => 'tds_tutor_teacher_registration',
                'fields' => [
                    'redirect_to' => '',
                ],
            ],
            [
                'id' => 'profile',
                'label' => 'Tutor Profile',
                'shortcode' => 'tutor_profile',
                'alias' => 'tds_tutor_profile',
                'fields' => [
                    'user_id' => '',
                ],
            ],
            [
                'id' => 'quiz',
                'label' => 'Tutor Quiz',
                'shortcode' => 'tutor_quiz',
                'alias' => 'tds_tutor_quiz',
                'fields' => [
                    'id' => '',
                ],
            ],
            [
                'id' => 'course_categories',
                'label' => 'Tutor Course Categories',
                'shortcode' => 'tutor_course_categories',
                'alias' => 'tds_tutor_course_categories',
                'fields' => [
                    'include' => '',
                    'exclude' => '',
                    'columns' => '',
                ],
            ],
        ];

        return apply_filters('tds_tutor_shortcodes', $definitions);
    }

    public function register_shortcodes() {
        foreach ($this->get_definitions() as $definition) {
            add_shortcode($definition['alias'], function ($atts = [], $content = '') use ($definition) {
                $atts = shortcode_atts($definition['fields'], $atts, $definition['alias']);
                $shortcode = $this->build_shortcode($definition['shortcode'], $atts, $content);

                return do_shortcode($shortcode);
            });
        }
    }

    public function build_shortcode($shortcode, $atts, $content = '') {
        $attributes = '';
        foreach ($atts as $key => $value) {
            if ($value === '' || $value === null) {
                continue;
            }
            $attributes .= sprintf(' %s="%s"', esc_attr($key), esc_attr($value));
        }

        if ($content !== '') {
            return sprintf('[%1$s%2$s]%3$s[/%1$s]', $shortcode, $attributes, $content);
        }

        return sprintf('[%1$s%2$s]', $shortcode, $attributes);
    }
}
