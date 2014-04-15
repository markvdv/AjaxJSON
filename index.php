<html>
    <head>
        <title>Simple Ajax Example</title>
        <style>
            option{
                display:block;
            }
            datalist{
                display:block;
            }
        </style>
        <script language="Javascript">
            window.onload = function() {
                var sQuery = '';
                var eInput = document.getElementById("input");
                eInput.addEventListener('keyup', function() {
        var eDataList= document.getElementById('suggestions');            
                    xmlhttpPost("databaseController.php", true)
                    console.log('change detected');
                });
                var eButton = document.getElementById("Go");
                var eResult = document.getElementById('result');
                eButton.addEventListener('click', function() {
                    xmlhttpPost("databaseController.php", false);
                });
            };
            function xmlhttpPost(strURL, bool) {
                // Mozilla/Safari
                var xmlhttp = createXhrObject();
                var eInput = document.getElementById('input');
                if (eInput.getAttribute("value") !== '') {
                    var sValue = eInput.value
                }
                else {
                    var sValue = '';
                }
                xmlhttp.open('POST', strURL, true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4) {
                        if (bool === false) {
                            updatepage(xmlhttp);
                        }
                        else {
                            loadSuggestions(xmlhttp);
                        }
                    }
                }
                xmlhttp.send("w=" + sValue);
            }
            function updatepage(xmlhttp) {
                //omzetten van JSON string naar Javascript objecten
                var sJSON = xmlhttp.responseText;
                var oJsonParsed = JSON.parse(sJSON, reviver);
                var eRegExp = oJsonParsed['query'];

                var eResult = document.getElementById('result')
                eResult.innerHTML = '';
                for (var i in oJsonParsed) {
                    for (var j in oJsonParsed[i]) {
                        if (typeof eRegExp === 'undefined') {
                            eResult.innerHTML += oJsonParsed[i][j] + "<br>";
                        }
                        else {
                            if (eRegExp.test(oJsonParsed[i][j]) === true) {
                                eResult.innerHTML += oJsonParsed[i][j] + "<br>";
                            }
                        }
                    }
                }
            }
            function reviver(key, value) {
                if (key === "query") {
                    var eRegExp = new RegExp(value, 'i');
                    return eRegExp;
                }
                else {
                    return value;
                }
            }


            function loadSuggestions(xmlhttp) {
                var eDataList = document.getElementById('suggestions');
                var sJSON = xmlhttp.responseText;
                var oJsonParsed = JSON.parse(sJSON, reviver);
                var eRegExp = oJsonParsed['query'];
                var eOption = document.createElement('option');
                for (var i in oJsonParsed) {
                    for (var j in oJsonParsed[i]) {
                        if (eRegExp.test(oJsonParsed[i][j]) === true) {
                            eOption.id = oJsonParsed[i][j];
                            eOption.innerHTML = oJsonParsed[i][j];
                            eDataList.appendChild(eOption);
                        }
                    }
                }
            }
            function createXhrObject() {
                //memoizing
                var xmlhttp = '';
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else if (window.ActiveXObject) {
                    try {
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e) {
                        try {
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e) {
                        }
                    }
                }
                this.createXhrObject = function() {
                    return xmlhttp;
                }
                return xmlhttp;
            }
        </script>
    </head>
    <body>
        <form name="f1">
            <p>word: <input id='input' name="word" type="text" >  
                <input value="Go" id="Go" type="button" ></p>
            <select id='suggestions' size="4">

            </select>
        </form>
        <div id="result"></div>           
    </body>
</html>
