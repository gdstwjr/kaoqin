<?php

class News_info extends BaseController {

	protected $class_id = '';

	function __construct()
	{
		parent::BaseController();
		parent::is_admin();
		$this->class_id = $this->uri->segment(3);
		if( ! $this->class_id)
		{
			$this->warning('无效的分类！');
		}
	}

	function check_popedom($class_id)
	{
		$session_group_id = (int)$this->session->userdata('session_group_id');
		if($session_group_id == DEFINE_ADMIN_HIDDEN || $session_group_id == DEFINE_ADMIN_SYSTEM)
		{
			$popedom = array(
				'create'	=> TRUE,
				'update'	=> TRUE,
				'confirm'	=> TRUE,
				'delete'	=> TRUE
			);
		}
		else
		{
			$condition = array(
				'table_name' => 'news_class',
				'group_id' => $session_group_id,
				'class_id' => $class_id
			);
			$rst = $this->db->select('popedom')->get_where('group_popedom', $condition);
			if($rst->num_rows() > 0)
			{
				$row = $rst->row_array();
				$popedom = array(
					'create'	=> ($row['popedom'] & POPEDOM_CREATE) ? TRUE : FALSE,
					'update'	=> ($row['popedom'] & POPEDOM_UPDATE) ? TRUE : FALSE,
					'confirm'	=> ($row['popedom'] & POPEDOM_CONFIRM) ? TRUE : FALSE,
					'delete'	=> ($row['popedom'] & POPEDOM_DELETE) ? TRUE : FALSE
				);
			}
			else
			{
				$popedom = array(
					'create'	=> FALSE,
					'update'	=> FALSE,
					'confirm'	=> FALSE,
					'delete'	=> FALSE
				);
			}
		}
		return $popedom;
	}

	function get_navigation($class_id)
	{
		$ids = array();
		for ($i=1; $i<=strlen($class_id)/4; $i++)
		{
			$ids[] = substr($class_id, 0, $i*4);
		}
		$rst = $this->db->select('id,name')->where_in('id', $ids)->get('news_class');
		return $rst->result_array();
	}

	function index()
	{
		$this->load->helper('page');
		$data['navigation'] = $this->get_navigation($this->class_id);
		$data['popedom'] = $this->check_popedom($this->class_id);
		$data['class'] = $this->db->get_where('news_class', array('id'=>$this->class_id))->row_array();
		$this->load->view('news_info/index', $data);
	}

	function set_state()
	{
		//检查审核权限
		$data['popedom'] = $this->check_popedom($this->class_id);
		if($data['popedom']['confirm'] == FALSE)
		{
			error('无此操作权限！');
		}

		$id	= $this->input->post('id');
		if(empty($id))
		{
			error('无效操作！');
		}
		else
		{
			$ids = explode(',',$id);
		}

		if(isset($_POST['value']))
		{
			$value = (int)$this->input->post('value');
		}
		else
		{
			$row = $this->db->select('state')->where('id', $id)->get('news_info')->row_array();
			$value = ($row['state'] == 1) ? 0 : 1;
		}

		$this->db->where_in('id', $ids);
		$this->db->update('news_info', array('state'=>$value));
		success('操作成功');
	}

	function set_status()
	{
		//检查修改权限
		$data['popedom'] = $this->check_popedom($this->class_id);
		if($data['popedom']['update'] == FALSE)
		{
			error('无此操作权限！');
		}

		$id	= $this->input->post('id');
		if(empty($id))
		{
			error('无效操作！');
		}
		else
		{
			$ids = explode(',',$id);
		}
		$field = $this->input->post('field');

		if( ! in_array($field, explode('|', 'isTop|isHot|isNew|isRecommend')))
		{
			error('无效操作');
		}

		if(isset($_POST['value']))
		{
			$value = (int)$this->input->post('value');
		}
		else
		{
			$row = $this->db->select($field)->where('id', $id)->get('news_info')->row_array();
			$value = ($row[$field] == 1) ? 0 : 1;
		}
		$this->db->where_in('id', $ids);
		$this->db->update('news_info', array($field => $value));
		success('操作成功');
	}

