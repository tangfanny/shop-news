<?php

class ImgSizeModel extends Model{


	public function TemplateImgSize($site){
		
		$data = array();
		switch ($site) {
			case '1':
				$data['width']=684;
				$data['height']=371;
				break;
			case '2':
				$data['width']=208;
				$data['height']=181;
				break;
			case '3':
				$data['width']=208;
				$data['height']=181;
				break;
			case '4':
				$data['width']=425;
				$data['height']=181;
				break;
			default:
				$data['width']=0;
				$data['height']=0;
				break;
		}

	    return $data;
	}
	

}