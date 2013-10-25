<?php
    class MongoDB extends CI_Model{
        function login($username, $password){
			$this->db->select('username', 'password');
			$this->db->from('user');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->limit(1);			
			$result = $this->db->get();
			if ($result->num_rows() == 1){
				return true;
			} else {
				return false;
			}
		}
		
		function professor($order){
			return $this->db->query('SELECT macanbo,hoTen, ngaysinh, gioitinh, cv.ten as chucvu, phong, cn.ten as chuyennganh
											FROM CanBo cb
											JOIN ChucVu cv on cv.maChucVu = cb.maChucVu
											JOIN ChuyenNganh cn on cn.maChuyenNganh = cb.maChuyenNganh
                                            order by '.$order.';');
                                            
		}
        
        function searchProfessor($key){
            return $this->db->query('SELECT hoTen, ngaysinh, gioitinh, cv.ten as chucvu, phong, cn.ten as chuyennganh
											FROM CanBo cb
											JOIN ChucVu cv on cv.maChucVu = cb.maChucVu
											JOIN ChuyenNganh cn on cn.maChuyenNganh = cb.maChuyenNganh 
                                            where macanbo="'.$key.'";');
            
        }
        
		function delProfessor($submit){
		  unset($submit['xoa']);
		  foreach ($submit as $row => $key){
            $this->db->query("DELETE FROM canbo where maCanBo = '".$row."';");
            }
		}
        
		function subject($order){
			return $this->db->query('SELECT mh1.maMonHoc as mamon, mh1.ten as monhoc, mh1.soTinChi as sotinchi, mh2.ten as montienquyet, mh1.soTietHoc as sotiethoc
											FROM MonHoc mh1
											LEFT JOIN MonHoc mh2 on mh2.maMonHoc=mh1.tienQuyet 
                                            order by '.$order.';');
		}
        
        function searchSubject($key){
			return $this->db->query('SELECT mh1.ten as monhoc, mh1.soTinChi as sotinchi, mh2.ten as montienquyet, mh1.soTietHoc as sotiethoc
											FROM MonHoc mh1
											LEFT JOIN MonHoc mh2 on mh2.maMonHoc=mh1.tienQuyet 
                                            where mh1.maMonHoc="'.$key.'";');
		}
        
		function delSubject($submit){
            unset($submit['xoa']);
            foreach ($submit as $row => $key){
            $this->db->query("DELETE FROM monhoc where maMonHoc = '".$row."';");
		  }
        }
        
		function student($order){
			return $this->db->query('SELECT sv.masinhvien, sv.hoTen hoten, sv.ngaySinh as ngaysinh, sv.gioiTinh as gioitinh, queQuan, khoas, k.ten khoa, l.ten lop, cb.hoTen covan, cn.ten as chuyennganh
											FROM SinhVien sv
											LEFT JOIN Khoa k on k.MaKhoa=sv.maKhoa
											LEFT JOIN Lop l on l.maLop=sv.maLop
											LEFT JOIN CanBo cb on cb.maCanBo=sv.coVanHocTap
											LEFT JOIN ChuyenNganh cn on cn.maChuyenNganh=sv.maChuyenNganh
                                            order by '.$order.';');
		}
        
        function searchStudent($key){
			return $this->db->query('SELECT sv.hoTen hoten, sv.ngaySinh as ngaysinh, sv.gioiTinh as gioitinh, queQuan, khoas, k.ten khoa, l.ten lop, cb.hoTen covan, cn.ten as chuyennganh
											FROM SinhVien sv
											LEFT JOIN Khoa k on k.MaKhoa=sv.maKhoa
											LEFT JOIN Lop l on l.maLop=sv.maLop
											LEFT JOIN CanBo cb on cb.maCanBo=sv.coVanHocTap
											LEFT JOIN ChuyenNganh cn on cn.maChuyenNganh=sv.maChuyenNganh
                                            where sv.masinhvien="'.$key.'";');
		}
        
        function delStudent($submit){
            unset($submit['xoa']);
            foreach ($submit as $row => $key){
                $this->db->query("DELETE FROM sinhvien where masinhvien = '".$row."';");
            }
		}
		function classList(){
			return $this->db->query('SELECT maLop, ten FROM lop;');
		}
		
		function classGradeList($class){
			return $this->db->query('SELECT lmh.hocKy as hocky, maSinhVien as masv, hoTen as tensv, round(avg(diemSo),3) as diemtb
									FROM lop l
									JOIN SinhVien sv on sv.maLop=l.maLop
									JOIN KetQuaHocTap kq on kq.maSV=sv.maSinhVien
									JOIN LopMonHoc lmh on lmh.maLMH=kq.maLMH
									WHERE l.maLop="'.$class.'"
									GROUP BY lmh.hocKy, maSinhVien
									ORDER BY lmh.hocKy;');
		}
		
		function courseList($order){
			return $this->db->query('SELECT mh.ten tenmh, maLMH as malmh, hocKy as hocky, nam
									FROM LopMonHoc lmh
									JOIN MonHoc mh on mh.maMonHoc=lmh.maMonHoc
									ORDER BY '.$order.';');
		}
		
		function courseGradeList($course){
			return $this->db->query('SELECT maSinhVien as masv, hoTen as tensv, diemSo as diemso, diemChu as diemchu
									 FROM LopMonHoc lmh
									 JOIN KetQuaHocTap kq on kq.maLMH=lmh.maLMH
									 JOIN SinhVien sv on sv.maSinhVien=kq.maSV
									 WHERE lmh.maLMH="'.mysql_real_escape_string($course).'"
									 ORDER BY lmh.maLMH;');
		}
        
        //luu thong tin can bo
        
        function saveStaff($submit){
            $cv = $this->db->query('SELECT machucvu, ten FROM chucvu;');
            $chucvu= $submit['chucvu'];
            foreach ($cv->result_array() as $row){
                if ($chucvu == $row['ten']){
                    $submit['machucvu']=$row['machucvu'];
                    unset ($submit['chucvu']);
                    continue;
                }
            }      
            $cn = $this->db->query('SELECT machuyennganh, ten FROM chuyennganh;');
            $chuyennganh= $submit['chuyennganh'];
            foreach ($cn->result_array() as $row){
                if ($chuyennganh == $row['ten']){
                    $submit['machuyennganh']=$row['machuyennganh'];
                    unset ($submit['chuyennganh']);
                    continue;
                }
            }
            unset($submit['submit']);
            $where='macanbo=\''.$submit['primary_key'].'\';';
            unset($submit['primary_key']);
            //echo $this->db->update_string('canbo',$submit,$where);
            $this->db->query($this->db->update_string('canbo',$submit,$where));
                        
        }
        
        function saveSubject($submit){
            $tq = $this->db->query('SELECT mamonhoc FROM monhoc;');
            $tienquyet= $submit['montienquyet'];
            $submit['tienquyet']=$submit['montienquyet'];
            unset($submit['montienquyet']);
            foreach ($tq->result_array() as $row){
                if ($tienquyet == $row['mamonhoc']){
                    $submit['tienquyet']=$row['mamonhoc'];
                    unset ($submit['montienquyet']);
                    continue;
                }
            }                  
            unset($submit['submit']);
            $submit['ten']=$submit['monhoc'];
            unset($submit['monhoc']);
            $where='mamonhoc=\''.$submit['primary_key'].'\';';
            unset($submit['primary_key']);
            $this->db->query($this->db->update_string('monhoc',$submit,$where));
                        
        }
}
?>
    }
?>