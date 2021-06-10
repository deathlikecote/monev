<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li>
        <?php
        if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
            echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
        }
        $_SESSION['pesan'] = "";
        ?>
    </li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>e-Survei&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../config/koneksi.php";
$tampilUsr    = mysqli_query($esurveiCon, "SELECT 
a.projek, 
b.create_on, 
b.tgl_terbit, 
b.tgl_tutup
FROM tb_responden a, tb_projek b 
WHERE 
a.kode = '" . $_SESSION['id_user'] . "' AND
b.nama = a.projek AND
b.autentifikasi = 'portal'
ORDER BY b.tgl_tutup DESC");

?>
<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr); ?></span> rows for "Data e-Survei"</h4>
            </div>
            <!-- <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi edit dan hapus ...
            </div> -->
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Survei</th>
                            <th>Tgl Dibuat</th>
                            <th>Mulai | Berakhir</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($usr    = mysqli_fetch_array($tampilUsr)) {
                            $no++;
                            $namabaru        = strtolower($usr['projek']);
                            $nama_domain    = str_replace(" ", "-", $namabaru);
                        ?>
                            <tr>
                                <td align=left style="width: 10px">
                                    <?php echo $no; ?>
                                </td>

                                <td align=center>
                                    <?php echo strtoupper($usr['projek']); ?>
                                </td>

                                <td align=center><?php echo substr($usr['create_on'], 0, 10) ?></td>
                                <td align=center><?php echo $usr['tgl_terbit'] . " | " . $usr['tgl_tutup'] ?></td>

                                <td align=center>
                                    <?php
                                    if (date('Y-m-d') < $usr['tgl_terbit']) {
                                        $stet = 'Blm Terbit';
                                        echo "Blm Terbit";
                                    } else if (date('Y-m-d') >= $usr['tgl_tutup']) {
                                        $stet = 'selesai';
                                        echo "Selesai";
                                    } else {
                                        $stet = 'Berlangsung';
                                        echo "Berlangsung";
                                    }
                                    ?></td>

                                <td class="text-center">
                                    <?php if ($stet != 'selesai') { ?>
                                        <a type="button" target="_blank" class="btn btn-info btn-icon btn-sm" href="http://localhost/esurvei-server/esurvei/kuisioner/<?= $nama_domain; ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <?php } ?>
                                </td>

                            </tr>
                            <!-- #modal-dialog -->
                            <div id="Del<?php echo $usr['id'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda akan menghapus matakuliah <u><?php echo $usr['namamk'] ?></u>?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-data-mahasiswa&id=<?= $usr['id'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>
<!-- end row -->
<script>
    // 500 = 0,5 s
    $(document).ready(function() {
        setTimeout(function() {
            $(".pesan").fadeIn('slow');
        }, 500);
    });
    setTimeout(function() {
        $(".pesan").fadeOut('slow');
    }, 7000);

    $(document).ready(function() {
        $('#import').change(function() {
            $('#portdosen').trigger('click');
        });
    })

    function validateForm() {

        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if (!hasExtension('import', ['.xlsx'])) {
            alert("Hanya file excel yang diijinkan.");
            return false;
        }
    }
</script>