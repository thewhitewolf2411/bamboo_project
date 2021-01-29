@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Box Management</p>
        </div>
    </div>
    <div class="portal-content-container">

        <table class="portal-table sortable" id="categories-table">
            <tr>
                <td><div class="table-element">Box No.</div></td>
                <td><div class="table-element">Grade</div></td>
                <td><div class="table-element">Manifacturer</div></td>
                <td><div class="table-element">Network</div></td>
                <td><div class="table-element">Boxed Devices</div></td>
            </tr>
        </table>

    </div>
</div>


@endsection