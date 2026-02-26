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
 * Plugin change_auth class.
 *
 * @package    local_change_auth
 * @author     Melvyn Gomez - OpenRanger (melvyng@openranger.com)
 * @copyright  2025 Melvyn Gomez (https://openranger.com/)
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_change_auth\task;

/**
 * Scheduled task to change user authentication method
 * from 'email' to 'manual'.
 *
 * @package    local_change_auth
 */
class change_auth_cron extends \core\task\scheduled_task {
    /**
     * Returns the name of the scheduled task.
     *
     * @return string
     */
    public function get_name() {
        // Task name shown in the admin area.
        return get_string('change_auth_taskname', 'local_change_auth');
    }

    /**
     * Executes the scheduled task.
     *
     * @return void
     */
    public function execute() {
        global $DB;

        mtrace(get_string('taskstart', 'local_change_auth'));

        // Query all users with the auth method "email".
        $users = $DB->get_records('user', ['auth' => 'email']);
        $count = 0;

        foreach ($users as $user) {
            $user->auth = 'manual';
            try {
                $DB->update_record('user', $user);
                $count++;
            } catch (Exception $e) {
                $a = (object)[
                    'id' => $user->id,
                    'message' => $e->getMessage(),
                ];
                mtrace(get_string('taskerror', 'local_change_auth', $a));
            }
        }

        mtrace(get_string('taskcomplete', 'local_change_auth', $count));
    }
}
