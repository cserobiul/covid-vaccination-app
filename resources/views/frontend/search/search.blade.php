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
                        <h4>Status: {{ $status }}</h4>

                        @if($status == 'Scheduled')
                            <h4>Name: <span class="success">{{ $name ?? '' }}</span></h4>
                            <h4>Your scheduled vaccination date is: <span class="success">{{ $date ?? '' }}</span></h4>
                            <h4>Vaccination Center: <span class="success">{{ $center_name ?? '' }}</span></h4>
                            <br>
                        @elseif($status == 'Vaccinated')
                            <h4>Name: <span class="success">{{ $name ?? '' }}</span></h4>
                            <h4>Your scheduled vaccination date was: <span class="success">{{ $date ?? '' }}</span></h4>
                            <h4>Vaccination Center: <span class="success">{{ $center_name ?? '' }}</span></h4>
                            <br>
                        @elseif($status == 'Not scheduled')
                            <h4>Name: <span class="success">{{ $name ?? '' }}</span></h4>
                            <h4>Vaccination Center: <span class="success">{{ $center_name ?? '' }}</span></h4>
                            <h4>You are registered but not yet scheduled for vaccination.</h4>
                        @elseif($status == 'Not registered')
                            <h4> To get covid 19 vaccine, you must be registered first <a href="{{ $link ?? '' }}">Register here</a></h4>
                            <br>
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
                                   <li>If you are registered; Register first from <a href="{{ route('registration') }}">Registration Page</a></li>

                               </ul>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
