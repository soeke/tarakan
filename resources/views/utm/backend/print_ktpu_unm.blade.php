<!DOCTYPE html>
<html>
<head>
	<title>KTPU UTM Numpang {{ $mahasiswa->nim }} / {{ $mahasiswa->nama_mahasiswa }}</title>
	<style type="text/css">
		table {
			/* border-style: double; */
			border-width: 1px;
			border-color: white;
            /* border: 1px solid black; */
            /* border-collapse: collapse; */
		}
		table tr .text2 {
			text-align: right;
			font-size: 12px;
		}
		table tr .text {
			text-align: center;
			font-size: 14px;
		}
		table tr td {
			font-size: 14px;
		}
        table th {
			font-size: 14px;
		}

	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<td>
				<center><img src="{{ asset('img/kop-surat-baru.png') }}" width="750" height="120"></center>
				</td>
			</tr>
			<!-- <tr>
				<td colspan="2"><hr></td>
			</tr> -->
        </table>
      
        <table width="700">
            <h4><center>KARTU TANDA PESERTA NUMPANG UJIAN</center>
            <center>UJIAN TATAP MUKA (UTM)</center></h4>   
            <thead>
                <tr>
                    <!-- <th>#</th>
                    <th>Username</th> -->
                </tr>
            </thead>
            <tbody>
            <tr>
                <td width="15%">Masa</td>
                <td width="1%">:</td>
                <td width="42%">{{ $masa_semester }}</td><td></td><td></td><td></td>
                <td>UPBJJ-UT</td>
                <td>: {{ $mahasiswa->kode_upbjj }} / {{ $mahasiswa->nama_upbjj }}</td>
            </tr>
            <tr>
                <td>NIM / Nama</td>
                <td>:</td>
                <td> {{ $mahasiswa->nim }} / {{ $mahasiswa->nama_mahasiswa }}</td><td></td><td></td><td></td>
                <td>Program Studi</td>
                <td>: {{ $mahasiswa->kode_program_studi }} / {{ $mahasiswa->nama_program_studi }}</td>
            </tr>
            <tr></tr><tr></tr>
            <tr>
                <td>TEMPAT UJIAN</td>
                <td>:</td>
                <td>{{ $mahasiswa->tempat_ujian->id }} / {{ $mahasiswa->tempat_ujian->nama_tempat_ujian }}</td>
            </tr>
            </tbody>
        </table>
        <br>

        <table width="700" width="100%" border="1" cellpadding="3" cellspacing="0" >
            <thead>
                <tr>
                    <th width="25%" rowspan="2" colspan="2" style="vertical-align : middle;text-align:center;"><center>WAKTU UJIAN</center></th>
                    <th ><center>HARI PERTAMA</center></th>
                    <th><center>HARI KEDUA</center></th>
                </tr>
                <tr>
                    <th>{{$jadwal_utm->h1}}</th>
                    <th>{{$jadwal_utm->h2}}</th>
                </tr>
                <tr>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">JAM</th>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">PUKUL</th>
                    <th>Lokasi Ujian : {{ $mahasiswa->lokasi_ujian->nama_lokasi_ujian ?? ""}}</th>
                    <th>Lokasi Ujian : {{ $mahasiswa->lokasi_ujian->nama_lokasi_ujian ?? ""}}</th>
                </tr>
                    <tr>
                    <th>Ruang : {{ $mahasiswa->ruang_ujian ?? "-"}}</th>
                    <th>Ruang : {{ $mahasiswa->ruang_ujian ?? "-"?? "-"}}</th>
                </tr>
            </thead>
            
                <tr>
                    <td style="text-align:center;" width="6%">KE-1</td>
                    <td style="text-align:center;">07:00-08:30 WIB</td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_11))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_11}} / {{ $mahasiswa->nama_mtk_11 }}
                        @endif
                    </td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_21))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_21}} / {{ $mahasiswa->nama_mtk_21 }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">KE-2</td>
                    <td style="text-align:center;">08:45-10:15 WIB</td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_12))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_12}} / {{ $mahasiswa->nama_mtk_12 }}
                        @endif
                    </td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_22))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_22}} / {{ $mahasiswa->nama_mtk_22 }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">KE-3</td>
                    <td style="text-align:center;">10:30-12:00 WIB</td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_13))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_13}} / {{ $mahasiswa->nama_mtk_13 }}
                        @endif
                    </td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_23))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_23}} / {{ $mahasiswa->nama_mtk_23 }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">KE-4</td>
                    <td style="text-align:center;">12:45-14:15 WIB</td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_14))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_14}} / {{ $mahasiswa->nama_mtk_14 }}
                        @endif
                    </td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_24))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_24}} / {{ $mahasiswa->nama_mtk_24 }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">KE-5</td>
                    <td style="text-align:center;">14:30-16:00 WIB</td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_15))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_15}} / {{ $mahasiswa->nama_mtk_15 }}
                        @endif
                    </td>
                    <td>
                        @if(empty($mahasiswa->kode_mtk_25))
                        -
                        @else
                            {{$mahasiswa->kode_mtk_25}} / {{ $mahasiswa->nama_mtk_25 }}
                        @endif
                    </td>
                </tr>
            <tbody>

            </tbody>
        </table>

        <br>

		<table width="700">
			<tr>
		       <td>
			       <font size="2">
                   <strong>*Ketentuan :</strong>
                   <ol>
                    <li><strong> Hubungi UT Daerah tujuan untuk mengetahui lokasi Numpang Ujian Tatap Muka</strong></li>
                    <li>LOKASI UJIAN harus telah diketahui sehari sebelum hari ujian.</li>
                    <li>KTPU ini harus dibawa bersama Kartu Mahasiswa pada waktu ujian.</li>
                    <li>Terlambat lebih dari 30 menit tidak dibenarkan mengikuti ujian.</li>
                    <li>Mahasiswa yang telah menyelesaikan ujian sebelum waktunya, dapat dibenarkan meninggalkan ruang ujian setelah 45 menit jam ujian yang bersangkutan berlangsung.</li>
                    <li>Pada saat ujian tidak dibenarkan menggunakan alat komunikasi dalam bentuk apapun.</li>
                    <li>Apabila kedapatan menggunakan alat komunikasi pada saat ujian, akan dikenakan sanksi akademik berupa pemberian nilai E pada <strong>SEMUA</strong> matakuliah di semester tersebut.</li>
                   </ol>
                   </font>
		       </td>
		    </tr>
		</table>
		<br><br><br><br><br><br><br><br><br><br><br><br>

        <script language="JavaScript">
            var tanggallengkap = new String();
            var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
            namahari = namahari.split(" ");
            var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
            namabulan = namabulan.split(" ");
            var tgl = new Date();
            var hari = tgl.getDay();
            var tanggal = tgl.getDate();
            var bulan = tgl.getMonth();
            var tahun = tgl.getFullYear();
            tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
        </script>

		<table width="700" cellpadding="0">
			<tr>
                <td>Tanggal Cetak : <span id='jam' ></span> <script language='JavaScript'>document.write(tanggallengkap);</script></td>
				<td width="50%" class="text2">{{ $mahasiswa->nim }} / {{ $mahasiswa->nama_mahasiswa }}</td>
			</tr>
            <tr>
				<td colspan="2"><hr></td>
			</tr>
            <tr>
                <td width="60%">Universitas Terbuka Bogor | Jl. Sholeh Iskandar No 234 Kota Bogor | https://bogor.ut.ac.id </td>
				<td class="text2">Halaman 1 dari 1</td>
			</tr>
		</table>
                   
    </center>
</body>
</html>

<script type="text/javascript">window.print();</script>