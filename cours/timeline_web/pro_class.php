<?php

class TIMELINE_Obj {
	
	public $id = 0;
	public $name = '';
	public $desc = '';
	public $date = '';
	public $category = 0;
	public $credits = 0;
	public $img_ext = '';
	public $img_full = '';
	public $timeline_array = array();
	public $timeline_html = '';
	public $timeline_category = '';
	
	public function __construct($param_dbObj, $param_dbTable) {
		$this->dbObj = $param_dbObj;
		$this->dbTable = $param_dbTable;
	}
	
	
	public function addMod() {
		$temp_req = ($this->id ? 'UPDATE ' : 'INSERT INTO ') .'`'.$this->dbTable .'` SET'
							.															'  `name` = '					.$this->dbObj->quote($this->name)
							.															' ,`date` = '					.$this->dbObj->quote($this->date)
							.	(!empty($this->desc)			? ' ,`description` = '	.$this->dbObj->quote($this->desc) : '')
							.	(!empty($this->category)	? ' ,`category` = '			.$this->dbObj->quote($this->category) : '')
							.	(!empty($this->credits)		? ' ,`credits` = '			.$this->dbObj->quote($this->credits) : '')
							.	(!empty($this->img_full)	? ' ,`image` = '				.$this->dbObj->quote($this->img_full) : '')
							. ($this->id ? 'WHERE `id` = ' .$this->id : '')
							. '';
		
		if ($this->dbObj->query($temp_req) === FALSE) {
			$error_info = $this->dbObj->errorInfo();
			$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $error_info[1], $error_info[2], $temp_req);
			echo '<br>'.$tStr; error_log($tStr); unset($tStr, $error_info);
		} else {
			if (!$this->id && $this->img_ext) {
				$tempMax_req = 'SELECT MAX(`id`) AS `max` FROM `' .$this->dbTable.'`';
				
				if (($tempMax_res = $this->dbObj->query($tempMax_req)) === FALSE) {
					$errorInfo = $this->dbObj->errorInfo();
					$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempMax_req);
					echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
				} else {
					
					$tempMax_value = $tempMax_res->fetch();
					
					$image = 'timeline_' .$tempMax_value['max'] .'.' .$this->img_ext;
					$tempImg_req = 'UPDATE ' .$this->dbTable .' SET `image` = "' .$image .'" WHERE `id` = ' .$tempMax_value['max'];
					
					if ($this->dbObj->query($tempImg_req) === FALSE) {
						$errorInfo = $this->dbObj->errorInfo();
						$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempImg_req);
						echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
					}
					else {
						$this->img_full = $image;
					}
					unset($tempImg_req, $image);
				}
				$tempMax_res->closeCursor();
				unset($tempMax_req, $tempMax_res, $tempMax_value);
			}
		}
		unset($temp_req);
	}
	
	
	public function load($type = 'array') {

		$tLoad_req = ''
								.' SELECT `main`.*, `cat`.`name` AS `category_name` FROM `' .$this->dbTable .'` AS `main` ' 
								.' LEFT JOIN `timeline_category` AS `cat`'
								.' ON `main`.`category` = `cat`.`id`'
								.($this->id ? 'WHERE `main`.`id` = '.$this->id : '')
								.' ORDER BY `date` DESC';
			
		if (($tLoad_res = $this->dbObj->query($tLoad_req)) === FALSE) {
			$errorInfo = $this->dbObj->errorInfo();
			$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tLoad_req);
			echo $tStr; error_log($tStr); unset($tStr);
		} else {
			while($tLoad_array = $tLoad_res->fetch(PDO::FETCH_ASSOC)) {
				
				$txtFormat_date = date('Y F d', strtotime($tLoad_array['date']));
				
				if ($type == 'html') {
					$this->timeline_html	.=''
																.	'<tr class="timeline-el" data-id="' .$tLoad_array['id'] .'">'	
																.		'<td>' .$txtFormat_date .'</td>'
																.		'<td>' .$tLoad_array['id'] .'</td>'
																.		'<td>' .$tLoad_array['name'] .'</td>'
																.		'<td>' .$tLoad_array['category_name'] .'</td>'
																.		'<td><a href="#" class="timeline-edit">Link</a></td>'
																.	'</tr>'	
																.	'';
				} 
				elseif ($type == 'array') {
					$this->timeline_array[] = array(
																			'id'					=> $tLoad_array['id'],
																			'name'				=> $tLoad_array['name'],
																		'date'				=> $tLoad_array['date'],
																			'description'	=> $tLoad_array['description'],
																			'cat_id'			=> $tLoad_array['category'],
																			'cat_name'		=> $tLoad_array['category_name'],
																			'credits'			=> $tLoad_array['credits'],
																			'image'				=> $tLoad_array['image']
																		);
				}
			}
			$tLoad_res->closeCursor();
			
			if ($type == 'html') return $this->timeline_html;
			if ($type == 'array') return $this->timeline_array;
		}
		unset($tLoad_req, $tLoad_res, $tLoad_array);
	}
	
	public function delete() {
		$tDel_req = 'DELETE FROM `' .$this->dbTable .'` WHERE `id` = ' .$this->id;
		if ($this->dbObj->query($tDel_req) === FALSE) {
			$errorInfo = $this->dbObj->errorInfo();
			$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tDel_req);
			echo $tStr; error_log($tStr); unset($tStr);
		}
	}
	
	public function loadSelect() {
		$tCat_req = 'SELECT * FROM `' .$this->dbTable .'`';
		if (($tCat_res = $this->dbObj->query($tCat_req)) === FALSE) {
			$errorInfo = $this->dbObj->errorInfo();
			$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tCat_req);
			echo $tStr; error_log($tStr); unset($tStr);
		} else {
			while($tCat_array = $tCat_res->fetch(PDO::FETCH_ASSOC)) {
				
				$this->timeline_category.=''
																.	'<option value="' .$tCat_array['id'] .'">'
																.		$tCat_array['name']
																.	'</option>'
																.	'';				
			}
			$tCat_res->closeCursor();
		}
		unset($tCat_req, $tCat_res, $tCat_array);
		
		return $this->timeline_category;
	}
}

?>