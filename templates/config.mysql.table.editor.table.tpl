<?php

declare(strict_types=1);

namespace MySQLTableEditor;

date_default_timezone_set("America/Chicago");

require_once("vendor/autoload.php");

use MySQLTableEditor\ClsIncludeTableConfig;
use MySQLTableEditor\ClsIncludeMySQLTableEditor;

/* ===================================================================================================================== */
// Configuration Settings
/* ===================================================================================================================== */

// Configuration settings not intended for change, but can be
ClsIncludeTableConfig::setConfigSettingsCommon();

// App Table Name of the Page
define('APPTITLE', '{text id="AppTitle"}');

// Show file extension on url script base and select dropdowns
define('HIDEFILENAMEEXTENSION', {text id="HideFileNameExt"});

// Numbers of rows/records in "list view"
define('NUMBERROWSINLISTVIEW', {text id="NumberRowsListView"});

// Language:
// en=English  de=German
// fr=French   it=Italian
// nl=Dutch    sw=Swedish
// es=Spanish
define('LANGUAGE', '{text id="Language"}');

// Warning no .htaccess ('on' or 'off')
// Not passed into the constructor
define('HTACCESSWARNING', '{text id="HtAccessWarning"}');

/* ===================================================================================================================== */
// Critical Settings (Database)
/* ===================================================================================================================== */

// Table of the database you want to edit
define('TABLENAME', '{text id="TableName"}');

// Primary key of the table (must be AUTO_INCREMENT)
define('PRIMARYKEY', '{text id="PrimaryKey"}');

// Fields you want to see in "list view". Always add the primary key
define('FIELDSINLISTVIEW', array({text id="FieldsinListView"}));

// Required fields in edit or add record
define('FIELDSREQUIRED', array({text id="FieldsRequired"}));

// Fields you DO NOT want to edit, but shows. Consequently, these fields are not submitted for update or saved or allowed to input on add
define('FIELDSTONOTEDIT', array());

// Visible name of fields in Add/Edit View
define('SHOWTEXTADDEDIT', array({text id="ShowTextAddEdit"}));

// Visible name of the fields in List View
define('SHOWTEXTLISTVIEW', array({text id="ShowTextListView"}));

/* ===================================================================================================================== */
// Optional Settings
/* ===================================================================================================================== */

// Field help texts on Add/Edit page
define('FIELDHELPTEXTS', array(
    'NewsID' => "Auto Incremented; Don't edit this field",
    'Status' => 'Active or Inactive',
    'Website' => 'Old or New Website',
    'Topic' => 'Topic or Title of News item',
    'News' => 'Content of News Record',
    'DateDisplay' => 'Date to Show for this News Item',
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

ClsIncludeMySQLTableEditor::executeMySQLTableEditor();

/* ===================================================================================================================== */
