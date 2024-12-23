@charset "utf-8";
/* CSS Document */

/* ===================================================================================================================== */

html {
    width: 100vw;
    height: 100%;

    margin: 0 auto;

    animation-duration: 100s;
    animation-name: chgBackgroundImage;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-timing-function: ease;
    animation-fill-mode: both;
}

body {
    margin: 6px;
    padding: 0;
}

@keyframes chgBackgroundImage {
    10% {
        background-image: linear-gradient( 135deg, #CE9FFC 10%, #7367F0 100%);
    }
    20% {
        background-image: linear-gradient( 135deg, #43CBFF 10%, #9708CC 100%);
    }
    30% {
        background-image: linear-gradient( 135deg, #F6CEEC 10%, #D939CD 100%);
    }
    40% {
        background-image: linear-gradient( 135deg, #92FFC0 10%, #002661 100%);
    }
    50% {
        background-image: linear-gradient( 135deg, #EECE13 10%, #B210FF 100%);
    }
    60% {
        background-image: linear-gradient( 135deg, #FFF3B0 10%, #CA26FF 100%);
    }
    70% {
        background-image: linear-gradient( 135deg, #FFF886 10%, #F072B6 100%);
    }
    80% {
        background-image: linear-gradient( 135deg, #F5CBFF 10%, #C346C2 100%);
    }
    90% {
        background-image: linear-gradient( 135deg, #FD6E6A 10%, #FFC600 100%);
    }
    100% {
        background-image: linear-gradient( 135deg, #F0FF00 10%, #58CFFB 100%);
    }
}

/* ===================================================================================================================== */

.NavigationPlusAppTitle {
    margin-top: 6px;
    margin-bottom: 6px;
    padding: 10px;

    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;

    background-color: #ddc7ef;
    border: 1px solid black;
}

.AppTitleLink  {
    color: #008FD4;

    text-decoration: none;

    font-size: 14pt;
    font-weight: bold;
}

.AppTitleLink:hover {
    color: #7332ec;
}

/* ===================================================================================================================== */

.mte_navigation {
    display: inline-block;
}

.mte_navigation a {
    margin-left: 5px;
    margin-right: 5px;
    padding: .5em .8em;

    text-decoration: none;

    color: #000;

    font-size: 10pt;
    font-weight: bold;

    border: 1px solid black;
}

.mte_navigation a:hover:not(.active) {
    background-color: skyblue;
}

.mte_nav_prev_next {
    display: inline-block;

    color: darkblue !important;
    background-color: gold;
}

.CurrentPage {
    color: #fff !important;
    background-color: #ad1212;
}

.OtherPage {
    background-color: #dbea9a;
}

/* ===================================================================================================================== */

.Message {
    padding: 10px;

    display: block;

    color: #fff;

    font-size: 10pt;
    font-weight: bold;

    background-color: #DD0000;
    border: 1px solid black;
}

.NothingFound {
    padding: 80px !important;

    color: darkblue;

    font-weight: bold;
    font-size: 1em !important;
}

.AddEditFieldNameColumn {
    min-width: 10vw;
    padding-left: 20px !important;

    color: darkgreen;

    font-weight: 800;
}

.AddEditFieldValueColumn {
    padding-left: 20px !important;
}

.AddEditHelpTextColumn {
    max-width: 15vw;
    padding-left: 20px !important;
    color: darkblue;
    word-wrap: break-word;
}

/* ===================================================================================================================== */

.TopActionBar {
    height: 8vh;
    margin: 0 auto;
    padding-left: 6px;
    padding-right: 6px;

    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;

    background-color: #09526d;

    border-left: 1px solid black;
    border-right: 1px solid black;
}

.ClearSearchHighlight {
    background-color: goldenrod;
}

/* ===================================================================================================================== */

.AddButton, .OkayGoButton, .GoBackButton {
    width: 45px !important;
    height: 31px !important;

    border: 1px solid darkorchid;
}

.AddButton, .GoBackButton {
    width: 145px !important;
}

.ClearSearch {
    width: 8em !important;
    height: 32px !important;

    border: 1px solid darkorchid;
}

.AddButton:hover, .OkayGoButton:hover, .ClearSearch:hover, .GoBackButton:hover, .FrmEditButtons:hover {
    cursor: pointer;
    background-color: chocolate;
}

/* ===================================================================================================================== */

.mte_content {
    margin: 0 auto;

    color: #696969;

    font-family: 'Verdana', 'Arial', sans-serif;
}

/* ===================================================================================================================== */

.mte_content table {
    width: 100%;

    color: black;

    border-spacing: 1px;
    border-collapse: separate;

    border: 2px solid black;
}

.mte_content table tr:nth-child(even) {
    background-color: lightpink;
}

.mte_content table tr:nth-child(odd) {
    background-color: rosybrown;
}

.mte_content table tr:hover {
    background-color: coral;
}

.mte_content table th {
    padding: 6px;

    color: #fff;
    background-color: #242456;

    font-weight: bold;
}

/* stylelint-disable-next-line no-descending-specificity */
.mte_content table th a {
    color: #70e8f5;

    text-decoration: none;
}

/* stylelint-disable-next-line no-descending-specificity */
.mte_content table th a:hover {
    color: darkorchid;
}

.mte_content table td {
    padding: 6px;

    vertical-align: top;
    font-size: 12px;

    border-top: 1px solid darkred;
    border-bottom: 1px solid darkred;
}

/* stylelint-disable-next-line no-descending-specificity */
.mte_content table td a:hover {
    color: darkred;
    font-weight: 600;
}

.mte_nowrap {
    white-space: nowrap;
}

/* ===================================================================================================================== */

.DivFormSearch {
    margin-right: 15px;
}

.FrmSearch {
    display: inline-block;
}

#TBSearch {
    width: 14em !important;
}

/* ===================================================================================================================== */

.FrmEdit {
    width: 100%;

    display: inline-block;
}

.TableEdit {
    width: 100%;
}

/* stylelint-disable-next-line no-descending-specificity */
.TableEdit td {
    background-color: #CCC;

    border-left: 1px solid black;
    border-right: 1px solid black;
}

/* ===================================================================================================================== */

input {
    min-width: 100px;
    width: {text id="width_input_fields"};
    height: 26px;
    padding-left: 3px;

    font-size: 18px;

    border: 2px solid lightskyblue;
}

input:hover {
    border: 2px solid darkblue;
}

select {
    min-width: 200px;
    height: 30px;

    font-size: 18px;

    border: 1px solid darkorchid;
}

.mte_navigation_select {
    min-width: 60px;
}

select:hover {
    cursor: pointer;
    background-color: chocolate;
}

button {
    min-width: 2em;
    height: 26px;

    font-size: 16px;

    border: 1px solid #B9B9B9;
}

textarea {
    width: {text id="width_textarea_fields"};
    height: {text id="height_textarea_fields"};
    padding-left: 2px;

    font-size: 18px;

    border: 2px solid lightskyblue;
}

textarea:hover {
    border: 2px solid darkblue;
}

/* ===================================================================================================================== */

.icons_del_edit {
    width: 22px;
    height: auto;
    border: 0;
}

.icons_del_edit:hover {
    -webkit-filter: hue-rotate(120deg) brightness(55%) drop-shadow(5px 5px 5px greenyellow);
    filter: hue-rotate(120deg) brightness(55%) drop-shadow(5px 5px 5px greenyellow);
}

.SortImage {
    width:9px;
    height:8px;
}

.SortImage:hover {
    -webkit-filter: hue-rotate(90deg) brightness(55%) drop-shadow(5px 5px 5px red);
    filter: hue-rotate(90deg) brightness(55%) drop-shadow(5px 5px 5px red);
}

/* ===================================================================================================================== */

.Required {
    background-color: #FFF897;
}

/* ===================================================================================================================== */

.DivGoBack {
    padding: 25px;

    background-color: #690239;

    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
}

.DivFrmEdit {
    margin-top: 6px;
    margin-bottom: 6px;

    color: black;
}

.DivEditButtons {
    margin-top: 6px;
    padding: 25px;

    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;

    background-color: #690239;

    border: 1px solid black;
}

.DivEditButtons input {
    width: 300px;
    height: 31px;
}

/* ===================================================================================================================== */

.ContentDeletedSaved {
    padding: 10px;
    color:#fff;
    background: #FF8000;
    font-weight: bold;
}

.ContentDeletedSavedError {
    padding: 2px 20px 20px 20px;
    margin: 0 0 20px 0;

    color: #fff;

    background: #DF0000;
}

/* ===================================================================================================================== */

section {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

h4 {
    text-align: center;
}

section form {
    width: 70%;
    margin: 0 auto;
    padding: 25px;

    background-color: #CCC;

    border: 2px solid black;
    border-radius: 10px;
}

section form legend {
    color: darkred;
    font-weight: 700;
}

section form fieldset {
    margin-top: 15px;
    margin-bottom: 15px;
}

section form div {
    width: 100%;
    margin-top: 10px;
    margin-bottom: 10px;
    padding-bottom: 10px;
}

.FrmAddEditButtons {
    width: 90%;
    margin: 0 auto;

    text-align: center;
}

.FrmAddEditButtons input {
    width: 10em;
}

.FrmAddEditButtons input:hover {
    cursor: pointer;
}

/* ===================================================================================================================== */

textarea#EditConfigTable {
    width: 100%;
    height: 90vh !important;
    margin-top: 10px;
    padding: 15px 15px 15px;

    display: block;

    line-height: 1;
    font-size: 12px;
    font-family: 'courier new', cursive;

    border-radius: 12px;
    border: 2px solid #F7E98D;

    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    box-sizing: border-box;

    transition: box-shadow 2.5s ease;

    background: -o-linear-gradient(#F9EFAF, #F7E98D);
    background: -ms-linear-gradient(#F9EFAF, #F7E98D);
    background: -moz-linear-gradient(#F9EFAF, #F7E98D);
    background: -webkit-linear-gradient(#F9EFAF, #F7E98D);
    background: linear-gradient(#F9EFAF, #F7E98D);
}

/* ===================================================================================================================== */