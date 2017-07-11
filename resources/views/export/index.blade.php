@extends('layouts.main')
@section('title', 'Export Options')
@section('content')
    @component('components.breadcrumbs')
        <li class="active">Export Options</li>
    @endcomponent

    <div class='page-header'>
        <h3><span class="glyphicon glyphicon-export"></span> Export Options</h3>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Export to Excel</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Export inventory to Excel</label>
                    <a href="{{ route('export.excel.combined') }}" class="btn btn-primary">Inventory - All Images &amp; Details</a>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Export all Images to Excel</label>
                    <a href="{{ route('export.excel.pieces') }}" class="btn btn-primary">All Images</a>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Export all details to Excel</label>
                    <a href="{{ route('export.excel.details') }}" class="btn btn-primary">All Details</a>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Export to PDF (Please be patient, these can take a while to render)</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Export all Images to PDF (List)</label>
                    <a href="{{ route('export.pdf.pieces.list.download') }}" class="btn btn-primary"><span class="glyphicon glyphicon-list"></span> All Images - List</a>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Export all Images to PDF (Grid)</label>
                    <a href="{{ route('export.pdf.pieces.grid.download') }}" class="btn btn-primary"><span class="glyphicon glyphicon-th"></span> All Images - Grid</a>
                </div>
            </form>
        </div>
    </div>
@endsection