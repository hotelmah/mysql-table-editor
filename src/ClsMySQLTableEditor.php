<?php

declare(strict_types=1);

namespace MySQLTableEditor;

date_default_timezone_set("America/Chicago");

use MySQLi\ClsDataBaseWrapperMTE;
use MySQLTableEditor\TraitGetAllTableFileNames;

// class.mysql.table.editor
// cSpell:disable

/* ===================================================================================================================== */

/*
    * MySQL Table Editor v2
    *
    * Copyright (c) 2018, 2024 Martin Meijer and hotelmah (November 13, 2024)
    *
    * https://sourceforge.net/projects/sql-edit-table/
    *
    * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    * THE SOFTWARE.
    *
*/

/* ===================================================================================================================== */
// No Direct Access
if (strtolower(basename($_SERVER['PHP_SELF'])) == strtolower(basename(__FILE__))) {
    die('No access...');
}
/* ===================================================================================================================== */

class ClsMySQLTableEditor
{
    use TraitGetAllTableFileNames;
    use Languages;

    private string $version;
    public string $AppTitle;

    private string $language;
    private array $text;

    private object $mysqli;

    private string $table;
    public string $primary_key;

    # the fields you want to see in "list view"
    public array $fields_in_list_view;

    # numbers of rows/records in "list view"
    public int $num_rows_list_view;

    # required fields in edit or add record
    public array $fields_required;

    # Fields you want to edit:
    public array $fields_to_not_edit;

    # help text
    public array $help_text;

    # visible name of the fields in Add/Edit
    public array $show_text_AddEdit;

    # visible name of the fields in listview
    public array $show_text_listview;

    public string $width_input_fields;
    public string $width_textarea_fields;
    public string $height_textarea_fields;

    # warning no .htaccess ('on' or 'off')
    public string $htaccess_warning;
    public string $htaccess_warning_result;

    public array $lookup_table;

    public string $url_base;
    public string $url_script;
    public string $url_script_base;
    private string $ImagesDirName;

    public int $content_saved;
    public string $content_deleted;
    public string $content_error;

    public string $last_page_html;
    public string $next_page_html;
    public string $navigation;
    public string $navigationSelectOption;

    public int $start;
    public string $query_string;
    public string $in_search_value;
    public string $options;

    public string $TableHeader;
    public string $rows;

    public bool $edit;
    public int $count_required;
    public bool $show_add_edit_html;
    public string $RecordAddSaveScript;

