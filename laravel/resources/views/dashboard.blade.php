@extends('master')
@section('title')
    Dashboard
@endsection
@section('content')
    {{--user centered content--}}
    <h4>User centered content</h4>
    <div class="row">
        {{--users--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[0]}}</div>
                            <div>Users</div>
                        </div>
                    </div>
                </div>
                <a href="/users">
                    <div class="panel-footer">
                        <span class="pull-left">View All users</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        {{--groups--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[1]}}</div>
                            <div>Groups</div>
                        </div>
                    </div>
                </div>
                <a href="/groups">
                    <div class="panel-footer">
                        <span class="pull-left">View all groups</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        {{--parties--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-birthday-cake fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[2]}}</div>
                            <div>Parties!</div>
                        </div>
                    </div>
                </div>
                <a href="/parties">
                    <div class="panel-footer">
                        <span class="pull-left">View all parties</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{--Referenda centered content--}}
    <h4>Referenda centered content</h4>
    <div class="row">
        {{--active--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-question fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[3]}}</div>
                            <div>Active Referenda</div>
                        </div>
                    </div>
                </div>
                <a href="/referenda">
                    <div class="panel-footer">
                        <span class="pull-left">View all Referenda</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        {{--non active--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-question fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[4]}}</div>
                            <div>Not active Referenda</div>
                        </div>
                    </div>
                </div>
                <a href="/referenda">
                    <div class="panel-footer">
                        <span class="pull-left">View all Referenda</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        {{--requests--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-question fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[8]}}</div>
                            <div>Referenda requests</div>
                        </div>
                    </div>
                </div>
                <a href="/referenda">
                    <div class="panel-footer">
                        <span class="pull-left">View all referenda</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{--Election centered content--}}
    <h4>Election centered content</h4>
    <div class="row">
        {{--active--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-pencil fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[5]}}</div>
                            <div>Open elections</div>
                        </div>
                    </div>
                </div>
                <a href="/elections">
                    <div class="panel-footer">
                        <span class="pull-left">View All elections</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-pencil fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$all[6]}}</div>
                            <div>Closed elections</div>
                        </div>
                    </div>
                </div>
                <a href="/elections">
                    <div class="panel-footer">
                        <span class="pull-left">View all ellections</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection
