@extends('layouts.header')

@section('content')

<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>

</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4>Unapproved Courses</h4>
                <br>
                <table class="table table-bordered table-hover tablelink">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Level</th>
                            <th>Medium</th>
                            <th>Language</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        <tbody class="unapproved-courses">
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4>Approved Courses</h4>
                <br>

                <table class="table table-bordered table-hover tablelink">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Level</th>
                            <th>Medium</th>
                            <th>Language</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Actions</th>


                        </tr>
                        <tbody class="approved-courses">
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>


@endsection
