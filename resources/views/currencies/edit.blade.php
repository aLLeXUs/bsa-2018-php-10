@extends('layout')

@section('title', 'Add currency')

@section('header')
    @component('components.headerLink', [
        'link' => route('currencies.index')
    ])
        <i class="fas fa-dollar-sign"></i> Currencies
    @endcomponent
    @can('create')
        @component('components.headerLink', [
            'link' => route('currencies.add')
        ])
            <i class="fas fa-plus"></i> Add
        @endcomponent
    @endcan
@endsection

@section('content')
    <form method="post" action="{{ route('currencies.update', $currency['id']) }}">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $currency['name'] }}" placeholder="Name">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Short name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('short_name') ? ' is-invalid' : '' }}" name="short_name" value="{{ old('short_name') ? old('short_name') : $currency['short_name'] }}" placeholder="Short name">
                @if ($errors->has('short_name'))
                    <div class="invalid-feedback">{{ $errors->first('short_name') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Logo url</label>
            <div class="col-sm-10">
                <input type="text" class="form-control{{ $errors->has('logo_url') ? ' is-invalid' : '' }}" name="logo_url" value="{{ old('logo_url') ? old('logo_url') : $currency['logo_url'] }}" placeholder="Logo url">
                @if ($errors->has('logo_url'))
                    <div class="invalid-feedback">{{ $errors->first('logo_url') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Rate</label>
            <div class="col-sm-10">
                <input type="text" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" value="{{ old('rate') ? old('rate') : $currency['rate'] }}" placeholder="Rate">
                @if ($errors->has('rate'))
                    <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group float-right row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection