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
        <form id="FrmEditTable" method="POST" action="">
            <fieldset id="configuration">
                <legend>Contents of Table Configuration</legend>
                <div>
                    <label for="EditConfigTable">{text id="TableName"}:</label>
                    <textarea id="EditConfigTable" name="EditConfigTable">{text id="RequestedEditConfigTable"}</textarea>
                </div>
            </fieldset>

            <div class="FrmAddEditButtons">
                <input type="reset" value="Reset this form"/>
                <input type="button" onclick="goBackToIndex();" value="Cancel" {text id="Disabled"} />
                <input type="submit" name="FrmEditTable" value="Save"/>
                <input type="hidden" name="TableName" value="{text id="TableName"}"/>
            </div>
        </form>
    </section>
</body>
</html>
