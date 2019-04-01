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
				<!-- Kandungan -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Kandungan Bakteri / Spora / Virus</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vKandungan'] ?>" name="vKandungan" class="vKandungan required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKandungan']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vKandungan_metoda'] ?>" name="vKandungan_metoda"class="vKandungan_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKandungan_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vKandungan_mutu'] ?>" name="vKandungan_mutu"  class="vKandungan_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vKandungan_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dKandungan_tanggal'] ?>" name="dKandungan_tanggal"  class="dKandungan_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- Kandungan -->

				<!-- patologi -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Keamanan/ Erupsi/ Toksisitas Abnormal</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
							<table>
								<tr>
									<td>Patologi</td>
									<td>:
										<textarea type="text" name="vPatologi" value="<?php echo $row['vPatologi'] ?>" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>Jenis Hwn</td>
									<td>:
										<textarea type="text" name="vPatologi_jenis" value="<?php echo $row['vPatologi_jenis'] ?>" class="vPatologi_jenis required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_jenis']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>Umur</td>
									<td>:
										<textarea type="text" name="vPatologi_umur" value="<?php echo $row['vPatologi_umur'] ?>" class="vPatologi_umur required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_umur']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>BB</td>
									<td>:
										<textarea type="text" name="vPatologi_bb" value="<?php echo $row['vPatologi_bb'] ?>" class="vPatologi_bb required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_bb']) ?></textarea>
									</td>
								</tr>


								<tr>
									<td>Perlakuan</td>
									<td>:
										<textarea type="text" name="vPatologi_perlakuan" value="<?php echo $row['vPatologi_perlakuan'] ?>" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_perlakuan']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Prosentase</td>
									<td>:
										<textarea type="text" name="vPatologi_persen" value="<?php echo $row['vPatologi_persen'] ?>" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_persen']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Kontrol</td>
									<td>:
										<textarea type="text" name="vPatologi_kontrol" value="<?php echo $row['vPatologi_kontrol'] ?>" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_kontrol']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>MDL</td>
									<td>:
										<textarea type="text" name="vPatologi_mdl" value="<?php echo $row['vPatologi_mdl'] ?>" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_mdl']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>CDL</td>
									<td>:
										<textarea type="text" name="vPatologi_cdl" value="<?php echo $row['vPatologi_cdl'] ?>" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPatologi_cdl']) ?></textarea>
									</td>
								</tr>
							</table>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vPatologi_metoda" value="<?php echo $row['vPatologi_metoda'] ?>" class="vPatologi_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPatologi_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vPatologi_mutu" value="<?php echo $row['vPatologi_mutu'] ?>" class="vPatologi_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vPatologi_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dPatologi_tanggal" value="<?php echo $row['dPatologi_tanggal'] ?>" class="dPatologi_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- patologi -->

				<!-- potensi -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Potensi </b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
							<table>
								<tr>
									<td>Potensi</td>
									<td>:
										<textarea type="text" name="vPotensi" value="<?php echo $row['vPotensi'] ?>" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>Jenis Hwn</td>
									<td>:
										<textarea type="text" name="vPotensi_jenis" value="<?php echo $row['vPotensi_jenis'] ?>" class="vPotensi_jenis required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_jenis']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>Umur</td>
									<td>:
										<textarea type="text" name="vPotensi_umur" value="<?php echo $row['vPotensi_umur'] ?>" class="vPotensi_umur required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_umur']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>BB</td>
									<td>:
										<textarea type="text" name="vPotensi_bb" value="<?php echo $row['vPotensi_bb'] ?>" class="vPotensi_bb required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_bb']) ?></textarea>
									</td>
								</tr>


								<tr>
									<td>Perlakuan</td>
									<td>:
										<textarea type="text" name="vPotensi_perlakuan" value="<?php echo $row['vPotensi_perlakuan'] ?>" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_perlakuan']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Prosentase</td>
									<td>:
										<textarea type="text" name="vPotensi_persen" value="<?php echo $row['vPotensi_persen'] ?>" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_persen']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Kontrol</td>
									<td>:
										<textarea type="text" name="vPotensi_kontrol" value="<?php echo $row['vPotensi_kontrol'] ?>" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_kontrol']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>MDL</td>
									<td>:
										<textarea type="text" name="vPotensi_mdl" value="<?php echo $row['vPotensi_mdl'] ?>" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_mdl']) ?></textarea>
									</td>
								</tr>

								<tr>
									<td>CDL</td>
									<td>:
										<textarea type="text" name="vPotensi_cdl" value="<?php echo $row['vPotensi_cdl'] ?>" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vPotensi_cdl']) ?></textarea>
									</td>
								</tr>
							</table>
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
				<!-- potensi -->

				<!-- identitas -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Identitas</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" value="<?php echo $row['vIdentitas'] ?>" name="vIdentitas" class="vIdentitas required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vIdentitas']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vIdentitas_metoda'] ?>" name="vIdentitas_metoda" value="" class="vIdentitas_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vIdentitas_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" value="<?php echo $row['vIdentitas_mutu'] ?>" name="vIdentitas_mutu" value="" class="vIdentitas_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vIdentitas_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" value="<?php echo $row['dIdentitas_tanggal'] ?>" name="dIdentitas_tanggal" value="" class="dIdentitas_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- identitas -->

				<!-- inaktivasi -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Inaktivasi <br> Mikroorganisme hidup</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
							<table>
								<tr>
									<td>Jenis Hwn / telur</td>
									<td>:
										<textarea type="text" name="vInaktivasi_jenis" value="<?php echo $row['vInaktivasi_jenis'] ?>" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vInaktivasi_jenis']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Perlakuan</td>
									<td>:
										<textarea type="text" name="vInaktivasi_perlakuan" value="<?php echo $row['vInaktivasi_perlakuan'] ?>" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vInaktivasi_perlakuan']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Prosentase</td>
									<td>:
										<textarea type="text" name="vInaktivasi_persen" value="<?php echo $row['vInaktivasi_persen'] ?>" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vInaktivasi_persen']) ?></textarea>
									</td>
								</tr>
								<tr>
									<td>Kontrol</td>
									<td>:
										<textarea type="text" name="vInaktivasi_kontrol" value="<?php echo $row['vInaktivasi_kontrol'] ?>" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"><?php echo nl2br($row['vInaktivasi_kontrol']) ?></textarea>
									</td>
								</tr>
							</table>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vInaktivasi_metoda" value="<?php echo $row['vInaktivasi_metoda'] ?>" class="vInaktivasi_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vInaktivasi_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vInaktivasi_mutu" value="<?php echo $row['vInaktivasi_mutu'] ?>" class="vInaktivasi_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vInaktivasi_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dInaktivasi_tanggal" value="<?php echo $row['dInaktivasi_tanggal'] ?>" class="dInaktivasi_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- inaktivasi -->
				
				<!-- Virus -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Kontaminasi Virus Lain</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vVirus" value="<?php echo $row['vVirus'] ?>" class="vVirus required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vVirus']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vVirus_metoda" value="<?php echo $row['vVirus_metoda'] ?>" class="vVirus_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vVirus_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vVirus_mutu" value="<?php echo $row['vVirus_mutu'] ?>" class="vVirus_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vVirus_mutu']) ?></textarea>
						</td>
						<td style="border: 1px solid #dddddd; width: 10%">
							<input type="text" name="dVirus_tanggal" value="<?php echo $row['dVirus_tanggal'] ?>" class="dVirus_tanggal tanggal" style="width: 90%" />
						</td>
						
					</tr>
				<!-- Virus -->

				

				<!-- lain -->
					<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
						<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
							<b>Lain-lain</b>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
							<textarea type="text" name="vLain" value="<?php echo $row['vLain'] ?>" class="vLain required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vLain']) ?></textarea>
						</td>		
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vLain_metoda" value="<?php echo $row['vLain_metoda'] ?>" class="vLain_metoda required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vLain_metoda']) ?></textarea>
						</td>	
						<td style="border: 1px solid #dddddd; width: 25%">
							<textarea type="text" name="vLain_mutu" value="<?php echo $row['vLain_mutu'] ?>" class="vLain_mutu required" style="width: 95%; text-align: left;"><?php echo nl2br($row['vLain_mutu']) ?></textarea>
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
			<!-- Kandungan -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kandungan Bakteri / Spora / Virus</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vKandungan" value="" class="vKandungan required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKandungan_metoda" value="" class="vKandungan_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vKandungan_mutu" value="" class="vKandungan_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dKandungan_tanggal" value="" class="dKandungan_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Kandungan -->

			<!-- patologi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Keamanan/ Erupsi/ Toksisitas Abnormal</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
						<table>
							<tr>
								<td>Patologi</td>
								<td>:
									<textarea type="text" name="vPatologi" value="" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Jenis Hwn</td>
								<td>:
									<textarea type="text" name="vPatologi_jenis" value="" class="vPatologi_jenis required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>Umur</td>
								<td>:
									<textarea type="text" name="vPatologi_bb" value="" class="vPatologi_bb required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>BB</td>
								<td>:
									<textarea type="text" name="vPatologi_umur" value="" class="vPatologi_umur required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>


							<tr>
								<td>Perlakuan</td>
								<td>:
									<textarea type="text" name="vPatologi_perlakuan" value="" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Prosentase</td>
								<td>:
									<textarea type="text" name="vPatologi_persen" value="" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Kontrol</td>
								<td>:
									<textarea type="text" name="vPatologi_kontrol" value="" class="vPatologi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>MDl</td>
								<td>:
									<textarea type="text" name="vPatologi_mdl" value="" class="vPatologi_mdl required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>CDL</td>
								<td>:
									<textarea type="text" name="vPatologi_cdl" value="" class="vPatologi_cdl required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>


						</table>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPatologi_metoda" value="" class="vPatologi_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vPatologi_mutu" value="" class="vPatologi_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dPatologi_tanggal" value="" class="dPatologi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- patologi -->

			<!-- potensi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Potensi </b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
						<table>
							<tr>
								<td>Potensi</td>
								<td>:
									<textarea type="text" name="vPotensi" value="" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Jenis Hwn</td>
								<td>:
									<textarea type="text" name="vPotensi_jenis" value="" class="vPotensi_jenis required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>Umur</td>
								<td>:
									<textarea type="text" name="vPotensi_bb" value="" class="vPotensi_bb required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>BB</td>
								<td>:
									<textarea type="text" name="vPotensi_umur" value="" class="vPotensi_umur required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>


							<tr>
								<td>Perlakuan</td>
								<td>:
									<textarea type="text" name="vPotensi_perlakuan" value="" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Prosentase</td>
								<td>:
									<textarea type="text" name="vPotensi_persen" value="" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Kontrol</td>
								<td>:
									<textarea type="text" name="vPotensi_kontrol" value="" class="vPotensi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>MDl</td>
								<td>:
									<textarea type="text" name="vPotensi_mdl" value="" class="vPotensi_mdl required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>

							<tr>
								<td>CDL</td>
								<td>:
									<textarea type="text" name="vPotensi_cdl" value="" class="vPotensi_cdl required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>


						</table>
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
			<!-- potensi -->

			<!-- identitas -->
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
			<!-- identitas -->

			<!-- inaktivasi -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Inaktivasi </b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: left;">
						<table>
							<tr>
								<td>Jenis Hewan</td>
								<td>:
									<textarea type="text" name="vInaktivasi_jenis" value="" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Perlakuan</td>
								<td>:
									<textarea type="text" name="vInaktivasi_perlakuan" value="" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Prosentase</td>
								<td>:
									<textarea type="text" name="vInaktivasi_persen" value="" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
							<tr>
								<td>Kontrol</td>
								<td>:
									<textarea type="text" name="vInaktivasi_kontrol" value="" class="vInaktivasi required" style="width: 85%; text-align: left;" text-align: left;"/>		
								</td>
							</tr>
						</table>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vInaktivasi_metoda" value="" class="vInaktivasi_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vInaktivasi_mutu" value="" class="vInaktivasi_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dInaktivasi_tanggal" value="" class="dInaktivasi_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- inaktivasi -->

			<!-- Virus -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Kontaminasi Virus Lain</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vVirus" value="" class="vVirus required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vVirus_metoda" value="" class="vVirus_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vVirus_mutu" value="" class="vVirus_mutu required" style="width: 95%; text-align: left;"></textarea>
					</td>
					<td style="border: 1px solid #dddddd; width: 10%">
						<input type="text" name="dVirus_tanggal" value="" class="dVirus_tanggal tanggal" style="width: 90%" />
					</td>
					
				</tr>
			<!-- Virus -->

			



			<!-- lain -->
				<tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
					<td colspan="2" style="border: 1px solid #dddddd; width: 10%; text-align: left;">
						<b>Lain-lain</b>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%; text-align: center;">
						<textarea type="text" name="vLain" value="" class="vLain required" style="width: 95%; text-align: left;"></textarea>
					</td>		
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLain_metoda" value="" class="vLain_metoda required" style="width: 95%; text-align: left;"></textarea>
					</td>	
					<td style="border: 1px solid #dddddd; width: 25%">
						<textarea type="text" name="vLain_mutu" value="" class="vLain_mutu required" style="width: 95%; text-align: left;"></textarea>
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
