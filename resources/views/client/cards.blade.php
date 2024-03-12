@extends('client.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($cards as $card)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-inner">
                    <div class="front">
                        <img src="https://i.ibb.co/PYss3yv/map.png" class="map-img">
                        <div class="row">
                            <img src="https://i.ibb.co/G9pDnYJ/chip.png" width="60px">
                            <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="60px">
                        </div>
                        <div class="row card-no">
                            @foreach(str_split($card->card_number, 4) as $chunk)
                                <p>{{ $chunk }}</p>
                            @endforeach
                        </div>
                        <div class="row card-holder">
                            <p>{{ __('Titulaire de la carte') }}</p>
                            <p>{{ __('Valide jusqu\'au') }}</p>
                        </div>
                        <div class="row name">
                            <p>{{ $card->name }}</p>
                            <p class="h4">{{ \Carbon\Carbon::parse($card->expiration_date)->format('m/Y') }}</p>
                        </div>
                    </div>
                    <div class="back">
                        <img src="https://i.ibb.co/PYss3yv/map.png" class="map-img">
                        <div class="bar"></div>
                        <div class="row card-cvv">
                            <div>
                                <img src="https://i.ibb.co/S6JG8px/pattern.png">
                            </div>
                            <p>{{ $card->cvv }}</p>
                        </div>
                        <div class="row card-text">
                            <p>{{ __('Ceci est un design de carte virtuelle ') }}</p>
                        </div>
                        <div class="row signature">
                            <p>{{ __('SIGNATURE DU CLIENT') }}</p>
                            <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="80px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=josefin+Sans:wght@400;500;600;700&display=swap');

    .card {
        width: 450px;
        height: 250px;
        color: #fff;
        cursor: pointer;
        perspective: 1000px;
    }

    .card-inner {
        width: 100%;
        height: 100%;
        position: relative;
        transition: transform 1s;
        transform-style: preserve-3d;
    }

    .front,
    .back {
        width: 100%;
        height: 100%;
        background-image: linear-gradient(45deg, #0045c7, #ff2c7d);
        position: absolute;
        top: 0;
        left: 0;
        padding: 20px 30px;
        border-radius: 15px;
        overflow: hidden;
        z-index: 1;
        backface-visibility: hidden;
    }

    .row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .map-img {
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0.3;
        z-index: -1;
    }

    .card-no {
        font-size: 35px;
        margin-top: 10px;
    }

    .card-holder {
        font-size: 12px;
        margin-top: 20px;
    }

    .name {
        font-size: 22px;
        /* margin-top: 10px; */
    }

    .bar {
        background: #222;
        margin-left: -30px;
        margin-right: -30px;
        height: 60px;
        margin-top: 10px;
    }

    .card-cvv {
        margin-top: 20px;
    }

    .card-cvv div {
        flex: 1;
    }

    .card-cvv img {
        width: 100%;
        display: block;
        line-height: 0;
    }

    .card-cvv p {
        background: #fff;
        color: #000;
        font-size: 22px;
        padding: 10px 20px;
    }

    .card-text {
        /* margin-top: 30px; */
        font-size: 14px;
    }

    .signature {
        /* margin-top: 30px; */
    }

    .back {
        transform: rotateY(180deg);
    }

    .card:hover .card-inner {
        transform: rotateY(-180deg);
    }
</style>
@endsection