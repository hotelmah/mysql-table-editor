<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="MySQL Table Editor v2, 11-15-2024">
        <title>{text id="Title"}</title>
        <link href="{text id="url_base"}{text id="CSSDirName"}/{text id="CSSFileName"}" rel="stylesheet" type="text/css">
        <script src="{text id="url_base"}{text id="JavascriptDirName"}/{text id="JavascriptFileName"}" type="text/javascript" defer></script>
    </head>
    <body>
        <div class='mte_content'>
            <div class='NavigationPlusAppTitle'>
                <div>
                    <a href='{text id="url_script"}' class='AppTitleLink'>
                        {text id="AppTitle"}
                    </a>
                </div>
                <div>
                    <b>{text id="CurrentFormattedDate"}</b>
                </div>
                <div class='mte_navigation'>
                    {text id="last_page_html"} {text id="navigation"} {text id="next_page_html"}
                </div>
                <div>
                    {select id="SelectTableTop"}
                    <button onClick="gotoSelectedTableTop();" class='OkayGoButton'>{text id="textGo"}</button>
                    <button onClick="gotoEditTableTop();" class='OkayGoButton'>{text id="textEdit"}</button>
                </div>
                <div class='mte_navigation'>
                    <select id='pageTop' name='pageTop' class='mte_navigation_select'>{text id="navigationSelectOption"}</select>
                    <button onClick="go2PageTop();" class='OkayGoButton'>{text id="textGo"}</button>
                </div>
            </div>

            {text id="htaccess_warning_comment_start"}
            <div class='Message'>
                <span>{text id="Protect_this_directory_with"} .htaccess</span>
            </div>
            {text id="htaccess_warning_comment_end"}
            {start id="BlocContentMessages"}
            {end id="BlocContentMessages"}
            {start id="BlocTopActionBar"}
            <div class='TopActionBar {text id="ClearSearchHighlight"}'>
                <div>
                    <button onclick='window.location="{text id="urlScript"}?{text id="queryString"}&mte_a=new"' class='AddButton'>{text id="textAddRecord"}</button>
                </div>
                <div>
                    <button onclick='window.location="{text id="urlScriptBase"}?AddTable=yes"' class='AddButton'>{text id="textAddNewTable"}</button>
                </div>
                <div class="DivFormSearch">
                    <form method='get' action='{text id="urlScript"}' class='FrmSearch' onsubmit='return submitFormSearch()'>
                        <input type='text' id='TBSearch' name='s' value='{text id="in_search_value"}' placeholder='{text id="textSearch"}'>
                        <select name='f'>{text id="options"}</select>
                        <input type='submit' value='{text id="textGo"}' class='OkayGoButton'>
                    </form>
                    {text id="startCommentClearSearch"}<button onclick='window.location="{text id="urlScript"}"' class='ClearSearch'>{text id="textClearSearch"}</button>{text id="endCommentClearSearch"}
                </div>
            </div>
            {end id="BlocTopActionBar"}
            {start id="BlocShowRecordsListView"}
            <table>
                <tr>
                    {text id="TableHeader"}
                </tr>
                {text id="rows"}
            </table>
            {end id="BlocShowRecordsListView"}
            {start id="BlocShowRecordAddEdit"}
            <div class='DivGoBack'>
                <button onclick='window.location="{text id="HistoryPage"}"' class='GoBackButton'>{text id="textGoBack"}</button>
            </div>
            <div class='DivFrmEdit'>
                <form method='post' action='{text id="urlScript"}' onsubmit='return submitFormAddEdit()' class='FrmEdit'>
                    <table class='TableEdit'>
                        {text id="rows"}
                    </table>
                    <div class='DivEditButtons'>
                        <input type="reset" value="{text id="textResetThisRecord"}" class='FrmEditButtons'/>
                        <input type='submit' value='{text id="textSave"}' class='FrmEditButtons'>
                        <input type='hidden' name='mte_a' value='save'>
                        {text id="InputHiddenAddRecord"}
                    </div>
                </form>
            </div>
            {end id="BlocShowRecordAddEdit"}

            <div class='NavigationPlusAppTitle'>
                <div>
                    <a href='{text id="url_script"}' class='AppTitleLink'>
                        {text id="AppTitle"}
                    </a>
                </div>
                <div>
                    <b>{text id="CurrentFormattedDate"}</b>
                </div>
                <div class='mte_navigation'>
                    {text id="last_page_html"} {text id="navigation"} {text id="next_page_html"}
                </div>
                <div>
                    {select id="SelectTableBottom"}
                    <button onClick="gotoSelectedTableBottom();" class='OkayGoButton'>{text id="textGo"}</button>
                    <button onClick="gotoEditTableBottom();" class='OkayGoButton'>{text id="textEdit"}</button>
                </div>
                <div class='mte_navigation'>
                    <select id='pageBottom' name='pageBottom' class='mte_navigation_select'>{text id="navigationSelectOption"}</select>
                    <button onClick="go2PageBottom();" class='OkayGoButton'>{text id="textGo"}</button>
                </div>
            </div>
        </div>
    </body>
</html>