    /* ===================================================================================================================== */
    public function __construct(string $TempTableName, string $TempTablePrimaryKey, array $TempFieldsInListView, string $TempAppTitle, string $TempLanguage, int $TempNumberRowsInListView, array $TempFieldsRequired, array $TempFieldsToNotEdit, array $TempFieldHelpTexts, array $TempShowTextAddEdit, array $TempShowTextListView, array $TempLookupTable, string $TempScriptName, string $TempImagesDirName, string $TempURLBase = './', bool $TempHideFileNameExt = false)
    {
        /* ===================================================================================================================== */

        $this->version = 'MySQL Table Editor v2';

        /* ===================================================================================================================== */

        $this->mysqli = new ClsDataBaseWrapperMTE();

        /* ===================================================================================================================== */
        if (!empty($TempTableName)) {
            $this->table = $TempTableName;
        } else {
            $this->table = '';
        }

        if (!empty($TempTablePrimaryKey)) {
            $this->primary_key = $TempTablePrimaryKey;
        } else {
            $this->primary_key = '';
        }
        /* ===================================================================================================================== */

        if (is_array($TempFieldsInListView) && count($TempFieldsInListView) > 0) {
            $this->fields_in_list_view = $TempFieldsInListView;
        } else {
            $this->fields_in_list_view = array();
        }

        /* ===================================================================================================================== */

        if (!empty($TempAppTitle)) {
            $this->AppTitle = $TempAppTitle;
        } else {
            $this->AppTitle = $this->version;
        }

        /* ===================================================================================================================== */

        $this->text = array();

        switch ($TempLanguage) {
            case 'de':
                $this->language = $TempLanguage;
                $this->german();
                break;
            case 'fr':
                $this->language = $TempLanguage;
                $this->french();
                break;
            case 'it':
                $this->language = $TempLanguage;
                $this->italian();
                break;
            case 'nl':
                $this->language = $TempLanguage;
                $this->dutch();
                break;
            case 'sw':
                $this->language = $TempLanguage;
                $this->swedish();
                break;
            case 'es':
                $this->language = $TempLanguage;
                $this->spanish();
                break;
            default:
                $this->language = 'en';
                $this->english();
        }

        /* ===================================================================================================================== */

        if (is_int($TempNumberRowsInListView)) {
            $this->num_rows_list_view = $TempNumberRowsInListView;
        } else {
            $this->num_rows_list_view = 5;
        }

        /* ===================================================================================================================== */

        if (is_array($TempFieldsRequired) && count($TempFieldsRequired) > 0) {
            $this->fields_required = $TempFieldsRequired;
        } else {
            $this->fields_required = array();
        }

        /* ===================================================================================================================== */

        if (is_array($TempFieldsToNotEdit) && count($TempFieldsToNotEdit) > 0) {
            $this->fields_to_not_edit = $TempFieldsToNotEdit;
        } else {
            $this->fields_to_not_edit = array();
        }

        /* ===================================================================================================================== */

        if (is_array($TempFieldHelpTexts) && count($TempFieldHelpTexts) > 0) {
            $this->help_text = $TempFieldHelpTexts;
        } else {
            $this->help_text = array();
        }

        /* ===================================================================================================================== */

        if (is_array($TempShowTextAddEdit) && count($TempShowTextAddEdit) > 0) {
            $this->show_text_AddEdit = $TempShowTextAddEdit;
        } else {
            $this->show_text_AddEdit = array();
        }

        /* ===================================================================================================================== */

        if (is_array($TempShowTextListView) && count($TempShowTextListView) > 0) {
            $this->show_text_listview = $TempShowTextListView;
        } else {
            $this->show_text_listview = array();
        }

        /* ===================================================================================================================== */

        if (is_array($TempLookupTable) && count($TempLookupTable) > 0) {
            $this->lookup_table = $TempLookupTable;
        } else {
            $this->lookup_table = array();
        }

        /* ===================================================================================================================== */

        $this->url_base = $TempURLBase;
        $this->ImagesDirName = $TempImagesDirName;

        /* ===================================================================================================================== */

        $this->content_deleted = '';
        $this->content_saved = 0;
        $this->content_error = '';

        $this->last_page_html = '';
        $this->next_page_html = '';
        $this->navigation = '';
        $this->navigationSelectOption = '';

        $this->start = 0;
        $this->query_string = '';
        $this->in_search_value = '';
        $this->options = '';

        $this->TableHeader = '';
        $this->rows = '';

        $this->count_required = 0;
        $this->show_add_edit_html = false;
        $this->edit = false;

        $this->RecordAddSaveScript = '';

        $this->width_input_fields = WIDTHINPUTFIELDS;
        $this->width_textarea_fields = WIDTHTEXTAREAFIELDS;
        $this->height_textarea_fields = HEIGHTTEXTAREAFIELDS;
        $this->htaccess_warning = HTACCESSWARNING;

        /* ===================================================================================================================== */

        $break = explode('/', $TempScriptName);
        $this->url_script = $break[count($break) - 1];

        if ($TempHideFileNameExt) {
            $this->url_script = explode('.', $this->url_script)[0];
        }

        $this->url_script_base = dirname($TempScriptName);

        /* ===================================================================================================================== */

        if (!isset($_GET['mte_a'])) {
            $_GET['mte_a'] = '';
        }
        if (!isset($_POST['mte_a'])) {
            $_POST['mte_a'] = '';
        }
        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '';
        }
        if (!isset($_GET['start'])) {
            $_GET['start'] = '';
        }
        if (!isset($_GET['ad'])) {
            $_GET['ad'] = '';
        }
        if (!isset($_GET['s'])) {
            $_GET['s'] = '';
        }
        if (!isset($_GET['f'])) {
            $_GET['f'] = '';
        }

        /* ===================================================================================================================== */

