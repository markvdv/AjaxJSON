<html>
    <head>
        <title>Simple Ajax Example</title>
        <script language="Javascript">
            window.onload = function() {
                var eButton = document.getElementById("Go");
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
                        updatepage(xmlhttp.responseText);
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

            function updatepage(str) {
                document.getElementById("result").innerHTML = str;
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
