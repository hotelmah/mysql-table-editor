<?php

declare(strict_types=1);

namespace MySQLTableEditor;

date_default_timezone_set("America/Chicago");

// class.mysql.table.editor.map.data.template

class ClsMapperToTemplates
{
    public static function mapTableEditorHtmlDataToTemplate(object $TempTableEditor, object &$TempTemplate_html): void
    {
        $TempTemplate_html->setModeliXe();

        $TempTemplate_html->mxText("Title", WEBPAGETITLE);
        $TempTemplate_html->mxText("AppTitle", $TempTableEditor->AppTitle);
        $TempTemplate_html->mxText("url_base", $TempTableEditor->url_base);
        $TempTemplate_html->mxText("url_script", $TempTableEditor->url_script);
        $TempTemplate_html->mxText("CSSDirName", CSSDIRNAME);
        $TempTemplate_html->mxText("CSSFileName", CSSFILENAME);
        $TempTemplate_html->mxText("JavascriptDirName", JAVASCRIPTDIRNAME);
        $TempTemplate_html->mxText("JavascriptFileName", JAVASCRIPTFILENAME);

        $TempTemplate_html->mxText("CurrentFormattedDate", date("l, F d, Y"));
        $TempTemplate_html->mxSelect("SelectTableTop", "SelectTableTop", "SelectTableTop", null, $TempTableEditor->getAllTableFileNames(getcwd(), OTHERTABLESEARCHSTRING, HIDEFILENAMEEXTENSION), '', '', '');
        $TempTemplate_html->mxSelect("SelectTableBottom", "SelectTableBottom", "SelectTableBottom", null, $TempTableEditor->getAllTableFileNames(getcwd(), OTHERTABLESEARCHSTRING, HIDEFILENAMEEXTENSION), '', '', '');
        $TempTemplate_html->mxText("textGo", $TempTableEditor->getText('Go'));
        $TempTemplate_html->mxText("textEdit", $TempTableEditor->getText('Edit'));

        /* ===================================================================================================================== */

        $TempTemplate_html->mxText("last_page_html", $TempTableEditor->last_page_html);
        $TempTemplate_html->mxText("navigation", $TempTableEditor->navigation);
        $TempTemplate_html->mxText("next_page_html", $TempTableEditor->next_page_html);
        $TempTemplate_html->mxText("navigationSelectOption", $TempTableEditor->navigationSelectOption);

        /* ===================================================================================================================== */

        $TempTemplate_html->mxText("Protect_this_directory_with", $TempTableEditor->getText('Protect_this_directory_with'));

        if ($TempTableEditor->htaccess_warning_result == 'enabled') {
            $TempTemplate_html->mxText("htaccess_warning_comment_start", '');
            $TempTemplate_html->mxText("htaccess_warning_comment_end", '');
        } else {
            $TempTemplate_html->mxText("htaccess_warning_comment_start", '<!--');
            $TempTemplate_html->mxText("htaccess_warning_comment_end", '-->');
        }

        /* ===================================================================================================================== */

        $TempTemplate_html->mxText("BlocTopActionBar.urlScript", $TempTableEditor->url_script);
        $TempTemplate_html->mxText("BlocTopActionBar.urlScriptBase", $TempTableEditor->url_script_base);
        $TempTemplate_html->mxText("BlocTopActionBar.queryString", $TempTableEditor->query_string);
        $TempTemplate_html->mxText("BlocTopActionBar.textAddRecord", $TempTableEditor->getText('Add_Record'));
        $TempTemplate_html->mxText("BlocTopActionBar.textAddNewTable", $TempTableEditor->getText('Add_Table'));
        $TempTemplate_html->mxText("BlocTopActionBar.in_search_value", $TempTableEditor->in_search_value);
        $TempTemplate_html->mxText("BlocTopActionBar.textSearch", $TempTableEditor->getText('Search'));
        $TempTemplate_html->mxText("BlocTopActionBar.options", $TempTableEditor->options);
        $TempTemplate_html->mxText("BlocTopActionBar.textGo", $TempTableEditor->getText('Go'));
        $TempTemplate_html->mxText("BlocTopActionBar.textClearSearch", $TempTableEditor->getText('Clear_Search'));

        if (empty($_GET['s']) && empty($_GET['f'])) {
            $TempTemplate_html->mxText("BlocTopActionBar.startCommentClearSearch", '<!--');
            $TempTemplate_html->mxText("BlocTopActionBar.endCommentClearSearch", '-->');
            $TempTemplate_html->mxText("BlocTopActionBar.ClearSearchHighlight", '');
        } else {
            $TempTemplate_html->mxText("BlocTopActionBar.startCommentClearSearch", '');
            $TempTemplate_html->mxText("BlocTopActionBar.endCommentClearSearch", '');
            $TempTemplate_html->mxText("BlocTopActionBar.ClearSearchHighlight", 'ClearSearchHighlight');
        }

        /* ===================================================================================================================== */

        if ($TempTableEditor->edit) {
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.InputHiddenAddRecord", "<input type='hidden' name='mte_new_rec' value='0'>");
        } else {
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.InputHiddenAddRecord", "<input type='hidden' name='mte_new_rec' value='1'>");
        }

        /* ===================================================================================================================== */

        if ($TempTableEditor->show_add_edit_html) {
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.HistoryPage", $_SESSION['hist_page']);
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.textGoBack", $TempTableEditor->getText('Go_Back'));
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.urlScript", $TempTableEditor->url_script);
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.rows", $TempTableEditor->rows);
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.textResetThisRecord", $TempTableEditor->getText('Reset_This_Record'));
            $TempTemplate_html->mxText("BlocShowRecordAddEdit.textSave", $TempTableEditor->getText('Save'));

            $TempTemplate_html->mxBloc("BlocShowRecordsListView", 'dele');
            $TempTemplate_html->mxBloc("BlocTopActionBar", 'dele');
        } else {
            $TempTemplate_html->mxText("BlocShowRecordsListView.TableHeader", $TempTableEditor->TableHeader);
            $TempTemplate_html->mxText("BlocShowRecordsListView.rows", $TempTableEditor->rows);

            $TempTemplate_html->mxBloc("BlocShowRecordAddEdit", 'dele');
        }

        /* ===================================================================================================================== */

        if (!empty($TempTableEditor->content_error)) {
            $TempTemplate_html->mxBloc("BlocContentMessages", "modify", URLBASE . TEMPLATEDIRNAME . "/" . "mysql.table.editor.messages.tpl");
            $TempTemplate_html->mxBloc("BlocContentMessages.BlocContentDeleted", "dele");
            $TempTemplate_html->mxBloc("BlocContentMessages.BlocContentSaved", "dele");

            $TempTemplate_html->mxText("BlocContentMessages.BlocContentError.ContentErrorDescription", $TempTableEditor->content_error);
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentError.queryGetErrorNumber", $TempTableEditor->getQueryErrorNumber());
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentError.queryGetErrorMessage", $TempTableEditor->getQueryErrorMessage());
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentError.urlScript", $TempTableEditor->url_script);
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentError.textListRecords", $TempTableEditor->getText('List_Records'));
        } elseif (!empty($TempTableEditor->content_deleted)) {
            $TempTemplate_html->mxBloc("BlocContentMessages", "modify", URLBASE . TEMPLATEDIRNAME . "/" . "mysql.table.editor.messages.tpl");
            $TempTemplate_html->mxBloc("BlocContentMessages.BlocContentError", "dele");
            $TempTemplate_html->mxBloc("BlocContentMessages.BlocContentSaved", "dele");

            $TempTemplate_html->mxText("BlocContentMessages.BlocContentDeleted.ShowTextAddEditPrimaryKey", (isset($TempTableEditor->show_text_AddEdit[$TempTableEditor->primary_key]) ? $TempTableEditor->show_text_AddEdit[$TempTableEditor->primary_key] : $TempTableEditor->primary_key));
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentDeleted.DeleteID", $TempTableEditor->content_deleted);
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentDeleted.textDeleted", $TempTableEditor->getText('Deleted'));
        } elseif ($TempTableEditor->content_saved != 0) {
            $TempTemplate_html->mxBloc("BlocContentMessages", "modify", URLBASE . TEMPLATEDIRNAME . "/" . "mysql.table.editor.messages.tpl");
            $TempTemplate_html->mxBloc("BlocContentMessages.BlocContentError", "dele");
            $TempTemplate_html->mxBloc("BlocContentMessages.BlocContentDeleted", "dele");

            $TempTemplate_html->mxText("BlocContentMessages.BlocContentSaved.ShowTextAddEditPrimaryKey", (isset($TempTableEditor->show_text_AddEdit[$TempTableEditor->primary_key]) ? $TempTableEditor->show_text_AddEdit[$TempTableEditor->primary_key] : $TempTableEditor->primary_key));
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentSaved.SavedID", $TempTableEditor->content_saved);
            $TempTemplate_html->mxText("BlocContentMessages.BlocContentSaved.textSaved", $TempTableEditor->getText('Saved'));
        }

        /* ===================================================================================================================== */
    }