        // No Cache
        if (!headers_sent()) {
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: post-check=0, pre-check=0', false);
            header('Pragma: no-cache');
            header("Cache-control: private");
        }
    }
    /* ===================================================================================================================== */

    public function __destruct()
    {
        unset($this->mysqli);
    }

    /* ===================================================================================================================== */
    public function routeAndPopulate(): void
    {
        if ($_GET['mte_a'] == 'edit') {
            $this->show_add_edit_html = true;
            $this->edit = true;
            $this->editRec(intval($_GET['id']));
        } elseif ($_GET['mte_a'] == 'new') {
            $this->show_add_edit_html = true;
            $this->editRec(0);
        } elseif ($_GET['mte_a'] == 'del') {
            $this->delRec($_GET['id']);
        } elseif ($_POST['mte_a'] == 'save') {
            $this->esaveRec(intval($_POST['mte_new_rec']));
        } else {
            $this->showList();
        }

        /* ===================================================================================================================== */

        // Warning no htaccess
        $this->htaccess_warning_result = 'disabled';
        if (!file_exists('./.htaccess') && $this->htaccess_warning == 'on') {
            $this->htaccess_warning_result = 'enabled';
        }

        // Save page location + no page history on the edit page because after refresh the Go Back is useless
        if (!$_GET['mte_a']) {
            $_SESSION['hist_page'] = $this->url_script . '?' . $_SERVER['QUERY_STRING'];
        }
    }
    /* ===================================================================================================================== */


    /* ===================================================================================================================== */
    private function showList(): void
    {
        /* ===================================================================================================================== */

        # message after add or edit
        if (isset($_SESSION['content_saved'])) {
            $this->content_saved = intval($_SESSION['content_saved']);
            $this->RecordAddSaveScript = '';
            unset($_SESSION['content_saved']);
        }

        /* ===================================================================================================================== */

        if (isset($_GET["start"])) {
            $this->start = (int)$_GET["start"];
        }

        $this->query_string = '&start=' . $this->start;

        // sorting
        $this->query_string .= '&ad=' . $_GET['ad'] . '&sort=' . $_GET['sort'];

        // searching
        $this->query_string .= '&s=' . $_GET['s'] . '&f=' . $_GET['f'];

        /* ===================================================================================================================== */

        $this->mysqli->getTableRecords($this->buildSQLStatement());

        $TotalNumRows = $this->mysqli->resultSetFetchNumRows();

        $this->mysqli->getTableRecords($this->buildSQLStatement(true));

        /* ===================================================================================================================== */

        if ($this->mysqli->resultSetFetchNumRows() > 0) {
            $count = 0;

            while ($rij = $this->mysqli->resultSetFetchNextRow()) {
                $count++;
                $this_row = '';

                if ($count == 1) {
                    $this->TableHeader = "<th class='mte_nowrap'>Actions</th>";
                }

                foreach ($rij as $key => $value) {
                    $sort_image = '';
                    if (in_array($key, $this->fields_in_list_view, true)) {
                        if ($count == 1) {
                            // show nice text of a value
                            if ($this->show_text_listview[$key]) {
                                $show_key = $this->show_text_listview[$key];
                            } else {
                                $show_key = $key;
                            }

                            # default sort (a = ascending)
                            $ad = 'a';

                            // sorting
                            if ($_GET['sort'] == $key && $_GET['ad'] == 'a') {
                                $sort_image = "<img src='" . $this->url_base . $this->ImagesDirName . "/sort_a.png' class='SortImage' alt='Ascending' title='Ascending'>";
                                $ad = 'd';
                            }
                            if ($_GET['sort'] == $key && $_GET['ad'] == 'd') {
                                $sort_image = "<img src='" . $this->url_base . $this->ImagesDirName . "/sort_d.png' class='SortImage' alt='Descending' title='Descending'>";
                                $ad = 'a';
                            }

                            // remove sort and add new ones
                            $query_sort = preg_replace('/&(sort|ad)=[^&]*/', '', $this->query_string) . "&sort=$key&ad=$ad";

                            $this->TableHeader .= "<th class='mte_nowrap'><a href='$this->url_script?$query_sort'>$show_key</a> $sort_image</th>";
                        }

                        if ($key == $this->primary_key) {
                            $buttons = "\t<td class='mte_nowrap'>";
                            $buttons .= "<a href='javascript:void(0)' onclick='del_confirm($value)' title='{$this->getText('Delete')}'>";
                            $buttons .= "\t<img src='" . $this->url_base . $this->ImagesDirName . "/del.png' class='icons_del_edit' title='Delete {$this->show_text_listview[$key]} $value'>";
                            $buttons .= "</a>";
                            $buttons .= "&nbsp; &nbsp;";
                            $buttons .= "<a href='?$this->query_string&mte_a=edit&id=$value' title='{$this->getText('Edit')}'>";
                            $buttons .= "<img src='" . $this->url_base . $this->ImagesDirName . "/edit.png' class='icons_del_edit' title='Edit {$this->show_text_listview[$key]} $value'>";
                            $buttons .= "</a>";
                            $buttons .= "</td>\n";

                            $this_row .= "\t<td>$value</td>\n";
                        } else {
                            $this_row .= "\t<td>" . substr($value, 0, 300) . "</td>\n";
                        }
                    }
                }

                $this->rows .= "\n<tr>\n" . $buttons . $this_row . "</tr>\n";
            }
        } else {
            $this->TableHeader = "<td class='NothingFound'>{$this->getText('Nothing_Found')}...</td>";
        }
        /* ===================================================================================================================== */

        # remove start= from url
        $query_nav = preg_replace('/&(start|mte_a|id)=[^&]*/', '', $this->query_string);

        # this page
        $this_page = ($this->num_rows_list_view + $this->start) / $this->num_rows_list_view;

        # last page
        $last_page = ceil($TotalNumRows / $this->num_rows_list_view);

        # navigation numbers
        if ($this_page > 10) {
            $vanaf = $this_page - 10;
        } else {
            $vanaf = 1;
        }
        if ($last_page > $this_page + 10) {
            $tot = $this_page + 10;
        } else {
            $tot = $last_page;
        }


        for ($f = $vanaf; $f <= $tot; $f++) {
            $nav_toon = $this->num_rows_list_view * ($f - 1);

            if ($f == $this_page) {
                $this->navigation .= "<a href='' class='CurrentPage'>$f</a>";
                $this->navigationSelectOption .= "<option value='$this->url_script?$query_nav&start=$nav_toon' selected>$f</option>";
            } else {
                $this->navigation .= "<a href='$this->url_script?$query_nav&start=$nav_toon' class='OtherPage'>$f</a>";
                $this->navigationSelectOption .= "<option value='$this->url_script?$query_nav&start=$nav_toon'>$f</option>";
            }
        }
        if ($TotalNumRows < $this->num_rows_list_view) {
            $this->navigation = '';
            $this->navigationSelectOption = "<option value='' selected>Empty</option>";
        }


        # Previous if
        if ($this_page > 1) {
            $last =  (($this_page - 1) * $this->num_rows_list_view) - $this->num_rows_list_view;
            $this->last_page_html = "<a href='$this->url_script?$query_nav&start=$last' class='mte_nav_prev_next'>{$this->getText('Previous')}</a>";
        }

        # Next if
        if (($this_page != $last_page) && ($TotalNumRows > 1)) {
            $next =  $this->start + $this->num_rows_list_view;
            $this->next_page_html =  "<a href='$this->url_script?$query_nav&start=$next' class='mte_nav_prev_next'>{$this->getText('Next')}</a>";
        }

        /* ===================================================================================================================== */
        # Search form options
        $in_search_field = $_GET['f'];

        foreach ($this->fields_in_list_view as $option) {
            if ($this->show_text_listview[$option]) {
                $show_option = $this->show_text_listview[$option];
            } else {
                $show_option = $option;
            }

            if ($option == $in_search_field) {
                $this->options .= "<option selected value='$option'>$show_option</option>";
            } else {
                $this->options .= "<option value='$option'>$show_option</option>";
            }
        }
        $this->in_search_value = htmlentities(trim(stripslashes($_GET['s'])), ENT_QUOTES, "UTF-8");
    }
    /* ===================================================================================================================== */


    /* ===================================================================================================================== */
    private function delRec(string $in_id): void
    {
        if ($this->mysqli->deleteUpdateRecord("DELETE FROM " . $this->table . " WHERE `" . $this->primary_key . "` = '" . $in_id . "'")) {
            $this->content_deleted = $in_id;
            $this->showList();
        } else {
            $this->content_error = "Problem Encountered Deleting Record";
        }
    }
    /* ===================================================================================================================== */


    /* ===================================================================================================================== */
    private function editRec(int $in_id): void
    {
        /* ===================================================================================================================== */

        $this->mysqli->getTableRecords("SHOW COLUMNS FROM `" . $this->table . "`");

        # get field types
        while ($rij = $this->mysqli->resultSetFetchNextRow()) {
            extract($rij);

            $field_type[$Field] = $Type;
        }

        if (!$this->edit) {
            $rij = $field_type;
        } else {
            if ($this->edit) {
                $where_edit = "WHERE `" . $this->primary_key . "` = " . $in_id;
            }

            $this->mysqli->getTableRecords("SELECT * FROM `" . $this->table . "` " . $where_edit . " LIMIT 1");

            $rij = $this->mysqli->resultSetFetchNextRow();
        }

        $this->navigationSelectOption = "<option value='' selected>Empty</option>";

        /* ===================================================================================================================== */
        foreach ($rij as $key => $value) {
            if (!$this->edit) {
                $value = '';
            }

            $field = '';
            $options = '';
            $style = '';
            $field_id = '';
            $readonly = '';
            $maxlength = '';
            $value_htmlentities = '';

            if (in_array($key, $this->fields_required, true)) {
                $this->count_required++;
                $style = "class='Required'";
                $field_id = "id='id_" . $this->count_required . "'";
            } else {
                $field_id = "id='" . $key . "'";
            }

            $field_kind = $field_type[$key];

            if (preg_match('/^varchar\(([4-9]|[4-9]\d|\d{3,4})\)$/', $field_kind, $matches)) {
                $maxlength = $matches[1];
            } elseif ($field_kind == "int") {
                $maxlength = '5';
            } elseif (($field_kind == 'date') || ($field_kind == 'datetime')) {
                $maxlength = '20';
            }

            # different fields
            # textarea

            if (preg_match('/^varchar\(([5-9]\d|\d{3,})\)$/', $field_kind)) {
                $field = "<textarea $field_id name='$key' maxlength='$maxlength' $style>$value</textarea>";
            } elseif (preg_match("/enum\((.*)\)/", $field_kind, $matches)) {
                # select/options
                $all_options = substr($matches[1], 1, -1);
                $options_array = explode("','", $all_options);
                foreach ($options_array as $option) {
                    if ($option == $value) {
                        $options .= "<option selected>$option</option>";
                    } else {
                        $options .= "<option>$option</option>";
                    }
                }
                $field = "<select $field_id name='$key' $style>$options</select>";
            } elseif (!preg_match("/blob/", $field_kind)) {
                # input
                if (preg_match("/\(*(.*)\)*/", $field_kind, $matches)) {
                    if (($key == $this->primary_key) || (in_array($key, $this->fields_to_not_edit, true))) {
                        $style = "style='background: grey'";
                        $readonly = 'readonly';
                    }

                    if ($value == null) {
                        $value_htmlentities = '';
                    } elseif (($key == $this->primary_key)) {
                        $value_htmlentities = $value;
                    } else {
                        $value_htmlentities = htmlentities($value, ENT_QUOTES, "UTF-8");
                    }

                    if (!$this->edit && $key == $this->primary_key) {
                        $field = "<input type='hidden' name='$key' value=''>[auto increment]";

                        // if you want to change the value of the primary_key,
                        // remove the <input hidden> and use these 4 lines:
                        // *** START ***
                        // $result = mysqli_query ($this->mysqli, "SELECT $this->primary_key FROM $this->table ORDER BY $this->primary_key DESC LIMIT 1");
                        // $row = mysqli_fetch_array ($result, MYSQLI_NUM);
                        // $new_last_id = $row[0]+1;
                        // $field = "<input type='text' name='$key' value='$new_last_id'>[auto increment]";
                        // *** END ***
                    } else {
                        if (isset($this->lookup_table[$key])) {
                            if (is_array($this->lookup_table[$key])) {
                                $this->mysqli->getTableRecords($this->lookup_table[$key]['query']);
                                if ($this->mysqli->resultSetFetchNumRows() > 0) {
                                    while ($menu_items = $this->mysqli->resultSetFetchNextRow()) {
                                        $option_value = $menu_items[$this->lookup_table[$key]['option_value']];
                                        $option_text = $menu_items[$this->lookup_table[$key]['option_text']];
                                        $option_value = str_replace('"', "&quot;", $option_value);
                                        if (str_replace("&quot;", '"', $option_value) == $value) {
                                            $options .= "<option selected value=\"$option_value\">$option_text</option>";
                                        } else {
                                            $options .= "<option value=\"$option_value\">$option_text</option>";
                                        }
                                    }
                                    $field = "<select $field_id name='$key' $style>$options</select>";
                                }
                                $field = "<select $field_id name='$key' $style>$options</select>";
                            }
                        } elseif ($field_kind == 'date') {
                            $field = "<input type='date' $field_id name='$key' value='$value_htmlentities' maxlength='$maxlength' $readonly $style>";
                        } elseif ($field_kind == 'datetime') {
                             $field = "<input type='datetime-local' $field_id name='$key' value='$value_htmlentities' maxlength='$maxlength' $readonly $style>";
                        } else {
                            $field = "<input type='text' $field_id name='$key' value='$value_htmlentities' maxlength='$maxlength' $readonly $style>";
                        }
                    }
                }
            } elseif (preg_match("/blob/", $field_kind)) {
                # blob: don't show
                $field = '[<i>binary</i>]';
            }

            # make table row
            if (isset($this->show_text_AddEdit[$key])) {
                $show_key = $this->show_text_AddEdit[$key];
            } else {
                $show_key = $key;
            }

            $this->rows .= "\n<tr>\n\t<td class='AddEditFieldNameColumn'>" . $show_key . "</td>\n\t<td class='AddEditFieldValueColumn'>" . $field . "</td>\n\t<td class='AddEditHelpTextColumn'>" . (isset($this->help_text[$key]) ? $this->help_text[$key] : "[Help Key Not Set]")  . "</td>\n</tr>";
        }
    }
    /* ===================================================================================================================== */


    /* ===================================================================================================================== */
    private function esaveRec(int $in_mte_new_rec): void
    {
        $insert_fields = '';
        $insert_values = '';
        $updates = '';

        /* ===================================================================================================================== */

        foreach ($_POST as $key => $value) {
            if ($key == $this->primary_key) {
                $in_id = $value;
                $where = "$key = $value";
            }

            if (($key != 'mte_a' && $key != 'mte_new_rec' && $key != 'option') && (!in_array($key, $this->fields_to_not_edit, true))) {
                if ($in_mte_new_rec) {
                    $insert_fields .= "`$key`, ";
                    if ($key == $this->primary_key) {
                        $insert_values .= "null, ";
                    } else {
                        $insert_values .= " '" . addslashes(stripslashes($value)) . "', ";
                    }
                } else {
                    $updates .= " `$key` = '" . addslashes(stripslashes($value)) . "', ";
                }
            }
        }

        /* ===================================================================================================================== */

        // Remove trailing comma
        $insert_fields = substr($insert_fields, 0, -2);
        $insert_values = substr($insert_values, 0, -2);
        $updates = substr($updates, 0, -2);

        /* ===================================================================================================================== */

        if ($in_mte_new_rec) {
            # new record:
            $sql = "INSERT INTO `$this->table` ($insert_fields) VALUES ($insert_values);";
        } else {
            # edit record:
            $sql = "UPDATE `$this->table` SET $updates WHERE $where LIMIT 1;";
        }
        /* ===================================================================================================================== */

        if ($this->mysqli->deleteUpdateRecord($sql)) {
            if ($in_mte_new_rec) {
                $saved_id = $this->mysqli->queryGetInsUpdAutoGenID();
                $_GET['s'] = $saved_id;
                $_GET['f'] = $this->primary_key;
            } else {
                $saved_id = $in_id;
            }

            $_SESSION['content_saved'] = $saved_id;

            if ($in_mte_new_rec) {
                $this->RecordAddSaveScript = 'setTimeout(function() {window.location="' . $_SESSION['hist_page'] . 'start=0&f=&sort=' . $this->primary_key . '&ad=d";}, 500);';
            } else {
                $this->RecordAddSaveScript = 'setTimeout(function() {window.location="' . $_SESSION['hist_page'] . '";}, 500);';
            }
        } else {
            $this->content_error = "Problem Encountered Saving Record";
        }
    }
    /* ===================================================================================================================== */

    private function buildSQLStatement(bool $TempAddLimit = false): string
    {
        if ($_GET['sort'] && in_array($_GET['sort'], $this->fields_in_list_view, true)) {
            if ($_GET['ad'] == 'a') {
                $asc_des = 'ASC';
            }
            if ($_GET['ad'] == 'd') {
                $asc_des = 'DESC';
            }
            $order_by = "ORDER BY " . $_GET['sort'] . ' ' . $asc_des;
        } else {
            $order_by = "ORDER BY " . $this->primary_key . " DESC";
        }

        // Search
        $in_search_field = '';
        $where_search = '';
        if ($_GET['s'] && $_GET['f']) {
            $in_search = addslashes(stripslashes($_GET['s']));
            $in_search_field = $_GET['f'];

            if ($in_search_field == $this->primary_key) {
                $where_search = "WHERE " . $in_search_field . " = '" . $in_search . "'";
            } else {
                $where_search = "WHERE " . $in_search_field . " LIKE '%" . $in_search . "%'";
            }
        }

        $sql = "SELECT * FROM `" . $this->table . "` " . $where_search . ' ' . $order_by;

        if ($TempAddLimit) {
            $sql .= " LIMIT " . $this->start . ", " . $this->num_rows_list_view;
        }
        return $sql;
    }
    /* ===================================================================================================================== */

    public function getText(string $TempTranslate): string
    {
        return (isset($this->text[$TempTranslate]) ? $this->text[$TempTranslate] : "[Text Not Found]");
    }

    /* ===================================================================================================================== */

    public function getQueryErrorNumber(): int
    {
        return $this->mysqli->queryGetErrorNumber();
    }

    public function getQueryErrorMessage(): string
    {
        return $this->mysqli->queryGetErrorMessage();
    }
}

