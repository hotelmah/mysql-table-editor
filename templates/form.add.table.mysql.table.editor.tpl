<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MySQL Table Editor Form v2, 12-10-2024">
    <title>{text id="Title"}</title>
    <link href="{text id="url_base"}{text id="CSSDirName"}/{text id="CSSFileName"}" rel="stylesheet" type="text/css">
    <script src="{text id="url_base"}{text id="JavascriptDirName"}/{text id="JavascriptFileName"}" type="text/javascript" defer></script>
</head>
<body>
    <section>
        <h4>Please add a new table. You may have to manually edit the table config file if a mistake was made.</h4>
        <form id="FrmAddTable" method="POST" action="">
            <fieldset id="configuration">
                <legend>Configuration Settings - See generated table config file for more settings</legend>
                <div>
                    <label for="AppTitle">Application Table Title (hyperlinked): </label>
                    <input id="AppTitle" name="AppTitle" type="text" required />
                </div>
                <div>
                    <label for="HideFileNameExt">Hide File Name Extension: </label>
                    <select title="HideFileName" id="HideFileNameExt" name="HideFileNameExt">
                        <option value="false" selected>false</option>
                        <option value="true">true</option>
                    </select>
                </div>
                <div>
                    <label for="NumberRowsListView">Number of records/rows per page in list view: </label>
                    <input id="NumberRowsListView" name="NumberRowsListView" type="number" min="1" max="400"/>
                </div>
                <div>
                    <label for="Language">Language: </label>
                    <select title="Language" id="Language" name="Language">
                        <option value="en" selected>English</option>
                        <option value="de">German</option>
                        <option value="fr">French</option>
                        <option value="it">Italian</option>
                        <option value="nl">Dutch</option>
                        <option value="sw">Swedish</option>
                        <option value="es">Spanish</option>
                    </select>
                </div>
                <div>
                    <label for="HtAccessWarning">.htaccess Warning: </label>
                    <select title="HtAccessWarning" id="HtAccessWarning" name="HtAccessWarning">
                        <option value="on" selected>on</option>
                        <option value="off">off</option>
                    </select>
                </div>
            </fieldset>

            <fieldset id="critical">
                <legend>Critical Settings (Database)</legend>
                <div>
                    <label for="TableName">Table Name in the database to edit: </label>
                    <input id="TableName" name="TableName" type="text" required/>
                </div>
                <div>
                    <label for="PrimaryKey">Primary Key of the table (must be auto incremented): </label>
                    <input id="PrimaryKey" name="PrimaryKey" type="text" required />
                </div>
                <div>
                    <label for="FieldsinListView">Fields you want to see in list view. <strong>*Please add the Primary Key*</strong>, (separate by comma): </label>
                    <input id="FieldsinListView" name="FieldsinListView" type="text" required />
                </div>
                <div>
                    <label for="FieldsRequired">Fields required in edit or add record view. Always <strong>exclude the Primary Key</strong> since that is auto incremented. For simplicity, copy the fields from above. Separate each field with a comma: </label>
                    <input id="FieldsRequired" name="FieldsRequired" type="text" required />
                </div>
                <div>
                    <label for="ShowTextAddEdit">Visible name of fields in edit or add record view (separate by comma). The input above is the field names in the database. Here, how do you want to present those field names? For simplicity, copy the fields names from above: </label>
                    <input id="ShowTextAddEdit" name="ShowTextAddEdit" type="text" required />
                </div>
                <div>
                    <label for="ShowTextListView">Visible name of fields in list view (separate by comma). <strong>*Be sure to add the Primary Key.*</strong> For simplicity, copy the same fields names from the "Fields you want to see in list view": </label>
                    <input id="ShowTextListView" name="ShowTextListView" type="text" required />
                </div>
            </fieldset>
            <fieldset>
                <legend>There are two optional settings: Field help texts and a lookup table. Please manually configure those in the table config file.</legend>
            </fieldset>
            <div class="FrmAddEditButtons">
                <input type="reset" value="Reset this form"/>
                <input type="button" onclick="goBack();" value="Cancel" {text id="Disabled"} />
                <input type="submit" name="FrmAddTable" value="Submit" />
            </div>
        </form>
    </section>
</body>
</html>
