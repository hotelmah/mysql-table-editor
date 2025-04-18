<?php

declare(strict_types=1);

namespace MySQLTableEditor;

date_default_timezone_set("America/Chicago");

use MySQLTableEditor\ClsMapperToTemplates;
use ModeliXe\ModeliXe;
use WriteFile\ClsWriteFile;

// include.mysql.table.editor
class ClsIncludeMySQLTableEditor
{
    public static function executeMySQLTableEditor(): void
    {
        /* ===================================================================================================================== */

        $MySQLTableEditor = new ClsMySQLTableEditor(TABLENAME, PRIMARYKEY, FIELDSINLISTVIEW, APPTITLE, LANGUAGE, NUMBERROWSINLISTVIEW, FIELDSREQUIRED, FIELDSTONOTEDIT, FIELDHELPTEXTS, SHOWTEXTADDEDIT, SHOWTEXTLISTVIEW, LOOKUPTABLE, $_SERVER['SCRIPT_NAME'], IMAGESDIRNAME, URLBASE, HIDEFILENAMEEXTENSION);
        $MySQLTableEditor_html = new ModeliXe(URLBASE . TEMPLATEDIRNAME . DIRECTORY_SEPARATOR . "mysql.table.editor.tpl", '', '', -1, false);
        $MySQLTableEditor_css = new ModeliXe(URLBASE . TEMPLATEDIRNAME . DIRECTORY_SEPARATOR . CSSFILENAME . ".tpl", '', '', -1, false);
        $MySQLTableEditor_javascript = new ModeliXe(URLBASE . TEMPLATEDIRNAME . DIRECTORY_SEPARATOR . JAVASCRIPTFILENAME . ".tpl", '', '', -1, false);

        /* ===================================================================================================================== */

        $MySQLTableEditor->routeAndPopulate();

        /* ===================================================================================================================== */

        ClsMapperToTemplates::mapTableEditorCSSDataToTemplate($MySQLTableEditor, $MySQLTableEditor_css);

        $MySQLTableEditor_css_file = new ClsWriteFile();
        $MySQLTableEditor_css_file->saveData($MySQLTableEditor_css->mxWrite(true), false);
        $MySQLTableEditor_css_file->write(URLBASE . CSSDIRNAME . DIRECTORY_SEPARATOR . CSSFILENAME);

        unset($MySQLTableEditor_css_file);
        unset($MySQLTableEditor_css);

        /* ===================================================================================================================== */

        ClsMapperToTemplates::mapTableEditorJavascriptDataToTemplate($MySQLTableEditor, $MySQLTableEditor_javascript);

        $MySQLTableEditor_javascript_file = new ClsWriteFile();
        $MySQLTableEditor_javascript_file->saveData($MySQLTableEditor_javascript->mxWrite(true), false);
        $MySQLTableEditor_javascript_file->write(URLBASE . JAVASCRIPTDIRNAME . DIRECTORY_SEPARATOR . JAVASCRIPTFILENAME);

        unset($MySQLTableEditor_javascript_file);
        unset($MySQLTableEditor_javascript);

        /* ===================================================================================================================== */

        ClsMapperToTemplates::mapTableEditorHtmlDataToTemplate($MySQLTableEditor, $MySQLTableEditor_html);

        /* ===================================================================================================================== */

        unset($MySQLTableEditor);

        /* ===================================================================================================================== */

        $MySQLTableEditor_html->mxWrite(false);
        unset($MySQLTableEditor_html);

        /* ===================================================================================================================== */
    }
}
