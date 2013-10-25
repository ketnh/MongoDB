<?php
	class TableConstruct{
		function construct($title, $index, $header, $data, $baseURL = null){            
			$result ='<h2 class="header">'.$title.'</h2><br/>';
                        $result .='<div id="subcontent">';
			$result .= '<table class="table_cons">';
			$num = count($index);
			$result .= '<tr>';
			for ($i = 0; $i < $num; ++$i){
				$result .= '<th><a href = '.$baseURL.'/'.$index[$i].'>'.$header[($index[$i])].'</a></th>';
			}
			$result .= '</tr>';
			$count = 1;
			foreach ($data->result() as $row){
				$result .= '<tr>';
				$result .= '<td>'.$count.'</td>';
				for ($i = 1; $i < $num; ++$i){
					if ($index[$i] == 'gioitinh'){
						$result .= '<td>'.($row->$index[$i] == '1' ? 'nam' : 'nữ').'</td>';
						continue;
					}
                    if ($index[$i] == 'xoa'){
                        if (isset($row->macanbo)) $key = $row->macanbo;
                        if (isset($row->mamon)) $key = $row->mamon;
                        if (isset($row->masinhvien)) $key = $row->masinhvien;
						$result .= '<td><input type="checkbox" name="'.$key.'" /></td>';
						continue;
					}
                    if ($index[$i] == 'edit'){
                        if (isset($row->macanbo)) {
                            $key = $row->macanbo;
                            $result .='<td><a href="/HQT/index.php/statistic/editStaffList/'.$key.'">Edit</a></td>';
                        }
                        if (isset($row->mamon)) {
                            $key = $row->mamon;
                            $result .='<td><a href="/HQT/index.php/statistic/editSubjectList/'.$key.'">Edit</a></td>';
                        }
                        if (isset($row->masinhvien)) {
                            $key = $row->masinhvien;
                            $result .='<td><a href="/HQT/index.php/statistic/editStudentList/'.$key.'">Edit</a></td>';
                        }
						continue;
					} 
					$result .= '<td>'.$row->$index[$i].'</td>';
				}
				$result .= '</tr>';
				$count++;
			}
			$result .= '</table>';
                        $result .= '</div>';
			return $result;
		}
		
		function constructLink($title, $index, $header, $data, $key, $link){
			$result = '<h1 class="header">'.$title.'</h1>';
			$result .= '<table class="table_cons">';
			$num = count($index);
			$result .= '<tr>';
			for ($i = 0; $i < $num; ++$i){
				$result .= '<th>'.$header[($index[$i])].'</th>';
			}
			$result .= '</tr>';
			$count = 1;
			foreach ($data->result() as $row){
				$result .= '<tr>';
				$result .= '<td>'.$count.'</td>';
				for ($i = 1; $i < $num; ++$i){
					if ($index[$i] == $key){
						$result .= '<td>'.($row->$index[$i]).' (<a href="'.base_url().$link.str_replace(' ', '_', $row->$index[$i]).'">Xem điểm</a>)</td>';
						continue;
					}
                    if ($index[$i] == 'xoa'){
						$result .= '<td><input type="checkbox" name="'.$count.'" /></td>';
						continue;
					}
					$result .= '<td>'.$row->$index[$i].'</td>';
				}
				$result .= '</tr>';
				$count++;
			}
			$result .= '</table>';
			return $result;
		}
        
        function dropdown_menu($array, $id, $javascript){
            $result ='<select id='.$id. ' onchange="'.$javascript.'">';
            foreach ($array as $row => $key)
            $result = $result.'<option value="'.$row.'">'.$key.'</option>';
            $result = $result."</select> ";
            return $result;
        }
        
        function search($array,$id,$action){
            $result = 'Tìm kiếm:'.'<form method="post" accept-charset="utf-8" action="'.$action.'" />';
            $result .= $this->dropdown_menu($array,'mix','');
            $result .= '<input type="text" name="value"/>';
            $result .= '<input type ="submit" name="submit" value ="Tìm">';
            $result .= '</form>';
            return $result;
        }
        function displayEditForm($title,$array_name,$array_default,$action,$primary_key){
            $result ='<h1 class="header">'.$title.'</h1><br/><br/>';
            $result.='<table><form method="post" accept-charset="utf-8" action="'.$action.'" />';
            $result.='<input type="hidden" name="primary_key" value="'.$primary_key.'" />';
            foreach ($array_name as $row=>$key){
                $result.='<tr>';
                $i=0;
                $result.='<td>'.$key.'</td><td><input type="text" name="'.$row.'" value="'.$array_default[$row].'"/></td>';            
                $i++;
                $result.='</tr>';
            }
            $result.='<tr><td><input type = "submit" name="submit" value="OK"/><td></tr></form></table>';
            return $result;   
        }
	}