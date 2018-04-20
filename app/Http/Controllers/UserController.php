<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
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
            $user->update($request->all());
            Log::debug('User bol updatnuty : '.$user);
        } else {
            $request->validate([
                'login' => 'required|string|max:255',
                'email' => 'string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            Log::debug('Request je validny ');
            $user = User::create($request->all());
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

//        dd($cennik);

        $pocet_dospely = 2;
        $pocet_deti_pristelka = 3;
        $pocet_deti = 1;
        $pocetOsob = $pocet_dospely + $pocet_deti + $pocet_deti_pristelka;
        $poplatok_pobyt = $pocetOsob * $cennik->get('cena_standard_poplatok');

        $ubytovanie_od = Carbon::parse('01.03.2018');
        $ubytovanie_do = Carbon::parse('15.03.2018');
//        $pocetDni = $ubytovanie_od->diffInDays($ubytovanie_do);

//        $firstNight = $ubytovanie_od;
        $lastNight = $ubytovanie_do->subDay();

        $tarify = $cennik->get('tarif');
        $sadzby = collect($tarify)->get('sadzba');
        dd($sadzby);

        // mozno nebudem potrebovat premennu noc
        $noc = 1;
        while ($ubytovanie_od->lte($lastNight)) {
            $night_date_from = $ubytovanie_od->copy()->format('d-m-Y');
            $night_date_to = $ubytovanie_od->addDay()->format('d-m-Y');

//            $tarify = $cennik->get('tarif');

//            $first3 = $tarify->where('sadzba','Prvé tri noci sú drahšie');

            if ($noc < 4 ) {
                $cost_adults=8;
                $cost_children=1;
                $sadzba= 'Prvé tri noci sú drahšie';
            } elseif ($noc < 8) {
//                pride podmienka
                $cost_adults=4;
                $cost_children=3;
                $sadzba= 'Marcová akcia';
            } else {
                $cost_adults = $cennik->get('cena_standard_dospely');
                $cost_children = $cennik->get('cena_standard_dieta');
                $sadzba= 'Jarná akcia';
            }

            $noc++;
            $nights[] = [
                'night_date_from' => $night_date_from,
                'night_date_to' => $night_date_to,
                'cost_adults' => $cost_adults,
                'cost_children' => $cost_children,
                'sadzba' => $sadzba
            ];
        }

//        dd($nights);

//        $platny_tarif = $cennik->where('datum_od','<',$ubytovanie_od);

//        $cennik->dd();
//        {{ $vysledok }}

        return view('vypocet')
            ->with('poplatok_pobyt',$poplatok_pobyt)
            ->with('pocetOsob',$pocetOsob);
    }

    public function  calculatePrice()
    {
        // premenne "obchodu", ktore by sa mali tahat z konfiguracie alebo db
        // pre nas priklad stacia zatial natvrdo
        $prices = [
            'priceForAdult' => 6.0,
            'priceForChildrenWithBed' => 4.0,
        ];
        $standardPrice = 0.66;
        // na akcie pouzivam asociativne pole, ale krajsie by bolo zaobalit do objektu
        $actions = [
            [
                'from' => Carbon::create(2011, 3, 1),
                'to' => Carbon::create(2011, 3, 3),
                'priceForAdult' => 8.0,
                'priceForChildrenWithBed' => 1.0,
            ],
            [
                'from' => Carbon::create(2011, 3, 6),
                'to' => Carbon::create(2011, 3, 8),
                'priceForAdult' => 4.0,
                'priceForChildrenWithBed' => 3.5,
            ],
            [
                'from' => Carbon::create(2011, 3, 5),
                'to' => Carbon::create(2011, 3, 16),
                'priceForAdult' => 3.5,
                'priceForChildrenWithBed' => 2.5,
            ],
        ];
//        dd($actions);

        // porozbijame si akcie na intervaly (
        // v zadani nebolo povedane, ktory ma prioritu, tak sa berie ten, ktory zacal neskor)
        $normalisedActions = $this->normaliseDates($actions);

//        dd($normalisedActions);

        // vstupne premenne od zakaznika, neskor by sa mali posielat z nejakeho formularu a validovat
        $from = Carbon::create(2011, 3, 1);
        $to = Carbon::create(2011, 3, 15);
        $adults = 2;
        $children = 3;
        $childrenWithoutBed = 1;
        $childrenWithBed = $children - $childrenWithoutBed;
        $totalPersons = $adults + $children;
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($from, $interval, $to);

        dd($dateRange);

        // samotny vypocet ceny cez akcie a mimo akcie
        $result = collect($dateRange)->map(function ($day) use ($normalisedActions, $prices) {
            $interval = $this->interval($day, $normalisedActions);
            if ($interval) {
                return array_only($interval, ['priceForAdult', 'priceForChildrenWithBed']);
            } else {
                return $prices;
            }
        })->map(function ($item) use ($adults, $childrenWithBed) {
            return $adults * $item['priceForAdult'] + $childrenWithBed * $item['priceForChildrenWithBed'];
        })->sum();

        // vypocet standardnej ceny pre vsetky osoby
        $standardPriceForPersons = $totalPersons * $standardPrice;

        // konecny vysledok
        return $result + $standardPriceForPersons;
    }

    private function sortDates($collection)
    {
        Log::debug('Values before sorting', collect($collection)->values()->toArray());

        return collect($collection)->sortBy(function ($item) {
            // trochu hack zretazovat datumy pomocou oddelovaca
            return $item['from']->format('d-m-Y') . '#' . $item['to']->format('d-m-Y');
        })->tap(function ($collection) {
            Log::debug('Values after sorting', $collection->values()->toArray());
        })->values()->all();
    }
    public function normaliseDates($dates)
    {
        // usortime si podla datumu zaciatku a konca, aby sme neskor pocas iteracie mali istotu, ze porovnavame
        // dva za sebou iduce intervaly
        $sortedDays = $this->sortDates($dates);
        $result = [];
        for ($i = 0; $i < sizeof($sortedDays); $i++) {
            for ($j = $i + 1; $j < sizeof($sortedDays); $j++) {
                if ($this->isIntersection($sortedDays[$i], $sortedDays[$j])) {
                    $result[] = $this->getIntervals($sortedDays[$i], $sortedDays[$j]);
                } else {
                    $result[] = [$sortedDays[$i]];
                }
            }
        }
        return collect($result)->flatten(1)->values()->all();
    }

    private function interval($day, $intervals)
    {
        foreach ($intervals as $interval) {
            if ($day->greaterThanOrEqualTo($interval['from']) && $day->lessThanOrEqualTo($interval['to'])) {
                return $interval;
            }
        }
        return false;
    }
    private function isIntersection($firstDate, $secondDate)
    {
        return $firstDate['from']->lessThanOrEqualTo($secondDate['to']) && $firstDate['to']->greaterThanOrEqualTo($secondDate['from']);
    }

    private function getIntervals($dateA, $dateB)
    {
        if ($dateA['to']->greaterThan($dateB['to'])) {
            $firstInterval = $dateA;
            $firstInterval['to'] = $dateB['from']->copy()->subDay();
            $secondInterval = $dateA;
            $secondInterval['from'] = $dateB['to']->copy()->addDay();
            return [$firstInterval, $dateB, $secondInterval];
        } else {
            $dateA['to'] = $dateB['from']->copy()->subDay();
            return [$dateA];
        }
    }
}
