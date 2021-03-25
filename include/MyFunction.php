
<?php
function eHari($tgl){
	$tgl=$tgl;
	return $harix=substr($tgl,-2); 
}

function eBulan($tgls){
	$tgl=$tgls;
	$bul=substr($tgl,5,2); 
	if(substr($bul,0,1)=="0"){
	    $bulx=substr($bul,1,1); 
	}else{
	    $bulx=substr($tgl,5,2); 
	}
	$bulans=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
	$bulanx=$bulans[$bulx];
	return array($bul,$bulanx);
}

function eTahun($tgl){
	$tgl=$tgl;
	return $tahunx=substr($tgl,0,4); 
}

function buatrp($angka)
{
 $jadi = "Rp " . number_format($angka,0,'','.');
return $jadi;
}


/*<script type="text/javascript">
	var format = function(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(",") > 0) {
        parts = str.split(",");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
};

$(function(){
    $("#biaya").keyup(function(e){
        $(this).val(format($(this).val()));
    });
});
</script>*/

?>
