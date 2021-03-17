DROP TABLE tb_projek;

CREATE TABLE `tb_projek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nama_value` varchar(200) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `autentifikasi` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` longtext,
  `surat` varchar(50) DEFAULT NULL,
  `reminder` int(11) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `create_on` datetime NOT NULL,
  `update_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO tb_projek VALUES("10","Teddy septian hanadi","teddy_septian_hanadi","2021-01-21","2021-02-03","","","","","","0","0","2021-01-21 04:51:41","");
INSERT INTO tb_projek VALUES("11","Tracer Study","tracer_study","2021-01-17","2021-01-30","","","","","","0","0","2021-01-23 11:36:20","");



DROP TABLE tb_responden;

CREATE TABLE `tb_responden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `projek` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO tb_responden VALUES("14","KD001","Teddy Septian Hanadi","628722874439","teddy.septian.h@gmail.com","Teddy septian hanadi","0");
INSERT INTO tb_responden VALUES("15","KD002","Asdiansyah Saputra","628728955","asdiansyahsaputra@gmail.com","Teddy septian hanadi","0");



DROP TABLE tb_teddy_septian_hanadi_answer;

CREATE TABLE `tb_teddy_septian_hanadi_answer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(6) DEFAULT NULL,
  `id_page` int(6) DEFAULT NULL,
  `id_page_detail` int(6) DEFAULT NULL,
  `id_jwb` varchar(200) DEFAULT NULL,
  `valuex` varchar(200) DEFAULT NULL,
  `lainnya` longtext,
  `tgl_isi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_answer VALUES("1","2","1","3","","2","","2021-01-23 10:50:19");
INSERT INTO tb_teddy_septian_hanadi_answer VALUES("2","2","1","4","","28","","2021-01-23 09:53:46");
INSERT INTO tb_teddy_septian_hanadi_answer VALUES("3","2","1","5","","Jl. Ir. H. Juanda, BLK No. 301","","2021-01-23 09:53:46");
INSERT INTO tb_teddy_septian_hanadi_answer VALUES("4","2","1","6","1","1","","2021-01-23 09:53:46");
INSERT INTO tb_teddy_septian_hanadi_answer VALUES("5","2","1","6","2","2","","2021-01-23 09:53:46");
INSERT INTO tb_teddy_septian_hanadi_answer VALUES("6","2","1","7","1","4","","2021-01-23 09:53:46");
INSERT INTO tb_teddy_septian_hanadi_answer VALUES("7","2","1","7","2","4","","2021-01-23 09:53:46");



DROP TABLE tb_teddy_septian_hanadi_cv;

CREATE TABLE `tb_teddy_septian_hanadi_cv` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `val_jwb` varchar(100) NOT NULL,
  `con_jwb` longtext NOT NULL,
  `lainnya` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_cv VALUES("1","3","1","Jokowi","0");
INSERT INTO tb_teddy_septian_hanadi_cv VALUES("2","3","2","Jusuf Kala","0");
INSERT INTO tb_teddy_septian_hanadi_cv VALUES("3","3","3","Soekarno","0");



DROP TABLE tb_teddy_septian_hanadi_md;

CREATE TABLE `tb_teddy_septian_hanadi_md` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `var_jwb` varchar(200) NOT NULL,
  `val_jwb` varchar(200) NOT NULL,
  `con_jwb` longtext NOT NULL,
  `lainnya` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_md VALUES("1","6","A4_1","1","Bandung","0");
INSERT INTO tb_teddy_septian_hanadi_md VALUES("2","6","A4_2","2","Jakarta","0");
INSERT INTO tb_teddy_septian_hanadi_md VALUES("3","8","B1_1","1","Belimbing","0");
INSERT INTO tb_teddy_septian_hanadi_md VALUES("4","8","B1_2","1","Apel","0");
INSERT INTO tb_teddy_septian_hanadi_md VALUES("5","8","B1_3","1","Melon","0");
INSERT INTO tb_teddy_septian_hanadi_md VALUES("6","8","B1_4","1","Jeruk","0");
INSERT INTO tb_teddy_septian_hanadi_md VALUES("7","8","B1_5","1","Mangga","0");



DROP TABLE tb_teddy_septian_hanadi_or;

CREATE TABLE `tb_teddy_septian_hanadi_or` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `var_jwb` varchar(100) NOT NULL,
  `con_jwb` longtext NOT NULL,
  `lainnya` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_or VALUES("1","7","A5_1","Bandung","0");
INSERT INTO tb_teddy_septian_hanadi_or VALUES("2","7","A5_2","Jakarta","0");



DROP TABLE tb_teddy_septian_hanadi_page;

CREATE TABLE `tb_teddy_septian_hanadi_page` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page` int(6) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `operator` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_page VALUES("1","1","","","","");
INSERT INTO tb_teddy_septian_hanadi_page VALUES("2","2","","","","");



DROP TABLE tb_teddy_septian_hanadi_page_detail;

