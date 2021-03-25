<?php session_start(); ?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SPM Admin</title>
  <link rel="stylesheet" href="css/stylelogin.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>


<body>

<?php
//kode php ini kita gunakan untuk menampilkan pesan eror
if (!empty($_GET['error'])) {
    if ($_GET['error'] == 1) {
?>
    <div class="login-help">
      <p>Username dan password belum diisi.</p>
    </div>
<?php
    } else if ($_GET['error'] == 2) {
?>
    <div class="login-help">
      <h2>Username belum diisi.</h2>
    </div>
<?php
        //echo '<h3>Username belum diisi!</h3>';
    } else if ($_GET['error'] == 3) {
?>
    <div class="login-help">
      <p>password belum diisi.</p>
    </div>
<?php        
		//echo '<h3>Password belum diisi!</h3>';
    } else if ($_GET['error'] == 4) {
?>
    <div class="login-help">
      <p>Username dan password tidak terdaftar.</p>
    </div>
<?php
	//echo '<h3>Username dan Password tidak terdaftar!</h3>';
    }
}
?>

  <section class="container">
    <div class="login">
      <h1>MONITORING</h1>
      <form method="post" action="spmceklogin.php">
        <p><input type="text" name="login" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p><a href="index.php">Click here to reset</a>.</p>
    </div>
  </section>

  <section class="about">
    <p class="about-links">
      <a href="#">Aplikasi Sisak</a>
      <a href="http://poltekpar-palembang.ac.id" target="_blank">Official Webiste</a>
    </p>
    <p class="about-author">
      &copy; 2017&ndash;2017 Unit Satuan Penjaminan Mutu <br>
      ---- Poltekpar Palembang ---- 
  </section>
</body>
</html>
