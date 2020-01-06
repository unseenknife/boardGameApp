@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                <!-- foreach loop, loop voor elke game-->
                @foreach ($users as $user)
                <div class="row" id="myTable">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-2">
                                <!--haalt hieronder de gamename op, maar haalt elke spatie weg hieruit en zoekt naar een bestand met deze naam in public/images-->
                                <img class="card-img-top" src="{{asset('storage')}}/playerId{{$user->id}}.jpg">
                            </div>
                            <div class="col-md-10">
                                <div class="card-block">
                                    <div class="col-6 cardUser">
                                        <!-- card titel laat hier de gamenaam zien-->
                                        <h4 class="card-title">{{$user->f_name . " " . $user->l_name}}</h4>
                                        <!-- card subtitel, dus kleiner en grijs echo hierbij de minplayers - maxplayers van de game-->
                                        <h6 class="card-subtitle mb-2">{{$user->Player()->first()->nickname}}</h6>
                                    </div>
                                    <div class="col-4 destroyBtnUser">
                                        <form method="post" action="{{route('users.destroy', $user->id)}}" id="destroyUser" class="destroyBtn">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-primary btnCreateBattle" onclick="document.getElementById('destroyUser').submit()"><i class="fas fa-trash-alt"></i></a>
                                        </form>
                                    </div>
{{--                                    <a class="btn btn-primary" href="games/{{$game->id}}"> Play a game!</a>--}}
                                    {{--<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#{{str_replace(' ',"",$game->name)}}">--}}
                                        {{--Play a game!--}}
                                    {{--</button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection