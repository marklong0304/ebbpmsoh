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
						<td rowspan="4"><b>Fisik</b></td>
					</tr>
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num">Warna</span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vWarna'] ?>" name="vWarna" value="" class="vWarna " style="width: 95%; text-align: left;"><?php echo nl2br($row['vWarna']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vWarna_metoda'] ?>" name="vWarna_metoda" value="" class="vWarna_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vWarna_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vWarna_mutu'] ?>" name="vWarna_mutu" value="" class="vWarna_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vWarna_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dWarna_tanggal'] ?>" name="dWarna_tanggal" value="" class="dWarna_tanggal tanggal" style="width: 90%" />
						</td>

					</tr>

					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num">Partikel Asing</span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vAsing'] ?>" name="vAsing" value="" class="vAsing " style="width: 95%; text-align: left;"><?php echo nl2br($row['vAsing']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vAsing_metoda'] ?>" name="vAsing_metoda" value="" class="vAsing_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vAsing_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vAsing_mutu'] ?>" name="vAsing_mutu" value="" class="vAsing_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vAsing_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dAsing_tanggal'] ?>" name="dAsing_tanggal" value="" class="dAsing_tanggal tanggal" style="width: 90%" />
						</td>
					</tr>

					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<span class="sample_permintaan_sample_num">Homogenitas</span>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vHomogen'] ?>" name="vHomogen" value="" class="vHomogen " style="width: 95%; text-align: left;"><?php echo nl2br($row['vHomogen']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vHomogen_metoda'] ?>" name="vHomogen_metoda" value="" class="vHomogen_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vHomogen_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vHomogen_mutu'] ?>" name="vHomogen_mutu" value="" class="vHomogen_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vHomogen_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dHomogen_tanggal'] ?>" name="dHomogen_tanggal" value="" class="dHomogen_tanggal tanggal" style="width: 90%" />
						</td>
					</tr>
				<!-- fisik -->


				<!-- kevakuman -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Kevakuman</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vVakum'] ?>" name="vVakum" class="vVakum " style="width: 95%; text-align: left;"><?php echo nl2br($row['vVakum']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vVakum_metoda'] ?>" name="vVakum_metoda"class="vVakum_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vVakum_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vVakum_mutu'] ?>" name="vVakum_mutu"  class="vVakum_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vVakum_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dVakum_tanggal'] ?>" name="dVakum_tanggal"  class="dVakum_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- kevakuman -->

				<!-- kelembapan -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Kelembaban</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vLembab'] ?>" name="vLembab" class="vLembab " style="width: 95%; text-align: left;"><?php echo nl2br($row['vLembab']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vLembab_metoda'] ?>" name="vLembab_metoda" value="" class="vLembab_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vLembab_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vLembab_mutu'] ?>" name="vLembab_mutu" value="" class="vLembab_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vLembab_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dLembab_tanggal'] ?>" name="dLembab_tanggal" value="" class="dLembab_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- kelembapan -->

				<!-- kemurnian -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Kemurnian</b>
						</td>
						
						<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<table style="width: 100%; text-align: left;">
								<tr>
									<td style="width: 30%; text-align: left;">P. Apus</td>
									<td>:
										<textarea type="text" value="<?php echo $row['vMurni_apus'] ?>" name="vMurni_apus"  class="vMurni " style="width: 85%; text-align: left;"><?php echo nl2br($row['vMurni_apus']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td style="width: 30%; text-align: left;">37 &deg C</td>
									<td>:
										<textarea type="text" value="<?php echo $row['vMurni_37'] ?>" name="vMurni_37"  class="vMurni " style="width: 85%; text-align: left;"><?php echo nl2br($row['vMurni_37']) ?></textarea>
									</td>
								</tr>
							</table>
						</td>
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vMurni_metoda" value="<?php echo $row['vMurni_metoda'] ?>" class="vMurni_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vMurni_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vMurni_mutu"value="<?php echo $row['vMurni_mutu'] ?>" class="vMurni_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vMurni_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dMurni_tanggal" value="<?php echo $row['dMurni_tanggal'] ?>" class="dMurni_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- Kemurnian -->

				<!-- Steril -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Sterilitas</b>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<table style="width: 95%; text-align: left;">
								<tr>
									<td style="width: 30%; text-align: left;">37 &deg C</td>
									<td>:
										<textarea type="text" name="vSteril_37" value="<?php echo $row['vSteril_37'] ?>" class="vSteril " style="width: 85%; text-align: left;"><?php echo nl2br($row['vSteril_37']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>22 &deg C</td>
									<td>:
										<textarea type="text" name="vSteril_22" value="<?php echo $row['vSteril_22'] ?>" class="vSteril " style="width: 85%; text-align: left;"><?php echo nl2br($row['vSteril_22']) ?></textarea>
									</td>
								</tr>
							</table>
						</td>
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vSteril_metoda" value="<?php echo $row['vSteril_metoda'] ?>" class="vSteril_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vSteril_mutu" value="<?php echo $row['vSteril_mutu'] ?>" class="vSteril_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vSteril_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dSteril_tanggal" value="<?php echo $row['dSteril_tanggal'] ?>" class="dSteril_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- Steril -->


				<!-- disolasi -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Disolasi</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vDisolasi" value="<?php echo $row['vDisolasi'] ?>" class="vDisolasi " style="width: 95%; text-align: left;"><?php echo nl2br($row['vDisolasi']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vDisolasi_metoda" value="<?php echo $row['vDisolasi_metoda'] ?>" class="vDisolasi_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vDisolasi_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vDisolasi_mutu" value="<?php echo $row['vDisolasi_mutu'] ?>" class="vDisolasi_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vDisolasi_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dDisolasi_tanggal" value="<?php echo $row['dDisolasi_tanggal'] ?>" class="dDisolasi_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- disolasi -->

				<!-- kontaminasi -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Kontaminasi <br> Mikroorganisme hidup</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
							<table>
								<tr>
									<td>Mycoplasma</td>
									<td>:
										<textarea type="text" name="vKontaminasi_mico" value="<?php echo $row['vKontaminasi_mico'] ?>" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vKontaminasi_mico']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Salmonella</td>
									<td>:
										<textarea type="text" name="vKontaminasi_salmon" value="<?php echo $row['vKontaminasi_salmon'] ?>" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vKontaminasi_salmon']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Jamur</td>
									<td>:
										<textarea type="text" name="vKontaminasi_jamur" value="<?php echo $row['vKontaminasi_jamur'] ?>" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vKontaminasi_jamur']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>E. Coli</td>
									<td>:
										<textarea type="text" name="vKontaminasi_coli" value="<?php echo $row['vKontaminasi_coli'] ?>" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vKontaminasi_coli']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Microorg. Hidup lain</td>
									<td>:
										<textarea type="text" name="vKontaminasi_lain" value="<?php echo $row['vKontaminasi_lain'] ?>" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vKontaminasi_lain']) ?></textarea>
									</td>
								</tr>
							</table>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vKontaminasi_metoda" value="<?php echo $row['vKontaminasi_metoda'] ?>" class="vKontaminasi_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vKontaminasi_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vKontaminasi_mutu" value="<?php echo $row['vKontaminasi_mutu'] ?>" class="vKontaminasi_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vKontaminasi_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dKontaminasi_tanggal" value="<?php echo $row['dKontaminasi_tanggal'] ?>" class="dKontaminasi_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- kontaminasi -->

				<!-- lain -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Lain-lain</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vLain" value="<?php echo $row['vLain'] ?>" class="vLain " style="width: 95%; text-align: left;"><?php echo nl2br($row['vLain']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vLain_metoda" value="<?php echo $row['vLain_metoda'] ?>" class="vLain_metoda " style="width: 95%; text-align: left;"><?php echo nl2br($row['vLain_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vLain_mutu" value="<?php echo $row['vLain_mutu'] ?>" class="vLain_mutu " style="width: 95%; text-align: left;"><?php echo nl2br($row['vLain_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dLain_tanggal" value="<?php echo $row['dLain_tanggal'] ?>" class="dLain_tanggal tanggal" style="width: 90%" />
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
					<td rowspan="4"><b>Fisik</b></td>
				</tr>
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<span class="sample_permintaan_sample_num">Warna</span>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vWarna" value="" class="vWarna " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vWarna_metoda" value="" class="vWarna_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vWarna_mutu" value="" class="vWarna_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dWarna_tanggal" value="" class="dWarna_tanggal tanggal" style="width: 90%" />
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
						<textarea type="text" name="vAsing" value="" class="vAsing " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vAsing_metoda" value="" class="vAsing_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vAsing_mutu" value="" class="vAsing_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dAsing_tanggal" value="" class="dAsing_tanggal tanggal" style="width: 90%" />
					</td>
				</tr>

				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<span class="sample_permintaan_sample_num">Homogenitas</span>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vHomogen" value="" class="vHomogen " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vHomogen_metoda" value="" class="vHomogen_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vHomogen_mutu" value="" class="vHomogen_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dHomogen_tanggal" value="" class="dHomogen_tanggal tanggal" style="width: 90%" />
					</td>
				</tr>
			<!-- fisik -->

			<!-- kevakuman -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kevakuman</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vVakum" value="" class="vVakum " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vVakum_metoda" value="" class="vVakum_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vVakum_mutu" value="" class="vVakum_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dVakum_tanggal" value="" class="dVakum_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- kevakuman -->

			<!-- kelembapan -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kelembaban</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vLembab" value="" class="vLembab " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLembab_metoda" value="" class="vLembab_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLembab_mutu" value="" class="vLembab_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dLembab_tanggal" value="" class="dLembab_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- kelembapan -->

			<!-- kemurnian -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kemurnian</b>
					</td>
					
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<table style="width: 100%; text-align: left;">
							<tr>
								<td style="width: 30%; text-align: left;">P. Apus</td>
								<td>:
									<textarea type="text" name="vMurni_apus" value="" class="vMurni " style="width: 85%; text-align: left;"></textarea>
								</td>
							</tr>
							<tr>
								<td style="width: 30%; text-align: left;">37 &deg C</td>
								<td>:
									<textarea type="text" name="vMurni_37" value="" class="vMurni " style="width: 85%; text-align: left;"></textarea>
								</td>
							</tr>
						</table>
					</td>
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vMurni_metoda" value="" class="vMurni_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vMurni_mutu" value="" class="vMurni_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dMurni_tanggal" value="" class="dMurni_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Kemurnian -->

			<!-- Steril -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Sterilitas</b>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<table style="width: 95%; text-align: left;">
							<tr>
								<td style="width: 30%; text-align: left;">37 &deg C</td>
								<td>:
									<textarea type="text" name="vSteril_37" value="" class="vSteril " style="width: 85%; text-align: left;"></textarea>
								</td>
							</tr>
							<tr>
								<td>22 &deg C</td>
								<td>:
									<textarea type="text" name="vSteril_22" value="" class="vSteril " style="width: 85%; text-align: left;"></textarea>
								</td>
							</tr>
						</table>
					</td>
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril_metoda" value="" class="vSteril_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vSteril_mutu" value="" class="vSteril_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dSteril_tanggal" value="" class="dSteril_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Steril -->


			<!-- disolasi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Disolasi</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vDisolasi" value="" class="vDisolasi " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vDisolasi_metoda" value="" class="vDisolasi_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vDisolasi_mutu" value="" class="vDisolasi_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dDisolasi_tanggal" value="" class="dDisolasi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- disolasi -->

			<!-- kontaminasi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kontaminasi <br> Mikroorganisme hidup</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
						<table>
							<tr>
								<td>Mycoplasma</td>
								<td>:
									<textarea type="text" name="vKontaminasi_mico" value="" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Salmonella</td>
								<td>:
									<textarea type="text" name="vKontaminasi_salmon" value="" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Jamur</td>
								<td>:
									<textarea type="text" name="vKontaminasi_jamur" value="" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>E. Coli</td>
								<td>:
									<textarea type="text" name="vKontaminasi_coli" value="" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Microorg. Hidup lain</td>
								<td>:
									<textarea type="text" name="vKontaminasi_lain" value="" class="vKontaminasi " style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
						</table>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKontaminasi_metoda" value="" class="vKontaminasi_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKontaminasi_mutu" value="" class="vKontaminasi_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dKontaminasi_tanggal" value="" class="dKontaminasi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- kontaminasi -->

			<!-- lain -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Lain-lain</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vLain" value="" class="vLain " style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLain_metoda" value="" class="vLain_metoda " style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLain_mutu" value="" class="vLain_mutu " style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dLain_tanggal" value="" class="dLain_tanggal tanggal" style="width: 90%" />
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