	function add()
	{
		//检查增加权限
		$data['popedom'] = $this->check_popedom($this->class_id);
		if($data['popedom']['create'] == FALSE)
		{
			$this->warning('无此操作权限！');
		}

		$data['navigation'] = $this->get_navigation($this->class_id);
		$data['class'] = $this->db->get_where('news_class', array('id'=>$this->class_id))->row_array();

		$this->load->library("fckeditor", array('instanceName'=>'content'));
		$this->fckeditor->Value = "";
		$this->fckeditor->Height = "350";
		$data['fckeditor'] = $this->fckeditor->CreateHtml();

		$row = $this->db->select_max('sortnum')->get_where('news_info', array('class_id'=>$this->class_id))->row_array();
		$data['sortnum'] = $row['sortnum'] + 5;

		$data['session_realname'] = $this->session->userdata('session_realname');

		$this->load->view('news_info/add', $data);
	}

	function insert()
	{
		//检查增加权限
		$data['popedom'] = $this->check_popedom($this->class_id);
		if($data['popedom']['create'] == FALSE)
		{
			$this->warning('无此操作权限！');
		}

		$class_id = $this->class_id;
		$sortnum = (int)$this->input->post('sortnum');
		$title = $this->input->post('title');
		$subTitle = $this->input->post('subTitle');
		$titleColor = $this->input->post('titleColor');
		$titleFontWeight = $this->input->post('titleFontWeight');
		$firstLetter = $this->input->post('firstLetter');

		$website = $this->input->post('website');
		$keyword = $this->input->post('keyword');
		$editor = $this->input->post('editor');
		$author = $this->input->post('author');
		$source = $this->input->post('source');
		$publishdate = $this->input->post('publishdate');
		$intro = $this->input->post('intro');
		$content = $this->input->post('content');

		$create_admin_id = $modify_admin_id = $this->session->userdata('session_admin_id');
		$create_time = $modify_time = time();
		$views = (int)$this->input->post('views');
		$isTop = (int)$this->input->post('isTop');
		$isHot = (int)$this->input->post('isHot');
		$isNew = (int)$this->input->post('isNew');
		$isRecommend = (int)$this->input->post('isRecommend');
		$state = (int)$this->input->post('state');

		if( ! $title)
		{
			$this->info("参数填写不完整！");
		}

		$pics = '';	//多图

		$data = compact('class_id','sortnum','title','subTitle','titleColor','titleFontWeight','firstLetter','website','keyword','editor','author','source','publishdate','intro','content','pics','create_admin_id','create_time','modify_admin_id','modify_time','views','isTop','isHot','isNew','isRecommend','state');
		if($this->db->insert('news_info', $data))
		{
			$id = $this->db->insert_id();
		}
		else
		{
			$this->info("添加信息操作失败！");
		}

		//记录编辑器的上传图片
		$content_files = $this->input->post('content_files');
		$files = explode(',', $content_files);
		foreach($files as $val){
			if(empty($val)) continue;
			$file = '.' . $val;
			$image = getimagesize($file);
			$image['size'] = filesize($file);
			$array = array(
				'admin_id' => $this->session->userdata('session_admin_id'),
				'table_name' => 'news_info',
				'field_name' => 'content',
				'info_id' => $id,
				'file' => $val,
				'name' => substr($val, strrpos($val, '/') + 1),
				'type' => $image['mime'],
				'size' => $image['size'],
				'uploadTime' => time(),
				'uploadIp' => ip2long(get_client_ip()),
				'views' => 0
			);
			$this->db->insert('filestamp', $array);
		}

		redirect(get_cookie('return_url'));
	}

