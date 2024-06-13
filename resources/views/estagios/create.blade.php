@extends('main') 

@section('content')

<form method="POST" action="/estagios">
@csrf
<div style="text-align: center;"><b>Aviso Importante:</b> O termo deve ser entregue assinado para a instituição no mínimo 10 dias úteis antes do início do estágio no email {{ $settings->email }}</div>
@include ('estagios.form')

<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>

</form>

@endsection('content')