/* ===================================================================================================================== */
/* ===================================================================================================================== */

//phpcs:ignore
trait Languages
{
    public function english(): void
    {
        $this->text['Add_Record'] = 'Add Record';
        $this->text['Add_Table'] = 'Add New Table';
        $this->text['Clear_Search'] = 'Clear Search';
        $this->text['Search'] = 'Search';

        $this->text['Go'] = 'Go';
        $this->text['Go_Back'] = 'Go Back';
        $this->text['List_Records'] = 'List Records';

        $this->text['Reset_This_Record'] = 'Reset This Record';
        $this->text['Save'] = 'Save';
        $this->text['Saved'] = 'Saved';
        $this->text['Edit'] = 'Edit';
        $this->text['Delete'] = 'Delete';
        $this->text['Deleted'] = 'Deleted';

        $this->text['Previous'] = 'Previous';
        $this->text['Next'] = 'Next';

        $this->text['Nothing_Found'] = 'Nothing Found';
        $this->text['Check_the_required_fields'] = 'Check the required (yellow) fields';
        $this->text['Nothing_To_Search'] = "Nothing to Search. Please enter text into Search Field.";
        $this->text['Nothing_To_Save'] = "Nothing to Save. No changes were made.";
        $this->text['Protect_this_directory_with'] = 'Protect this directory with';
    }

