<html>
    <head>
        <title>Simple Ajax Example</title>
        <style>
            option{
                display:block;
            }
            #suggestions{
                display:none;
            }
        </style>
        <script language="Javascript">
            window.onload = function() {
                //REFERENTIES NAAR ELEMENTEN
                var eInput = document.getElementById("input"),
                        eButton = document.getElementById("Go"),
                        eDataList = document.getElementById('suggestions');
                //EVENTLISTENERS
                eButton.addEventListener('click', function() {
                    xmlhttpPost("databaseController.php", false);
                    eDataList.innerHTML='';
                    eDataList.size=0;
                    eDataList.style.display="none";
                });
                eInput.addEventListener('keydown', function() {
                    xmlhttpPost("databaseController.php", true)
                });
                //EINDE ONLOAD

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
                        if (typeof eRegExp!=="undefined"&& eRegExp.test(oJsonParsed[i][j]) === true) {
                            for (var k in eDataList.children) {
                                if (eDataList.children[k].id === oJsonParsed[i][j]) {
                                    return false;
                                }
                            }
                            eOption.id = oJsonParsed[i][j];
                            eOption.innerHTML = oJsonParsed[i][j];
                            eDataList.appendChild(eOption);
                        }
                    }
                }
                eDataList.size+=1;
                eDataList.style.display= "block";
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
                            console.error('cant create XMLHttpRequest')
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
            <select id='suggestions' >

            </select>
        </form>
        <div id="result"></div>           
    </body>
</html>
