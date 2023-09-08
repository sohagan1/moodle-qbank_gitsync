# Importing a repo into Moodle

## Prerequisites
- Set up the webserver on the Moodle instance.
- Set up your local machine.

## Importing
- Create a repository of questions with a folder hierarchy akin to question categories i.e. top/category/subcategory.
- Each category below top should have a `gitsync_gategory.xml` file containing a 'category question' with the details of he category. See the `testrepo` folder in this repository for an example.
- From the commandline in the `cli` folder run `importrepo.php`. There are a number of options you can input. List them all with `php importrepo.php -h`. You can use -shortname or --longname on the command line followed by a space and the value.

|Short|Long|Required value|
|-|-|-|
|i|moodleinstance|Key of Moodle instance in  moodleinstances to use. Should match end of instance URL.|
|d|directory|Directory of repo on users computer, containg "top" folder|
|l|contextlevel|Context in which to place questions. Set to system, coursecategory, course or module
|c|coursename|Unique course name for course or module context.
|m|modulename|Unique (within course) module name for module context.
|g|coursecategory|Unique course category name for coursecategory context.
|t|token|Security token for webservice.
|h|help|

Examples:

`php importrepo.php -t 4ec7cd3f62e08f595df5e9c90ea7cfcd -i edmundlocal -d "C:\question_repos\first\questions" --contextlevel system`

This sets the token, the Moodle instance and the location of the repository to upload. Categories will be created at the system level.

`php importrepo.php -l module -c "Course 1" -m "Test 1"`

This will use the default token, instance and location values in `importrepo.php` but create the categories in quiz 'Test 1' of 'Course 1'.

- Importing will create a manifest file specific to the Moodle instance and context in the root of the repo. This links files in the repo to specific questionbankentries in the Moodle instance.