    public function german(): void
    {
        $this->text['Add_Record'] = 'Neuer Datensatz';
        $this->text['Add_Table'] = 'Tabelle hinzufügen';
        $this->text['Clear_Search'] = 'Suche Zurücksetzen';
        $this->text['Search'] = 'Suche';

        $this->text['Go'] = 'Gehen';
        $this->text['Go_Back'] = 'Zurück ohne Änderung';
        $this->text['List_Records'] = 'Auflisten von Datensätzen';

        $this->text['Reset_This_Record'] = 'Diesen Datensatz zurücksetzen';
        $this->text['Save'] = 'Speichern';
        $this->text['Saved'] = 'Gespeichert';
        $this->text['Edit'] = 'Bearbeiten';
        $this->text['Delete'] = 'Löschen';
        $this->text['Deleted'] = 'Gelöscht';

        $this->text['Previous'] = 'Vorherige';
        $this->text['Next'] = 'Nächste';

        $this->text['Nothing_Found'] = 'Nichts Gefunden';
        $this->text['Check_the_required_fields'] = 'Überprüfe die (gelb hinterlegten) Pflichtfelder';
        $this->text['Nothing_To_Search'] = "Nichts zu suchen. Bitte geben Sie Text in das Suchfeld ein.";
        $this->text['Nothing_To_Save'] = "Nichts zu speichern. Es wurden keine Änderungen vorgenommen.";
        $this->text['Protect_this_directory_with'] = 'Schütze dieses Verzeichnis per';
    }

