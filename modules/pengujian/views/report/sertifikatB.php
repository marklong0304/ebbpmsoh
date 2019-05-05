<?php 
//print_r($item)    ;
    
 ?>
<style type="text/css">
    .infokiri{
        width: 2%;
    }
    .infokanan{
        width: 2%;
    }
    #form_serti{
        margin-left: 1%;
        margin-right: 1%;
    }
    #header{
        font-weight: bold;
    }

    .tengah{
        text-align: center;
    }
    .en{
        font-style: italic;
    }
body {
    font-size: 13.5px; /* or 62.5% or whatever you like, it doesn't matter, it's just a browser fix, however "rem" units will be based on that value, so make it confortable for calculations */
}

</style>
<body>
<table >
    <tr class="halaman1">
        <td class="infokiri">
        </td>
        <td class="isian">
            <div id="form_serti">
                    <div id=atas"">
                    	<table class="ttd_qr" width="100%">
                            <tr>
                                <td width="50%" class="qrcode" style="text-align: left;">
									SNI ISO 9001 : 2008 ( ISO 9001 : 2008 )
                                </td>
                                <td width="50%" class="ttd" style="text-align: right;">
                        			<span id="nomor1" style="float:right;margin-left: 70%;"><b>No. B-<?php echo $item[0]->NOMOR1; ?></b></span>
                                </td>
                            </tr>
                        </table>

                        <span id="iso" style="float:left;align:left;">
                            
                        </span>
                        
                    </div>
                         <br>
                    <div id="header" class="tengah" style="font-size: 12px;">
                         KEMENTERIAN PERTANIAN
                         <br>
                         DIREKTORAT JENDERAL PETERNAKAN DAN KESEHATAN HEWAN
                         <br>
                         <span style="font-size: 13.5px;" >BALAI BESAR PENGUJIAN MUTU DAN SERTIFIKASI OBAT HEWAN</span>
                         <br>
                         <span style="font-size: 13.5px;" >BOGOR - INDONESIA</span>
                    </div>
                    <div id="header_en" class="tengah" style="font-size: 12px;">
                        <div class="en">
                            MINISTRY OF AGRICULTURE
                            <br>
                            DIRECTORATE GENERAL OF LIVESTOCK AND ANIMAL HEALTH SERVICES
                            <br>
                            <span style="font-size: 13.5px;" >NATIONAL VETERINARY DRUG ASSAY LABORATORY</span>
                            <br>
                            <span  style="font-size: 13.5px;">BOGOR - INDONESIA</span>
                        </div>
                    </div>
                    <div class="tengah">
                        <span style="font-size: 21px;text-decoration: underline;font-weight: bold;">SERTIFIKAT PENGUJIAN</span>
                        <br>
                        <span class="en" >CERTIFICATE OF ANALISYS</span>
                    </div>
                     
                    <div class="tengah">
                        <span class="" ><b>Nomor : <?php echo $item[0]->NOMOR2; ?></b></span>
                    </div>
                    <div class="tengah">
                        <p style="text-align: justify;">
                            Berdasarkan Surat Keputusan Menteri Pertanian Nomor : <?php echo $item[0]->NOMOR3; ?>, Tanggal <?php echo $item[0]->TANGGAL1; ?> dan Keputusan Menteri Pertanian Nomor : <?php echo $item[0]->NOMOR4; ?> Tanggal <?php echo $item[0]->TANGGAL2; ?>, telah dilakukan pengujian mutu terhadap obat hewan tersebut di bawah ini dan hasil uji telah lulus memenuhi standar persyaratan mutu.
                            According to Decree of The Minister of Agriculture of The Republic of Indonesia dated <?php echo $item[0]->TANGGAL3; ?>, No : <?php echo $item[0]->NOMOR5; ?>, and Undersigned of The Minister of Agriculture of Republic of Indonesia dated <?php echo $item[0]->NOMOR4; ?>, No : <?php echo $item[0]->NOMOR6; ?>, certifies that quality control of the following veterinary drug has been carried out and met test requirements.
                        </p>    
                    </div>
                    <div>
                        <table width="100%" style="font-size: 10.5px;">
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        Nama Laboratorium Penguji                    
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Name of Assay Laboratory</span>
                                    </td>
                                    <td width="60%">: BBPMSOH</td>
                                </tr>    
                                <tr>
                                    <td>
                                        Alamat Laboratorium
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Address of Assay Laboratory</span>
                                    </td>
                                    <td>: Jl Raya Pembangunan Gunung Sindur, Gn. Sindur, Bogor, Jawa Barat 16340</td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Pemohon
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Name of Applicant</span>
                                    </td>
                                    <td>: <?php echo $item[0]->NAMA_PEMOHON; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Alamat Pemohon
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Address of Applicant</span>
                                    </td>
                                    <td>: <?php echo $item[0]->ALAMAT_PEMOHON; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Produsen
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Name of Produces</span>
                                    </td>
                                    <td>: <?php echo $item[0]->NAMA_PRODUSEN; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Dagang Obat Hewan
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Trade Name</span>
                                    </td>
                                    <td>: <?php echo $item[0]->NAMA_DAGANG; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Nomor Bets
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Batch No. / Lot</span>
                                    </td>
                                    <td>: <?php echo $item[0]->NOMOR_TRADING; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Waktu Kadaluarsa
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Expired Date</span>
                                    </td>
                                    <td>: <?php echo $item[0]->KADALUARSA; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Nomor Registrasi
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Registration No.</span>
                                    </td>
                                    <td>: <?php echo $item[0]->NOREG; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Kemasan
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Packaging</span>
                                    </td>
                                    <td>: <?php echo $item[0]->KEMASAN; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Jenis Produk
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Nama</span>
                                    </td>
                                    <td>: <?php echo $item[0]->JENIS; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal Penerimaan Contoh
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Date of Sample Acceptance</span>
                                    </td>
                                    <td>: <?php echo $item[0]->TANGGAL_TERIMA_CONTOH; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Acuan Prosedur Pengambilan Contoh
                                        <br>
                                        <span class="en" style="font-size: 9.5px;">Sampling Procedure Referece</span>
                                    </td>
                                    <td>: <?php echo $item[0]->ACUAN; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Nomor Uji
                                        <br>
                                        <span class="en " style="font-size: 9.5px;">Assay No.</span>
                                    </td>
                                    <td>: <?php echo $item[0]->NOMOR_UJI; ?></td>
                                </tr>
                           </tbody>
                        </table>
                        <table class="ttd_qr" width="100%">
                            <tr>
                                <td width="50%" class="qrcode" style="text-align: center;">
									<?php 
										echo '<img src="'.base_url().'/files/pengujian/qrcode/'.$id.'.png" width="72" height="72" />';
									?>
                                </td>
                                <td width="50%" class="ttd" style="text-align: center;">
                                    Bogor, <?php echo $item[0]->TANGGAL_NOW; ?>
                                    <br>
                                    Kepala Balai Besar Pengajuan Mutu dan <br> Sertifikasi Obat Hewan 
                                    <br>
                                    <span class="en">Director of National Veterinary Drug Assay Laboratory</span>
                                    <br>
                                    <br>
                                    <br>
                                    <br>

                                    <span style="text-decoration:underline;"><?php echo $item[0]->KABALAI_NAMA; ?></span>
                                    <br>
                                    <?php echo $item[0]->KABALAI_NIP; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="tengah">
                        <span style="font-size:10.5px;">Sertifikat ini berlaku selama satu kali periode pendaftaran dan hanya untuk bets sampel yang diuji</span>
                        <br>
                        <span class="en" style="font-size:9.5px;">
                            This certificate is valid only for one period of registration and the batch of tested sample 
                        </span>
                    </div>
            </div>

        </td>
        <td class="infokanan">
            
        </td>
    </tr>

    <tr  class="halaman2">
    	<td></td>
        <table width="70%" style="margin-top: 1%;font-size:8.5px;">
            <tr>
                <td>Lampiran</td>
                <td>: SERTIFIKAT PENGUJIAN</td>

                <td>NO</td>
                <td>: <?php echo $item[0]->NOMOR1; ?></td>

            </tr>
            <tr>
                <td>Annex</td>
                <td>:<span class="en"> CERTIFICATE OF ANALYSIS</span></td>
                <td></td>
                <td></td>
            </tr>
            
        </table>    
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td>
        <?php 
            if($dMt06['iDist_bakteri']== 1 and $dMt06['iDist_farmastetik'] ==1){
                    // farmastetik
                    $templatenya = 'sertifikatF.docx';
                }else if($dMt06['iDist_bakteri']== 1 and $dMt06['iDist_virologi'] ==1){
                    // biologik
                    $templatenya = 'sertifikatB.docx';
                }else if($dMt06['iDist_bakteri']== 1){
                    // biologik
                    $templatenya = 'sertifikatB.docx';
                }else if($dMt06['iDist_virologi']== 1){
                    // biologik
                    $templatenya = 'sertifikatB.docx';
                }else{
                    //$dMt06['iDist_farmastetik'] ==1;
                    $templatenya = 'sertifikatF.docx';
                }

                if($templatenya== 'sertifikatB.docx'){
                ?>
                    <div class="tengah" style="font-weight: bold; margin-top: 2%;">
                        HASIL PENGUJIAN PRODUK BIOLOGIK
                        <br>
                        <span class="en">
                            RESULT OF ASSAY FOR BIOLOGICAL PRODUCT
                        </span>
                    </div>
                <?php 
                
                }else{
                ?>
                    <div class="tengah" style="font-weight: bold; margin-top: 2%;">
                        HASIL PENGUJIAN PRODUK FARMASETIK DAN PREMIKS
                        <br>
                        <span class="en">
                            RESULT OF ASSAY FOR PHARMACEUTICAL AND PREMIX PRODUCT
                        </span>
                    </div>

                <?php 
                
                }
         ?>

        </td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td>
            <?php 
                $data['item'] = $item;
                if($dMt06['iDist_bakteri']== 1 and $dMt06['iDist_farmastetik'] ==1){
                    // farmastetik
                    $templatenya = 'sertifikatF.docx';
                }else if($dMt06['iDist_bakteri']== 1 and $dMt06['iDist_virologi'] ==1){
                    // biologik
                    $templatenya = 'sertifikatB.docx';
                }else if($dMt06['iDist_bakteri']== 1){
                    // biologik
                    $templatenya = 'sertifikatB.docx';
                }else if($dMt06['iDist_virologi']== 1){
                    // biologik
                    $templatenya = 'sertifikatB.docx';
                }else{
                    //$dMt06['iDist_farmastetik'] ==1;
                    $templatenya = 'sertifikatF.docx';
                }

                if($templatenya== 'sertifikatB.docx'){
                    echo $this->load->view('report/tipe_b',$data,true);    
                }else{
                    echo $this->load->view('report/tipe_f',$data,true);
                }
                
             ?>
            
        </td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
        <table class="ttd_qr" width="100%" style="margin-top: 3%;">
            <tr>
                <td width="60%" class="qrcode" style="text-align: center;">
                </td>
                <td width="40%" class="ttd" style="text-align: center;">
                    Bogor, <?php echo $item[0]->TANGGAL_NOW; ?>
                    <br>
                    Kepala Balai Besar Pengajuan Mutu dan <br> Sertifikasi Obat Hewan 
                    <br>
                    <span class="en">Director of National Veterinary Drug Assay Laboratory</span>

                    <br>
                    <br>
                    <br>
                    <br>
                    <span style="text-decoration:underline;"><?php echo $item[0]->KABALAI_NAMA; ?></span>
                    <br>
                    <?php echo $item[0]->KABALAI_NIP; ?>
                </td>
            </tr>
        </table>
        <td></td>
    </tr>
</table>
</body>