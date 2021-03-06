<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Add option
 *
 * @param string $name Option name (required|unique)
 * @param string $value Option value
 * @param integer $autoload Whether to autoload this option
 *
 * @since  Version 1.0.1
 *
 */
function user_add_option($name, $value = '', $autoload = 1)
{
    if (!option_exists($name)) {
        $CI = &get_instance();

        $newData = [
            'name' => $name,
            'value' => $value,
        ];


        if ($CI->db->field_exists('autoload', db_prefix() . 'options')) {
            $newData['autoload'] = $autoload;
        }

        // $CI->db->insert(db_prefix() . 'options', $newData);

        $insert_id = $CI->db->insert_id();

        if ($CI->session->userdata('admin_id')) {
            $array = array('name' => $name, 'user_id' => $CI->session->userdata('admin_id'));
            $res_data = $CI->db->select('value')
                ->where($array)->get(db_prefix() . 'menu_mapping')->row();
            if (!empty($res_data)) {
                $CI->db->where('name', $name);
                $CI->db->where('user_id', $CI->session->userdata('admin_id'));
                $newdata = ['value' => $value];

                $CI->db->update(db_prefix() . 'menu_mapping', $newdata);

            } else {
                $newDataCheck = [
                    'name' => $name,
                    'value' => $value,
                    'user_id' => $CI->session->userdata('admin_id')
                ];
                $CI->db->insert(db_prefix() . 'menu_mapping', $newDataCheck);

            }

        }

        if ($insert_id) {
            return true;
        }

        return false;
    }

    return false;
}

function get_menu_option($name, $default)
{
    $option = user_get_option($name);
    if (empty($option)) {
        user_update_option($name, $default);
        return $default;
    }
    return $option;
}

function user_get_option($name)
{
    $CI = &get_instance();
    $array = array('name' => $name, 'user_id' => $CI->session->userdata('admin_id'));
    $option = $CI->db->where($array)->get(db_prefix() . 'menu_mapping')->row();
    return $option ? $option->value : '';
}

/**
 * Updates option by name
 *
 * @param string $name Option name
 * @param string $value Option Value
 * @param mixed $autoload Whether to update the autoload
 *
 * @return boolean
 */
function user_update_option($name, $value, $autoload = null)
{
    /**
     * Create the option if not exists
     * @since  2.3.3
     */
    if (!option_exists($name)) {
        return add_option($name, $value, $autoload === null ? 1 : 0);
    }

    $CI = &get_instance();

    $CI->db->where('name', $name);
    if ($autoload) {
        $data['autoload'] = $autoload;
    }

    if ($CI->session->userdata('admin_id')) {
        $array = array('name' => $name, 'user_id' => $CI->session->userdata('admin_id'));
        $res_data = $CI->db->select('value')
            ->where($array)->get(db_prefix() . 'menu_mapping')->row();
        if (!empty($res_data)) {
            $CI->db->where('name', $name);
            $CI->db->where('user_id', $CI->session->userdata('admin_id'));
            $newdata = ['value' => $value];

            $CI->db->update(db_prefix() . 'menu_mapping', $newdata);

        } else {
            $newDataCheck = [
                'name' => $name,
                'value' => $value,
                'user_id' => $CI->session->userdata('admin_id')
            ];
            $CI->db->insert(db_prefix() . 'menu_mapping', $newDataCheck);

        }


    }


    if ($CI->db->affected_rows() > 0) {
        return true;
    }

    return false;
}

/**
 * Delete option
 * @param mixed $name option name
 * @return boolean
 * @since  Version 1.0.4
 */
function delete_option($name)
{
    $CI = &get_instance();
    $CI->db->where('name', $name);
    $CI->db->delete(db_prefix() . 'options');

    return (bool)$CI->db->affected_rows();
}

function save_transl($slug, $data)
{
    user_update_option($slug, serialize($data));
    return true;
}


/**
 * Add option
 *
 * @param string $name Option name (required|unique)
 * @param string $value Option value
 * @param integer $autoload Whether to autoload this option
 *
 * @since  Version 1.0.1
 *
 */
function add_option($name, $value = '', $autoload = 1)
{
    if (!option_exists($name)) {
        $CI = &get_instance();

        $newData = [
            'name' => $name,
            'value' => $value,
        ];

        if ($CI->db->field_exists('autoload', db_prefix() . 'options')) {
            $newData['autoload'] = $autoload;
        }

        $CI->db->insert(db_prefix() . 'options', $newData);

        $insert_id = $CI->db->insert_id();

        if ($insert_id) {
            return true;
        }

        return false;
    }

    return false;
}

/**
 * Get option value
 * @param string $name Option name
 * @return mixed
 */
function get_option($name)
{
    $CI = &get_instance();
    if (!class_exists('app', false)) {
        $CI->load->library('app');
    }

    return $CI->app->get_option($name);
}

/**
 * Updates option by name
 *
 * @param string $name Option name
 * @param string $value Option Value
 * @param mixed $autoload Whether to update the autoload
 *
 * @return boolean
 */
