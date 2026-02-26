<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Admin settings page registration for Plugin Replacer.
 *
 * @package    local_change_auth
 * @author     Melvyn Gomez - OpenRanger (melvyng@openranger.com)
 * @copyright  2025 Melvyn Gomez (https://openranger.com/)
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_change_auth', get_string('pluginname', 'local_change_auth'));

    $settings->add(new admin_setting_configselect(
        'local_change_auth/schedule',
        get_string('change_auth_schedule', 'local_change_auth'),
        get_string('change_auth_schedule_desc', 'local_change_auth'),
        'daily',
        [
            'daily' => get_string('change_auth_daily', 'local_change_auth'),
            'weekly' => get_string('change_auth_weekly', 'local_change_auth'),
        ]
    ));

    $ADMIN->add('localplugins', $settings);
}
