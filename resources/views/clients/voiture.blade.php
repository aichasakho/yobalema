@extends('layouts.client.base')

@section('title', "Voiture")

@section('content')

    <div style="height: 200px"></div>
    <div class="container">
        <div class="row">
            @foreach($voitures as $voiture)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{asset('/storage/'.$voiture->image_voiture)}}" alt="" class="card-img-top" width="100%" height="200px">
                        <div class="card-body">
                            <p>{{$voiture->matricule}}</p>

                            @include('shared.voiture-modal', [
                                'id' => $voiture->id,
                                'title' => __('Voir détails'),
                                'voiture' => $voiture,
                            ])
                        </div>

                    </div>

                </div>
            @endforeach
        </div>
    </div>










@endsection

