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

                    <h1 style="text-align: center">Výpočet ceny ubytovania</h1>
                        <br>

                        <h3>Cenník v daných obdobiach :</h3>
                        <br>
                        <table>
                            <tr>
                                <th>Dátum OD</th>
                                <th>Dátum DO</th>
                                <th>Sadzba</th>
                                <th>Cena dospelý</th>
                                <th>Cena dieťa</th>
                            </tr>
                            <tr>
                                <td>01.03.2018</td>
                                <td>03.03.2018</td>
                                <td>Prvé tri noci sú drahšie</td>
                                <td>8 €</td>
                                <td>1 €</td>
                            </tr>
                            <tr>
                                <td>06.03.2018</td>
                                <td>08.03.2018</td>
                                <td>Marcová akcia</td>
                                <td>4 €</td>
                                <td>3.5 €</td>
                            </tr>
                            <tr>
                                <td>13.03.2018</td>
                                <td>16.03.2018</td>
                                <td>Jarná akcia</td>
                                <td>3.5 €</td>
                                <td>2.5 €</td>
                            </tr>
                        </table>
                        <br>
                    <p>
                        Štandardný poplatok je 6 eur pre dospelého na noc a 4 eura pre dieťa na noc (dieťa bez postele 0 €).
                    </p>
                    <p>
                        Štandardný poplatok za každú osobu je 0,66 € na celu dobu ubytovania.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
