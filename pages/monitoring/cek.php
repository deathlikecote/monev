
<?php
session_start();
include "../../config/koneksi.php";
if ($_POST['jenis'] == 'edom') {
    $pertax = $_POST['pertapost'];
    if ($_SESSION['perta'] != $pertax) {
        $tax = $pertax;
    } else {
        $tax = '';
    }

    $qry = mysqli_query($Open, "SELECT * FROM edompotensi$tax WHERE ta ='" . $pertax . "'");
    if (mysqli_num_rows($qry) > 0) {
        echo "1";
    } else {
        echo "0";
    }
} else if ($_POST['jenis'] == 'epom') {
    $pertax = $_POST['pertapost'];
    if ($_SESSION['perta'] != $pertax) {
        $tax = $pertax;
    } else {
        $tax = '';
    }

    $qry = mysqli_query($Open, "SELECT * FROM epompotensi$tax WHERE ta ='" . $pertax . "'");
    if (mysqli_num_rows($qry) > 0) {
        echo "1";
    } else {
        echo "0";
    }
} else if ($_POST['jenis'] == 'epod' || $_POST['jenis'] == 'edop') {
    $pertax = $_POST['pertapost'];
    if ($_SESSION['perta'] != $pertax) {
        $tax = $pertax;
    } else {
        $tax = '';
    }

    $qry = mysqli_query($Open, "SELECT * FROM exoxpotensi$tax WHERE ta ='" . $pertax . "'");
    if (mysqli_num_rows($qry) > 0) {
        echo "1";
    } else {
        echo "0";
    }
}

?>