    public function french(): void
    {
        $this->text['Add_Record'] = 'Ajouter un enregistrement';
        $this->text['Add_Table'] = 'ajouter un tableau';
        $this->text['Clear_Search'] = 'Réinitialiser la recherche';
        $this->text['Search'] = 'Rechercher';

        $this->text['Go'] = 'Aller';
        $this->text['Go_Back'] = 'Revenir';
        $this->text['List_Records'] = 'Liste des enregistrements';

        $this->text['Reset_This_Record'] = 'Réinitialiser cet enregistrement';
        $this->text['Save'] = 'Enregistrer';
        $this->text['Saved'] = 'Enregistré';
        $this->text['Edit'] = 'Editer';
        $this->text['Delete'] = 'Supprimer';
        $this->text['Deleted'] = 'Supprimé';

        $this->text['Previous'] = 'Précédent';
        $this->text['Next'] = 'Suivant';

        $this->text['Nothing_Found'] = 'Aucun enregistrement trouvé';
        $this->text['Check_the_required_fields'] = 'Vérifiez les champs obligatoires (jaunes)';
        $this->text['Nothing_To_Search'] = "Rien à rechercher. Veuillez saisir du texte dans le champ de recherche.";
        $this->text['Nothing_To_Save'] = "Rien à sauvegarder. Aucune modification n'a été apportée.";
        $this->text['Protect_this_directory_with'] = 'Protégez ce répertoire avec';
    }

