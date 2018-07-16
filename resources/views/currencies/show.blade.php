@extends('layout')

@section('title', "Currency - {$currency['name']}")

@section('header')
    @component('components.headerLink', [
        'link' => route('currencies.index')
    ])
        <i class="fas fa-dollar-sign"></i> Currencies
    @endcomponent
    @can('currency.create')
        @component('components.headerLink', [
            'link' => route('currencies.add')
        ])
            <i class="fas fa-plus"></i> Add
        @endcomponent
    @endcan
@endsection

@section('content')
    <table class="table">
        <tbody>
        <tr>
            <th scope="row">Logo</th>
            <td><img src="{{ $currency['logo_url'] }}" alt=""></td>
        </tr>
        <tr>
            <th scope="row">Name</th>
            <td>{{ $currency['name'] }}</td>
        </tr>
        <tr>
            <th scope="row">Short name</th>
            <td>{{ $currency['short_name'] }}</td>
        </tr>
        <tr>
            <th scope="row">Rate</th>
            <td>{{ $currency['rate'] }}</td>
        </tr>
        </tbody>
    </table>
    <div class="float-right row">
        @can('update', $currency)
        <a href="{{ route('currencies.edit', $currency['id']) }}" class="btn btn-primary edit-button"><i class="fas fa-edit"></i> Edit</a>
        @endcan
        @can('delete', $currency)
        <form method="post" action="{{ route('currencies.destroy', $currency['id']) }}">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" title="Delete" class="btn btn-danger ml-2 delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
        </form>
        @endcan
    </div>
@endsection