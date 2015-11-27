@extends('master')
@section('title', 'About')
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">
                <table class="table table-condensed">
                    <tr>
                        <td width="50%">
                            <h3>About</h3>
                            <h4>Learning Laravel 5</h4>
                            <h5>Building Practical Applications</h5>
                            <h6>by Nathan Wu</h6>
                            <h6>support@learninglaravel.net</h6>
                        </td>
                        <td width="50%" class="text-right">
                            @if(Auth::user())
                                <p>
                                    <img src={{ $gravatar }}><br>
                                    <strong>{{ Auth::user()->name }}</strong><br>
                                    {{ Auth::user()->email }} <br>
                                    @if(Auth::user()->hasRole('admin'))
                                        Administrator
                                    @elseif(Auth::user()->hasRole('member'))
                                        Member
                                    @endif
                                    <br>
                                    <a href="https://leanpub.com/user_dashboard/library" target="_blank">Learn Pub Library</a></li>
                                </p>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