    public function italian(): void
    {
        $this->text['Add_Record'] = 'Nuova Riga';
        $this->text['Add_Table'] = 'aggiungere tabella';
        $this->text['Clear_Search'] = 'Resetta Ricerca';
        $this->text['Search'] = 'Cerca';

        $this->text['Go'] = 'Andare';
        $this->text['Go_Back'] = 'Indietro';
        $this->text['List_Records'] = 'Elenco record';

        $this->text['Reset_This_Record'] = 'Reimposta questo record';
        $this->text['Save'] = 'Salva';
        $this->text['Saved'] = 'Salvato';
        $this->text['Edit'] = 'Modifica';
        $this->text['Delete'] = 'Elimina';
        $this->text['Deleted'] = 'Eliminato';

        $this->text['Previous'] = 'Precedente';
        $this->text['Next'] = 'Successivo';

        $this->text['Nothing_Found'] = 'Nessun Risultato!';
        $this->text['Check_the_required_fields'] = 'Controlla i campi (gialli) obbligatori';
        $this->text['Nothing_To_Search'] = "Niente da cercare. Inserisci il testo nel campo di ricerca.";
        $this->text['Nothing_To_Save'] = "Niente da salvare. Non sono state apportate modifiche.";
        $this->text['Protect_this_directory_with'] = 'Proteggi questa directory con';
    }

