@extends('frontend.layouts.master')
@section('title','Covid 19 Vaccination Program - Registration')
@section('content')
    <div class="page-wrapper bg-red p-t-20 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h5>Welcome to Covid 19 Vaccination Program</h5>
                    <br>
                    <h2 class="title">Registration</h2>

                    @includeIf('frontend.layouts._alert')
                    <br><br>
                    <form method="POST" method="POST" action="{{ route('registrationProcess') }}">
                        @csrf
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2"
                                           type="text"
                                           placeholder="Name *"
                                           name="name"
                                           value="{{ old('name') }}"
                                    >
                                </div>
                                @error('name')
                                <span class="error">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2"
                                           type="email"
                                           placeholder="Valid Email Address *"
                                           name="email"
                                           value="{{ old('email') }}"
                                    >
                                </div>
                                @error('email')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2 js-datepicker"
                                           type="text"
                                           placeholder="Birthdate"
                                           name="dob"
                                           value="{{ old('dob') }}"
                                    >
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                                @error('dob')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                                @error('gender')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="vaccine_center">
                                    <option disabled="disabled" selected="selected">Vaccine Center *</option>
                                    @foreach($vaccine_centers as $vaccine_center)
                                        <option value="{{ $vaccine_center->id }}"
                                            {{ old('vaccine_center') == $vaccine_center->id ? 'selected' : '' }}
                                        >{{ ucwords($vaccine_center->name) }}
                                            - {{ ucfirst($vaccine_center->address) }} </option>
                                    @endforeach
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        @error('vaccine_center')
                        <span class="error">{{ $message }}</span>
                        @enderror
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2"
                                           type="text"
                                           placeholder=" Valid NID Number *"
                                           minlength="10"
                                           max="16"
                                           name="nid"
                                           value="{{ old('nid') }}"

                                    >
                                </div>
                                @error('nid')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2"
                                           type="text"
                                           placeholder=" Valid Phone Number *"
                                           minlength="8"
                                           max="20"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           required
                                    >
                                </div>
                                @error('phone')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit">Register</button>
                        </div>
                    </form>
                    <div class="note">
                        <h4>Note:</h4>
                        <ul>
                            <li>To get covid 19 vaccine, you must be registered first</li>
                            <li>(*) indicates</li>
                            <li>Please provide <strong>valid email address</strong> to get email about schedule of covid 19 vaccine
                                schedule date
                            </li>
                            <li>Please provide valid <strong>NID number</strong> to search vaccine schedule status later</li>
                            <li>Please provide valid <strong>Phone number</strong> to get SMS notification for covid 19 Vaccine schedule date</li>
                            <li>If already registered; check your status from <a href="{{ route('search') }}">Search
                                    Page</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
