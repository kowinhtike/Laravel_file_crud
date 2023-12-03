@extends('layouts.ajax_master')

@section('title', 'Contact Page')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto my-3 d-flex justify-content-between align-items-center">
                <h2>All contacts</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addContactModal">
                    Add Contact
                </button>
            </div>

            <div class="col-10 mx-auto">
                <table id="contactTable" class="table hover table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr id="cid{{ $contact->id }}">
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="editContact({{ $contact->id }})">Edit</button>
                                    <button class="btn btn-danger"
                                        onclick="deleteContact({{ $contact->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Add Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addContactForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <button type="submit" class="btn btn-dark my-3 mx-auto">Crete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Contact edit Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editContactForm">
                        @csrf
                        <input type="hidden" name="id" id="id1">
                        <div class="mb-3">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" name="name" id="name1">
                        </div>
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone1">
                        </div>
                        <button type="submit" class="btn btn-dark my-3 mx-auto">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $("#addContactForm").submit(e => {
            e.preventDefault();

            let name = $("#name").val();
            let phone = $("#phone").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "/contact/store",
                type: 'POST',
                data: {
                    name,
                    phone,
                    _token
                },
                success: response => {
                    console.log(response);
                    $("#addContactForm")[0].reset();
                    const inputDateString = response.contact.created_at;
                    const date = new Date(inputDateString);
                    const formattedDateString = date.toLocaleDateString("en-GB", {
                        day: "numeric",
                        month: "numeric",
                        year: "numeric"
                    });

                    $("#contactTable tbody").prepend(`
                    <tr id="cid${response.contact.id}" >
                            <td>${response.contact.id}</td>
                            <td>${response.contact.name}</td>
                            <td>${response.contact.phone}</td>
                            <td>${formattedDateString}</td>
                            <td>
                                <button class="btn btn-primary"  onclick="editContact(${response.contact.id})">Edit</button>
                                <button class="btn btn-danger" onclick="deleteContact(${response.contact.id})" >Delete</button>
                            </td>
                        </tr>
                    `);

                    $("#addContactModal").modal('hide');

                    Swal.fire({
  title: "Successful!",
  text: "You added the data!",
  icon: "success"
});
                }
            })
        });
    </script>

    <script>
        const editContact = id => {
            $("#editContactModal").modal('toggle');
            $.get('/contact/edit/' + id, contact => {
                $("#id1").val(contact.id)
                $("#name1").val(contact.name)
                $("#phone1").val(contact.phone)
            })
        }

        $("#editContactForm").submit(e => {
            e.preventDefault();

            var id = $("#id1").val();
            var name = $("#name1").val();
            var phone = $("#phone1").val();
            var _token = $("input[name=_token]").val();

            console.log(id + name + phone + _token)

            $.ajax({
                url: "/contact/update",
                type: 'POST',
                data: {
                    id,
                    name,
                    phone,
                    _token
                },
                success: response => {
                    $("#editContactModal").modal('toggle');
                    $(`#contactTable tbody #cid${response.contact.id} td:nth-child(1)`).text(response
                        .contact.id)
                    $(`#contactTable tbody #cid${response.contact.id} td:nth-child(2)`).text(response
                        .contact.name)
                    $(`#contactTable tbody #cid${response.contact.id} td:nth-child(3)`).text(response
                        .contact.phone)
                        Swal.fire({
  title: "Successful!",
  text: "You updated this data!",
  icon: "success"
});
                }
            })
        })
    </script>
    <script>
        const deleteContact = id => {
            if (confirm("Are you sure want to delete?")) {
                // $.get('/contact/delete/' + id, contact => {
                //     $(`#cid${id}`).remove();
                // });

                var _token = $("input[name=_token]").val();
                $.ajax({
                url: "/contact/delete/"+id,
                type: 'POST',
                data: {
                    _token
                },
                success: response => {
                    $(`#cid${id}`).remove();
                    Swal.fire({
  title: "Successful!",
  text: "You deleted this item!",
  icon: "success"
});
                }
            });


            }

        }
    </script>
@endpush
