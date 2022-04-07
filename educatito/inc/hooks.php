<?php

if (!function_exists('educatito_fw_ext_backups_demos')) {

    function educatito_fw_ext_backups_demos($demos) {
        $demos_array = array(
            'educa' => array(
                'title' => esc_html__('Educatito', 'educatito'),
                'screenshot' => get_template_directory_uri() . '/screenshot.jpg',
                'preview_link' => 'http://educa.jrbthemes.com/',
            ),
        );

        $download_url = 'http://jidevexperts.com/import_demo/educa/';

        foreach ($demos_array as $id => $data) {
            $demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
                'url' => $download_url,
                'file_id' => $id,
            ));
            $demo->set_title($data['title']);
            $demo->set_screenshot($data['screenshot']);
            $demo->set_preview_link($data['preview_link']);

            $demos[$demo->get_id()] = $demo;

            unset($demo);
        }

        return $demos;
    }

}
add_filter('fw:ext:backups-demo:demos', 'educatito_fw_ext_backups_demos');
