@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="span3">
            @include('sidebar.admin')
        </div>
        <div class="span9">
            <div class="content">
                <div class="module message">
                    <div class="module-head">
                        <h3>Pengguna</h3>
                    </div>
                    <div class="module-option clearfix">
                        <div class="pull-right">
                            <a href="{{route('user.create')}}" class="btn btn-primary">Buat Pengguna</a>
                        </div>
                    </div>
                    <div class="module-body table">
                        <table class="table table-message">
                            <tbody>
                                <tr class="heading">
                                    <td class="cell-title">Username</td>
                                    <td class="cell-title">Role</td>
                                    <td class="cell-title">Nama</td>
                                    <td class="cell-title">Email</td>
                                    <td class="cell-title">Waktu Ditambahkan</td>
                                    <td></td>
                                </tr>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->role ? $user->role->name : ''}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at->format('d M Y')}}</td>
                                        <td align="right">
                                            @if (Auth::user()->id != $user->id)
                                            <a href="{{route('user.edit',['id' => $user->id])}}"><i class="icon-edit"></i> Edit
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
