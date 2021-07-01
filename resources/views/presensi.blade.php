@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Presensi Peserta')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detail Agenda</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-condensed" >
                    <tr><th style="width: 150px">Nama Rapat</th><td>{{$agenda->nama_agenda}}</td></tr>
                    <tr><th>Tanggal</th><td>{{$agenda->tanggal}}</td></tr>
                    <tr><th>Waktu</th><td>{{$agenda->waktu_mulai .' - '. $agenda->waktu_selesai}}</td></tr>
                    <tr><th>Tempat</th><td>{{$agenda->ruangan->nama}}</td></tr>
                    <tr><th>Keterangan</th><td>{{$agenda->keterangan}}</td></tr>
                    <tr><th>PIC Rapat</th><td>{{$agenda->pic}}</td></tr>
                
                    <script>
                        CountDownTimer('{{$agenda->created_at}}', 'countdown');
                        function CountDownTimer(dt, id)
                        {
                            var end = new Date('{{$agenda->tanggal}}');
                            var _second = 1000;
                            var _minute = _second * 60;
                            var _hour = _minute * 60;
                            var _day = _hour * 24;
                            var timer;
                            function showRemaining() {
                                var now = new Date();
                                var distance = end - now;
                                if (distance < 0) {

                                    clearInterval(timer);
                                    document.getElementById(id).innerHTML = '<b>AGENDA SUDAH BERAKHIR</b> ';
                                    return;
                                }
                                var days = Math.floor(distance / _day);
                                var hours = Math.floor((distance % _day) / _hour);
                                var minutes = Math.floor((distance % _hour) / _minute);
                                var seconds = Math.floor((distance % _minute) / _second);

                                document.getElementById(id).innerHTML = days + ' Hari ';
                                document.getElementById(id).innerHTML += hours + ' Jam ';
                                document.getElementById(id).innerHTML += minutes + ' Menit ';
                                document.getElementById(id).innerHTML += seconds + ' detik';
                                document.getElementById(id).innerHTML +='<h2>AGENDA BELUM DIMULAI</h2>';
                            }
                            timer = setInterval(showRemaining, 1000);
                        }

                        function display_ct6() {
                            var x = new Date()
                            var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';

                            var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
                            x1 = x1 + " " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds() + ampm;
                            document.getElementById('ct6').innerHTML = x1;
                            display_c6();
                        }
                        function display_c6(){
                            var refresh=1000; // Refresh rate in milli seconds
                            mytime=setTimeout('display_ct6()',refresh)
                        }
                        display_c6()
                            
                            
                        
                    </script>
                    <?php
                        $now = new DateTime();
                        $now = $now->format('Y-m-d'); 
                    ?>
                    @if($now < $agenda->tanggal)
                    <tr><th>Waktu menuju Agenda</th><td id="countdown"></td></tr>
                    @elseif($now == $agenda->tanggal)
                    <tr><th>Waktu Sekarang</th><td> <h2> <span id='ct6'></span></h2> </td></tr>
                    @else
                    <tr><th>Waktu </th><td id="countdown"></td></tr>
                    @endif
                </table>
            </div>
            <div class="box-footer">
                <form role="form" action="/presensi/peserta/{{$agenda->id}}" method="post">
                {{ csrf_field() }}
                <table class="table table-condensed" >
                    <tr>
                        <th style="width: 150px">Nama Peserta </th><td>{{$pegawai->name}}</td>
                        <input type=hidden name='user_id' value='{{$pegawai->id}}'>
                    </tr>
                    <tr>
                        <th>Unit </th><td>{{$pegawai->unit->nama_unit}}</td>
                        <!--<input type=hidden name='agenda_id' value='{{$agenda->id}}'>-->
                    </tr>
                    @foreach($agenda->user as $user)
                        @if($user->pivot->user_id == $pegawai->id)
                    
                    <tr>
                        <th>Status Presensi </th><td>{{$user->pivot->presensi}} {{$user->pivot->presensi_at}}</td>
                        <!--<input type=hidden name='agenda_id' value='{{$agenda->id}}'>-->
                    </tr>
                        @endif
                    @endforeach
                    <tr><th colspan =2>
                    @foreach($agenda->user as $user)
                        @if($user->pivot->user_id == $pegawai->id)
                            @if(($now == $agenda->tanggal) AND ($user->pivot->presensi=='belum'))
                            <button type="submit" class="btn btn-success btn-block">KLIK UNTUK PRESENSI</button>
                            
                            @else
                            <button type="submit" class="btn btn-success btn-block" disabled>KLIK UNTUK PRESENSI</button>
                            
                            @endif
                        @endif
                    @endforeach
                        <a href="/agenda" class="btn btn-warning btn-block">Kembali</a>
                    </th></tr>
                    
                </form>
                </table>
                @if($errors->any())
                    <div class="text-danger">
                        {{ $errors->first()}}
                    </div>
                @endif
                
                
            </div>
        </div>
        <!-- /.box -->
        <!-- /.box-body -->
    </div>
</div>
@endsection