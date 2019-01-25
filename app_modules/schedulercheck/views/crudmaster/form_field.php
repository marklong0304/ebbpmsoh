<?php 
	//print_r($fields);
	 //[0] => Array ( [COLUMN_NAME] => iapplet_bd [COLUMN_KEY] => PRI [COLUMN_TYPE] => int(11) unsigned [DATA_TYPE] => int [CHARACTER_MAXIMUM_LENGTH] => 

	
 ?>

 <table border='1' style="width: 100%;border-collapse: collapse;">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Name</th>
 			<th>Field Type & Length</th>
 			<th>Show on Form</th>
 			<th>Text on Label</th>
 			<th>Field Input as</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php 
 			$i=1;
 			foreach ($fields as $field ) {
 				
 				if($field['COLUMN_KEY']=="PRI"){
 					$bold='bold';
 					$isPk =1;
 				}else{
 					$bold='normal';
 					$isPk=0;
 				}
 		?>
		 		<tr>
		 			<td style="text-align: right;"><?php echo $i ?></td>
		 			<td style="font-weight: <?php echo $bold ?>;">
		 				<?php echo $field['COLUMN_NAME'] ?>
		 				<input type="hidden" name="txtinput[]" value="<?php echo $field['COLUMN_NAME']  ?> ">
		 				
		 			</td>
		 			<td style="text-align: left;"><?php echo $field['COLUMN_TYPE'] ?></td>
		 			<td>
		 				<?php 

		 					if ($isPk) {
		 						echo '<input type="hidden" name="showonform[]" value="0">';	
		 					}else{
		 						$fideal=0;
			 					$ljenis = array( 0=>'No',1=>'Yes');
					            $o  = "<select name='showonform[]' id='showonform'>";            
					            foreach($ljenis as $k=>$v) {
					                if ($k == $fideal) $selected = " selected";
					                else $selected = "";
					                $o .= "<option {$selected} value='".$k."'>".$v."</option>";
					            }            
					            $o .= "</select>";

					            echo $o;	
		 					}
		 					

		 				?>

		 			</td>
		 			<td>
		 				<?php 
		 					if ($isPk) {
		 						echo '<input type="hidden" name="txtlabel[]" value="'.$field['COLUMN_NAME'].'">';	
		 					}else{


		 				 ?>
		 					<input type="text" name="txtlabel[]" value="<?php echo $field['COLUMN_NAME']  ?> ">
		 				<?php 
		 					}
		 				?>
		 			</td>
		 			
		 			<td>
		 				<?php 
		 					/*mapping field type */
		 					/*
								1. untuk text
								2. untuk number
								3. date
								4. textarea


		 					*/


		 					switch ($field['DATA_TYPE']) {
		 						case 'int':
		 						case 'tinyint':
		 						
		 							$fideal=2;
		 							break;
		 						
		 						case 'date':
		 							$fideal=3;
		 							break;

		 						case 'text':
		 							$fideal=4;
		 							break;


		 						default:
		 							$fideal=1;
		 							break;
		 					}

		 					if ($isPk) {
		 						echo '<input type="hidden" name="jenis_input[]" value="2">';	
		 					}else{
		 						$ljenis = array(1=>'Input Field', 2=>'Number', 3=>'Date Picker',4=>'Text Area',5=>'Dropdown Static',6=>'Dropdown Dynamic',7=>'Upload File');
					            $o  = "<select name='jenis_input[]' id='jenis_input'>";            
					            foreach($ljenis as $k=>$v) {
					                if ($k == $fideal) $selected = " selected";
					                else $selected = "";
					                $o .= "<option {$selected} value='".$k."'>".$v."</option>";
					            }            
					            $o .= "</select>";

					            echo $o;
				            	
		 					}

		 					
		 				 ?>

		 			</td>
		 			
		 		</tr>
 		<?php 
 			$i++;
 			}
 		?>
 	</tbody>
 </table>