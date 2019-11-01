<?php

class block_content_templates_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $DB;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // get all courses from the 'Template' category
        $cat_name = 'Templates';
        $catid = get_config('block_content_templates', 'templatecategory');
        $sql = "select c.* from {course} c join {course_categories} cc on cc.id = c.category where cc.id = '$catid'";
        $tcourses = $DB->get_records_sql($sql);

        $options = array();
        $options[0] = get_string('no_selection', 'block_content_templates');
        foreach($tcourses as $tcourse) {
            $options[$tcourse->id] = $tcourse->fullname;
        }
        $mform->addElement('select', 'config_template_course', get_string('template_course', 'block_content_templates'), $options);
        $mform->addHelpButton('test', 'tests', 'block');


//        $mform->setDefault('config_text', 'default value');
        $mform->setDefault('config_template_course', get_config('block_content_templates', 'defaulttemplate'));
        $mform->setType('config_template_course', PARAM_RAW);

    }
}