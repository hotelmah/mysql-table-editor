<?php

declare(strict_types=1);

namespace MySQLTableEditor;

require_once('vendor/autoload.php');

use MySQLTableEditor\ClsGetAllTableFileNames;
use MySQLTableEditor\ClsIncludeTableConfig;
use ModeliXe\ModeliXe;
use WriteFile\ClsWriteFile;

/* ===================================================================================================================== */

ClsIncludeTableConfig::setConfigSettingsCommon();

/* ===================================================================================================================== */

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $GetAllTableFileNames = new ClsGetAllTableFileNames();

    $ValidTables = $GetAllTableFileNames->getAllTableFileNames(__DIR__, OTHERTABLESEARCHSTRING, false);

    if ((count($ValidTables) > 0) && !isset($_GET['AddTable']) && !isset($_GET['EditConfig'])) {
        header("location:" . current(array_slice($ValidTables, 0, 1, true)));
    } elseif ((!isset($_GET['AddTable']) || ($_GET['AddTable'] == 'yes')) && !isset($_GET['EditConfig'])) {
        $html = new ModeliXe(URLBASE . TEMPLATEDIRNAME . DIRECTORY_SEPARATOR . "form.add.table.mysql.table.editor.tpl", '', '', -1, false);

        $html->setModeliXe();

        $html->mxText("Title", "MySQLTableEditor v2 Add Table");
        $html->mxText("url_base", URLBASE);
        $html->mxText("CSSDirName", CSSDIRNAME);
        $html->mxText("CSSFileName", CSSFILENAME);
        $html->mxText("JavascriptDirName", JAVASCRIPTDIRNAME);
        $html->mxText("JavascriptFileName", JAVASCRIPTFILENAME);

        if (count($ValidTables) > 0) {
            $html->mxText("Disabled", "");
        } else {
            $html->mxText("Disabled", "disabled");
        }

        $html->mxWrite(false);
        unset($html);
    } elseif (isset($_GET['EditConfig'])) {
        if (file_exists($_GET['EditConfig'])) {
            $RequestedTable = file_get_contents($_GET['EditConfig']);

            $html = new ModeliXe(URLBASE . TEMPLATEDIRNAME . DIRECTORY_SEPARATOR . "form.edit.table.mysql.table.editor.tpl", '', '', -1, false);

            $html->setModeliXe();

            $html->mxText("Title", "MySQLTableEditor v2 Edit Table");
            $html->mxText("url_base", URLBASE);
            $html->mxText("CSSDirName", CSSDIRNAME);
            $html->mxText("CSSFileName", CSSFILENAME);
            $html->mxText("JavascriptDirName", JAVASCRIPTDIRNAME);
            $html->mxText("JavascriptFileName", JAVASCRIPTFILENAME);

            $html->mxText('TableName', (preg_match('#(\.php)$#', $_GET['EditConfig']) ? $_GET['EditConfig'] : $_GET['EditConfig'] . '.php'));
            $html->mxText('RequestedEditConfigTable', htmlspecialchars($RequestedTable));

            $html->mxWrite(false);
            unset($html);
        } else {
            echo "<h2>File does not exist.</h2>";
        }
    }

    unset($GetAllTableFileNames);
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['FrmAddTable'])) {
        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        extract($body);

        $FieldsinListViewAry = explode(',', $FieldsinListView);
        $FieldsinListView = implode(', ', array_map(function ($x) {
            return "'" . trim($x) . "'";
        }, $FieldsinListViewAry));

        $FieldsRequiredAry = explode(',', $FieldsRequired);
        $FieldsRequired = implode(', ', array_map(function ($x) {
            return "'" . trim($x) . "'";
        }, $FieldsRequiredAry));

        $ShowTextAddEditAry = explode(',', $ShowTextAddEdit);
        $ShowTextAddEdit = implode(', ', array_map(function ($x) {
            return "'" . trim($x) . "'";
        }, $ShowTextAddEditAry));

        $ShowTextListViewAry = explode(',', $ShowTextListView);
        $ShowTextListView = implode(', ', array_map(function ($x) {
            return "'" . trim($x) . "'";
        }, $ShowTextListViewAry));

        $html = new ModeliXe(URLBASE . TEMPLATEDIRNAME . DIRECTORY_SEPARATOR . "config.mysql.table.editor.table.tpl", '', '', -1, false);

        $html->setModeliXe();

        $html->mxText("AppTitle", $AppTitle);
        $html->mxText("HideFileNameExt", $HideFileNameExt);
        $html->mxText("NumberRowsListView", $NumberRowsListView);
        $html->mxText("Language", $Language);
        $html->mxText("HtAccessWarning", $HtAccessWarning);
        $html->mxText("TableName", $TableName);
        $html->mxText("PrimaryKey", $PrimaryKey);
        $html->mxText("FieldsinListView", $FieldsinListView);
        $html->mxText("FieldsRequired", $FieldsRequired);
        $html->mxText("ShowTextAddEdit", $ShowTextAddEdit);
        $html->mxText("ShowTextListView", $ShowTextListView);

        $TableFile = new ClsWriteFile();
        $TableFile->saveData($html->mxWrite(true), false);
        $TableFile->write('Table' . $TableName . ".php");

        unset($TableFile);
        unset($html);
        echo "<h2>File Written. Refresh does not work. Reload the App to redirect to the new table. If a mistake was made, manually edit you Table config file.</h2>";
    } elseif (isset($_POST['FrmEditTable'])) {
        file_put_contents($_POST['TableName'], $_POST['EditConfigTable']);
        header('location:' . $_SERVER['SCRIPT_NAME']);
    }
}
