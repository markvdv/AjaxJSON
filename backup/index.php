<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>JSON en AJAX</title>
        <script src="json2.js"></script>
    </head>
    <body>
      
        <script>
            window.onload = function() {
                var eSubmit = document.getElementsByTagName('button')[0];
                eSubmit.addEventListener("click", function() {
                    window.location.href="ajaxhandler.php?q=string";
                  // loadData()"ajaxhandler.php?q=string");
                });
            }
            function loadData(url) {
                var xmlhttp = createXhrObject();
                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var eMyDiv = document.getElementById('myDiv');
                        eMyDiv.innerHTML = xmlhttp.responseText
                    }
                }
                xmlhttp.open("GET", url, true)
                xmlhttp.send();
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
        <button>haalinfo op</button>
        <div id="myDiv"></div>
    </body>
</html>