    /* ===================================================================================================================== */

    public static function mapTableEditorCSSDataToTemplate(object $TempTableEditor, object &$TempTemplate_css): void
    {
        $TempTemplate_css->setModeliXe();

        $TempTemplate_css->mxText("width_input_fields", $TempTableEditor->width_input_fields);
        $TempTemplate_css->mxText("width_textarea_fields", $TempTableEditor->width_textarea_fields);
        $TempTemplate_css->mxText("height_textarea_fields", $TempTableEditor->height_textarea_fields);
    }

    /* ===================================================================================================================== */

    public static function mapTableEditorJavascriptDataToTemplate(object $TempTableEditor, object &$TempTemplate_javascript): void
    {
        $TempTemplate_javascript->setModeliXe();

        $TempTemplate_javascript->mxText("textDelete", $TempTableEditor->getText('Delete'));
        $TempTemplate_javascript->mxText("showPrimaryKey", (isset($TempTableEditor->show_text_listview[$TempTableEditor->primary_key]) ? $TempTableEditor->show_text_listview[$TempTableEditor->primary_key] : $TempTableEditor->primary_key));
        $TempTemplate_javascript->mxText("urlScript", $TempTableEditor->url_script);
        $TempTemplate_javascript->mxText("queryString", $TempTableEditor->query_string);
        $TempTemplate_javascript->mxText("count_required", $TempTableEditor->count_required);
        $TempTemplate_javascript->mxText("textNothingToSearch", $TempTableEditor->getText('Nothing_To_Search'));
        $TempTemplate_javascript->mxText("textNothingToSave", $TempTableEditor->getText('Nothing_To_Save'));
        $TempTemplate_javascript->mxText("textChkRequiredFields", $TempTableEditor->getText('Check_the_required_fields'));
        $TempTemplate_javascript->mxText("RecordAddSaveScript", $TempTableEditor->RecordAddSaveScript);
    }
}
/* ===================================================================================================================== */
