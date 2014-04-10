<?php /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ ?>
<script src="data.json"></script>
<?php $q = "q" ?>
<script>
    window.onload = function() {
        alert(1);
        var q = "<?php echo $q; ?>";
        var oData = {};
        oData = JSON.parse(jsonData, function(key, value) {
            if (key === q) {
                return "geodeavond";
            }
            return value;
        });
        alert(1);
        var sGetParams = '';
        for (var i in oData) {
            sGetParams += i + "=" + oData[i] + "&";
        }
        alert(sGetParams);
        sGetParams = sGetParams.substr(0, sGetParams.length - 1);
        window.location.href = "index.php?" + sGetParams;
        alert(sGetParams);
    }
</script>

