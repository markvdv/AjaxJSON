<html>
    <head>
        <title>Simple Ajax Example</title>
        <script language="Javascript">
            window.onload=function(){
              var eButton= document.getElementById("Go");
              eButton.addEventListener('click',function(){xmlhttpPost("databaseController.php")});
            };
            function xmlhttpPost(strURL) {
                var xmlHttpReq = false;
                var self = this;
                // Mozilla/Safari
                if (window.XMLHttpRequest) {
                    self.xmlHttpReq = new XMLHttpRequest();
                }
                // IE
                else if (window.ActiveXObject) {
                    self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
                }
                self.xmlHttpReq.open('POST', strURL, true);
                self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                self.xmlHttpReq.onreadystatechange = function() {
                    if (self.xmlHttpReq.readyState == 4) {
                        updatepage(self.xmlHttpReq.responseText);
                    }
                }
                self.xmlHttpReq.send(getquerystring());
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
        </script>
    </head>
    <body>
        <form name="f1">
            <p>word: <input name="word" type="text" >  
                <input value="Go" id="Go" type="button" ></p>
 -->             </form>
    </body>
</html>
