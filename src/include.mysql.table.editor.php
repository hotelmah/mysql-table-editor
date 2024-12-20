<?php

declare(strict_types=1);

namespace MySQLTableEditor;

use MySQLTableEditor\Mapper;
use ModeliXe\ModeliXe;
use WriteFile\ClsWriteFile;

/* ===================================================================================================================== */

$MySQLTableEditor = new ClsMySQLTableEditor(TABLENAME, PRIMARYKEY, FIELDSINLISTVIEW, APPTITLE, LANGUAGE, NUMBERROWSINLISTVIEW, FIELDSREQUIRED, FIELDSTOEDIT, FIELDHELPTEXTS, SHOWTEXTADDEDIT, SHOWTEXTLISTVIEW, LOOKUPTABLE, $_SERVER['SCRIPT_NAME'], IMAGESDIRNAME, URLBASE, HIDEFILENAMEEXTENSION);
$MySQLTableEditor_html = new ModeliXe(URLBASE . TEMPLATEDIRNAME . "/" . "mysql.table.editor.tpl", '', '', -1, false);
$MySQLTableEditor_css = new ModeliXe(URLBASE . TEMPLATEDIRNAME . "/" . CSSFILENAME . ".tpl", '', '', -1, false);
$MySQLTableEditor_javascript = new ModeliXe(URLBASE . TEMPLATEDIRNAME . "/" . JAVASCRIPTFILENAME . ".tpl", '', '', -1, false);

/* ===================================================================================================================== */

$MySQLTableEditor->routeAndPopulate();

/* ===================================================================================================================== */

Mapper::mapTableEditorCSSDataToTemplate($MySQLTableEditor, $MySQLTableEditor_css);

$MySQLTableEditor_css_file = new ClsWriteFile();
$MySQLTableEditor_css_file->saveData($MySQLTableEditor_css->mxWrite(true), false);
$MySQLTableEditor_css_file->write(URLBASE . CSSDIRNAME . "/" . CSSFILENAME);

unset($MySQLTableEditor_css_file);
unset($MySQLTableEditor_css);

/* ===================================================================================================================== */

Mapper::mapTableEditorJavascriptDataToTemplate($MySQLTableEditor, $MySQLTableEditor_javascript);

$MySQLTableEditor_javascript_file = new ClsWriteFile();
$MySQLTableEditor_javascript_file->saveData($MySQLTableEditor_javascript->mxWrite(true), false);
$MySQLTableEditor_javascript_file->write(URLBASE . JAVASCRIPTDIRNAME . "/" . JAVASCRIPTFILENAME);

unset($MySQLTableEditor_javascript_file);
unset($MySQLTableEditor_javascript);

/* ===================================================================================================================== */

Mapper::mapTableEditorHtmlDataToTemplate($MySQLTableEditor, $MySQLTableEditor_html);

/* ===================================================================================================================== */

unset($MySQLTableEditor);

/* ===================================================================================================================== */

$MySQLTableEditor_html->mxWrite(false);
unset($MySQLTableEditor_html);

/* ===================================================================================================================== */
