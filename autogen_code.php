//si vous avez beaucoup de champ cette fonction facilite
//la generation des nom de champ
function autogen()
{
	
	$mysql_query="show columns from users";
	$query=$this->_custom_query($mysql_query);

	/*
	foreach ($query->result() as $row) {
	$column_name= $row->Field;
	if($column_name!="id") {


	//echo $column_name."<br>";
	echo'$data[\'item_title\'] = $this->input->post(\''.$column_name.'\',TRUE);<br>';

}
}


echo"<hr>";

	foreach ($query->result() as $row) {
	$column_name= $row->Field;
	if($column_name!="id") {


	//echo $column_name."<br>";
	echo' $data[\''.$column_name.'\'] = $row->'.$column_name.';<br>';

}
}

echo"<hr>";

	foreach ($query->result() as $row) {
	$column_name= $row->Field;
	if($column_name!="id") {


	//echo $column_name."<br>";
	

$var = '<div class="control-group">
							  <label class="control-label" for="typeahead">'.ucfirst($column_name).'</label>
							  <div class="controls">
								<input type="text" class="span6" name="'.$column_name.'" value="<?= $'.$column_name.'?>">
							
							  </div>
							</div>';

							echo htmlentities($var);

echo "<br><br>";





}
}

*/


}