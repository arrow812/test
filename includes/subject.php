<?php
require_once('connection.php');
require_once('page.php');

class Subject{

	public $iId;
	public $sSubjectName;
	public $iPosition;
	public $iVisible;
	public $aPages;

	public function __construct(){
		$this->iId = 0;
		$this->sSubjectName = '';
		$this->iPosition = 0;
		$this->iVisible = 0;
		$this->aPages = [];
	}

	public function load($iId){

		$oConnection = new Connection();

		$sSQL = 'SELECT id, subject_name, position, visible
				FROM subjects
				WHERE id = '.$iId;

		$oResultSet = $oConnection->query($sSQL);

		$aRow = $oConnection->fetch($oResultSet);

		$this->iId = $aRow['id'];
		$this->sSubjectName = $aRow['subject_name'];
		$this->iPosition = $aRow['position'];
		$this->iVisible = $aRow['visible'];

		//loading pages of this subject

		//query all Page IDs of the subject
		$sSQL = 'SELECT id
				FROM pages
				WHERE subject_id = '.$iId;
		$oResultSet = $oConnection->query($sSQL);

		//Fetch page IDs from the result set
		while($aRow =$oConnection->fetch($oResultSet)){
			$iPageId = $aRow['id'];

			$oPage = new Page();
			$oPage->load($iPageId);
			$this->aPages[] = $oPage; // add more at the end of array
		}
	}


	public function save(){

		$oConnection = new Connection;

		$sSQL = "INSERT INTO subjects ( subject_name, position, visible) 
				VALUES ( '".$this->sSubjectName."', '".$this->iPosition."', '".$this->iVisible."')";

		//execute query
		$bSuccess = $oConnection->query($sSQL);

		//check for sucessful creation
		if ($bSuccess == true){

		$this->iId = $oConnection->getInsertId();

		}
	}
}

// /testing -----------
// $oSubject = new Subject();
// // $oSubject->load(3);
// $oSubject->sSubjectName= 'Subject 4';
// $oSubject->iPosition= 1;
// $oSubject->iVisible= 1;


// $oSubject->save();



// $oSubject = new Subject();
// $oSubject->load(2);

// echo '<pre>';
// print_r($oSubject);
// echo '</pre>';

?>