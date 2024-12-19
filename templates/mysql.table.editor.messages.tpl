{start id="BlocContentError"}
<div>
    <div class='ContentDeletedSavedError'>
        <h3>Error: {text id="ContentErrorDescription"}</h3>
        <p>Query Error Number:  {text id="queryGetErrorNumber"}</p>
        <p>Query Error Message: {text id="queryGetErrorMessage"}</p>
    </div>
    <div class="TopActionBar">
        <button type="button" onclick='window.location="{text id="urlScript"}"' class="GoBackButton">{text id="textListRecords"}...</button>
    </div>
</div>
{end id="BlocContentError"}
{start id="BlocContentDeleted"}
<div>
    <div class='ContentDeletedSaved'>Record {text id="ShowTextAddEditPrimaryKey"} {text id="DeleteID"} {text id="textDeleted"}</div>
</div>
{end id="BlocContentDeleted"}
{start id="BlocContentSaved"}
<div>
    <div class='ContentDeletedSaved'>Record {text id="ShowTextAddEditPrimaryKey"} {text id="SavedID"} {text id="textSaved"}</div>
</div>
{end id="BlocContentSaved"}