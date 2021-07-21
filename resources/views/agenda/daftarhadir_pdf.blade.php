<!DOCTYPE html>
<html>
<head>
	<title>Report Daftar Hadir</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <table class="table table-borderless" >
        <thead>
            <tr>
                <th class="align-middle"><img src="{{asset('adminlte/dist/img/LogoKemenkes.png')}}" alt="Logo Kemenkes" width="80" height="80"></th>
                <th class="col-10 text-center align-middle">
                    <h6>DIREKTORAL JENDERAL PELAYANAN KESEHATAN</h6>
                    <h6>RUMAH SAKIT UMUM PUSAT SURAKARTA</h6>
                    Jl.Prof.Dr.R.Soeharso No.28 Surakarta Telp. Fax. 0271-713055
                    
                </th>
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
	</style>
    <hr class='new4'> 
	
	<table class="table table-borderless" >
		<tbody>
			<tr><th colspan='4' class="text-center"><h3>DAFTAR HADIR</h3></th></tr>
		<tr>
			<th style="width: 10%">Hari</th><td style="width: 40%">{{$arrhari[$tanggal->format('N')]}}</td>
			<th class="text-right" style="width: 25%">Tempat</th><td style="width: 25%">{{$agenda->ruangan->nama}}</td>
		</tr>
		<tr>
			<th >Tanggal</th><td >{{$tanggal->format('d-m-Y')}}</td>
			<th class="text-right">Acara</th><td>{{$agenda->nama_agenda}}</td>
		</tr>
		</tbody>
	</table>

	<table class='table table-bordered'>
		<thead>
			<tr class="text-center">
				<th style="width: 7%">No</th>
				<th>NAMA</th>
				<th>INSTANSI</th>
				<th>WAKTU PRESENSI</th>
				
			</tr>
		</thead>
		<tbody>
		<?php $no=1; ?>
		
			@foreach($peserta as $user)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->unit->nama_unit }}</td>
				<td>{{ $user->pivot->presensi_at }}</td>
			</tr>
			@endforeach
			@foreach($tamu as $t)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $t->nama }}</td>
				<td>{{ $t->unit }}</td>
				<td>{{ $t->created_at }}</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
		
</body>
</html>