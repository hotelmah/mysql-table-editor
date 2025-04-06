<?php

declare(strict_types=1);

namespace MySQLTableEditor;

date_default_timezone_set("America/Chicago");

// include.table.config

/* ===================================================================================================================== */
// Configuration Settings (Common)
/* ===================================================================================================================== */

class ClsIncludeTableConfig
{
    public static function setConfigSettingsCommon(): void
    {
        ini_set('display_errors', 1); // 0=Live, 1=Debug
        date_default_timezone_set("America/Chicago");

        // Webpage tab title
        define('WEBPAGETITLE', "MySQL Table Editor v2");

        // Path Base for Directories: CSS (TPL File), Javascript (TPL File), Templates, and Images (SRC attribute in main class)
        // This assumes all these directories are at the same hierarchial level
        define('URLBASE', './');

        // Check the case and directory names for the following on your server
        define('CSSDIRNAME', 'css');
        define('JAVASCRIPTDIRNAME', 'javascript');
        define('TEMPLATEDIRNAME', 'templates');
        define('IMAGESDIRNAME', 'images');

        // Read from template, populate variables, and write CSS and Javascript files to disk every time
        define('CSSFILENAME', 'mysql.table.editor.fancy.css');
        define('JAVASCRIPTFILENAME', 'mysql.table.editor.js');

        // Look in content of other files in current working directory to find MTE tables, to add to drop down, to switch tables
        define('OTHERTABLESEARCHSTRING', "#ClsIncludeMySQLTableEditor::executeMySQLTableEditor\(\);#");

        // CSS Form Fields Add/Edit
        // Not passed into the constructor
        define('WIDTHINPUTFIELDS', '450px');
        define('WIDTHTEXTAREAFIELDS', '450px');
        define('HEIGHTTEXTAREAFIELDS', '250px');
    }
}
/* ===================================================================================================================== */
