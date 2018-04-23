<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // overim ci je naplnene hiddenute pole s ID
        $id = $request->input('userID');
        if ($id) {
            $request->validate([
                'login' => 'required|string|max:255',
                'email' => 'string|email|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
            Log::debug('Request je validny ');

            $user = User::find($id);
            $user->meno = $request['meno'];
            $user->priezvisko = $request['priezvisko'];
            $user->ulica = $request['ulica'];
            $user->cislo = $request['cislo'];
            $user->psc = $request['psc'];
            $user->mesto = $request['mesto'];
            $user->popis = $request['popis'];
            $user->stav = $request['stav'];
            $user->login = $request['login'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->remember_token = str_random(10);
            $user->save();

            Log::debug('User bol updatnuty : '.$user);
        } else {
            $request->validate([
                'login' => 'required|string|max:255|unique',
                'email' => 'string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            Log::debug('Request je validny ');
//            $user = User::create($request->all());
            $user = User::create([
                'meno' => $request['meno'],
                'priezvisko' => $request['priezvisko'],
                'ulica' => $request['ulica'],
                'cislo' => $request['cislo'],
                'psc' => $request['psc'],
                'mesto' => $request['mesto'],
                'popis' => $request['popis'],
                'stav' => $request['stav'],
                'login' => $request['login'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'remember_token' => str_random(10),
            ]);
            Log::debug('User bol vytvoreny : ' . $user);
        }

         return redirect()
             ->back()
             ->with('status','User "' . $user->login .'" bol uspesne ulozeny do DB.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update riesim v metode store ako aj create
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showZadanie()
    {
       // zobrazi vstupne hodnoty a datum cennika
        Log::debug('Test na zapis do logu.');
        return view('vypocet');
    }

    public function vypocetCenyUbytovania(Request $request)
    {
        $cennik = collect([
            "tarif" => [
                [
                    'datum_od'=> Carbon::parse($request->input('t1_od')),
                    'datum_do'=> Carbon::parse($request->input('t1_do')),
                    'sadzba' => 'Prvé tri noci sú drahšie',
                    'cena_dospely' => 8,
                    'cena_dieta' => 1
                ],
                [
                    'datum_od'=> Carbon::parse($request->input('t2_od')),
                    'datum_do'=> Carbon::parse($request->input('t2_do')),
                    'sadzba' => 'Marcová akcia',
                    'cena_dospely' => 4,
                    'cena_dieta' => 3.5
                ],
                [
                    'datum_od'=> Carbon::parse($request->input('t3_od')),
                    'datum_do'=>Carbon::parse($request->input('t3_do')),
                    'sadzba' => 'Jarná akcia',
                    'cena_dospely' => 3.5,
                    'cena_dieta' => 2.5
                ]
            ],
            'cena_standard_dospely' => 6,
            'cena_standard_dieta' => 4,
            'cena_standard_poplatok' => 0.66
        ]);

        $pocet_dospely = $request->input('pocet_dospely');
        $pocet_deti = $request->input('pocet_deti');
        $pocet_deti_pristelka = $request->input('pocet_pristelka');
        $pocetOsob = $pocet_dospely + $pocet_deti + $pocet_deti_pristelka;
        $poplatok_pobyt = $pocetOsob * $cennik->get('cena_standard_poplatok');

        $ubytovanie_od = Carbon::parse($request->input('ubytovanie_od'));
        $ubytovanie_do = Carbon::parse($request->input('ubytovanie_do'));
//        $pocetDni = $ubytovanie_od->diffInDays($ubytovanie_do);

        $first3nights = collect($cennik->get('tarif'))->firstWhere('sadzba','Prvé tri noci sú drahšie');
        $tarify = collect($cennik->get('tarif'))->whereNotIn('sadzba','Prvé tri noci sú drahšie');
        // zoradene tarify podla datumu
        $sort_tarify = $tarify->sortBy('datum_od')->toArray();

        $interval = new DateInterval('P1D');
        $dlzka_pobytu = new DatePeriod($ubytovanie_od, $interval ,$ubytovanie_do);

        foreach ($dlzka_pobytu as $night) {
            $night_date_from = $night->copy()->format('d.m.Y');
            $night_date_to = $night->copy()->addDay()->format('d.m.Y');

            // v pripade ze aktualny den sa nebude nachadzak v cenniku akcii tak ostane nasledujuci cennik Standard
            $cost_adults = $cennik->get('cena_standard_dospely');
            $cost_children = $cennik->get('cena_standard_dieta');
            $sadzba = 'Štandard';

            if ($night->between(array_get($first3nights, 'datum_od'), array_get($first3nights, 'datum_do'))) {
                $cost_adults = array_get($first3nights, 'cena_dospely');
                $cost_children = array_get($first3nights, 'cena_dieta');
                $sadzba = array_get($first3nights, 'sadzba');
            } else {
                // prehladanie aktualneho datumu v akciach z cennika
                foreach ($sort_tarify as $tarif) {
                    if ($night->between(array_get($tarif, 'datum_od'), array_get($tarif, 'datum_do'))) {
                        $cost_adults = array_get($tarif, 'cena_dospely');
                        $cost_children = array_get($tarif, 'cena_dieta');
                        $sadzba = array_get($tarif, 'sadzba');
                    }
                }
            }
            $nights[] = [
                'night_date_from' => $night_date_from,
                'night_date_to' => $night_date_to,
                'cost_adults' => $cost_adults,
                'cost_children' => $cost_children,
                'sadzba' => $sadzba
            ];
        }

        $cena_dospely = collect($nights)->sum('cost_adults');
        $cena_deti = collect($nights)->sum('cost_children');
        $cena_spolu = ($cena_dospely * $pocet_dospely) + ($cena_deti * $pocet_deti);
        $cena_konecna = $cena_spolu + $poplatok_pobyt;

        return view('vypocet')
            ->with('ubytovanie_od',$ubytovanie_od->format('d.m.Y'))
            ->with('ubytovanie_do',$ubytovanie_do->format('d.m.Y'))
            ->with('poplatok_pobyt',$poplatok_pobyt)
            ->with('pocetOsob',$pocetOsob)
            ->with('pocet_dospely',$pocet_dospely)
            ->with('pocet_deti',$pocet_deti)
            ->with('nights',$nights)
            ->with('cena_dospely',$cena_dospely)
            ->with('cena_deti',$cena_deti)
            ->with('cena_konecna',$cena_konecna)
            ->with('status','Cena za ubytovanie bola úspešne prepočítaná.');
    }
}