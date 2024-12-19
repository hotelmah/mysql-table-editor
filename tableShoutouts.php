<?php

declare(strict_types=1);

namespace MTE;

require_once("includes/class.mysql.table.editor.php");
require_once("../ModeliXe/src/ModeliXe.php");
require_once("includes/function.write.file.php");
require_once("includes/function.mysql.table.editor.map.data.template.php");

/* ===================================================================================================================== */
// Configuration Settings
/* ===================================================================================================================== */

// Configuration settings not intended for change, but can be
require_once('includes/include.table.config.php');

// App Table Name of the Page
define('APPTITLE', 'kevinp.net Shoutouts');

// Show file extension on url script base and select dropdowns
define('HIDEFILENAMEEXTENSION', false);

// Numbers of rows/records in "list view"
define('NUMBERROWSINLISTVIEW', 5);

// Language:
// en=English  de=German
// fr=French   it=Italian
// nl=Dutch    sw=Swedish
// es=Spanish
define('LANGUAGE', 'en');

// Warning no .htaccess ('on' or 'off')
// Not passed into the constructor
define('HTACCESSWARNING', 'on');

/* ===================================================================================================================== */
// Critical Settings (Database)
/* ===================================================================================================================== */

// Table of the database you want to edit
define('TABLENAME', 'Shoutouts');

// Primary key of the table (must be AUTO_INCREMENT)
define('PRIMARYKEY', 'ShoutoutID');

// Fields you want to see in "list view". Always add the primary key
define('FIELDSINLISTVIEW', array('ShoutoutID', 'Status', 'Subject', 'Message', 'Name', 'DateTimeClient', 'DateTimeServer'));

// Required fields in edit or add record
define('FIELDSREQUIRED', array('Status', 'Subject', 'Message', 'Name', 'DateTimeClient'));

// Fields you want to edit (make empty this to edit all the fields)
define('FIELDSTOEDIT', array());

// Visible name of fields in Add/Edit View
define('SHOWTEXTADDEDIT', array(
    'ShoutoutID' => 'ShoutoutID',
    'Status' => 'Status',
    'Subject' => 'Subject',
    'Message' => 'Message',
    'Name' => 'Name',
    'DateTimeClient' => 'DateTimeClient',
    'DateTimeServer' => 'DateTimeServer'
));

// Visible name of the fields in List View
define('SHOWTEXTLISTVIEW', array(
    'ShoutoutID' => 'ShoutoutID',
    'Status' => 'Status',
    'Subject' => 'Subject',
    'Message' => 'Message',
    'Name' => 'Name',
    'DateTimeClient' => 'DateTimeClient',
    'DateTimeServer' => 'DateTimeServer'
));

/* ===================================================================================================================== */
// Optional Settings
/* ===================================================================================================================== */

// Field help texts on Add/Edit page
define('FIELDHELPTEXTS', array(
    'ShoutoutID' => "Auto Incremented; Don't edit this field",
    'Status' => 'Active or Inactive',
    'Subject' => 'Topic or Subject of Shoutout',
    'Message' => 'Your Shoutout, or what you want to say',
    'Name' => 'Put your name here for the record',
    'DateTimeClient' => 'Date to Show for this Shoutout Item',
    'DateTimeServer' => 'Date of actual entry of this news item. This should be auto populated. No need to enter a date.'
));

// Make selectlist on inputfield based on another table
// in this example: `employees`.`job` is based on `jobs`.`jobname`
define('LOOKUPTABLE', array(
    'job' => array(
        'query' => "SELECT `id`, `jobname` FROM `jobs`;",
        'option_value' => 'id',
        'option_text' => 'jobname'
    )
));

/* ===================================================================================================================== */

session_start();

/* ===================================================================================================================== */

require_once('includes/include.mysql.table.editor.php');

/* ===================================================================================================================== */
