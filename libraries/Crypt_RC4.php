<?php
class Cart extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	function buy_material($material_id=NULL)
	{
		if(!$material_id)
		{
			redirect(base_url());
		}
		$this->session->set_userdata('back_url','cart/buy_material/'.$material_id);
		if(!$this->ion_auth->logged_in())
		{
			//redirect(base_url('user/login'));
		}
		if($_POST)
		{
			
		}
		$this->data['user_id']=$this->session->user_id=6;
		$this->data['amount']=99;
		$this->data['subview']='cart/buy_material';
		$this->load->view('_layout_main',$this->data);
	}
	function payment()
	{
		$secret_key = "d8f190d5d1d182fc9cf8f26aff9a4947";  
   		// Your Secret Key
		if(isset($_GET['DR'])) {
		    //require('secure.php');
		     $DR = preg_replace("/\s/","+",$_GET['DR']);
		     $this->load->library('Crypt_RC4');
		     $rc4 = new Crypt_RC4($secret_key);
		     $QueryString = base64_decode($DR);
		    
		     $rc4->decrypt($QueryString);
		     $QueryString = explode('&',$QueryString);

		     $response = array();
		    foreach($QueryString as $param){
		        $param = explode('=',$param);
		        $response[$param[0]] = urldecode($param[1]);
		     }
		}
		if(($response['ResponseCode'] == 0))
		{
		 ?><table><?php
		    foreach( $response as $key => $value) 
		    {
		        ?><tr><td><?php echo $key;?></td><td><?php echo $value; ?></td></tr><?php          
		    }
		 ?></table><?php
		}
		// payment failed
		if(($response['ResponseCode'] != 0))
		{
		 ?><table><?php
		    foreach( $response as $key => $value) 
		    {
		       ?><tr><td><?php echo $key;?></td><td><?php echo $value; ?></td></tr><?php
		    }
		 ?></table><?php
		}
	}
}


?>
