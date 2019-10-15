<?php
	define('DBERROR_fmt', '%s ON L[%s] : DB ERROR(%s) : %s ON REQ : %s');

	class PAINTING_Obj {

		public $retArray = array();
		public $id = 0;
		public $name = '';
		public $type = '';
		public $date_start = '';
		public $date_end = '';
		public $desc = '';
		public $size = '';
		public $price = 0;
		public $image = '';
		public $image_extension = '';
		public $db_ident = '';
		public $db_type = '';
		private $noWhere = FALSE;

		public function __construct($param_dbObj, $param_type) {
			$this->dbObj = $param_dbObj;
			$this->type = $param_type;
			
			switch($param_type) {
				case 'painting_all':
					$this->db_ident = 'lty_peintures';
					$this->noWhere = TRUE;
					break;
				case 'clb':
					$this->db_ident = 'lty_peintures';
					break;
				case 'clc':
					$this->db_ident = 'lty_peintures';
					break;
				case 'event':
					$this->db_ident = 'lty_events';
					$this->noWhere = TRUE;
					$this->type = 'event';
					break;
			}
		}

		public function load($arrayKey = 'id', $loadType = 'array') {
			$tempLoad_req =
				' SELECT `painting`.* '
				. ' FROM ' .$this->db_ident .' AS `painting` '
				. (empty($this->noWhere) ? ' WHERE `painting`.`type` = "'.$this->type.'"' : '')
				. ' ORDER BY `painting`.`id` DESC';
				
			if( ($tempLoad_res = $this->dbObj->query($tempLoad_req)) === FALSE ) {
				$errorInfo = $this->dbObj->errorInfo();
				$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempLoad_req);
				echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
			}
			else {
				$this->retArray['totalCount'] = $tempLoad_res->rowCount();
				while ( $tempLoad_array = $tempLoad_res->fetch(PDO::FETCH_ASSOC)) {
					//$tempLoad_array['name'] = htmlentities($tempLoad_array['name'], ENT_COMPAT, 'iso-8859-1');

					if ($loadType == 'array') {
						$this->retArray['paintingArray'][ ((int) $tempLoad_array[$arrayKey]) ] = (array) $tempLoad_array;
					}
					else if ($loadType == 'table') {
						if (isset($tempLoad_array['type'])) {
							if ($tempLoad_array['type'] == 'clc') {
								$tempLoad_array['type_name'] = 'Changeons Choses';
							}
							elseif ($tempLoad_array['type'] == 'clb') {
								$tempLoad_array['type_name'] = 'Lumi&egrave;res Bassin';	
							}
						}
						//print_r($tempLoad_array);
						$tempLoad_array['rowctn'] = ''
						.	'<tr class="paintingEl" data-id="' .$tempLoad_array['id'] .'">'
						.		'<td class="img-box"><div>'
						.			'<img src="../peintures/' .$tempLoad_array['image'] .'">'
						.			'</div></td>'
						.		'<td class="txt-box"><p>'. $tempLoad_array['name'] .'</p><p>' .$tempLoad_array['description'] .'</p></td>'
						.	($this->type != "event" ?
									'<td class="size-box">' .utf8_encode($tempLoad_array['size']) .'</td>'
								.	'<td class="price-box">' .utf8_encode($tempLoad_array['price']) .'</td>'
								.	'<td class="type-box" data-type="' .utf8_encode($tempLoad_array['type']) .'">' .$tempLoad_array['type_name'] .'</td>'
							: '<td class="date-box"><span class="dateStart">' .date('Y-m-d',strtotime($tempLoad_array['date_start'])) .'</span><br>au<br><span class="dateEnd">'.date('Y-m-d',strtotime($tempLoad_array['date_end'])).'</span></td>'
							)
						.		'<td class="edit-box"><a href="#" class="modify get-data">Modifier</a><br><a href="#" class="delete get-data" value="">Effacer</a>'
						.	'</tr>'.PHP_EOL;

						$this->retArray['painting'][] = $tempLoad_array['rowctn'];
					}
					//print_r($this->retArray['painting']);
				}
				$tempLoad_res->closeCursor();

				if ($loadType == 'array') {
					$this->arr = $this->retArray['paintingArray'];
					return $this->retArray['paintingArray'];
				}
			}
			unset($tempLoad_req, $tempLoad_res, $tempLoad_array);
		}


		public function delFromTable() {
			$tempSel_req = 'SELECT `image` FROM ' .$this->db_ident .' WHERE `id` = ' .$this->id;
			if( ($tempSel_res = $this->dbObj->query($tempSel_req)) === FALSE ) {
				$errorInfo = $this->dbObj->errorInfo();
				$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempSel_req);
				echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
			}
			else {
				$tempSel_value = $tempSel_res->fetch();
				$tempDel_req = 'DELETE FROM  ' .$this->db_ident .' WHERE `id` = ' .$this->dbObj->quote($this->id);
				if( $this->dbObj->query($tempDel_req) === FALSE ) {
					$errorInfo = $this->dbObj->errorInfo();
					$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempDel_req);
					echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
				}
				else {
					unlink($_SERVER['DOCUMENT_ROOT'] .'/git/projet/peinture_lty/peintures/' .$tempSel_value['image']);
				}
				unset($tempDel_req);
			}
			unset($tempSel_req, $tempSel_res, $tempSel_value);
		}

		public function addModTable() {
			//var_dump($this);
			$temp_req	= ( $this->id ? 'UPDATE ' : 'INSERT INTO ' ) .$this->db_ident .' SET '
							. '`name` = '.$this->dbObj->quote(stripslashes(utf8_encode($this->name))).' '
							. ',`description` = ' .$this->dbObj->quote(stripslashes(utf8_encode($this->desc))).' '
							. (!empty($this->size) ? ',`size` = '.$this->dbObj->quote($this->size).' ' : '')
							. (!empty($this->price) ? ',`price` = '.$this->dbObj->quote($this->price).' ' : '')
							. ($this->type != 'event' ? ',`type` = '.$this->dbObj->quote($this->type).' ' : '')
							. ($this->type == 'event' ? ',`date_start` = '.$this->dbObj->quote($this->date_start).' ' :'')
							. ($this->type == 'event' ? ',`date_end` = '.$this->dbObj->quote($this->date_end).' ' :'')
							. ( $this->id ? ' WHERE `id` = '.$this->dbObj->quote($this->id) : '' );
			//echo $temp_req; exit();
			
			if ($this->dbObj->query($temp_req) === FALSE) {
				$errorInfo = $this->dbObj->errorInfo();
				$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $temp_req);
				echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
			} else {
					$tempMax_req = 'SELECT MAX(`id`) AS `max` FROM ' .$this->db_ident;
					if (($tempMax_res = $this->dbObj->query($tempMax_req)) === FALSE) {
						$errorInfo = $this->dbObj->errorInfo();
						$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempMax_req);
						echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
					}
					else {
						$tempMax_value = $tempMax_res->fetch();
						if (empty($this->id)) {
							$image = $this->type .'_' .$tempMax_value['max'] .'.' .$this->image_extension;
							$tempImg_req = 'UPDATE ' .$this->db_ident .' SET `image` = "' .$image .'" WHERE `id` = ' .$tempMax_value['max'];
							if ($this->dbObj->query($tempImg_req) === FALSE) {
								$errorInfo = $this->dbObj->errorInfo();
								$tStr = sprintf(DBERROR_fmt, __FILE__, __LINE__, $errorInfo[1], $errorInfo[2], $tempImg_req);
								echo '<br>'.$tStr; error_log($tStr); unset($tStr, $errorMsg);
							}
							else {
								$this->image = $image;
							}
							unset($tempImg_req, $image);
						}
					}
					unset($tempMax_req, $tempMax_res, $tempMax_value);
			}
			unset($temp_req);
		}
	}

?>
