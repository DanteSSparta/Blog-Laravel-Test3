@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <h1 class="text-center">Filters</h1>
        <table class="table">
        @foreach($filters as $filter)
                <tr>
                    <td>{{$filter->word}}</td>
                    <td>
                        <form method="post" action="{{route('filters.destroy', $filter)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default" style="width: 100px; float: left;">Delete</button>
                        </form>
                    </td>
                </tr>
        @endforeach
        </table>
        <hr>
        <form method="post" action="/filters">
            {{csrf_field()}}
            <div class="form-group">
                <label for="word">Input your filter word</label>
                <input type="text" name="word" id="word">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
@endsection

@section('footer')


@endsection