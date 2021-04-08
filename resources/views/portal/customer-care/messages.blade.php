@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Messages</p>
        </div>
    </div>

    <div class="portal-table-container">

        <table class="portal-table" id="messages">
            <tr>
                <td><div class="table-element">Message from</div></td>
                <td><div class="table-element">Email</div></td>
                <td><div class="table-element">Phone number</div></td>
                <td><div class="table-element">Title</div></td>
                <td><div class="table-element">Seen</div></td>
            </tr>
            @foreach ($messages as $message)
            <tr class="message" data-value="{{$message->id}}">
                <td><div class="table-element">{{$message->first_name . " " . $message->last_name}}</div></td>
                <td><div class="table-element">{{$message->email}}</div></td>
                <td><div class="table-element">{{$message->telephone}}</div></td>
                <td><div class="table-element">{{$message->order_number}}</div></td>
                <td><div class="table-element">@if($message->seen) Yes @else No @endif</div></td>
            </tr>
            @endforeach
        </table>

    </div>
</div>

<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="noteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="color: black;" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-2">

            <div class="row">
                <div class="col-md-2"><p>From:</p></div>
                <div class="col-md-2" id="message-from-name"><p></p></div>
                <div class="col-md-2"><p>Email:</p></div>
                <div class="col-md-2" id="message-from-email"><p></p></div>
            </div>
            <div id="message-content">
                Message:
                <p></p>
            </div>

        </div>
        <div class="modal-footer">
            <a href="" id="reply-btn" class="btn btn-primary btn-blue">Reply</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


@endsection