CREATE TABLE `tb_teddy_septian_hanadi_page_detail` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page` int(6) NOT NULL,
  `id_urut` varchar(100) NOT NULL,
  `id_soal` varchar(100) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `label` longtext,
  `behind` varchar(200) DEFAULT NULL,
  `range_val` int(6) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `operator` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("1","1","","A","hl","Judul Halaman Pertama","","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("2","1","1","a","sh","Contoh Pertanyaan Survei Bagian A","","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("3","1","2","A1","cv","Siapakah presiden pertama Indonesia ?","","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("4","1","3","A2","tn","Berapa usia beliau?","Tahuhn","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("5","1","4","A3","tl","Di mana alamat anda tinggal?","","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("6","1","5","A4","md","Pilih kota di bawah ini!","","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("7","1","6","A5","or","Bagaimana menurut anda kota-kota di bawah ini!","","","","","","");
INSERT INTO tb_teddy_septian_hanadi_page_detail VALUES("8","2","1","B1","md","Pilih buah-buahan yang anda sukai!","","","","","","");



DROP TABLE tb_teddy_septian_hanadi_range;

CREATE TABLE `tb_teddy_septian_hanadi_range` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `val_jwb` varchar(100) NOT NULL,
  `con_jwb` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_range VALUES("1","7","1","Sangat Sedikit");
INSERT INTO tb_teddy_septian_hanadi_range VALUES("2","7","2","Sedikit");
INSERT INTO tb_teddy_septian_hanadi_range VALUES("3","7","3","Banyak");
INSERT INTO tb_teddy_septian_hanadi_range VALUES("4","7","4","Sangat Banyak");



DROP TABLE tb_teddy_septian_hanadi_user;

CREATE TABLE `tb_teddy_septian_hanadi_user` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail_password` int(6) DEFAULT NULL,
  `mail` int(6) DEFAULT NULL,
  `pengisian` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tb_teddy_septian_hanadi_user VALUES("1","ujicoba","Uji Coba","10cf4ce1ce9dcd8f3f7c2c37974d8b84","0","0","0");
INSERT INTO tb_teddy_septian_hanadi_user VALUES("2","KD001","Teddy Septian Hanadi","807a43e3dd09e724bda59c7452863f28","0","0","0");
INSERT INTO tb_teddy_septian_hanadi_user VALUES("3","KD002","Asdiansyah Saputra","8837d5ecd7db84301b2e451c0bcb13f7","0","0","0");



DROP TABLE tb_tracer_study_answer;

CREATE TABLE `tb_tracer_study_answer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(6) DEFAULT NULL,
  `id_page` int(6) DEFAULT NULL,
  `id_page_detail` int(6) DEFAULT NULL,
  `id_jwb` varchar(200) DEFAULT NULL,
  `valuex` varchar(200) DEFAULT NULL,
  `lainnya` longtext,
  `tgl_isi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tb_tracer_study_cv;

CREATE TABLE `tb_tracer_study_cv` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `val_jwb` varchar(100) NOT NULL,
  `con_jwb` longtext NOT NULL,
  `lainnya` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tb_tracer_study_md;

CREATE TABLE `tb_tracer_study_md` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `var_jwb` varchar(200) NOT NULL,
  `val_jwb` varchar(200) NOT NULL,
  `con_jwb` longtext NOT NULL,
  `lainnya` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tb_tracer_study_or;

CREATE TABLE `tb_tracer_study_or` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `var_jwb` varchar(100) NOT NULL,
  `con_jwb` longtext NOT NULL,
  `lainnya` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tb_tracer_study_page;

CREATE TABLE `tb_tracer_study_page` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page` int(6) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `operator` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tb_tracer_study_page VALUES("1","1","","","","");



DROP TABLE tb_tracer_study_page_detail;

CREATE TABLE `tb_tracer_study_page_detail` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page` int(6) NOT NULL,
  `id_urut` varchar(100) NOT NULL,
  `id_soal` varchar(100) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `label` longtext,
  `behind` varchar(200) DEFAULT NULL,
  `range_val` int(6) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `operator` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tb_tracer_study_range;

CREATE TABLE `tb_tracer_study_range` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_page_detail` int(6) NOT NULL,
  `val_jwb` varchar(100) NOT NULL,
  `con_jwb` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tb_tracer_study_user;

CREATE TABLE `tb_tracer_study_user` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail_password` int(6) DEFAULT NULL,
  `mail` int(6) DEFAULT NULL,
  `pengisian` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tb_tracer_study_user VALUES("1","ujicoba","Uji Coba","10cf4ce1ce9dcd8f3f7c2c37974d8b84","0","0","0");



DROP TABLE tb_user;

CREATE TABLE `tb_user` (
  `id_user` varchar(32) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` varchar(16) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `id_peg` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  KEY `id_peg` (`id_peg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_user VALUES("admin","Admin","202cb962ac59075b964b07152d234b70","Admin","","0");
INSERT INTO tb_user VALUES("superadmin","Superadmin","202cb962ac59075b964b07152d234b70","Superadmin","logo.png","0");
INSERT INTO tb_user VALUES("tedsh","Teddy","202cb962ac59075b964b07152d234b70","Pejabat","cf.jpg","0");



