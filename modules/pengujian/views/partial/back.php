<script type="text/javascript">
	function browse_multi1_sample_permintaan_sample(url, title, dis, param) {
		var i = $('.btn_browse_bb').index(dis);	
		load_popup_multi(url+'&'+param,'','',title,i);
	}
	function get_rawmaterial_exists() {
		var i = 0;
		var l_irawmat_id = '';
		$('.detraw_id').each(function() {
			if  ($('.detraw_id').eq(i).val() != '') {
				l_irawmat_id += $('.detraw_id').eq(i).val()+'_';
			}
			
			i++;
		});
	
		l_irawmat_id = l_irawmat_id.substring(0, l_irawmat_id.length - 1);
		if (l_irawmat_id === undefined) l_ireq_id = 0;
		$('.list_raw_material_exists').val(l_irawmat_id);
		var x= $('.list_raw_material_exists').val(l_irawmat_id);
		//alert (l_irawmat_id);
	}
	jQuery('.angka').live('keyup', function() {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	});

	$('.tanggal').datepicker({changeMonth:true,
							changeYear:true,
							dateFormat:"yy-mm-dd" });
</script>
<style type="text/css">
	table.hover_table tr:hover {
		
	}
</style>
<table class="hover_table" id="sample_permintaan_sample" cellspacing="0" cellpadding="1" style="width: 98%; border: 1px solid #dddddd; text-align: center; margin-left: 5px; border-collapse: collapse">
	<thead>
	<tr style="width: 98%; border: 1px solid #dddddd; background: #A3619D; border-collapse: collapse">
		<th colspan="6" style="border: 1px solid #dddddd;"><span style="font-weight: bold; color: #ffffff; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3); text-transform: uppercase;">Pengujian Fisik</span></th>
	</tr>
	<tr style="width: 98%; border: 1px solid #dddddd; background: #DBC0D2; border-collapse: collapse">
		<th style="border: 1px solid #dddddd;" colspan="2">Hasil Uji</th>
		<th style="border: 1px solid #dddddd;">Metoda</th>
		<th style="border: 1px solid #dddddd;">Persyaratan Mutu</th>
		<th style="border: 1px solid #dddddd;">Tanggal</th>
		<!-- <th style="border: 1px solid #dddddd;">Action</th>		 -->
	</tr>
	</thead>
	<tbody>
		<?php
			$i = 0;
			if(!empty($rows)) {
				foreach($rows as $row) {
				$i++;				
		?>
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<span class="sample_permintaan_sample_num">Warna</span>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vWarna[]" value="" class="vWarna required" style="width: 100%; text-align: left;"/>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vWarna_metoda[]" value="" class="vWarna_metoda required" style="width: 100%; text-align: left;"/>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vWarna_mutu[]" value="" class="vWarna_mutu required" style="width: 100%" />
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="dWarna_tanggal tanggal[]" value="" class="dWarna_tanggal tanggal" style="width: 90%" />
					</td>

					<!-- <td style="border: 1px solid #dddddd; width: 10%">
						<span class="delete_btn"><a href="javascript:;" class="sample_permintaan_sample_del" onclick="del_row(this, 'sample_permintaan_sample_del')">[Hapus]</a></span>
					</td>	 -->	
				</tr>

				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<span class="sample_permintaan_sample_num">Partikel Asing</span>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vAsing[]" value="" class="vAsing required" style="width: 100%; text-align: left;"/>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vAsing_metoda[]" value="" class="vAsing_metoda required" style="width: 100%; text-align: left;"/>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vAsing_mutu[]" value="" class="vAsing_mutu required" style="width: 100%; text-align: left;"/>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="dAsing_tanggal tanggal[]" value="" class="dAsing_tanggal tanggal" style="width: 90%" />
					</td>
				</tr>

				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<span class="sample_permintaan_sample_num">Homogenitas</span>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vHomogen[]" value="" class="vHomogen required" style="width: 100%; text-align: left;"/>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vHomogen_metoda[]" value="" class="vHomogen_metoda required" style="width: 100%; text-align: left;"/>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="vHomogen_mutu[]" value="" class="vHomogen_mutu required" style="width: 100%; text-align: left;"/>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" value="<?php echo $row['ijumlah'] ?>" name="dHomogen_tanggal tanggal[]" value="" class="dHomogen_tanggal tanggal" style="width: 90%" />
					</td>
				</tr>

		<?php
				}
			}
			else {
			//$i++;
		?>
		<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
			<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
				<span class="sample_permintaan_sample_num">Warna</span>
			</td>		
			<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
				<input type="text" name="vWarna[]" value="" class="vWarna required" style="width: 100%; text-align: left;"/>
			</td>		
			<td style="border: 1px solid #dddddd; width: 25%">
				<input type="text" name="vWarna_metoda[]" value="" class="vWarna_metoda required" style="width: 100%; text-align: left;"/>
			</td>	
			<td style="border: 1px solid #dddddd; width: 25%">
				<input type="text" name="vWarna_mutu[]" value="" class="vWarna_mutu required" style="width: 100%" />
			</td>
			<td style="border: 1px solid #dddddd; width: 10%">
				<input type="text" name="dWarna_tanggal tanggal[]" value="" class="dWarna_tanggal tanggal" style="width: 90%" />
			</td>
			<!-- <td style="border: 1px solid #dddddd; width: 10%">
				<span class="delete_btn"><a href="javascript:;" class="sample_permintaan_sample_del" onclick="del_row(this, 'sample_permintaan_sample_del')">[Delete]</a></span>
			</td>		 -->
		</tr>

		<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
			<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
				<span class="sample_permintaan_sample_num">Partikel Asing</span>
			</td>		
			<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
				<input type="text" name="vAsing[]" value="" class="vAsing required" style="width: 100%; text-align: left;"/>
			</td>		
			<td style="border: 1px solid #dddddd; width: 25%">
				<input type="text" name="vAsing_metoda[]" value="" class="vAsing_metoda required" style="width: 100%; text-align: left;"/>
			</td>	
			<td style="border: 1px solid #dddddd; width: 25%">
				<input type="text" name="vAsing_mutu[]" value="" class="vAsing_mutu required" style="width: 100%; text-align: left;"/>
			</td>
			<td style="border: 1px solid #dddddd; width: 10%">
				<input type="text" name="dAsing_tanggal tanggal[]" value="" class="dAsing_tanggal tanggal" style="width: 90%" />
			</td>
		</tr>

		<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
			<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
				<span class="sample_permintaan_sample_num">Homogenitas</span>
			</td>		
			<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
				<input type="text" name="vHomogen[]" value="" class="vHomogen required" style="width: 100%; text-align: left;"/>
			</td>		
			<td style="border: 1px solid #dddddd; width: 25%">
				<input type="text" name="vHomogen_metoda[]" value="" class="vHomogen_metoda required" style="width: 100%; text-align: left;"/>
			</td>	
			<td style="border: 1px solid #dddddd; width: 25%">
				<input type="text" name="vHomogen_mutu[]" value="" class="vHomogen_mutu required" style="width: 100%; text-align: left;"/>
			</td>
			<td style="border: 1px solid #dddddd; width: 10%">
				<input type="text" name="dHomogen_tanggal tanggal[]" value="" class="dHomogen_tanggal tanggal" style="width: 90%" />
			</td>
		</tr>


		<?php } ?>
	</tbody>
	<!-- <tfoot>
		<tr>
			<td colspan="5"></td><td style="text-align: center"><a href="javascript:;" onclick="javascript:add_row('sample_permintaan_sample')">Tambah</a></td>
		</tr>
	</tfoot> -->
</table>
