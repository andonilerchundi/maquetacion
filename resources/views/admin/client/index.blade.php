@php
    $route='client'
@endphp


@extends('admin.layout.table_form')
    
@section('table')

    <table>
        
        <tr>
            <th>Nombre/ Razon Social</th>
            <th>Email</th>
            <th>Telefono</th>
            <th></th>
        </tr>
        
        @foreach($customers as $client_element)
            <tr>
                
             
                <td>
                    {{$client_element->name}}
                </td>
                <td>
                    {{$client_element->email}}
                </td>
        
                <td>
                    {{$client_element->telefono}}
                </td>
               
                <td>
                    <div class="button-container">

                        <button class="edit" id="edit" data-url="{{route('customers_show', ['client' => $client_element->id ])}}"> 
                            <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </button>

                        <button class="remove" data-url="{{route('customers_destroy', ['client' => $client_element->id ])}}">
                            <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z" />
                            </svg>
                        </button>

                    </div>
                </td>
                
            </tr>
        @endforeach  

    </table>

@endsection

@section('form')

    <form class="formulario admin-form" action="{{route("customers_store")}}">

        {{ csrf_field() }}


        <div class="form-group">
            <div class="column">

                <div class="input-container">
                    <input type="hidden" name="id" value="{{isset($client->id) ? $client->id : ''}}">
                </div>
                <div class="label-container">
                    <label for="name">Nombre/Razon Social:</label>
                </div>

                <div class="input-container">
                    <input name="name" value="{{isset($client->name) ? $client->name : ''}}" >
                </div>

                <div class="label-container">
                    <label for="email">Email:</label>
                </div>

                <div class="input-container">
                    <input name="email" type="text" value="{{isset($client->email) ? $client->email : ''}}" >
                </div>

                <div class="label-container">
                    <label for="telefono" >Telefono:</label>
                </div>

                <div class="input-container">
                    <input  name="telefono" value="{{isset($client->telefono) ? $client->telefono : ''}}" >
                </div>

                <div class="label-container">
                    <label for="nif">NIF:</label>
                </div>

                <div class="input-container">
                    <input name="nif"  value="{{isset($client->nif) ? $client->nif : ''}}" >
                </div>
                
            </div>
            <div class="column">
                <div class="label-container">
                    <label for="country">Pais:</label>
                </div>
                <select name="country_id" class="county-box" >
                    <option></option>
                    @foreach ($countries as $country)
                        <option value="{{$country->id}}" {{$client->country_id == $country->id ? "selected" : ""}}>{{$country->name}}</option>
                    @endforeach
                </select> 
            
                <div class="label-container">
                    <label for="cp">CP:</label>
                </div>

                <div class="input-container">
                    <input name="cp" value="{{isset($client->cp) ? $client->cp : ''}}" >
                </div>
                <div class="label-container">
                    <label for="ciudad">Ciudad:</label>
                </div>

                <div class="input-container">
                    <input  name="ciudad" value="{{isset($client->ciudad) ? $client->ciudad : ''}}" >
                </div>
                <div class="label-container">
                    <label for="address">Dirección:</label>
                </div>

                <div class="input-container">
                    <input name="address" value="{{isset($client->address) ? $client->address : ''}}" >
                </div>

               
                <div class="button-form">
                    <div class="button">
                        <button id="send"> Enviar </button>
                    </div>

                    <div class="button">
                        <button id="reload" > Reload </button>
                    </div>
                </div>
            </div>
    </form>

@endsection
    