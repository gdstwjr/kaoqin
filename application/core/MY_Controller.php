<?php
class BaseController extends CI_Controller 
{
	function  __construct() {
	{
               parent::__construct();
		//parent::BaseController();
	}

	function info($msg, $url='javascript:history.back();', $waitSec=1)
	{
		$data = array('msg'=>$msg, 'url'=>$url, 'waitSec'=>$waitSec);
		$this->load->view('common/info', $data);
	}

	function warning($msg, $url='javascript:history.back();', $waitSec=3)
	{
		$data = array('msg'=>$msg, 'url'=>$url, 'waitSec'=>$waitSec);
		$this->load->view('common/warning', $data);
	}

	function is_admin()
	{
		if($this->session->userdata('session_group_id') && $this->session->userdata('session_admin_id'))
		{
			return TRUE;
		}
		else
		{
			redirect(site_url('login'));
		}
	}

	function is_hidden_admin()
	{
		if($this->session->userdata('session_group_id') == DEFINE_ADMIN_HIDDEN)
		{
			return TRUE;
		}
		else
		{
			$this->warning('无效的操作！');
		}
	}

	function is_system_admin()
	{
		if($this->session->userdata('session_group_id') <= DEFINE_ADMIN_SYSTEM)
		{
			return TRUE;
		}
		else
		{
			$this->warning('检查管理权限失败！');
		}
	}

	function is_senior_admin()
	{
		if($this->session->userdata('session_group_id') <= DEFINE_ADMIN_SENIOR)
		{
			return TRUE;
		}
		else
		{
			$this->warning('检查操作权限失败！');
		}
	}

	function check_popedom_advanced($id)
	{
		$session_group_id = (int)$this->session->userdata('session_group_id');
		if($session_group_id == DEFINE_ADMIN_HIDDEN || $session_group_id == DEFINE_ADMIN_SYSTEM)
		{
			return TRUE;
		}
		else
		{
			$rst = $this->db->get_where('advanced_popedom', array('advanced_id'=>$id, 'group_id'=>$session_group_id));
			if($rst->num_rows() > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}

}
}
/* End of file MY_Controller.php */