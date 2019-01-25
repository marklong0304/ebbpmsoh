<script type="text/javascript">
    $(document).ready(function() {
		$('#tabelalert').fxdHdrCol({
            width:     "100%",
            height:    300,
            colModal: [
            	{ width: 30, align: 'Right' },
                { width: 250, align: 'Left' },
                
            ],
            sort: false
        });


    });
</script>
<style type="text/css">
	.tehead{
	   background-color: #5c9ccc;
	}

	#dashdatabody tr:nth-child(odd) {
	   background-color: #ccc;
	}

	#bodyeses tr:nth-child(odd) {
	   background-color: #ccc;
	}

	#bodyalert tr:nth-child(odd) {
	   background-color: #ccc;
	}


</style>

<table id="tabelalert">
	<thead class="tehead">
		<tr>
			<th>No</th>
			<th>Nama Scheduler</th>
		</tr>
		
	</thead>
	<tbody id="bodyalert">
		<?php 
			$i=1;
			foreach ($nonames as $noname){
				if ($noname['isAda']==0) {
					
				
		?>
					<tr>
		    			<td><?php echo $i ?></td>
		    			<td><?php echo $noname['vNama_Scheduler'] ?></td>
					</tr>	
		<?php 
					$i++;
				}
			} 
		?>
		
	</tbody>
</table>