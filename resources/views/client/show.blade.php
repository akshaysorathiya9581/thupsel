@extends('layouts.app')
@section('page-title')
    {{clientPrefix()}}{{!empty($client->clients)?$client->clients->client_id:''}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('client.index')}}">{{__('Client')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{clientPrefix()}}{{!empty($client->clients)?$client->clients->client_id:''}} {{__('Details')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>  {{clientPrefix()}}{{!empty($client->clients)?$client->clients->client_id:''}} {{__('Details')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Name')}}</h6>
                                <p class="mb-20">{{$client->name}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Email')}}</h6>
                                <p class="mb-20">{{$client->email}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Phone Number')}}</h6>
                                <p class="mb-20">{{$client->phone_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Company')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->company:'-'}} </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" col-md-12 mb-20">
                        <h5> {{__('Service Address')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Country')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->service_country:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('State')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->service_state:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('City')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->service_city:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Zip Code')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->service_zip_code:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Address')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->service_address:'-'}} </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" col-md-12 mb-20">
                        <h5> {{__('Billing Address')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Billing Country')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->billing_country:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Billing State')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->billing_state:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Billing City')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->billing_city:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Billing Zip Code')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->billing_zip_code:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Billing Address')}}</h6>
                                <p class="mb-20">{{!empty($client->clients)?$client->clients->billing_address:'-'}} </p>
                            </div>
                        </div>


                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-group">
                                <h5 class="mb-20">{{ __('Parts Categories') }}</h5>
                                <ul class="list-unstyled ps-3">
                                    @forelse($partsCategories as $cat)
                                        <li class="mb-1">
                                            <i class="fa fa-circle text-primary me-2" style="font-size: 0.5rem;"></i> {{ $cat->category->name }}
                                        </li>
                                    @empty
                                        <li>-</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-group">
                                <h5 class="mb-20">{{ __('Service Categories') }}</h5>
                                <ul class="list-unstyled ps-3">
                                    @forelse($serviceCategories as $cat)
                                        <li class="mb-1">
                                            <i class="fa fa-circle text-primary me-2" style="font-size: 0.5rem;"></i> {{ $cat->category->name }}
                                        </li>
                                    @empty
                                        <li>-</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
