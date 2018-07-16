@extends('layout')

@section('title', 'Currency market')

@section('header')
    @component('components.headerLink', [
        'link' => route('currencies.index'),
        'active' => true
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
    @if ($currencies->count() == 0)
        <p class="text-center">No currencies</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Short name</th>
                <th scope="col">Rate</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($currencies as $currency)
                <tr>
                    <td><img src="{{ $currency['logo_url'] }}" height="24" width="24" alt=""> <a
                                href="{{ route('currencies.show', $currency['id']) }}">{{ $currency['name'] }}</a></td>
                    <td>{{ $currency['short_name'] }}</td>
                    <td>{{ $currency['rate'] }}</td>
                    <td>
                        @can('view', $currency)
                            <a href="{{ route('currencies.show', $currency['id']) }}" class="btn btn-link py-0" title="View"><i class="fas fa-eye"></i> View</a>
                        @endcan
                        @can('update', $currency)
                            <a href="{{ route('currencies.edit', $currency['id']) }}" class="btn btn-link py-0" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                        @endcan
                        @can('delete', $currency)
                            <button title="Delete" class="btn btn-link py-0" onclick="event.preventDefault();
                                let form = document.getElementById('delete-form');
                                form.action = '{{ route('currencies.destroy', $currency['id']) }}';form.submit();">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form id="delete-form" method="post" style="display: none">
            @csrf
            {{ method_field('DELETE') }}
        </form>
    @endisset
@endsection