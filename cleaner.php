<?php
/**
 * Plugin Name: WP ERP - Installation Cleaner
 * Description: Remove tables, roles and options created by WP ERP plugin
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
            '_erp_company', 'erp_settings_erp-crm_subscription', 'erp_acct_new_ledgers',
            'erp_email_settings_new-contact-assigned', 'erp_email_settings_hiring-anniversary-wish',
            'wp_erp_install_date', 'widget_erp-subscription-from-widget', 'erp_tracking_notice'
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
            'erp_ac_tax', 'erp_ac_tax_items', 'erp_acct_bill_account_details', 'erp_acct_bill_details',
            'erp_acct_bills', 'erp_acct_chart_of_accounts', 'erp_acct_currency_info', 'erp_acct_invoice_account_details',
            'erp_acct_invoice_details', 'erp_acct_invoice_receipts', 'erp_acct_invoice_receipts_details',
            'erp_acct_invoices', 'erp_acct_journal_details', 'erp_acct_journals', 'erp_acct_ledger_categories',
            'erp_acct_ledger_details', 'erp_acct_ledger_settings', 'erp_acct_ledgers',
            'erp_acct_cash_at_banks', 'erp_acct_transfer_voucher', 'erp_acct_opening_balances', 'erp_acct_financial_years',
            'erp_acct_pay_bill', 'erp_acct_pay_bill_details', 'erp_acct_pay_purchase', 'erp_acct_pay_purchase_details',
            'erp_acct_people_account_details', 'erp_acct_people_trn', 'erp_acct_people_trn_details',
            'erp_acct_product_categories', 'erp_acct_product_types', 'erp_acct_products', 'erp_acct_product_details',
            'erp_acct_purchase', 'erp_acct_purchase_account_details', 'erp_acct_purchase_details', 'erp_acct_tax_categories',
            'erp_acct_taxes', 'erp_acct_tax_cat_agency', 'erp_acct_tax_agencies', 'erp_acct_tax_pay',
            'erp_acct_tax_agency_details', 'erp_acct_invoice_details_tax', 'erp_acct_trn_status_types',
            'erp_acct_payment_methods', 'erp_acct_expenses', 'erp_acct_expense_details', 'erp_acct_expense_checks',
            'erp_holidays_indv', 'erp_user_leaves'
        ];

        foreach ($tables as $table) {
            $wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . $table );
        }

        /**
         * Or we can remove like below
         * (no need to specify tables)
         */
        // $tables = $wpdb->get_results(
        //     "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$wpdb->dbname}' AND TABLE_NAME LIKE '%_erp_%'"
        // );

        // foreach ( $tables as $table ) {
        //     $wpdb->query("DROP TABLE {$table->TABLE_NAME}");
        // }

        foreach ($roles as $role) {
            remove_role( $role );
        }

        foreach ($options as $option) {
            delete_option( $option );
        }
    }

}

register_activation_hook( __FILE__, array( 'WeDevs_ERP_Cleaner', 'activate' ) );
