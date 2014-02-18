<?php

class P_test extends CI_Controller {


	public function index()
	{
		// $words = $this->input->get('words');
		// $data['pinyin'] = $this->trans($words);	
		echo 'json_encode($data)';
	}
	
	
	private function trans($words){
		// apd_set_pprof_trace();
		$length = mb_strlen($words);

		$table_name = 'V';

		for( $index = 0; $index < $length; $index++){
			$one = mb_substr($words, $index, 1);

			if( $this->words_model->isWordHasPinyin($one) ){
				
				if( $index == 0 ){
					$table_name = $this->words_model->getWordPinyin($one);
				}
				
				$this->words_transed .= $this->words_model->getWordPinyin($one);
			} else {
				$this->words_transed .= $one;
			}

		}
		$result = $this->pinyin_db_model->save($words, $this->words_transed, $table_name);
		return $this->words_transed;

	}
	
	
	
}
