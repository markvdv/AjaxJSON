<html>
    <head>
        <title>Simple Ajax Example</title>
        <script language="Javascript">
            window.onload = function() {
                var eInput = document.getElementById("input");
                eInput.addEventListener('keyup', function() {
                    //xmlhttpPost("databaseController.php")
                    // console.log('change detected');
                });
                var eButton = document.getElementById("Go");
                var eResult = document.getElementById('result');
                eButton.addEventListener('click', function() {
                    xmlhttpPost("databaseController.php");
                });

            };
            function xmlhttpPost(strURL) {
                var xmlHttpReq = false;
                // Mozilla/Safari
                var xmlhttp = createXhrObject();
                xmlhttp.open('POST', strURL, true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4) {
                        updatepage(xmlhttp);
                    }
                }
                var eInput = document.getElementById('input');
                if (eInput.getAttribute("value") !== '') {
                    var sValue = eInput.value
                }
                else {
                    var sValue = '';
                }
                xmlhttp.send("w=" + sValue);
            }
            function updatepage(xmlhttp) {
                //omzetten van JSON string naar Javascript objecten
                var sJSON = xmlhttp.responseText;
                var oJsonParsed = JSON.parse(sJSON, reviver);

                //opmmaak
                var eRegExp = oJsonParsed['query'];
                var innerHTML = '';

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
            function loadSuggestions() {
                /*   var eDataList = document.getElementById('suggestions');
                 var eOption = document.createElement('option');
                 eOption.id = value;
                 eOption.innerHTML = value;
                 eDataList.appendChild(eOption);*/
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
            <datalist id='suggestions'>

            </datalist>
        </form>
        <div id="result"></div>           
    </body>
</html>
