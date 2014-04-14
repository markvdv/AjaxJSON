<html>
    <head>
        <title>Simple Ajax Example</title>
        <script language="Javascript">
            window.onload = function() {
                var eButton = document.getElementById("Go");
                var eResult = document.getElementById('result')
                eButton.addEventListener('click', function() {
                    xmlhttpPost("databaseController.php")
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
                var str = xmlhttp.responseText
                document.getElementById("result").innerHTML = str;

                //omzetten van JSON string naar Javascript objecten
                var sJSON = xmlhttp.responseText;
                // console.log(sJSON);
                //var oJsonParsed = JSON.parse(sJSON)
                var oJsonParsed = JSON.parse(sJSON, reviver);
                //   console.log(oJsonParsed);
                var eTable = document.createElement('table');
                eTable.border = "1px";
                for (var i in oJsonParsed) {
                    for (var j in oJsonParsed[i]) {
                        console.log(oJsonParsed[i][j])
                        /* var eDiv= document.createElement("div");
                         eDiv.innerHTML= oJsonParsed[i][j]['productId'];
                         document.getElementById("result").appendChild(eDiv);*/
                        var eTr = document.createElement('tr');

                        for (var k in oJsonParsed[i][j]) {
                            var eTd = document.createElement('td');
                            var innerHTML = k + ": " + oJsonParsed[i][j][k];
                            eTd.innerHTML = innerHTML;
                            eTr.appendChild(eTd);
                        }
                        eTable.appendChild(eTr);
                    }
                    var eResult = document.getElementById('result');
                    eResult.appendChild(eTable);
                }
            }
            function reviver (key,value) {
                    var sFuncties = '';
                    console.log("key: " + key);
                    console.log("value: " + value);
                    console.log("\n");
                    if (key === "functies") {
                        sFuncties += value;
                        alert(sFuncties);
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
            <p>word: <input name="word" type="text" >  
                <input value="Go" id="Go" type="button" ></p>
            <div id="result"></div>            </form>
    </body>
</html>
