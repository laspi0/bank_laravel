@extends('client.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-around">
                <div class="row mt-5">
                    <div class="card-wrap mr-5">
                        <div class="card-header four">
                            <i class="fab fa-js-square"></i>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('purchase.pack') }}">
                                @csrf
                                <input type="hidden" name="name" value="Standard">
                                <input type="hidden" name="ceiling" value="1000000">
                                <input type="hidden" name="agio" value="3000">
                            <h1 class="card-title">Standard</h1>
                            <p class="card-text h2">3.000 Fcfa/mois</p>
                            <p class="card-text h2">Plafond:1.000.000</p>
                            <button type="submit"  class="card-btn four">Acheter</button>
                        </form>
                        </div>
                    </div>                    <!-- Premium Pack -->
                    <div class="card-wrap mr-5">
                        <div class="card-header three">
                            <i class="fab fa-html5"></i>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('purchase.pack') }}">
                                @csrf
                                <input type="hidden" name="name" value="Premium">
                                <input type="hidden" name="ceiling" value="5000000">
                                <input type="hidden" name="agio" value="5000">
                            <h1 class="card-title">Premium</h1>
                            <p class="card-text h2">5.000 Fcfa/mois</p>
                            <p class="card-text h2">Plafond:5.000.000</p>
                            <button type="submit"  class="card-btn three">Acheter</button>
                        </form>
                        </div>
                    </div>
                    <!-- Premium Pack -->
                    <div class="card-wrap mr-5">
                        <div class="card-header one">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('purchase.pack') }}">
                                @csrf
                                <input type="hidden" name="name" value="Gold">
                                <input type="hidden" name="ceiling" value="90000000000">
                                <input type="hidden" name="agio" value="12000">
                            <h1 class="card-title">Gold</h1>
                            <p class="card-text h2">12.000/mois</p>
                            <p class="card-text h2">Plafond:Ullimité</p>
                            <button type="submit"  class="card-btn one">Acheter</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        :root {
            --color-text: #616161;
            --color-text-btn: #ffffff;
            --card1-gradient-color1: #f12711;
            --card1-gradient-color2: #f5af19;
            --card2-gradient-color1: #7F00FF;
            --card2-gradient-color2: #E100FF;
            --card3-gradient-color1: #3f2b96;
            --card3-gradient-color2: #a8c0ff;
            --card4-gradient-color1: #11998e;
            --card4-gradient-color2: #38ef7d;
        }



        .card-wrap {
            width: 220px;
            background: transparent;
            border-radius: 20px;
            border: 5px solid #1b68ff;
            overflow: hidden;
            color: var(--color-text);
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
                rgba(0, 0, 0, 0.23) 0px 6px 6px;
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .card-wrap:hover {
            transform: scale(1.1);
        }

        .card-header {
            height: 200px;
            width: 100%;
            background: red;
            border-radius: 100% 0% 100% 0% / 0% 50% 50% 100%;
            display: grid;
            place-items: center;

        }

        .card-header i {
            color: #fff;
            font-size: 72px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 60%;
            margin: 0 auto;
        }

        .card-title {
            text-align: center;
            text-transform: uppercase;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;

        }

        .card-text {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .card-btn {
            border: none;
            border-radius: 100px;
            padding: 5px 30px;
            color: #fff;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .card-header.one {
            background: linear-gradient(to bottom left, var(--card1-gradient-color1), var(--card1-gradient-color2));
        }

        .card-header.two {
            background: linear-gradient(to bottom left, var(--card2-gradient-color1), var(--card2-gradient-color2));
        }

        .card-header.three {
            background: linear-gradient(to bottom left, var(--card3-gradient-color1), var(--card3-gradient-color2));
        }

        .card-header.four {
            background: linear-gradient(to bottom left, var(--card4-gradient-color1), var(--card4-gradient-color2));
        }

        .card-btn.one {
            background: linear-gradient(to left, var(--card1-gradient-color1), var(--card1-gradient-color2));
        }

        .card-btn.two {
            background: linear-gradient(to left, var(--card2-gradient-color1), var(--card2-gradient-color2));
        }

        .card-btn.three {
            background: linear-gradient(to left, var(--card3-gradient-color1), var(--card3-gradient-color2));
        }

        .card-btn.four {
            background: linear-gradient(to left, var(--card4-gradient-color1), var(--card4-gradient-color2));
        }
    </style>
    @endsection