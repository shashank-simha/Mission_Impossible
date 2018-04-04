@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="team" class="col-md-4 control-label">Team name</label>

                            <div class="col-md-6">
                                <input id="team" type="text" class="form-control" name="team" value="" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="P1" class="col-md-4 control-label">Participant 1</label>

                            <div class="col-md-6">
                                <input id="P1" type="text" class="form-control" name="P1" value="" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Mob1" class="col-md-4 control-label">Mobile number</label>

                            <div class="col-md-6">
                                <input id="Mob1" type="text" class="form-control" name="Mob1" value="" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="P2" class="col-md-4 control-label">Participant 2</label>

                            <div class="col-md-6">
                                <input id="P2" type="text" class="form-control" name="P2" value="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Mob2" class="col-md-4 control-label">Mobile number</label>

                            <div class="col-md-6">
                                <input id="Mob2" type="text" class="form-control" name="Mob2" value="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
