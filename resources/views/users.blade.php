@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RIEŠENIE zadania číslo 1</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 style="text-align: center">Zoznam užívateľov [{{ count($users) }}]</h1>
                        {{--header-fixed--}}
                        <table id="tableUsers" class="table">
                        {{--<table id="tableUsers" class="table table-hover">--}}
                        {{--<table class="scroll">--}}
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th onclick="sortTable(0)">LOGIN <i class="fas fa-sort float-right"></i></th>
                                <th onclick="sortTable(1)">EMAIL <i class="fas fa-sort float-right"></i></th>
                                <th onclick="sortTable(2)">MENO <i class="fas fa-sort float-right"></i></th>
                                <th onclick="sortTable(3)">PRIEZVISKO <i class="fas fa-sort float-right"></i></th>
                            </tr>
                            </thead>

                            <tbody>

                            @forelse ($users as $user)
                                <tr class="trBody" value="{{ $user->id }}" data-user="{{ $user }}"
                                onclick="setForm(this)">

                                    {{--<td>{{ $loop->iteration }}</td>--}}
                                    <td class="sort">{{ $user->login }}</td>
                                    <td class="sort">{{ $user->email }}</td>
                                    <td class="sort">{{ $user->meno }}</td>
                                    <td class="sort">{{ $user->priezvisko }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td COLSPAN="4">NO USERS ...</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    <h2 style="text-align: center">Detailné informácie užívateľa : <span id="userID"></span></h2>
                        <br>
                        <form id="userForm">
                            @include('form')
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
