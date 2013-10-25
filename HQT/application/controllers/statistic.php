<?php
	class Statistic extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		/* List of professors and staff in school*/
		function displayStaffList($order=null){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
                $this->load->helper('form');
                $dis= form_open('statistic/delList');                
                $index = array('macanbo', 'hoTen', 'ngaysinh', 'gioitinh', 'chucvu', 'phong', 'chuyennganh', 'xoa','edit');
				$header = array('macanbo' => 'Mã cán bộ',
								'hoTen' => 'Họ tên',
								'ngaysinh' => 'Ngày sinh',
								'gioitinh' => 'Giới tính',
								'chucvu' => 'Chức vụ',
								'phong' => 'Phòng',								
								'chuyennganh' => 'Chuyên ngành');
				$title = 'DANH SÁCH CÁN BỘ';
                if ($order == null ) $order='hoten';
		$data = $this->users->professor($order);
                $header['xoa']="Xóa";
                $header['edit']="Edit";
                $baseURL = base_url('/index.php/statistic/displaystafflist/');
				$dis =$dis.$this->tableconstruct->construct($title, $index, $header, $data, $baseURL);
                $dis=$dis.form_submit('xoa','Xóa');
                $dis=$dis.form_close();
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
		/**/
		function displaySubjectList($order=null){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
                $this->load->helper('form');
                $dis = form_open('statistic/delList');
				$index = array('stt', 'mamon', 'monhoc', 'sotinchi', 'montienquyet', 'sotiethoc','xoa','edit');
				$header = array('stt' => 'STT',
								'mamon' => 'Mã môn học',
								'monhoc' => 'Tên môn học',
								'sotinchi' => 'Số tín chỉ',
								'montienquyet' => 'Môn tiên quyết',
								'sotiethoc' => 'Số tiết học',
                                'edit' => 'Edit');
				$title = 'DANH SÁCH MÔN HỌC';
                if ($order == null ) $order='mamon';
				$data = $this->users->subject($order);
                $header['xoa']="Xóa";
                $baseURL = base_url('/index.php/statistic/displaySubjectList/');
		$dis = $dis.$this->tableconstruct->construct($title, $index, $header, $data, $baseURL);
                $dis=$dis.form_submit('xoa','Xóa');
                $dis=$dis.form_close();
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
		/**/
		function displayStudentList($order=null){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
                        $this->load->helper('form');
                        $config['base_url'] = base_url('/index.php/statistic/displaystudentlist');
                        $config['total_rows'] = 200;
                        $config['per_page'] = 10; 
                        $this->pagination->initialize($config); 
                        $dis = form_open('statistic/delList');
				$index = array('masinhvien', 'hoten', 'ngaysinh', 'gioitinh', 'queQuan', 'khoas', 'khoa', 'lop', 'covan', 'chuyennganh','xoa','edit');
				$header = array('masinhvien' => 'Mã sinh viên',
								'hoten' => 'Tên sinh viên',
								'ngaysinh' => 'Ngày sinh',
								'gioitinh' => 'Giới tính',
								'queQuan' => 'Quê quán',
								'khoas' => 'Khóa',
								'khoa' => 'Khoa',
								'lop' => 'Lớp',
								'covan' => 'Cố vấn', 
								'chuyennganh' => 'Chuyên ngành');
				$title = 'DANH SÁCH SINH VIÊN';
                if ($order == null ) $order='masinhvien';
                $header['xoa']="Xóa";
                $header['edit']="Edit";
				$data = $this->users->student($order);
				$dis = $dis.$this->tableconstruct->construct($title, $index, $header, $data, $config['base_url']);
                                $dis = $dis.$this->pagination->create_links();
                $dis=$dis.form_submit('xoa','Xóa');
                $dis=$dis.form_close();
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
		
		/**/
		function displayClassList(){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
				$temp = $this->users->subject('mamon');
				$index = array('stt', 'maLop', 'ten');
				$header = array('stt' => 'STT',
								'maLop' => 'Mã lớp',
								'ten' => 'Tên lớp',
                                'xoa' => 'Xóa'
								);
				$title = 'DANH SÁCH CÁC LỚP';
				$data = $this->users->classList();
				$dis = $this->tableconstruct->constructLink($title, $index, $header, $data, 'maLop', 'index.php/statistic/displaystudentgrade/');
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
		
		/**/
		function displayStudentGrade($class){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
                
				$index = array('stt', 'hocky', 'masv', 'tensv', 'diemtb');
				$header = array('stt' => 'STT',
								'hocky' => 'Học kỳ',
								'masv' => 'Mã sinh viên',
								'tensv' => 'Tên sinh viên',
								'diemtb' => 'Điểm trung bình'
								);
				$title = 'DANH SÁCH ĐIỂM TRUNG BÌNH LỚP '.strtoupper($class);
				$data = $this->users->classGradeList($class);
				$dis = $this->tableconstruct->construct($title, $index, $header, $data);
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
		
		/**/
		function displayCourseList($order=null){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
                if ($order == null) $order = 'tenmh';
				$temp = $this->users->subject('mamon');
				$index = array('stt', 'tenmh', 'malmh', 'hocky', 'nam');
				$header = array('stt' => 'STT',
								'tenmh' => 'Tên môn học',
								'malmh' => 'Mã lớp môn học',
								'hocky' => 'Học kỳ',
								'nam' => 'Năm'
								);
				$title = 'DANH SÁCH CÁC LỚP MÔN HỌC';
				$data = $this->users->courseList($order);
				$dis = $this->tableconstruct->constructLink($title, $index, $header, $data, 'malmh', 'index.php/statistic/displaycoursegrade/');
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
		
		/**/
		function displayCourseGrade($course){
			$sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username'])){
				$this->load->view('home_view');
			} else {
				$temp = $this->users->subject('mamon');
				$index = array('stt', 'masv', 'tensv', 'diemso', 'diemchu');
				$header = array('stt' => 'STT',
								'masv' => 'Mã sinh viên',
								'tensv' => 'Tên sinh viên',
								'diemso' => 'Điểm bằng số',
								'diemchu' => 'Điểm bằng chữ'
								);
				$course = (str_replace('_', ' ', $course));
				$title = 'DANH SÁCH ĐIỂM LỚP '.$course;
				$data = $this->users->classGradeList($course);
				$dis = $this->tableconstruct->construct($title, $index, $header, $data);
				$this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
			}
		}
        
        // Xoa danh sach can bo mon hoc va sinh duoc chon
        function delList(){
            if ($this->input->get_request_header('Referer', TRUE) == 'http://localhost/HQT/index.php/statistic/displaystafflist'){
                $this->users->delProfessor($this->input->post());
                redirect(site_url().'/statistic/displaystafflist', 'refresh');
            }
            if ($this->input->get_request_header('Referer', TRUE) == 'http://localhost/HQT/index.php/statistic/displaysubjectlist'){
                $this->users->delSubject($this->input->post());
                redirect(site_url().'/statistic/displaysubjectlist', 'refresh');
            }
            if ($this->input->get_request_header('Referer', TRUE) == 'http://localhost/HQT/index.php/statistic/displaystudentlist'){
                $this->users->delStudent($this->input->post());
                redirect(site_url().'/statistic/displaystudentlist', 'refresh');
            }                                
	   }
       /**/
       
       //Chinh sua macanbo,hoTen, ngaysinh, gioitinh, cv.ten as chucvu, phong, k.Ten as khoa, cn.ten as chuyennganh
       function editStaffList($primay_key){
        $sessiondata = $this->session->userdata('logged_in');
			if ( !isset ($sessiondata['username']))
				$this->load->view('home_view');
            else {
                $data = $this->users->searchProfessor($primay_key);
                $array_name = array('hoTen' => 'Họ tên:',
                                    'ngaysinh' => 'Ngày sinh:',
                                    'gioitinh' => 'Giới tính', 
                                    'chucvu' => 'Chức vụ',
                                    'phong' => 'Phòng',
                                    'chuyennganh' => 'Chuyên ngành'                               
                                    );
                $title='Chỉnh sửa thông tin cán bộ mã số '.$primay_key;
                foreach ($data->result_array() as $row)
                $dis=$this->tableconstruct->displayEditForm($title,$array_name,$row,'../saveStaffList',$primay_key);
                $this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
            }
       }
       
       //SELECT mh1.maMonHoc as mamon, mh1.ten as monhoc, mh1.soTinChi as sotinchi, mh2.ten as montienquyet, mh1.soTietHoc as sotiethoc
       function editSubjectList($primay_key){
            $sessiondata = $this->session->userdata('logged_in');
            if ( !isset ($sessiondata['username']))
				$this->load->view('home_view');
            else {
                $title='Chỉnh sửa thông tin môn học mã số '.$primay_key;
                $data=$this->users->searchSubject($primay_key);
                $array_name = array('monhoc' => 'Môn học:',
                                    'sotinchi' => 'Số tín chỉ',
                                    'montienquyet' => 'Môn tiên quyết:', 
                                    'sotiethoc' => 'Số tiết học'                               
                                    );
                foreach ($data->result_array() as $row)
                $dis=$this->tableconstruct->displayEditForm($title,$array_name,$row,'../saveSubjectList',$primay_key);
                $this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
            }
            
       }
       
       //SELECT sv.masinhvien, sv.hoTen hoten, sv.ngaySinh as ngaysinh, sv.gioiTinh as gioitinh, queQuan, khoas, k.ten khoa, l.ten lop, cb.hoTen covan, cn.ten as chuyennganh
       function editStudentList($primay_key){
            $sessiondata = $this->session->userdata('logged_in');
            if ( !isset ($sessiondata['username']))
				$this->load->view('home_view');
            else {
                $title='Chỉnh sửa thông tin học viên mã số '.$primay_key;
                $data=$this->users->searchStudent($primay_key);
                $array_name = array('hoten' => 'Họ tên',
                                    'ngaysinh' => 'Ngày sinh',
                                    'gioitinh' => 'Giới tính', 
                                    'queQuan' => 'Quê quán',
                                    'khoas' => 'Khóa',
                                    'khoa' => 'Khoa',
                                    'lop' => 'Lớp',
                                    'covan' => 'Cố vấn',
                                    'chuyennganh' => 'Chuyên ngành'                               
                                    );
                foreach ($data->result_array() as $row)
                $dis=$this->tableconstruct->displayEditForm($title,$array_name,$row,'../s',$primay_key);
                $this->load->view('home_view', array('username'=>($sessiondata['username']), 'content' => $dis));
            }
            
       }
       
       //save thong tin da edit
       
       function saveStaffList(){
            $sessiondata = $this->session->userdata('logged_in');
            if ( !isset ($sessiondata['username']))
				$this->load->view('home_view');
            else {
                $this->users->saveStaff($this->input->post());
                redirect(site_url().'/statistic/displaystafflist', 'refresh');
            }
       }
       
       function saveSubjectList(){
            $sessiondata = $this->session->userdata('logged_in');
            if ( !isset ($sessiondata['username']))
				$this->load->view('home_view');
            else {
                $this->users->saveSubject($this->input->post());
                redirect(site_url().'/statistic/displaysubjectlist', 'refresh');
            }
       }
       
       
}
?>