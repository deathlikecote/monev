
	function format_tgl(tgl)
	{
		xxx = tgl.split("-");
		return xxx[2]+"/"+xxx[1]+"/"+xxx[0];
	}
	
	function format_tgl_balik(tgl)
	{
		xxx = tgl.split("/");
		return xxx[2]+"-"+xxx[1]+"-"+xxx[0];		
	}
	
	
	function slash_to_dash(xstring,inv)
	{
		xxx = xstring.split("/");
		zzz = '';
		for (var i=0;i<xxx.length;i++)
		{ 
			if (inv){
				zzz = xxx[i] + zzz;
				if (i < xxx.length-1){
					zzz = '-' + zzz;				
				}	
			}else{
				zzz = zzz + xxx[i];
				if (i < xxx.length-1){
					zzz = zzz + '-';							
				}
			}
		}
		return zzz;
	}
	
	function dash_to_slash(xstring,inv)
	{
		xxx = xstring.split("-");
		zzz = '';
		for (var i=0;i<xxx.length;i++)
		{ 
			if (inv){
				zzz = xxx[i] + zzz;
				if (i < xxx.length-1){
					zzz = '/' + zzz;								
				}
			}else{
				zzz = zzz + xxx[i];
				if (i < xxx.length-1){
					zzz = zzz + '/';								
				}
			}
		}
		return zzz;
	}

	//merubah nilai 1 digit menjadi 2 digit dengan diawali angka nol (0)
	 function checkTime(i)
	 {
		 if (i<10)
		   {
		   i="0" + i;
		   }
		 return i;
	 }	 



	 //fungsi membuat format tanggal dengan string..
	 function getstrdate(tglwaktu)
	 {
		 xxx = tglwaktu.split("-");
		
		 //tanggal
		 var y	= parseInt(xxx[0]);
		 var mont= parseInt(xxx[1]);
		 var da 	=  parseInt(xxx[2]);
		
		 //jam
		 var h	= parseInt(xxx[3]);
		 var m	= parseInt(xxx[4]);
		 var s	= parseInt(xxx[5]);

		 var hari= parseInt(xxx[6]);
		
		 switch (hari)
		 {
		 case 1:
			 namahari = 'SENIN';
		   break;
		 case 2:
			 namahari = 'SELASA';
		   break;
		 case 3:
			 namahari = 'RABU';
		   break;
		 case 4:
			 namahari = 'KAMIS';
		   break;
		 case 5:
			 namahari = 'JUM\'AT';
		   break;
		 case 6:
			 namahari = 'SABTU';
		   break;
		 default:
			 namahari = 'MINGGU';
		 }
         
		 switch (mont)
		 {
		 case 1:
			 namabln = 'JANUARI';
		   break;
		 case 2:
			 namabln = 'FEBRUARI';
		   break;
		 case 3:
			 namabln = 'MARET';
		   break;
		 case 4:
			 namabln = 'APRIL';
		   break;
		 case 5:
			 namabln = 'MEI';
		   break;
		 case 6:
			 namabln = 'JUNI';
		   break;
		 case 7:
			 namabln = 'JULI';
		   break;
		 case 8:
			 namabln = 'AGUSTUS';
		   break;
		 case 9:
			 namabln = 'SEPTEMBER';
		   break;
		 case 10:
			 namabln = 'OKTOBER';
		   break;
		 case 11:
			 namabln = 'NOVEMBER';
		   break;
		 default:
			 namabln = 'DESEMBER';
		 }
		
		 h	= checkTime(h);
		 m	= checkTime(m);
		 s	= checkTime(s);
		 da	= checkTime(da);
		 mont= checkTime(mont);
		
		 return namahari+", "+da+"/"+mont+"/"+y+" <small>"+h+":"+m+":"+s+"</small>";			
	 }
	 
	 