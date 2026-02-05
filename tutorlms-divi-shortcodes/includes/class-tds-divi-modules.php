<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once TDS_PLUGIN_PATH . 'includes/modules/class-tds-module-base.php';

class TDS_Divi_Modules {
    private $shortcodes;

    public function __construct(TDS_Shortcodes $shortcodes) {
        $this->shortcodes = $shortcodes;
    }

    public function register_hooks() {
        add_action('et_builder_ready', [$this, 'register_modules']);
    }

    public function register_modules() {
        if (!class_exists('ET_Builder_Module')) {
            return;
        }

        foreach ($this->shortcodes->get_definitions() as $definition) {
            $this->register_module_class($definition);
        }
    }

    private function register_module_class($definition) {
        $id = preg_replace('/[^a-z0-9_]/', '', strtolower($definition['id']));
        $class_name = 'TDS_Divi_Module_' . ucfirst($id);

        if (class_exists($class_name)) {
            return;
        }

        $definition_export = var_export($definition, true);

        $class_code = "class {$class_name} extends TDS_Divi_Module_Base {";
        $class_code .= "protected \$definition = {$definition_export};";
        $class_code .= "}";

        eval($class_code);

        if (class_exists($class_name)) {
            new $class_name();
        }
    }
}
