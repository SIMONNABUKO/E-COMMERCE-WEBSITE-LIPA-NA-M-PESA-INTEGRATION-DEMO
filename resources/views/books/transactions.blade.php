@extends('layouts.store')
@section('content')
<div class="container">
    @if(session()->has('error'))
    <p class="text-danger">{{session('error')}}</p>
    @endif
    <div class="row">
        <div class="col-md8 offset-md-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>

                    </tr>
                </thead>
                <tbody>
                    @if($trans->count() > 0)
                    @foreach($trans as $tran)
                    <tr>
                        <th scope="row">{{$tran->transaction_id}}</th>
                        <td>{{$tran->user->name}}</td>
                        @if($tran->status == 0)
                        <td class="text-warning">Pending</td>
                        @endif
                        @if($tran->status == 1)
                        <td class="text-success">Completed</td>
                        @endif
                        <td>{{$tran->created_at}}</td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection