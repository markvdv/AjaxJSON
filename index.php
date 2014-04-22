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
                    eDataList.innerHTML = '';
                    eDataList.size = 0;
                    eDataList.style.display = "none";
                    xmlhttpPost("databaseController.php", false);
                });
                eInput.addEventListener('keydown', function(e) {
                    if (e.keyCode == 13) {
                        console.log('NOOOO, u pressed enter :(');
                    }
                    xmlhttpPost("databaseController.php", true)
                });
                //EINDE ONLOAD

            };
            /**xmlhttpPost: gets the object to do the request and handles the update of the page or select list
             * 
             * @param {type} key
             * @param {type} value
             * @returns {RegExp}
             */
            function xmlhttpPost(strURL, bool) {
                // Mozilla/Safari
               
                var xmlhttp = createXhrObject(),
                        eInput = document.getElementById('input');
                if (eInput.getAttribute("value") !== '') {
                    var sValue = eInput.value
                     strURL+="?w=" + sValue;
                }
                else {
                    var sValue = '';
                }
                xmlhttp.open('GET', strURL, true);
                //  xmlhttp.setRequestHeader('Content-Type', 'text/html');
                //xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4) {
                        var sJSON = xmlhttp.responseText;
                        console.log(sJSON);
                        var oJsonParsed = JSON.parse(sJSON, reviver);
                        if (bool === false) {
                            updatepage(oJsonParsed);
                        }
                        else {
                            loadSuggestions(oJsonParsed);
                        }
                    }
                }
                xmlhttp.send();
            }
            /**reviver: function to get the queryparam out and make it a regexp when parsing JSON
             * 
             * @type @exp;oJsonParsed@pro;query
             */
            function reviver(key, value) {
                if (key === "query") {
                    var eRegExp = new RegExp(value, 'i');
                    return eRegExp;
                }
                else {
                    return value;
                }
            }
            /**updatepage: updates the page accordingly
             * 
             * @param {type} xmlhttp: XmlHttpRequest/ActiveXobject
             * @returns {Boolean}
             */
            function updatepage(oJsonParsed) {
                //referenties
                var eRegExp = oJsonParsed['query'],
                        eResult = document.getElementById('result');
                eResult.innerHTML = '';
                for (var i in oJsonParsed) {
                    for (var j in oJsonParsed[i]) {
                        if (j === "productNaam") {
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
            }


            /**loadSuggestions: loads the suggestions into the select dropdown below the input field
             * 
             * @returns {ActiveXObject|XMLHttpRequest|String}
             */
            function loadSuggestions(oJsonParsed) {
                var eDataList = document.getElementById('suggestions'),
                        eRegExp = oJsonParsed['query'],
                        eOption = document.createElement('option');
                for (var i in oJsonParsed) {
                    for (var j in oJsonParsed[i]) {
                        if (j === "productNaam") {
                            if (typeof eRegExp !== "undefined" && eRegExp.test(oJsonParsed[i][j]) === true) {
                                for (var k in eDataList.children) {
                                    if (eDataList.children[k].id === oJsonParsed[i][j]) {
                                        return false;
                                    }
                                }
                                eOption.id = oJsonParsed[i][j];
                                eOption.innerHTML = oJsonParsed[i][j];
                                eDataList.size = eDataList.children.length;
                                eDataList.appendChild(eOption);
                                eOption.addEventListener("click", function() {
                                    // alert(eInput)
                                    // alert(this.value)
                                });
                            }
                        }
                    }
                }
                eDataList.style.display = "block";
            }
            /**createXhrObject maakt het object voor httprequests aan
             * 
             * @returns {ActiveXObject|XMLHttpRequest|String}
             */
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
