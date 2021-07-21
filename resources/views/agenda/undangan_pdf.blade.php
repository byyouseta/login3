<!DOCTYPE html>
<html lang="en">
<head>
	<title>Undangan Peserta Rapat</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <table class="table table-borderless" >
        <thead>
            <tr>
                <th class="align-middle"><img src="{{asset('adminlte/dist/img/LogoKemenkes.png')}}" alt="Logo Kemenkes" width="80" height="80"></th>
                <td class="col-10 text-center align-middle" style="line-height: 1.2;">
                    <strong>
                    <div style="font-size: 18px;" >KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</div>
                    <div style="font-size: 16px;">DIREKTORAL JENDERAL PELAYANAN KESEHATAN</div>
                    <div style="font-size: 14px;">RUMAH SAKIT UMUM PUSAT (RSUP) SURAKARTA</div>
                    </strong>
                    <div style="font-size: 10px;">Jalan Prof. Dr. R. Soeharso No. 28 Surakarta 57144 Telp 0271-713055/720002<br>
                    surat elektronik: rsupsurakarta@kemkes.go.id;
                    info.rsupsurakarta@gmail.com
                    </div>
                </td>
                <th class="align-middle"><img src="{{asset('adminlte/dist/img/Logo.png')}}" alt="Logo RSUP" width="80" height="80"></th>
            </tr>
        </thead>
    </table>
	<?php 
		$arrhari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
		$hari = new DateTime($agenda->tanggal);
		//$hari = $arrhari[$tanggal->format('N')];
		$tanggal = new DateTime($agenda->tanggal);
	?>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
        hr.new4 {
            border: 2px solid black;
			margin-left: auto;
 			margin-right: auto;
			margin-top: -1em;
			margin-bottom: 0em;
        }
        
        .koran{
            display: flex;
            /*jumlah column*/
           /* -webkit-column-count: 2;   /*support Chrome, Safari, Opera */
             /* -moz-column-count: 2; support Firefox */ 
            column-count : 2;

            	
        }
        
	</style>
    <style>
        #people{
            display: flex;
            -webkit-column-count: 4; /* Chrome, Safari, Opera */
            -moz-column-count: 4; /* Firefox */
            column-count: 4;
            -webkit-column-gap:.5em;
            -moz-column-gap:.5em;
            column-gap:.5em;
            padding-bottom:2px;
            font-size:18px;
            line-height:21px;
        }

        .keeptogether{
            display:inline-block;
            width:100%;
        }
        </style>
    <hr class='new4'/> 
	@php
        $jmlundangan = $peserta->count();
        $urutan2 = ceil($jmlundangan/2);
        // $index = 1;

        foreach ($peserta as $index => $user) {
            # code...
            $undangan[$index] = $user->name;
        }

        $kanan = $urutan2;
        $nokiri = 1;
        $nokanan =$urutan2 +1;
    @endphp
    
    
	<table class="table table-borderless" >
		<tbody>
            <tr><th colspan='4' class="text-center"><h4>Undangan</h4></th></tr>
            <tr><td colspan='4'>Yth. Bapak Ibu </td></tr>
            
		</tbody>
	</table>
    <table class="table table-borderless">
        @for ($i = 0; $i < $urutan2; $i++)
        <tr><td class="ml-5" style="width: 50%">{{ $nokiri.'. '.$undangan[$i] }}</td>
            @php
                $kanan = $urutan2 + $i; 
                $nokiri++;   
            @endphp
            <td style="width: 50%">{{ $nokanan.'. '.$undangan[$kanan] }}</td>
            @php
                $nokanan++;
            @endphp
        </tr>
        @endfor     
    </table>
    <table class="table table-borderless" >
		<tbody>
            <tr><td colspan='3'>Di RSUP Surakarta</td></tr>
            <tr><td colspan='3'>Mengharap kehadiran Bapak/Ibu/Saudara/i pada :</td></tr>
		
	
			<tr >
				<th class="text-left ml-5" style="width: 20%">Hari,Tanggal</th><th style="width: 5%">:</th>
                <th style="width: 75%">{{$arrhari[$tanggal->format('N')]}}, {{$tanggal->format('d-m-Y')}}</th>
            </tr>
            <tr >
				<th class="text-left ml-5">Waktu</th><th>:</th>
                <th>{{ $agenda->waktu_mulai }} - {{ $agenda->waktu_selesai }}</th>
            </tr>
            <tr>
                <th class="text-left ml-5">Tempat</th><th>:</th>
                <th>{{ $agenda->ruangan->nama }}</th>
            </tr>
            <tr>
                <th class="text-left ml-5">Acara</th><th>:</th>
                <th>{{$agenda->nama_agenda}}</th>
            </tr>
            <tr>
                <th class="text-left ml-5">Keterangan</th><th>:</th>
                <th>{{$agenda->keterangan}}</th>
            </tr>
            <tr><td colspan='3'>Atas kehadirannya diucapkan terima kasih.</td></tr>
			
		</tbody>
    </table>
    <table class="table table-borderless">
        <tbody>
            <tr><td style="width: 65%"></td><td class="text-center" style="width: 35%">Direktur</td></tr>
            <tr><td style="width: 80%"></td><td></td></tr>
            <tr><td style="width: 80%"></td><td></td></tr>
            <tr><td style="width: 65%"></td><th class="text-center" style="width: 35%">dr. JAMILATUN ROSIDAH, MM</th></tr>
            

        </tbody>
		
	</table>
		
</body>
</html>