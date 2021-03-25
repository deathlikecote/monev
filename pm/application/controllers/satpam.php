<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satpam extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	private $_asset_string = '';

	public function __construct()
	{
		
		parent::__construct();		
	}

	public function index()
	{
		echo $this->load->view('ditabs/info');
	}
	
	private  function _cek_session() {
		
		if ($this->session->userdata('idopt')){
			
			$this->session->sess_destroy();
			redirect( base_url().'maaf/' );			
		}
	}

	public function kirimpassx(){
		$email=$_POST['email'];
		$this->load->model('edomuser_model','edomuser');
		$hasil=$this->edomuser->get_user($email);
		if ($hasil->num_rows<1){
			echo"<script>
					alert('NIM/Email tidak ditemukan di database.');
				</script>
			";
		}else{
			foreach($hasil->result() as $row){
			$nama=$row->nama;
			$user=$row->nim;
			$pass=$row->passtext;
			$mails=$row->nemail;
			}

			require (APPPATH.'libraries/PHPMailer-master/PHPMailerAutoload.php');
			$no=1;
			$mail = new \PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = 'login';
			$mail->SMTPSecure = 'ssl';
			$mail->Host = 'ssl://efgit.info';
			$mail->Port = 465;
			$mail->Username = 'autoreply@efgit.info';
			$mail->Password = 'gr2018';
			$mail->SetFrom('pm.admin@poltekpar-palembang.ac.id', 'Admin Portal Mahasiswa');
			$mail->Subject = 'Lupa Password';
			$mail->Body = '
			<div style="width:100%;height:100vh;background-color:#DCDCDC;font-family: Open Sans;">
			<br>
			<div style="width:50%;margin:0 auto;" >

			<div style="width:100%;background-color:#39BEE6;color:white;text-align:center;padding:10px;" >
			<font style="font-size:18pt;">PORTAL MAHASISWA POLTEKPAR PALEMBANG</font>
			</div>

			<div style="width:100%;color:#468191;padding:10px;font-size:10pt;text-align: center;">

			</div>
			<div style="width:100%;background-color:white;color:#646A73;padding:10px;font-size:10pt;">
			<p>Dear, '.$nama.'</p>

			<p>
			Berikut adalah user dan password anda :
			</p>
			<p>
			User/NIM : '.$user.'<br><br>
			Password : '.$pass.'<br><br> 
			</p>
			<hr style="border: dashed 1px #DCDCDC;">
			<p>
			Terima kasih.
			</p>
			<p>
			Admin,
			</p>
			<br>
			<p>
			Portal Mahasiswa POLTEKPAR PALEMBANG
			</p>
			</div>
			<br>
			<div style="padding:5px 0 5px 0;width:100%;background-color:#39BEE6;color:white;text-align:center;padding:10px;" >
			http://poltekpar-palembang.ac.id/pm
			</div>
			<br>
			</div>
			</div>
			';
			$mail->IsHTML(true);
			$mail->AddAddress(''.$mails.'');
			if($mail->Send()){
			echo"<script>
					alert('User dan Password telah dikirim ke ".$mails.". Silahkan cek email anda');
				</script>
			";

			}else{
			echo"<script>
					alert('User dan Password gagal dikirim ke ".$mails."');
				</script>
			";
			}
		}
		
	}
			
	function ceking()
	{
		$nameuser	= $_POST['nameopt'];
		$to			= $_POST['to'];
//		$submitlogin= $_POST['submitlogin'];
		
		$this->load->model('edomuser_model','edomuser');
		
		if ($nameuser){
			$cekopt = $this->edomuser->cek_opt($nameuser, $to);
			
			if (is_array($cekopt)){
				
				$arr['error'] 	= '';
				$this->session->set_userdata($cekopt);

			}else{
				
				$arr['error'] = '<div class="error">'.$cekopt.'</div>';				
			}
		}else{
			
			$arr['error'] = '<div class="error">Lengkapi <span>NIM</span> dan <span>PASSWORD</span>.</div>';
		}
		
		$arr['satu'] = $nameuser;
		$arr['edoc'] = md5(date('hyhdhmhyhmhdhhh').$nameuser);
		if($to == 'edom'){
			redirect('main_menu/nim/'.$arr['satu'].'/'.$arr['edoc'],$arr);
		}else{
			redirect('main_menu/quiz2',$arr);
		}
		// echo json_encode($arr);
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* End of file satpam.php */
/* Location: ./application/controllers/satpam.php */