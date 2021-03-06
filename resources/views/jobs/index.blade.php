@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Jobs</h1>
            <div class="pull-right">
                <a href="/jobs/create" class="btn btn-primary">Add New</a>
            </div>
        </div>
    <table class="table">
        <thead>
        <th>Title</th>
        <th>Posted by</th>
        <th>Created at</th>
        <th>Approved</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>{{$job->title}}</td>
                <td>{{$job->user->name}}</td>
                <td>{{$job->created_at}}</td>
                <td>
                    @include('jobs.approve', ['job' => $job])
                </td>
                <td>
                    <a href="/jobs/{{$job->id}}" class="btn btn-primary">view</a>
                    @if(Auth::check() && Auth::user()->isAdmin())

                        <a href="/jobs/{{$job->id}}/edit" class="btn btn-warning">edit</a>
                        <form action="/jobs/{{$job->id}}" method="post" style="display: inline;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">
                                delete
                            </button>
                        </form>
                    @endif


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $jobs->links() }}
    </div>
@stop