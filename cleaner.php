<?php
/**
 * Plugin Name: WP ERP - Installation Cleaner
 * Description: Remove databases and roles created by WP ERP plugin
 * Plugin URI: https://wperp.com
 * Author: weDevs
 * Author URI: https://wedevs.com
 * Version: 1.0
 * License: GPL2
 */


if ( ! defined( 'ABSPATH' ) ) exit;


class WeDevs_ERP_Cleaner {

    public static function activate() {
        global $wpdb;

        $options = [
            'wp_erp_version', 'wp_erp_db_version', 'erp_modules',
            'erp_email_settings_employee-welcome', 'erp_email_settings_new-leave-request',
            'erp_email_settings_approved-leave-request', 'erp_email_settings_rejected-leave-request',
            'erp_email_settings_new-task-assigned', 'erp_setup_wizard_ran', 'erp_settings_general',
            'erp_settings_accounting', 'erp_settings_erp-hr_workdays', 'wp_erp_activation_dismiss',
            '_erp_admin_menu', '_erp_adminbar_menu', 'erp_settings_erp-email_general', 'erp_settings_erp-email_smtp',
            '_erp_company'
        ];

        $roles = [
            'erp_hr_manager', 'employee',
            'erp_crm_manager', 'erp_crm_agent',
            'erp_ac_manager', 'erp_ac_agency'
        ];

        $tables = [
            'erp_company_locations', 'erp_hr_depts', 'erp_hr_designations', 'erp_hr_employees',
            'erp_hr_employee_history', 'erp_hr_employee_notes', 'erp_hr_leave_policies',
            'erp_hr_holiday', 'erp_hr_leave_entitlements', 'erp_hr_leaves',
            'erp_hr_leave_requests', 'erp_hr_work_exp', 'erp_hr_education', 'erp_hr_dependents',
            'erp_hr_employee_performance', 'erp_hr_announcement', 'erp_peoples',
            'erp_peoplemeta', 'erp_people_types', 'erp_people_type_relations', 'erp_audit_log',
            'erp_crm_customer_companies', 'erp_crm_customer_activities', 'erp_crm_activities_task',
            'erp_crm_contact_group', 'erp_crm_contact_subscriber', 'erp_crm_campaigns',
            'erp_crm_campaign_group', 'erp_crm_save_search', 'erp_crm_save_email_replies',
            'erp_ac_chart_classes', 'erp_ac_chart_types', 'erp_ac_journals', 'erp_ac_ledger',
            'erp_ac_banks', 'erp_ac_transactions', 'erp_ac_transaction_items', 'erp_ac_payments',
            'erp_ac_tax', 'erp_ac_tax_items'
        ];

        foreach ($tables as $table) {
            $wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . $table );
        }

        foreach ($roles as $role) {
            remove_role( $role );
        }

        foreach ($options as $option) {
            delete_option( $option );
        }
    }

}

register_activation_hook( __FILE__, array( 'WeDevs_ERP_Cleaner', 'activate' ) );
