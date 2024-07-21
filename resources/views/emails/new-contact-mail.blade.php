{{-- <h1>Ciao {{ Auth::user()->name }}!</h1> --}}

<h1>Ciao Admin</h1>
<p>Hai ricevuto una nuova richiesta di contatto</p>

<dl>
    <dt>Da</dt>
    <dd>{{ $lead->name }}</dd>
    <dt>Email</dt>
    <dd>{{ $lead->email }}</dd>
    <dt>Telefono</dt>
    <dd>{{ $lead->phone_number }}</dd>
    <dt>Messaggio</dt>
    <dd>{{ $lead->message }}</dd>
</dl>
