<html>
    <head>
        <title>Simple Ajax Example</title>
        <script language="Javascript">
            window.onload = function() {
                var eInput = document.getElementById("input");
                eInput.addEventListener('keydown', function() {
                    //    xmlhttpPost("databaseController.php")
                    // console.log('change detected');
                });
                var eButton = document.getElementById("Go");
                var eResult = document.getElementById('result')
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
                xmlhttp.send(getquerystring());
            }
            function getquerystring() {
                var form = document.forms['f1'];
                var word = form.word.value;
                qstr = 'w=' + escape(word);  // NOTE: no '?' before querystring
                return qstr;
            }

            function updatepage(xmlhttp) {
                //check of Json string goed doorkomt


                //omzetten van JSON string naar Javascript objecten
                var sJSON = xmlhttp.responseText;
                document.getElementById("result").innerHTML = sJSON;
                document.getElementById("result").innerHTML += '<br><br><br>';
                
                // console.log(sJSON);
                //var oJsonParsed = JSON.parse(sJSON)
                var oJsonParsed = JSON.parse(sJSON, reviver);
                var eTable = document.createElement('table');
                eTable.border = "1px";
                for (var i in oJsonParsed) {
                    var eTr = document.createElement('tr');
                    for (var j in oJsonParsed[i]) {
                        var eTd = document.createElement('td');
                        var innerHTML = j + ": " + oJsonParsed[i][j];
                        eTd.innerHTML = innerHTML;
                        eTr.appendChild(eTd);
                    }
                    eTable.appendChild(eTr);
                    var eResult = document.getElementById('result');
                    eResult.appendChild(eTable);
                }
            }
            function reviver(key, value) {
                if (key == 'query') {
                    var sQuery= new RegExp('value');
                return null;
                }
                else{                   
                 if (sQuery === 'undefined') {
                        console.log('Reviving ' + key + ' ' + value);
                        return value;
                    } else if(sQuery!=='undefined'){
                        if (sQuery.test(value)) {
                            return value;
                        }
                        else if(!sQuery.test(value)){
                            return null;
                        }
                    }
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