function update_option($name, $value, $autoload = null)
{
    /**
     * Create the option if not exists
     * @since  2.3.3
     */
    if (!option_exists($name)) {
        return add_option($name, $value, $autoload === null ? 1 : 0);
    }

    $CI = &get_instance();

    $CI->db->where('name', $name);
    $data = ['value' => $value];

    if ($autoload) {
        $data['autoload'] = $autoload;
    }

    $CI->db->update(db_prefix() . 'options', $data);

    if ($CI->db->affected_rows() > 0) {
        return true;
    }

    return false;
}

function get_transl($slug)
{
    $data = user_get_option($slug);
    if ($data)
        return unserialize($data);
    return array();
}

function get_transl_field($slug, $fied_slug, $default_value)
{
    $data = user_get_option($slug);
    if ($data) {
        $data = unserialize($data);
        if (!empty($data[$fied_slug])) {
            return $data[$fied_slug];
        }
    }
    return $default_value;

}

/**
 * @param string $name option name
 *
 * @return boolean
 * @since  2.3.3
 * Check whether an option exists
 *
 */
function option_exists($name)
{
    return total_rows(db_prefix() . 'options', [
            'name' => $name,
        ]) > 0;
}

function app_init_settings_tabs()
{
    $CI = &get_instance();

    $CI->app_tabs->add_settings_tab('general', [
        'name' => _l('settings_group_general'),
        'view' => 'admin/settings/includes/general',
        'position' => 5,
    ]);

    $CI->app_tabs->add_settings_tab('company', [
        'name' => _l('company_information'),
        'view' => 'admin/settings/includes/company',
        'position' => 10,
    ]);

    $CI->app_tabs->add_settings_tab('localization', [
        'name' => _l('settings_group_localization'),
        'view' => 'admin/settings/includes/localization',
        'position' => 15,
    ]);

    $CI->app_tabs->add_settings_tab('email', [
        'name' => _l('settings_group_email'),
        'view' => 'admin/settings/includes/email',
        'position' => 20,
    ]);

    $CI->app_tabs->add_settings_tab('sales', [
        'name' => _l('settings_group_sales'),
        'view' => 'admin/settings/includes/sales',
        'position' => 25,
    ]);

    $CI->app_tabs->add_settings_tab('subscriptions', [
        'name' => _l('subscriptions'),
        'view' => 'admin/settings/includes/subscriptions',
        'position' => 30,
    ]);

    $CI->app_tabs->add_settings_tab('payment_gateways', [
        'name' => _l('settings_group_online_payment_modes'),
        'view' => 'admin/settings/includes/payment_gateways',
        'position' => 35,
    ]);

    $CI->app_tabs->add_settings_tab('clients', [
        'name' => _l('settings_group_clients'),
        'view' => 'admin/settings/includes/clients',
        'position' => 40,
    ]);

    $CI->app_tabs->add_settings_tab('tasks', [
        'name' => _l('tasks'),
        'view' => 'admin/settings/includes/tasks',
        'position' => 45,
    ]);

    $CI->app_tabs->add_settings_tab('tickets', [
        'name' => _l('support'),
        'view' => 'admin/settings/includes/tickets',
        'position' => 50,
    ]);

    $CI->app_tabs->add_settings_tab('leads', [
        'name' => _l('leads'),
        'view' => 'admin/settings/includes/leads',
        'position' => 55,
    ]);

    $CI->app_tabs->add_settings_tab('calendar', [
        'name' => _l('settings_calendar'),
        'view' => 'admin/settings/includes/calendar',
        'position' => 60,
    ]);

    $CI->app_tabs->add_settings_tab('pdf', [
        'name' => _l('settings_pdf'),
        'view' => 'admin/settings/includes/pdf',
        'position' => 65,
    ]);

    $CI->app_tabs->add_settings_tab('e_sign', [
        'name' => 'E-Sign',
        'view' => 'admin/settings/includes/e_sign',
        'position' => 70,
    ]);

    $CI->app_tabs->add_settings_tab('cronjob', [
        'name' => _l('settings_group_cronjob'),
        'view' => 'admin/settings/includes/cronjob',
        'position' => 75,
    ]);

    $CI->app_tabs->add_settings_tab('tags', [
        'name' => _l('tags'),
        'view' => 'admin/settings/includes/tags',
        'position' => 80,
    ]);

    $CI->app_tabs->add_settings_tab('pusher', [
        'name' => 'Pusher.com',
        'view' => 'admin/settings/includes/pusher',
        'position' => 85,
    ]);

    $CI->app_tabs->add_settings_tab('google', [
        'name' => 'Google',
        'view' => 'admin/settings/includes/google',
        'position' => 90,
    ]);

    $CI->app_tabs->add_settings_tab('misc', [
        'name' => _l('settings_group_misc'),
        'view' => 'admin/settings/includes/misc',
        'position' => 95,
    ]);
}
