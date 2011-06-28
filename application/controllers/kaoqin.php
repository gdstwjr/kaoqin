<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class kaoqin extends BaseController
{
    function __construct() {
        parent::__construct();
    }
    
    function chaxu() {
        $this->load->helper('page');
        $this->load->view('kaoqin/chaxu');
    }
    
    function view() {
        /**
                SELECT * FROM  t_employee JOIN t_dakarecord_his  ON   t_dakarecord_his.iccardid =  t_employee.iccardid  WHERE t_dakarecord_his.iccardid='8947491' AND convert(varchar(10),dakatime ,120)='2011-05-10' AND (ioplace='3' or ioplace='5') ORDER BY dakatime desc
        **/

        $id	= $this->input->post('iccardid');
        $dakatime =$this->input->post('publishdate');
        $name=convert2gbk($this->input->post('employeename'));
        $limit =10;
        if(empty($name)){
            echo "The name is Null!";
        } else {
            $rst= $this->db->get_where('t_dakarecord_his', array('iccardid' => $id));
            $data = $rst->row_array();
            $iccardid= "t_employee.iccardid='".$id."'";
            $employeename="t_employee.employeename='".$name."'";
            if($name !=null ){
                $this->db->where($employeename);
            }

            if($id !=null ){
                $this->db->where($iccardid);
            }

            //查询时间段
            if( $dakatime != null) {
                $this->db->where("convert(varchar(10),dakatime ,120)='".$dakatime. "'");
            }


            //查询 打卡地点
            $where="(ioplace='3' or ioplace='5')";
            $this->db->where($where);

            $this->db->join('t_dakarecord_his', 't_dakarecord_his.iccardid = t_employee.iccardid');
            $this->db->join('t_department','t_department.departmentid = t_employee.departmentid');
            //设置 表名
            $this->db->from('t_employee');

            //按时间排序
            $this->db->order_by("dakatime", "desc");

            //运行选择查询语句并且返回结果集。

            $rst = $this->db->get();
            //输出SQL语句
           //echo $this->db->last_query();

            $data['rs']=$rst;
            //dump($data);
            if(!$rst) {
            echo "False!";
            }else{
                $this->load->view('kaoqin/view',$data);

            }
        }
    }
    
    function employee(){
        $this->load->helper('page');

        //$data['class'] = $this->db->get_where('t_employee')->row_array();

        
        $this->load->view('kaoqin/employee');
    }
    
    function edit(){
        $id	= (int)$this->uri->segment(3);
        $rst = $this->db->get_where('t_employee', array('employeeid' => $id));
        $data ['rs']= $rst->row_array();
        
                $rst = $this->db->query("SELECT * FROM t_employee  JOIN t_department ON
 t_department.departmentid = t_employee.departmentid 
WHERE t_employee.employeeid='".$id."'");
                
        $data['rst'] = $rst->row_array();
        
        $data['department'] = $this->db->get('t_department')->result_array();
        //var_dump($data['department']);
        $this->load->view('kaoqin/edit',$data);
    }
}
?>
