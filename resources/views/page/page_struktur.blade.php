@extends('page.layout.app')
@section('title', 'Struktur')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Struktur Organisasi</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="isi-page" id="isi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="isi-single-item">
                        <div class="down-content">
                            <div id="struktur">
                                <a href="#">
                                    <h4>Struktur Organisasi Unit Kerjasama Poliwangi</h4>
                                </a>
                                <div class="container isi-struktur">
                                    <div class="level-1 rectangle">
                                        <h6><b>Ketua Unit</b></h6>
                                        <hr>
                                        <h6>{{ $struktur->ketua }}</h6>
                                    </div>
                                    <ol class="level-2-wrapper">
                                        <li>
                                            <div class="level-2 rectangle">
                                                <h6><b>Sekretaris Ketua Unit</b></h6>
                                                <hr>
                                                <h6>{{ $struktur->sekretaris }}</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="level-2 rectangle">
                                                <h6><b>Staf Administrasi Ketua Unit</b></h6>
                                                <hr>
                                                <h6>{{ $struktur->staf }}</h6>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>Copyright © 2022 Poliwangi, Ltd. All Rights Reserved.
            </p>
        </div>
    </section>
@endsection
@push('css')
    <style>
        :root {
            --level-1: #8dccad;
            --level-2: #f5cc7f;
            --black: black;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        ol {
            list-style: none;
        }

        .rectangle {
            position: relative;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }


        /* LEVEL-1 STYLES */
        .level-1 {
            width: 50%;
            margin: 0 auto 60px;
            background: var(--level-1);
        }

        .level-1::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 40px;
            background: var(--black);
        }


        /* LEVEL-2 STYLES */
        .level-2-wrapper {
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .level-2-wrapper::before {
            content: "";
            position: absolute;
            top: -20px;
            left: 25%;
            width: 50%;
            height: 2px;
            background: var(--black);
        }

        .level-2-wrapper::after {
            display: none;
            content: "";
            position: absolute;
            left: -20px;
            bottom: -20px;
            width: calc(100% + 20px);
            height: 2px;
            background: var(--black);
        }

        .level-2-wrapper li {
            position: relative;
        }

        .level-2-wrapper>li::before {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: var(--black);
        }

        .level-2 {
            width: 70%;
            margin: 0 auto 40px;
            background: var(--level-2);
        }

        hr {
            margin: 2px;
        }

        /* MQ STYLES
                                                                                                                                                                                                            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        @media screen and (max-width: 700px) {
            .rectangle {
                padding: 20px 10px;
            }

            .level-1,
            .level-2 {
                width: 100%;
            }

            .level-1 {
                margin-bottom: 20px;
            }

            .level-1::before,
            .level-2-wrapper>li::before {
                display: none;
            }

            .level-2-wrapper,
            .level-2-wrapper::after,
            .level-2::after {
                display: block;
            }

            .level-2-wrapper {
                width: 90%;
                margin-left: 10%;
            }

            .level-2-wrapper::before {
                left: -20px;
                width: 2px;
                height: calc(100% + 40px);
            }

            .level-2-wrapper>li:not(:first-child) {
                margin-top: 50px;
            }
        }
    </style>
@endpush
