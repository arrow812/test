<?php
require_once('connection.php');

class Page{
	//properties of a page
	public $iId;
	public $sPageName;
	public $sContent;
	public $iPosition;
	public $iVisible;
	public $iSubjectId;

	//constructor to initial data
	public function __construct(){
		$this->iId = 0;
		$this->sPageName = '';
		$this->sContent = '';
		$this->iPosition = 0;
		$this->iVisible = 0;
		$this->iSubjectId = 0;
	}

	//to load a page from DB based on page id
	public function load($iId){

		//1:make connection
		$oConnection = new Connection();

		
		//2:create query
		$sSQL = 'SELECT id, page_name, content, 
						position, visible, subject_id
				FROM pages
				WHERE id = '.$iId;

		//3:execute query
		$oResultSet = $oConnection->query($sSQL);
		//4:fetch data from result set
		$aRow = $oConnection->fetch($oResultSet);

		$this->iId = $aRow['id'];
		$this->sPageName = $aRow['page_name'];
		$this->sContent = $aRow['content'];
		$this->iPosition = $aRow['position'];
		$this->iVisible = $aRow['visible'];
		$this->iSubjectId = $aRow['subject_id'];
		
		//5:close connection
	}

	//to save the data to the database
	public function save(){

		//connection
		$oConnection = new Connection;

		//create insert query
		$sSQL = "INSERT INTO pages (subject_id, page_name, position, visible, content) 
		VALUES ('".$this->iSubjectId."', '".$this->sPageName."', '".$this->iPosition."', '".$this->iVisible."', '".$this->sContent."')";

		//execute query
		// echo $sSQL;
		$bSuccess = $oConnection->query($sSQL);

		//check for successful creation
		//echo $sSQL;

		// if success = true 
		if($bSuccess == true){
			$this->iId = $oConnection->getInsertId();
		}
	}
}

// /testing -----------
// $oPage = new Page();
// // $oPage->load(3);
// $oPage->iSubjectId= 2;
// $oPage->sPageName= 'Aramis';
// $oPage->iPosition= 5;
// $oPage->iVisible= 1;
// $oPage->sContent= 'This is Aramis s page';

// $oPage->save();


// echo '<pre>';
// print_r($oPage);
// echo '</pre>';
?>











