@extends('layouts.app')

@section('content')
<style>
    .info-box {
      min-height: 140px;
      border: 1px solid black;
      margin-bottom: 30px;
      padding: 20px;
      color: white;
      -webkit-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
      box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
    }
    .info-box i {
      display: block;
      height: 100px;
      font-size: 60px;
      line-height: 100px;
      width: 100px;
      float: left;
      text-align: center;
      border-right: 2px solid rgba(255, 255, 255, 0.5);
      margin-right: 20px;
      padding-right: 20px;
      color: rgba(255, 255, 255, 0.75);

      text-decoration: none;
    }
    .info-box .count {
      margin-top: -10px;
      font-size: 34px;
      font-weight: 700;
    }
    .info-box .title {
      font-size: 18px;
      
      font-weight: 300;
    }
    .info-box .desc {
      margin-top: 10px;
      font-size: 12px;
    }
    .info-box.danger {
      background: #ff5454;
      border: 1px solid #ff2121;
    }
    .info-box.warning {
      background: #fabb3d;
      border: 1px solid #f9aa0b;
    }
    .info-box.primary {
      background: #20a8d8;
      border: 1px solid #1985ac;
    }
    .info-box.info {
      background: #67c2ef;
      border: 1px solid #39afea;
    }
    .info-box.success {
      background: #79c447;
      border: 1px solid #61a434;
    }
    a:hover {
        text-decoration: none;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="text-primary"><i class="fa fa-dashboard"></i> Dashboard</h2>

            <br>
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ url('/tools/stair-calculator') }}">
                        <div class="info-box info">
                            <i class="fa fa-calculator"></i>

                            <div class="title">
                                Stair Calculator
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
