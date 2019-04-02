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
<table class="hover_table" id="sample_permintaan_sample" cellspacing="0" cellpadding="1" style="width: 95%; border: 1px solid #dddddd; text-align: center; margin-left: 5px; border-collapse: collapse">
	<thead>
	<tr style="width: 95%; border: 1px solid #dddddd; background: #A3619D; border-collapse: collapse">
		<th colspan="6" style="border: 1px solid #dddddd;"><span style="font-weight: bold; color: #ffffff; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3); text-transform: uppercase;">Detail Pengujian</span></th>
	</tr>
	<tr style="width: 95%; border: 1px solid #dddddd; background: #DBC0D2; border-collapse: collapse">
		<th style="border: 1px solid #dddddd;">Jenis Uji</th>
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
				<!-- fisik -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num"><b>Warna<b></span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vWarna'] ?>" name="vWarna" value="" class="vWarna required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vWarna']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vWarna_metoda'] ?>" name="vWarna_metoda" value="" class="vWarna_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vWarna_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vWarna_mutu'] ?>" name="vWarna_mutu" value="" class="vWarna_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vWarna_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dWarna_tanggal'] ?>" name="dWarna_tanggal" value="" class="dWarna_tanggal tanggal" style="width: 90%" />
						</td>

					</tr>

					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num"><b>Partikel Asing<b></span>
						</td>		
						<td  style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vAsing'] ?>" name="vAsing" value="" class="vAsing required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vAsing']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vAsing_metoda'] ?>" name="vAsing_metoda" value="" class="vAsing_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vAsing_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vAsing_mutu'] ?>" name="vAsing_mutu" value="" class="vAsing_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vAsing_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dAsing_tanggal'] ?>" name="dAsing_tanggal" value="" class="dAsing_tanggal tanggal" style="width: 90%" />
						</td>
					</tr>

					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num"><b>Kelarutan<b></span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vKelarutan'] ?>" name="vKelarutan" value="" class="vKelarutan required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKelarutan']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vKelarutan_metoda'] ?>" name="vKelarutan_metoda" value="" class="vKelarutan_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKelarutan_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vKelarutan_mutu'] ?>" name="vKelarutan_mutu" value="" class="vKelarutan_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKelarutan_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dKelarutan_tanggal'] ?>" name="dKelarutan_tanggal" value="" class="dKelarutan_tanggal tanggal" style="width: 90%" />
						</td>
					</tr>
				<!-- fisik -->


				<!-- kevakuman -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Keseragaman Bobot</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vSeragam'] ?>" name="vSeragam" class="vSeragam required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSeragam']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vSeragam_metoda'] ?>" name="vSeragam_metoda"class="vSeragam_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSeragam_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vSeragam_mutu'] ?>" name="vSeragam_mutu"  class="vSeragam_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSeragam_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dSeragam_tanggal'] ?>" name="dSeragam_tanggal"  class="dSeragam_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- kevakuman -->

				<!-- Ph -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>pH<B>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vPh" value="<?php echo $row['vPh'] ?>" class="vPh required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPh']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vPh_metoda" value="<?php echo $row['vPh_metoda'] ?>" class="vPh_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPh_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vPh_mutu" value="<?php echo $row['vPh_mutu'] ?>" class="vPh_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPh_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dPh_tanggal" value="<?php echo $row['dPh_tanggal'] ?>" class="dPh_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- Ph -->

				

				<!-- Identitas -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Identitas</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vIdentitas" value="<?php echo $row['vIdentitas'] ?>" class="vIdentitas required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vIdentitas']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vIdentitas_metoda" value="<?php echo $row['vIdentitas_metoda'] ?>" class="vIdentitas_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vIdentitas_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vIdentitas_mutu" value="<?php echo $row['vIdentitas_mutu'] ?>" class="vIdentitas_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vIdentitas_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dIdentitas_tanggal" value="<?php echo $row['dIdentitas_tanggal'] ?>" class="dIdentitas_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- Identitas -->

			<!-- Steril37 -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Sterilitas 37 &deg;<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSteril37" value="<?php echo $row['vSteril37'] ?>" class="vSteril37 required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril37']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril37_metoda" value="<?php echo $row['vSteril37_metoda'] ?>" class="vSteril37_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril37_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril37_mutu" value="<?php echo $row['vSteril37_mutu'] ?>" class="vSteril37_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril37_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSteril37_tanggal" value="<?php echo $row['dSteril37_tanggal'] ?>" class="dSteril37_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Steril37 -->
			<!-- Steril22 -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Sterilitas 22 &deg;<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSteril22" value="<?php echo $row['vSteril22'] ?>" class="vSteril22 required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril22']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril22_metoda" value="<?php echo $row['vSteril22_metoda'] ?>" class="vSteril22_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril22_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril22_mutu" value="<?php echo $row['vSteril22_mutu'] ?>" class="vSteril22_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril22_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSteril22_tanggal" value="<?php echo $row['dSteril22_tanggal'] ?>" class="dSteril22_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Steril22 -->
			<!-- Kontaminasi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Uji Kontaminasi<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vKontaminasi" value="<?php echo $row['vKontaminasi'] ?>" class="vKontaminasi required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKontaminasi']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKontaminasi_metoda" value="<?php echo $row['vKontaminasi_metoda'] ?>" class="vKontaminasi_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKontaminasi_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKontaminasi_mutu" value="<?php echo $row['vKontaminasi_mutu'] ?>" class="vKontaminasi_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKontaminasi_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dKontaminasi_tanggal" value="<?php echo $row['dKontaminasi_tanggal'] ?>" class="dKontaminasi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Kontaminasi -->

			<!-- Coli -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>E. Coli<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vColi" value="<?php echo $row['vColi'] ?>" class="vColi required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vColi']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vColi_metoda" value="<?php echo $row['vColi_metoda'] ?>" class="vColi_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vColi_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vColi_mutu" value="<?php echo $row['vColi_mutu'] ?>" class="vColi_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vColi_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dColi_tanggal" value="<?php echo $row['dColi_tanggal'] ?>" class="dColi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Coli -->

			<!-- Salmon -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Salmonella<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSalmon" value="<?php echo $row['vSalmon'] ?>" class="vSalmon required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSalmon']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSalmon_metoda" value="<?php echo $row['vSalmon_metoda'] ?>" class="vSalmon_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSalmon_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSalmon_mutu" value="<?php echo $row['vSalmon_mutu'] ?>" class="vSalmon_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vSalmon_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSalmon_tanggal" value="<?php echo $row['dSalmon_tanggal'] ?>" class="dSalmon_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Salmon -->

			<!-- kelembapan -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kelembaban</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" value="<?php echo $row['vLembab'] ?>" name="vLembab" class="vLembab required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vLembab']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" value="<?php echo $row['vLembab_metoda'] ?>" name="vLembab_metoda" value="" class="vLembab_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vLembab_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" value="<?php echo $row['vLembab_mutu'] ?>" name="vLembab_mutu" value="" class="vLembab_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vLembab_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" value="<?php echo $row['dLembab_tanggal'] ?>" name="dLembab_tanggal" value="" class="dLembab_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- kelembapan -->

			<!-- Toksis -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Toksisitas Abnormal<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vToksis" value="<?php echo $row['vToksis'] ?>" class="vToksis required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vToksis']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vToksis_metoda" value="<?php echo $row['vToksis_metoda'] ?>" class="vToksis_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vToksis_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vToksis_mutu" value="<?php echo $row['vToksis_mutu'] ?>" class="vToksis_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vToksis_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dToksis_tanggal" value="<?php echo $row['dToksis_tanggal'] ?>" class="dToksis_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Toksis -->

			<!-- Pirogen -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Pirogenitas<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vPirogen" value="<?php echo $row['vPirogen'] ?>" class="vPirogen required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPirogen']) ?></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPirogen_metoda" value="<?php echo $row['vPirogen_metoda'] ?>" class="vPirogen_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPirogen_metoda']) ?></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPirogen_mutu" value="<?php echo $row['vPirogen_mutu'] ?>" class="vPirogen_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPirogen_mutu']) ?></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dPirogen_tanggal" value="<?php echo $row['dPirogen_tanggal'] ?>" class="dPirogen_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Pirogen -->




				<!-- lain -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Potensi<B>
							<br>
							<textarea type="text" name="vPotensi_object" value="<?php echo $row['vPotensi_object'] ?>" class="vPotensi_object required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPotensi_object']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vPotensi" value="<?php echo $row['vPotensi'] ?>" class="vPotensi required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPotensi']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vPotensi_metoda" value="<?php echo $row['vPotensi_metoda'] ?>" class="vPotensi_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPotensi_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vPotensi_mutu" value="<?php echo $row['vPotensi_mutu'] ?>" class="vPotensi_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPotensi_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dPotensi_tanggal" value="<?php echo $row['dPotensi_tanggal'] ?>" class="dPotensi_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- lain -->

		<?php
				}
			}
			else {
			//$i++;
		?>
				<!-- fisik -->
					
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num"><b>Warna<b></span>
						</td>		
						<td  style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vWarna" value="" class="vWarna required" style="width: 95%; text-align: left;"></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vWarna_metoda" value="" class="vWarna_metoda required" style="width: 95%; text-align: left;"></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vWarna_mutu" value="" class="vWarna_mutu required" style="width: 95%; text-align: left;"></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dWarna_tanggal" value="" class="dWarna_tanggal tanggal" style="width: 90%" />
						</td>
						<!-- <td style="border: 1px solid #dddddd; width: 10%">
							<span class="delete_btn"><a href="javascript:;" class="sample_permintaan_sample_del" onclick="del_row(this, 'sample_permintaan_sample_del')">[Delete]</a></span>
						</td>		 -->
					</tr>

					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num"><b>Partikel Asing<b></span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vAsing" value="" class="vAsing required" style="width: 95%; text-align: left;"></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vAsing_metoda" value="" class="vAsing_metoda required" style="width: 95%; text-align: left;"></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vAsing_mutu" value="" class="vAsing_mutu required" style="width: 95%; text-align: left;"></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dAsing_tanggal" value="" class="dAsing_tanggal tanggal" style="width: 90%" />
						</td>
					</tr>

					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num"><b>Kelarutan<b></span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vKelarutan" value="" class="vKelarutan required" style="width: 95%; text-align: left;"></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vKelarutan_metoda" value="" class="vKelarutan_metoda required" style="width: 95%; text-align: left;"></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vKelarutan_mutu" value="" class="vKelarutan_mutu required" style="width: 95%; text-align: left;"></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dKelarutan_tanggal" value="" class="dKelarutan_tanggal tanggal" style="width: 90%" />
						</td>
					</tr>
				<!-- fisik -->

			<!-- kevakuman -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Keseragaman Bobot</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSeragam" value="" class="vSeragam required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSeragam_metoda" value="" class="vSeragam_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSeragam_mutu" value="" class="vSeragam_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSeragam_tanggal" value="" class="dSeragam_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- kevakuman -->

			<!-- Ph -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>pH<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vPh" value="" class="vPh required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPh_metoda" value="" class="vPh_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPh_mutu" value="" class="vPh_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dPh_tanggal" value="" class="dPh_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Ph -->

			<!-- Identitas -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Identitas</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vIdentitas" value="" class="vIdentitas required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vIdentitas_metoda" value="" class="vIdentitas_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vIdentitas_mutu" value="" class="vIdentitas_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dIdentitas_tanggal" value="" class="dIdentitas_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Identitas -->

			<!-- Steril37 -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Sterilitas 37 &deg;<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSteril37" value="" class="vSteril37 required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril37_metoda" value="" class="vSteril37_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril37_mutu" value="" class="vSteril37_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSteril37_tanggal" value="" class="dSteril37_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Steril37 -->

			<!-- Steril22 -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Sterilitas 22 &deg;<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSteril22" value="" class="vSteril22 required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril22_metoda" value="" class="vSteril22_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril22_mutu" value="" class="vSteril22_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSteril22_tanggal" value="" class="dSteril22_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Steril22 -->

			<!-- Kontaminasi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Uji Kontaminasi<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vKontaminasi" value="" class="vKontaminasi required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKontaminasi_metoda" value="" class="vKontaminasi_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKontaminasi_mutu" value="" class="vKontaminasi_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dKontaminasi_tanggal" value="" class="dKontaminasi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Kontaminasi -->

			<!-- Coli -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>E. Coli<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vColi" value="" class="vColi required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vColi_metoda" value="" class="vColi_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vColi_mutu" value="" class="vColi_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dColi_tanggal" value="" class="dColi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Coli -->

			<!-- Salmon -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Salmonella<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vSalmon" value="" class="vSalmon required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSalmon_metoda" value="" class="vSalmon_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSalmon_mutu" value="" class="vSalmon_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSalmon_tanggal" value="" class="dSalmon_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Salmon -->

			<!-- kelembapan -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kelembaban</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vLembab" value="" class="vLembab required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLembab_metoda" value="" class="vLembab_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLembab_mutu" value="" class="vLembab_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dLembab_tanggal" value="" class="dLembab_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- kelembapan -->
			<!-- Toksis -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Toksisitas Abnormal<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vToksis" value="" class="vToksis required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vToksis_metoda" value="" class="vToksis_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vToksis_mutu" value="" class="vToksis_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dToksis_tanggal" value="" class="dToksis_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Toksis -->
			
			<!-- Pirogen -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Pirogenitas<B>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vPirogen" value="" class="vPirogen required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPirogen_metoda" value="" class="vPirogen_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPirogen_mutu" value="" class="vPirogen_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dPirogen_tanggal" value="" class="dPirogen_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Pirogen -->




			<!-- lain -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Potensi<b>
						<br>
						<textarea type="text" name="vPotensi_object" value="" class="vPotensi_object required" style="width: 95%; text-align: left;"></textarea>
							
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vPotensi" value="" class="vPotensi required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPotensi_metoda" value="" class="vPotensi_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPotensi_mutu" value="" class="vPotensi_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dPotensi_tanggal" value="" class="dPotensi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- lain -->



		<?php } ?>
	</tbody>
	<!-- <tfoot>
		<tr>
			<td colspan="5"></td><td style="text-align: center"><a href="javascript:;" onclick="javascript:add_row('sample_permintaan_sample')">Tambah</a></td>
		</tr>
	</tfoot> -->
</table>
