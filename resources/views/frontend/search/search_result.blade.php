@extends('frontend.layouts.master')
@section('title','Covid 19 Vaccination Program - Search')
@section('content')
    <div class="page-wrapper bg-red p-t-20 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h5>Welcome to Covid 19 Vaccination Program</h5>
                    <br>
                    <h2 class="title">Registration and Schedule Check</h2>

                    @if(isset($status))
                        <p>Status: {{ $status }}</p>

                        @if($status == 'Scheduled')
                            <p>Your scheduled vaccination date is: {{ $date }}</p>
                        @elseif($status == 'Not registered')
                            <a href="{{ $link }}">Register here</a>
                        @endif
                    @endif


                    <div class="search">
                        @component('components.frontend.search')
                        @endcomponent
                        <div class="note">
                            <h4>Note:</h4>
                            <br>
                            <ul>
                                <li>Input your NID number that you give during registration</li>
                                <li>If you are registered; Register first from <a href="{{ route('registration') }}">Registration
                                        Page</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