    public function dutch(): void
    {
        $this->text['Add_Record'] = 'Toevoegen';
        $this->text['Add_Table'] = 'tabel toevoegen';
        $this->text['Clear_Search'] = 'Reset Zoeken';
        $this->text['Search'] = 'Zoek';

        $this->text['Go'] = 'Gaan';
        $this->text['Go_Back'] = 'Terug';
        $this->text['List_Records'] = 'Lijst Records';

        $this->text['Reset_This_Record'] = 'Reset dit record';
        $this->text['Save'] = 'Bewaren';
        $this->text['Saved'] = 'Bewaard';
        $this->text['Edit'] = 'Bewerken';
        $this->text['Delete'] = 'Verwijder';
        $this->text['Deleted'] = 'Verwijderd';

        $this->text['Previous'] = 'Vorige';
        $this->text['Next'] = 'Volgende';

        $this->text['Nothing_Found'] = 'Niets Gevonden';
        $this->text['Check_the_required_fields'] = 'Controleer de verplichte (gele) velden';
        $this->text['Nothing_To_Search'] = "Niets om te zoeken. Voer tekst in het zoekveld in.";
        $this->text['Nothing_To_Save'] = "Niets om op te slaan. Er zijn geen wijzigingen aangebracht.";
        $this->text['Protect_this_directory_with'] = 'Bescherm deze folder met ';
    }

    public function swedish(): void
    {
        $this->text['Add_Record'] = 'Lägg Till';
        $this->text['Add_Table'] = 'lägg till tabell';
        $this->text['Clear_Search'] = 'Återställ';
        $this->text['Search'] = 'Sök';

        $this->text['Go'] = 'Gå';
        $this->text['Go_Back'] = 'Tillbaka';
        $this->text['List_Records'] = 'Lista poster';

        $this->text['Reset_This_Record'] = 'Återställ denna post';
        $this->text['Save'] = 'Spara';
        $this->text['Saved'] = 'Sparad';
        $this->text['Edit'] = 'Redigera';
        $this->text['Delete'] = 'Tabort';
        $this->text['Deleted'] = 'Borttagen';

        $this->text['Previous'] = 'Föregående';
        $this->text['Next'] = 'Nästa';

        $this->text['Nothing_Found'] = 'Inget Hittat';
        $this->text['Check_the_required_fields'] = 'Kontroller obligatoriska (gula) fält';
        $this->text['Nothing_To_Search'] = "Inget att söka. Ange text i sökfältet.";
        $this->text['Nothing_To_Save'] = "Inget att spara. Inga ändringar gjordes.";
        $this->text['Protect_this_directory_with'] = 'Skydda katalogen med';
    }

    public function spanish(): void
    {
        $this->text['Add_Record'] = 'Registro Nuevo';
        $this->text['Add_Table'] = 'Agregar tabla';
        $this->text['Clear_Search'] = 'Reinicia Búsqueda';
        $this->text['Search'] = 'Busca';

        $this->text['Go'] = 'Pasar';
        $this->text['Go_Back'] = 'Regresa';
        $this->text['List_Records'] = 'Lista de registros';

        $this->text['Reset_This_Record'] = 'Restablecer este registro';
        $this->text['Save'] = 'Guarda';
        $this->text['Saved'] = 'Guardado';
        $this->text['Edit'] = 'Editar';
        $this->text['Delete'] = 'Eliminar';
        $this->text['Deleted'] = 'Borrado';

        $this->text['Previous'] = 'Previo';
        $this->text['Next'] = 'Siguiente';

        $this->text['Nothing_Found'] = 'Sin Resultados';
        $this->text['Check_the_required_fields'] = 'Verifica los campos requeridos (amarillos)';
        $this->text['Nothing_To_Search'] = "No hay nada que buscar. Ingrese texto en el campo de búsqueda.";
        $this->text['Nothing_To_Save'] = "No hay nada que guardar. No se han realizado cambios.";
        $this->text['Protect_this_directory_with'] = 'Protege este directorio con';
    }
}
