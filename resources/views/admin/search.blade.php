@extends('layouts.admin-master')

@section('title')
	 Search
@endsection

@section('page_title')
	Search Item
@endsection

@section('content')
<div class="panel panel-info">
        <div class="panel-heading"><b>{{ $searchResults->count() }} results found for "{{ request('query') }}"</b></div>
    
        <div class="panel-body">
    
            @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                <h2>{{ ucfirst($type) }}</h2>
    
                @foreach($modelSearchResults as $searchResult)
                    <ul>
                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                    </ul>
                @endforeach
            @endforeach
    
        </div>
    </div>
@endsection