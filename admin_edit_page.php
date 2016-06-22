
<?php
require_once('includes/admin_header.php');
require_once('includes/page.php');
require_once('includes/form.php');



$iCurrentPage = 0;
//get page id to be edited
if(isset($_GET['pageid'])== true){
	$iCurrentPage = $_GET['pageid'];

}

$oPage = new Page;
$oPage->load($iCurrentPage);

//make sticky data for form
$aStickyData = [];
$aStickyData['page_name']=$oPage->sPageName ;
$aStickyData['subject_id']= $oPage->iSubjectId ;
$aStickyData['position'] = $oPage->iPosition;
$aStickyData['content'] = $oPage->sContent;

$oForm = new Form();

$oForm->aData=$aStickyData; //assign sticky data to form


//NEED!!! if submit button clicked _POST new data to DB...
// if(isset($_POST['submit'])==true){
// 	$oPage->sPageName=$_POST['page_name'];
// }

$oForm->open();
	$oForm->makeTextInput('Page Name','page_name');
	$oForm->makeTextInput('Subject ID','subject_id');
	$oForm->makeTextInput('Postion','position');
	$oForm->makeTextInput('Visible','Visible');
	$oForm->makeTextArea('Content','content');
$oForm->makeSubmit('Update page','submit');

$oForm->close();


?>

		<div class="two-thirds column">
			<h3>Edit Page</h3>
			<?php echo $oForm->sHTML; ?>
		<!-- 	<form>
				<label for="page_name">Page Name</label>
				<input type="text" id="page_name" name="page_name" value="Our goal"/>

				<label for="subject_id">Subject ID</label>
				<input type="text" id="subject_id" name="subject_id" value="1" />

				<label for="position">Postion</label>
				<input type="text" id="position" name="position" value="1" />

				<label for="visible">Visible</label>
				<input type="text" id="visible" name="visible" value="1" />

				<label for="content">Content</label>
				<textarea id="content" name="content">Although coming from different backgrounds, we are united to become web experts. Here are our stories</textarea>
				
				<input type="submit" name="submit" value="Update page"/>
			</form> -->
		</div>



<?php
require_once('includes/footer.php');
?>


