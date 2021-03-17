<?php
$namaSurvei = '';
$queryAktif=mysqli_query($Open,"SELECT * FROM tb_projek WHERE tgl_terbit <= '".date('Y-m-d')."' AND tgl_tutup > '".date('Y-m-d')."'");
while ($rAktif = mysqli_fetch_array($queryAktif)) {
	$namaSurvei .= $rAktif['nama']." ";
}
?>
<script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var namaSurvei = <?php echo "'".$namaSurvei."'"; ?>;
		alert(namaSurvei);
	});
</script>