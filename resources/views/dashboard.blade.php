@extends('layouts.app')
@section('content')
<div style="display:flex; justify-content:center;">
        <div class="col-md-6 col-md-offset-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                </div>
            </div>
            <div class="panel-body">
                <table>
                    <tr> 
                        <td>
                             <img style='width:100px; heigth:100px;'src='{{$film['Poster']}}' />
                        </td> 

                        <td> 
                             <h3>{{$film['Title']}} </h3>
                             <p>{{$film['Plot']}}</p>
                        </td> 
                    </tr>
                </table>
            </div>
            <div class="panel-footer">

            </div>
        </div>
</div>              
@endsection