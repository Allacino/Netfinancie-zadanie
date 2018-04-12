@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>ZADANIA   ...   </strong> <small>na vypracovanie</small></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#zadanie1">Zadanie 1</a></li>
                        <li><a data-toggle="tab" href="#zadanie2">Zadanie 2</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="zadanie1" class="tab-pane fade in active">
                            <br>
                            <h4>Úloha</h4>
                            <p>
                                Napíšte trojvrstvovú webovú aplikáciu v PHP pre účely správy jednoduchej MySQL databázy.
                            </p>
                            <h4>Popis problému</h4>
                            <p>
                                V databáze sú uložené osobné údaje ľudí. Tabuľka `ludia` sa skladá z týchto polí: `id`, `meno`,
                                `priezvisko`, `ulica`, `cislo`, `PSČ`, `mesto`, `login`, `heslo`, `email`, `popis`, `stav`. Pri tvorbe polí sú použité
                                typy INT a VARCHAR, pole `stav` je typu CHAR a nadobúda hodnoty “a”, “b” alebo “c”. Pole `heslo` je v DB
                                zašifrované pomocou MD5. Pole `id` slúži ako primárny kľúč – index.
                            </p>
                            <h4>Prezentačná vrstva - HTML stránky v prehliadači (front end – browser)</h4>
                            <p>
                                Skladá sa z formulára a zobrazenia databázovej tabuľky pomocou tagu "table". V HTML tabuľke nie sú
                                uvedené všetky polia databázovej tabuľky, ale len niektoré z nich. Na druhej strane, formulár obsahuje
                                všetky polia z databázovej tabuľky – názov poľa a editovateľné textové pole. Rozloženie formulára je
                                dosiahnuté použitím tagu "table". Tabuľku je možné kliknutím na záhlavie stĺpca zoradiť podľa tohto stĺpca,
                                    vzostupne alebo zostupne. Kliknutím na riadok HTML tabuľky sa formulár naplní JavaScriptom všetkými
                                    údaje o osobe, aj tými, ktoré nie sú v HTML tabuľke vidno. Formulár následne umožňuje úpravu týchto
                                    údajov a následné odoslanie strednej vrstve implementujúcej aplikačnú logiku v PHP. Formulár okrem
                                úpravy existujúcich záznamov slúži tiež na pridávanie ďalších záznamov do tabuľky `ludia`.
                            </p>
                            <h4>Vrstva aplikačnej logiky – programová logika v PHP skriptoch</h4>
                            <p>
                                Slúži na komunikáciu s databázovou vrstvou. PHP skript na strane serveru teda obsahuje funkcie pre
                                manipuláciu s DB tabuľkou, v ideálnom prípade pomocou API na to určenej triedy. Okrem toho PHP
                                    generuje HTML stránky prezentačnej vrstvy a spracováva užívateľský vstup z HTML formulára.
                            </p>
                            <h4>Databázová vrstva – MySQL databáza (back-end)</h4>
                            <p>
                                    Obsahuje fyzickú realizáciu MySQL databázy, ktorá pozostáva z jedinej tabuľky `ludia`.
                            </p>
                                <h4>Bonusy</h4>
                            <ul>
                                    <li>Validácia údajov zadaných do formulára pred samotným odoslaním na server JavaScript-om<br>
                                    – najmä kontrola správnosti zadaného emailu, napr. pomocou regulárneho výrazu
                                    </li>
                                <li>Riadky HMTL tabuľky reagujú na pohyb myši (onmouseover/onmouseout) vysvietením</li>
                                <li>
                                    HTML tabuľka zobrazuje iba niekoľko riadkov (cca 8), ktoré sa dajú samostatne scrollovať,
                                    najlepšie bez nutnosti scrollovania celej stránky
                                </li>
                                <li>Úvodná stránka plniaca funkciu prihlasovacieho formulára, ktorá umožní vstup len užívateľom
                                    evidovaných v databázovej tabuľke, pod ich prihlasovacím menom (pole `login`) a heslom
                                    (pole `heslo`)
                                </li>
                            </ul>
                            <br>
                            <div>
                                <a class="btn btn-primary" href="{{ url('/users') }}">
                                    {{ __('Prejsť na riešenie >>') }}
                                </a>
                            </div>
                        </div>
                        <div id="zadanie2" class="tab-pane fade">
                            <br>
                            <h4>Úloha</h4>
                            <p>
                            Napíšte PHP skript pre účely výpočtu ceny.
                            </p>
                            <h4>Popis problému</h4>
                            Zadané sú vstupné hodnoty:
                            <ul>
                                <li>dátum od</li>
                                <li>dátum do</li>
                                <li>počet dospelých osôb</li>
                                <li>počet detí</li>
                                <li>počet detí bez postele</li>
                                <li>interval – obdobie, kedy sú ceny iné</li>
                                <ul>
                                    <li>dátum od</li>
                                    <li>dátum do</li>
                                    <li>názov sadzby</li>
                                    <li>cena dospelý</li>
                                    <li>cena dieťa</li>
                                </ul>
                            <li>štandardný poplatok – cena dospelý</li>
                                <li>štandardný poplatok – cena dieťa</li>
                            <li>štandardný poplatok za osobu na celú dobu ubytovania</li>
                            </ul>
                            <p>
                            Úlohou je vypočítať cenu ubytovania na základe zadaných vstupov.
                            </p>
                            <h4>Prezentačná vrstva - HTML stránka v prehliadači (front end – browser)</h4>
                            <p>
                            Stačí vytvoriť jednoduchý PHP súbor, kde budú všetky vstupné hodnoty zadané natvrdo, bez
                            akéhokoľvek formulára. Vstupné hodnoty môžete použiť tie ktoré sú v priloženom súbore
                            „zadanie2.pdf“ a v ňom sa nachádza taktiež aj riešenie a výsledná cena, ktorú by mal zobraziť aj váš
                            skript. Výstupnú stránku netreba nijako formátovať, dôležité je akým spôsobom pomocou PHP
                            skriptu vypočítate cenu.
                            </p>
                            <br>
                            <div>
                                <a class="btn btn-primary" href="{{ url('/vypocet-ceny-ubytovania') }}">
                                    {{ __('Prejsť na riešenie >>') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
