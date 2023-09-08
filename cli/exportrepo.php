<?php
// This file is part of Stack - http://stack.maths.ed.ac.uk/
//
// Stack is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Stack is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Stack.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Export from Moodle into a git repo containing questions.
 *
 * @package    qbank_gitsync
 * @copyright  2023 University of Edinburgh
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qbank_gitsync;
define('CLI_SCRIPT', true);
require_once('../classes/curl_request.php');
require_once('../classes/cli_helper.php');
require_once('../classes/export_repo.php');

$moodleinstances = [
    'edmundlocal' => 'http://stack.stack.virtualbox.org/edmundlocal',
    'other' => 'http:localhost:8888'
];

$options = [
    [
        'longopt' => 'moodleinstance',
        'shortopt' => 'i',
        'description' => 'Key of Moodle instance in $moodleinstances to use. ' .
                        'Should match end of instance URL.',
        'default' => 'edmundlocal',
        'variable' => 'moodleinstance',
        'valuerequired' => true,
    ],
    [
        'longopt' => 'manifestpath',
        'shortopt' => 'f',
        'description' => 'Filepath of manifest file.',
        'default' => '/home/efarrow1/question_repos/first/questions/edmundlocal_module_Course 1_Test 1_question_manifest.json',
        'variable' => 'manifestpath',
        'valuerequired' => true,
    ],
    [
        'longopt' => 'token',
        'shortopt' => 't',
        'description' => 'Security token for webservice.',
        'default' => '4ec7cd3f62e08f595df5e9c90ea7cfcd',
        'variable' => 'token',
        'valuerequired' => true,
    ],
    [
        'longopt' => 'help',
        'shortopt' => 'h',
        'description' => '',
        'default' => false,
        'variable' => 'help',
        'valuerequired' => false,
    ]
];

if (!function_exists('tidy_repair_string')) {
    echo 'Please install HTML Tidy.';
    exit;
}
$clihelper = new cli_helper($options);
$exportrepo = new export_repo;
$exportrepo->process($clihelper, $moodleinstances);



