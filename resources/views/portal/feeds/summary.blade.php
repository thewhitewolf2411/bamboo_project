@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Feeds Summary</p>
            </div>
        </div>
        <div class="portal-table-container">

            <table class="portal-table" id="categories-table">
                <tr>
                    <td>Feed Process ID</td>
                    <td>Feed Type</td>
                    <td>Status</td>
                    <td>Error Log</td>
                    <td>Created</td>
                    <td>Modified</td>
                </tr>

                @foreach($feeds as $feed)

                <tr class="feed-container" data-value="{{$feed->id}}">
                    <td><div class="table-element">{{$feed->id}}</div></td>
                    <td><div class="table-element">{{$feed->feed_type}}</div></td>
                    <td><div class="table-element">{{$feed->status}}</div></td>
                    <td><div class="table-element">{{$feed->countLogs()}}</div></td>
                    <td><div class="table-element">{{$feed->created_at}}</div></td>
                    <td><div class="table-element">{{$feed->updated_at}}</div></td>
                </tr>

                @endforeach
            </table>

            </div>

    </div>

    <div id="view-feeds-log" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Feed Logs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-5">

                <table id="feed-logs-table" class="portal-table">
                    <thead>
                        <tr>
                            <th>Log id</th>
                            <th>Error log</th>
                            <th>Created at</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                    
                </table>

            </div>
            </div>
        </div>
    </div>
@endsection
