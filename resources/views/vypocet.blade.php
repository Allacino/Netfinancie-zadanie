@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RIEŠENIE zadania číslo 2</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="">
                        @csrf
                    <h1 style="text-align: center">Výpočet ceny ubytovania</h1>
                        <br>

                        <h3>Cenník v daných obdobiach :</h3>
                        <br>
                        <table class="table">
                            <tr>
                                <th>Dátum OD</th>
                                <th>Dátum DO</th>
                                <th>Sadzba</th>
                                <th>Cena dospelý</th>
                                <th>Cena dieťa</th>
                            </tr>
                            <tr>
                                <td><input name="t1_od" style="width: 80px" type="text" value="01.03.2018" autofocus></td>
                                <td><input name="t1_do" style="width: 80px" type="text" value="03.03.2018"></td>
                                <td>Prvé tri noci sú drahšie</td>
                                <td>8 €</td>
                                <td>1 €</td>
                            </tr>
                            <tr>
                                <td><input name="t2_od" style="width: 80px" type="text" value="06.03.2018"></td>
                                <td><input name="t2_do" style="width: 80px" type="text" value="08.03.2018"></td>
                                <td>Marcová akcia</td>
                                <td>4 €</td>
                                <td>3.5 €</td>
                            </tr>
                            <tr>
                                <td><input name="t3_od" style="width: 80px" type="text" value="05.03.2018"></td>
                                <td><input name="t3_do" style="width: 80px" type="text" value="16.03.2018"></td>
                                <td>Jarná akcia</td>
                                <td>3.5 €</td>
                                <td>2.5 €</td>
                            </tr>
                        </table>
                        <br>
                    <p>
                        Štandardný poplatok je <b>6 eur</b> pre dospelého na noc a <b>4 eura</b> pre dieťa na noc (dieťa bez postele <b>0 €</b>).
                    </p>
                    <p>
                        Štandardný poplatok za každú osobu je <b>0,66 €</b> na celu dobu ubytovania.
                    </p>
                        <hr>
                    <h4 style="text-align: center">VSTUPNÉ HODNOTY</h4>
                        <div class="float-right">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Vypočítať cenu') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <p>
                            Ubytovanie od: <strong><input name="ubytovanie_od" style="width: 80px" type="text" value="01.03.2018"></strong><br>
                            Ubytovanie do: <strong><input name="ubytovanie_do" style="width: 80px" type="text" value="15.03.2018"></strong><br>
                            Počet dospelých: <strong><input name="pocet_dospely" style="width: 20px" type="text" value="2"></strong><br>
                            Počet detí: <strong><input name="pocet_deti" style="width: 20px" type="text" value="3"></strong><br>
                            Počet detí bez postele (na prístelku): <strong><input name="pocet_pristelka" style="width: 20px" type="text" value="1"></strong><br>
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ session('status') }}
                            </div>
                        @endif

                    </form>

                        <div class="clearfix">
                            @isset($poplatok_pobyt)
                                <hr>
                                <h4 style="text-align: center">VÝSLEDNÁ CENA ZA UBYTOVANIE</h4>
                            <p>
                                Poplatok za celu rodinu na pobyt : <strong>{{ $poplatok_pobyt }} €</strong> (0,66 € * {{ $pocetOsob }} osôb)
                            </p>
                                <p>
                                    <h3><strong>Cena spolu: </strong>( {{ $cena_dospely }} € * {{ $pocet_dospely }} dospelé osoby ) + ( {{ $cena_deti }} € * {{ $pocet_deti }} deti ) + {{ $poplatok_pobyt }} € = <strong>{{ $cena_konecna }} €</strong></h3>
                                </p>
                                <br>

                                <h4 style="text-align: center">PREHĽAD JEDNOTLIVÝCH NOCÍ</h4>
                                <P>
                                <table id="tablenIGHTS" class="table">
                                    <thead>
                                    <tr>
                                        <th>Noc</th>
                                        <th>Dátum od</th>
                                        <th>Dátum do</th>
                                        <th>Sadzba</th>
                                        <th>Cena dospely</th>
                                        <th>Cena dieťa</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($nights as $noc)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $noc['night_date_from'] }}</td>
                                                <td>{{ $noc['night_date_to'] }}</td>
                                                <td>{{ $noc['sadzba'] }}</td>
                                                <td>{{ $noc['cost_adults'] }} €</td>
                                                <td>{{ $noc['cost_children'] }} €</td>
                                            </tr>
                                            @if ($loop->last)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $ubytovanie_od }}</td>
                                                    <td>{{ $ubytovanie_do }}</td>
                                                    <td></td>
                                                    <td>{{ $cena_dospely }} €</td>
                                                    <td>{{ $cena_deti }} €</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">Počet osôb : </td>
                                                    <td>{{ $pocet_dospely }}</td>
                                                    <td>{{ $pocet_deti }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                </p>

                            @endisset
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
