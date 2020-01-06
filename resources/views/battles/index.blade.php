@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-10">
                                <div class="card-block">
                                    <div class="row">
                                        <!-- card titel laat hier de gamenaam zien-->
                                        <h4 class="card-title tittleGame">Battle history</h4>
                                    </div>
                                    <!-- card subtitel, dus kleiner en grijs echo hierbij de minplayers - maxplayers van de game-->
                                    <h6 class="card-subtitle mb-2 text-muted gamesplayer numberofplayer showGameText">here you can see the past battles you have played</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($battle_players as $battle)
                        @if($battle->Battle()->first()->wonBy != 0)
                            <div class="col-md-10 lobbyCard">
                                <a data-toggle="collapse" href="#battle{{$battle->battle_id}}" aria-expanded="true" aria-controls="collapseOne" class="list-group-item list-group-item-action flex-column align-items-start" >
                                    <div class="row">
                                        <h6 class="card-subtitle col-md-4 text-muted cardLobbyList">{{$battle->Battle()->first()->Game->name}}</h6>
                                        <h6 class="card-title col-md-4 cardLobbyList">{{$battle->Battle()->first()->battleName}}</h6>
                                        <h6 class="card-subtitle col-md-4 text-muted cardLobbyList">{{date('d-m-Y  H:m', strtotime($battle->Battle()->first()->created_at))}}</h6>
                                    </div>
                                </a>
                            </div>
                            <div id="battle{{$battle->battle_id}}" class="col-md-10 lobbyCard collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-body col-md-10">
                                      <div class="card-body">
                                          <div class="row">
                                              <h6>
                                                  <i class="fas fa-trophy"></i> Winner: {{$battle->Battle()->first()->Player()->first()->nickname}}
                                              </h6>
                                          </div>
                                          <div class="center">
                                             <a class="btn btn-primary" href="{{route('battles.show', $battle->battle_id)}}">Go to battle</a>
                                          </div>
                                      </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection