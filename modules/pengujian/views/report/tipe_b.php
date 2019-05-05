<!-- table pengujian -->
  <style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{font-family:Arial, sans-serif;font-size:10.5px;/*padding:10.5 5px;*/border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
  .tg th{font-family:Arial, sans-serif;font-size:10.5px;font-weight:normal;/*padding:10.5 5px*/;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
  .tg .tg-baqh{text-align:center;vertical-align:top}
  .tg .tg-0lax{text-align:left;vertical-align:top}
  .tg .tg-8zwo{font-style:italic;text-align:left;vertical-align:top}
  </style>
  <table class="tg" style="width: 100%;">
    <tr>
      <th style="width: 40%;"class="tg-baqh" colspan="2">Jenis Uji <br><span style="font-style:italic">Kind of Test</span></th>
      <th style="width: 10%;" class="tg-baqh">Tanggal Uji <br><span style="font-style:italic">Date of Test</span></th>
      <th style="width: 15%;"class="tg-baqh">Acuan Metoda<br><span style="font-style:italic">Method Reference</span></th>
      <th style="width: 20%;"class="tg-baqh">Hasil<br><span style="font-style:italic">Result</span></th>
      <th style="width: 15%;"class="tg-baqh">Persyaratan Mutu<br><span style="font-style:italic">Requirement</span></th>
    </tr>
    <tr>
      <td class="tg-0lax" rowspan="4">Fisik <br><span style="font-style:italic">Property</span></td>
      <td class="tg-0lax">Warna<br><span style="font-style:italic">Colour</span></td>
      <td class="tg-0lax"><?php echo $item[0]->WARNA1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->WARNA2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->WARNA3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->WARNA4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax">Bau<br><span style="font-style:italic">Odor</span><br></td>
      <td class="tg-0lax"><?php echo $item[0]->BAU1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->BAU2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->BAU3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->BAU4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax">Partikel Asing<br><span style="font-style:italic">Foreign Particles</span><br></td>
      <td class="tg-0lax"><?php echo $item[0]->PARTIKEL_ASING1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->PARTIKEL_ASING2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->PARTIKEL_ASING3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->PARTIKEL_ASING4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax">Homogenitas<br><span style="font-style:italic">Homogenity</span><br></td>
      <td class="tg-0lax"><?php echo $item[0]->HOMOGENITAS1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->HOMOGENITAS2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->HOMOGENITAS3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->HOMOGENITAS4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Kevakuman<br>Acidity Alkalinity</td>
      <td class="tg-0lax"><?php echo $item[0]->KEVAKUMAN1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEVAKUMAN2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEVAKUMAN3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEVAKUMAN4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Kelembaban<br><span style="font-style:italic">Moisture</span></td>
      <td class="tg-0lax"><?php echo $item[0]->KELEMBABAN1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KELEMBABAN2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KELEMBABAN3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KELEMBABAN4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Kemurnian<br><span style="font-style:italic">Purity</span><br></td>
      <td class="tg-0lax"><?php echo $item[0]->KEMURNIAN1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEMURNIAN2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEMURNIAN3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEMURNIAN4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Sterilitas<br><span style="font-style:italic">Sterility</span></td>
      <td class="tg-0lax"><?php echo $item[0]->STERIL1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->STERIL2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->STERIL3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->STERIL4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" rowspan="5">Kontaminasi<br><span style="font-style:italic">Contamination</span><br></td>
      <td class="tg-8zwo">Mycoplasma</td>
      <td class="tg-0lax"><?php echo $item[0]->MYCROPLASMA1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->MYCROPLASMA2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->MYCROPLASMA3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->MYCROPLASMA4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax"><span style="font-style:italic">Salmonella</span><br></td>
      <td class="tg-0lax"><?php echo $item[0]->SALMONELLA1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->SALMONELLA2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->SALMONELLA3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->SALMONELLA4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax"><span style="font-style:italic">Echerichia Coli</span></td>
      <td class="tg-0lax"><?php echo $item[0]->COLI1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->COLI2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->COLI3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->COLI4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax">Jamur / <span style="font-style:italic">Fungi</span></td>
      <td class="tg-0lax"><?php echo $item[0]->JAMUR1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->JAMUR2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->JAMUR3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->JAMUR4; ?></td>
    </tr>
    <tr>
      <td class="tg-0lax">Mikroorganisme Hidup Lain / <br><span style="font-style:italic">Other Live Microorganism</span><br></td>
      <td class="tg-0lax"><?php echo $item[0]->ORGANISME1; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->ORGANISME2; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->ORGANISME3; ?></td>
      <td class="tg-0lax"><?php echo $item[0]->ORGANISME4; ?></td>
    </tr>
    
    <tr>
      <td class="tg-0lax" colspan="2">Kandungan Bakteri / Spora<br><span style="font-style:italic">Bacteria or Spore Count</span></td>
      <td class="tg-0lax"><?php echo $item[0]->BAKTERI1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->BAKTERI2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->BAKTERI3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->BAKTERI4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Kandungan Virus<br><span style="font-style:italic">Virus Content</span></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Identitas<br><span style="font-style:italic">Identity</span></td>
      <td class="tg-0lax"><?php echo $item[0]->IDENTITAS1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->IDENTITAS2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->IDENTITAS3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->IDENTITAS4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Inaktifasi<br><span style="font-style:italic">Inactivation</span></td>
      <td class="tg-0lax"><?php echo $item[0]->INAKTIF1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->INAKTIF2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->INAKTIF3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->INAKTIF4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Toksisitas Abnormal<br><span style="font-style:italic">Abnormal Toxicity</span></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->TOXIC4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Keamanan<br><span style="font-style:italic">Safety</span></td>
      <td class="tg-0lax"><?php echo $item[0]->KEAMANAN1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEAMANAN2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEAMANAN3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->KEAMANAN4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Potensi<br><span style="font-style:italic">Potency</span></td>
      <td class="tg-0lax"><?php echo $item[0]->POTENSI1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->POTENSI2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->POTENSI3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->POTENSI4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" colspan="2">Lain - Lain<br><span style="font-style:italic">Others</span></td>
      <td class="tg-0lax"><?php echo $item[0]->LAIN1 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->LAIN2 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->LAIN3 ?></td>
      <td class="tg-0lax"><?php echo $item[0]->LAIN4 ?></td>
    </tr>
    <tr>
      <td class="tg-0lax" >Penilaian<br><span style="font-style:italic">Judgement</span></td>
      <td class="tg-0lax" colspan="5"><?php echo $item[0]->PENILAIAN ?></td>
    </tr>
  </table>  
<!-- tabel pengujian -->  