	function edit()
	{
		//检查编辑权限
		$popedom = $this->check_popedom($this->class_id);
		if($popedom['update'] == FALSE)
		{
			$this->warning('无此操作权限！');
		}

		$id	= (int)$this->uri->segment(4);
		$rst = $this->db->get_where('news_info', array('id' => $id));
		$data = $rst->row_array();

		$data['navigation'] = $this->get_navigation($this->class_id);
		$data['popedom'] = $popedom;
		$data['class'] = $this->db->get_where('news_class', array('id'=>$this->class_id))->row_array();

		$this->load->library("fckeditor", array('instanceName'=>'content'));
		$this->fckeditor->Value = $data['content'];
		$this->fckeditor->Height = "350";
		$data['fckeditor'] = $this->fckeditor->CreateHtml();
		$this->load->view('news_info/edit', $data);
	}

	function update()
	{
		//检查编辑权限
		$popedom = $this->check_popedom($this->class_id);
		if($popedom['update'] == FALSE)
		{
			$this->warning('无此操作权限！');
		}

		$id	= $this->input->post('id');
		$class_id = $this->class_id;
		$sortnum = (int)$this->input->post('sortnum');
		$title = $this->input->post('title');
		$subTitle = $this->input->post('subTitle');
		$titleColor = $this->input->post('titleColor');
		$titleFontWeight = $this->input->post('titleFontWeight');
		$firstLetter = $this->input->post('firstLetter');

		$website = $this->input->post('website');
		$keyword = $this->input->post('keyword');
		$editor = $this->input->post('editor');
		$author = $this->input->post('author');
		$source = $this->input->post('source');
		$publishdate = $this->input->post('publishdate');
		$intro = $this->input->post('intro');
		$content = $this->input->post('content');

		$modify_admin_id = $this->session->userdata('session_admin_id');
		$modify_time = time();
		$views = (int)$this->input->post('views');
		$isTop = (int)$this->input->post('isTop');
		$isHot = (int)$this->input->post('isHot');
		$isNew = (int)$this->input->post('isNew');
		$isRecommend = (int)$this->input->post('isRecommend');
		$state = (int)$this->input->post('state');

		if( ! $title)
		{
			$this->info("参数填写不完整！");
		}

		$data = compact('class_id','sortnum','title','subTitle','titleColor','titleFontWeight','firstLetter','website','keyword','editor','author','source','publishdate','intro','content','modify_admin_id','modify_time','views','isTop','isHot','isNew','isRecommend','state');
		if( ! $this->db->update('news_info', $data, array('id'=>$id)))
		{
			$this->info('编辑信息操作失败！');
		}

		//记录编辑器的上传图片
		$content_files = $this->input->post('content_files');
		$files = explode(',', $content_files);
		foreach($files as $val){
			if(empty($val)) continue;
			$file = '.' . $val;
			$image = getimagesize($file);
			$image['size'] = filesize($file);
			$array = array(
				'admin_id' => $this->session->userdata('session_admin_id'),
				'table_name' => 'news_info',
				'field_name' => 'content',
				'info_id' => $id,
				'file' => $val,
				'name' => substr($val, strrpos($val, '/') + 1),
				'type' => $image['mime'],
				'size' => $image['size'],
				'uploadTime' => time(),
				'uploadIp' => ip2long(get_client_ip()),
				'views' => 0
			);
			$this->db->insert('filestamp', $array);
		}

		redirect(get_cookie('return_url'));
	}

	function del()
	{
		//检查删除权限
		$data['popedom'] = $this->check_popedom($this->class_id);
		if($data['popedom']['delete'] == FALSE)
		{
			error('无此操作权限！');
		}

		$id = $this->input->post("id");
		if(empty($id))
		{
			error('无效操作！');
		}
		else
		{
			$ids = explode(',',$id);
		}

		//删除相关文件戳
		$this->db->where('table_name', 'news_info');
		$this->db->where_in('info_id', $ids);
		if( ! $this->db->delete('filestamp'))
		{
			error('删除文件戳操作失败！');
		}

		//删除信息
		$this->db->where_in('id', $ids);
		if ( ! $this->db->delete('news_info'))
		{
			error('删除操作失败！');
		}

		success('删除操作成功！');
	}

}

/* End of file news_info.php */