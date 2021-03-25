<?php echo $assets; ?>
<body class="clouds">
<div class="container">
	<br><br>
	 <a  href="<?php echo base_url();?>main_menu/nim2/<?php echo $this->session->userdata('nimopt'); ?>/<?php echo $edok; ?>">
       <div class="col-md-1"><button class="form-control btn-primary">HOME</button></div>
    </a>
    <br><br>

<div class="col-md-12" style="background: rgba(255, 255, 255, 1); padding:10px;">
	<div class="col-md-12" style="text-align: center;font-size: 14pt;"><b>PENGUMUMAN</b></div><br>
 <table id="example1" class="table table-bordered table-striped" style="font-size: 9pt;">
                <thead>
	                <tr>
	                  <th align=center>NO</th>
	                  <th align=center>JUDUL</th>
	                  <th align=center>FILE</th>
	                  <th align=center>TANGGAL</th>
	                </tr>
                </thead>
                <tbody >
          <?php
                foreach ($arrview->result_array() as $x) {	
                  $no=$no+1;
          ?>
          <tr>
            <td align=left style="width: 10px"> 
               <?php echo $no; ?>
            </td>

            <td align=left> 
              <?php echo strtoupper($x['judul']); ?>
            </td>

             <td align=center> 
              <a href="<?php echo "http://sisak.poltekpar-palembang.ac.id/master/process/pengumuman/".$x['file']; ?>" target="_blank"><?php echo image_asset('pdf.png','', array('width'=>'20')); ?></a>
            </td>

            <td align=center> 
              <?php echo strtoupper($x['tanggal']); ?>
            </td>
          </tr>
          <?php } ?>

                </tbody>
                <tfoot>
	                <tr>
	                  <th align=center>NO</th>
	                  <th align=center>JUDUL</th>
	                  <th align=center>FILE</th>
	                  <th align=center>TANGGAL</th>
	                </tr>
                </tfoot>
              </table>
          </div>
</div>
</body>
 <script type="text/javascript">
 	$(function () {
    $("#example1").DataTable();
  
  });

    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
</script>