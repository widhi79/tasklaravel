@extends('template\tmpl')

@section('content')
    <div class="card mx-auto shadow" style="width:95%;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users Page</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Add</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <!-- Konten modal Anda akan ditampilkan di sini -->
                <table class="table table-bordered" id="tabelUsers" style="width: 100%;">
                    <thead>
                        <tr>
                            <th hidden>ID User</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Add User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah category -->
                    <form id="tambahUserForm">
                        <div class="form-group">
                            <div class="row">
                                <label for="namaUser">Nama User:</label>
                                <input type="text" class="form-control" id="namaUser" name="namaUser" required>
                            </div>
                            <div class="row">
                                <label for="userEmail">Email:</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                            </div>
                            <div class="row">
                                <label for="pswd">Password:</label>
                                <input type="password" class="form-control" id="pswd" name="pswd" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanUser()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form edit category akan ditambahkan di sini -->
                    <form id="editUserForm">
                        <div class="form-group">
                            <div class="row">
                                <label for="editNamaUser">Nama User:</label>
                                <input type="text" class="form-control" id="editNamaUser" name="editNamaUser" required>
                            </div>
                            <div class="row">
                                <label for="editemail">Email:</label>
                                <input type="email" class="form-control" id="editEmail" name="editEmail" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateUser()">Update</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var selectedUserId;

        $(document).ready(function() {
            console.log('API Token:', '{{ Auth::user()->api_token }}');

            $('#tabelUsers').DataTable({
                ajax: {
                    url: '/api/users',
                    dataSrc: '',
                    headers: {
                        //'Authorization': 'Bearer ' + '{{ Auth::user()->api_token }}'
                        'Authorization': 'Bearer ' +
                            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI4IiwianRpIjoiOTEyNzAyYTQwNzZiM2Q2NmFjNjljZTc5YzhmMmRjYjgyMmJlNWU4NGI5ZDQ1M2ZiMTIwMzJhMGYzNjE3MjZmZDZhZmU1ZjJhMTQwZDk5M2YiLCJpYXQiOjE2OTYwOTA5NTMuNjkzMDM5LCJuYmYiOjE2OTYwOTA5NTMuNjkzMDU1LCJleHAiOjE3Mjc3MTMzNTMuMjA5MTc4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.QgInH2t273RPmhoEUrCOdub1eqfDwWRUhkhUoziR6VACEHT354tTO-W3NbDFK2rqa_lPo3J7ps6wR9ARBPUtqrDfhX5YeCSrB4zG_jDxsoUE86RFc3RmsHb2JepWkckykFwhnxJAECVdk0xT39_klB6r6WLmvXxz-cDb7EHdwCFhAby0LZoUoiNzoyHeQ5Bwrg9iDp_NkRP4JFSretnz1D0ZktIffJptrXVMv-695QyThkGeioyJhBYWijs5mZUydGW6QwLbNck91KNBKWPtZQCivKaONQnUYaJMJZPARt0eZE2G9E5k4sG-Jr4JkqDUi_ds3it0ehkw-apmlSNdPwX9OxfR3p3cfvvaavvxvov0M-Xz-g85p7Pv1PYADaqrxEtgxYpgNz7op4SWbrhhzA85vzC4ZlJlPHdxqGu_OzISyzrh-qHQdQ920nN8xrwJPB-zXhSSekuk29hYv4qI3QKZPzr8kgQnSe3-0cnuAN7MGQSV7DYPrgW68ZDkV5E0ifX2AKTxjLHtAb8aoO3czzreXkkmDRk36lkmP0KDzg2k-Fp5cmei7ZHgHJP8J_VLKpbt40dx4JBf3Hy3-juuZQoT-IRMfBSgJpfls5r7rh9GhYQJYRTmE2fFPvrgs5lbOLN6A4MFRYFxYfDdTlTHIm2yZcrreYCBJFX13mcxfjY'
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Tambahkan tombol aksi di sini (contoh: Edit dan Hapus)
                            return '<button class="btn btn-info" onclick="editUser(' + row.id +
                                ')">Edit</button>';
                        }
                    },
                ]
            });
        });

        function simpanUser() {
            var namaUser = $('#namaUser').val();
            var userEmail = $('#userEmail').val();
            var pswd = $('#pswd').val();

            // Lakukan validasi form sesuai kebutuhan

            // Lakukan AJAX request untuk menyimpan category
            $.ajax({
                type: 'POST',
                url: '/api/users',
                headers: {
                    'Authorization': 'Bearer ' +
                        'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI4IiwianRpIjoiOTEyNzAyYTQwNzZiM2Q2NmFjNjljZTc5YzhmMmRjYjgyMmJlNWU4NGI5ZDQ1M2ZiMTIwMzJhMGYzNjE3MjZmZDZhZmU1ZjJhMTQwZDk5M2YiLCJpYXQiOjE2OTYwOTA5NTMuNjkzMDM5LCJuYmYiOjE2OTYwOTA5NTMuNjkzMDU1LCJleHAiOjE3Mjc3MTMzNTMuMjA5MTc4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.QgInH2t273RPmhoEUrCOdub1eqfDwWRUhkhUoziR6VACEHT354tTO-W3NbDFK2rqa_lPo3J7ps6wR9ARBPUtqrDfhX5YeCSrB4zG_jDxsoUE86RFc3RmsHb2JepWkckykFwhnxJAECVdk0xT39_klB6r6WLmvXxz-cDb7EHdwCFhAby0LZoUoiNzoyHeQ5Bwrg9iDp_NkRP4JFSretnz1D0ZktIffJptrXVMv-695QyThkGeioyJhBYWijs5mZUydGW6QwLbNck91KNBKWPtZQCivKaONQnUYaJMJZPARt0eZE2G9E5k4sG-Jr4JkqDUi_ds3it0ehkw-apmlSNdPwX9OxfR3p3cfvvaavvxvov0M-Xz-g85p7Pv1PYADaqrxEtgxYpgNz7op4SWbrhhzA85vzC4ZlJlPHdxqGu_OzISyzrh-qHQdQ920nN8xrwJPB-zXhSSekuk29hYv4qI3QKZPzr8kgQnSe3-0cnuAN7MGQSV7DYPrgW68ZDkV5E0ifX2AKTxjLHtAb8aoO3czzreXkkmDRk36lkmP0KDzg2k-Fp5cmei7ZHgHJP8J_VLKpbt40dx4JBf3Hy3-juuZQoT-IRMfBSgJpfls5r7rh9GhYQJYRTmE2fFPvrgs5lbOLN6A4MFRYFxYfDdTlTHIm2yZcrreYCBJFX13mcxfjY'
                },
                data: {
                    'name': namaUser,
                    'email': userEmail,
                    'password': pswd
                },
                success: function(data) {
                    // Handle kesuksesan, seperti menutup modal, membersihkan form, dll.
                    $('#tambahModal').modal('hide');
                    $('#tambahUserForm')[0].reset();
                    // Refresh data tabel jika diperlukan
                    $('#tabelUsers').DataTable().ajax.reload();
                },
                error: function(error) {
                    // Handle error, tampilkan pesan atau tindakan yang sesuai
                    console.error('Error:', error);
                }
            });
        }

        function editUser(id) {
            // Lakukan AJAX request untuk mendapatkan data category berdasarkan
            selectedUserId = id;
            $.ajax({
                type: 'GET',
                url: '/api/users/' + id,
                headers: {
                    'Authorization': 'Bearer ' +
                        'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI4IiwianRpIjoiOTEyNzAyYTQwNzZiM2Q2NmFjNjljZTc5YzhmMmRjYjgyMmJlNWU4NGI5ZDQ1M2ZiMTIwMzJhMGYzNjE3MjZmZDZhZmU1ZjJhMTQwZDk5M2YiLCJpYXQiOjE2OTYwOTA5NTMuNjkzMDM5LCJuYmYiOjE2OTYwOTA5NTMuNjkzMDU1LCJleHAiOjE3Mjc3MTMzNTMuMjA5MTc4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.QgInH2t273RPmhoEUrCOdub1eqfDwWRUhkhUoziR6VACEHT354tTO-W3NbDFK2rqa_lPo3J7ps6wR9ARBPUtqrDfhX5YeCSrB4zG_jDxsoUE86RFc3RmsHb2JepWkckykFwhnxJAECVdk0xT39_klB6r6WLmvXxz-cDb7EHdwCFhAby0LZoUoiNzoyHeQ5Bwrg9iDp_NkRP4JFSretnz1D0ZktIffJptrXVMv-695QyThkGeioyJhBYWijs5mZUydGW6QwLbNck91KNBKWPtZQCivKaONQnUYaJMJZPARt0eZE2G9E5k4sG-Jr4JkqDUi_ds3it0ehkw-apmlSNdPwX9OxfR3p3cfvvaavvxvov0M-Xz-g85p7Pv1PYADaqrxEtgxYpgNz7op4SWbrhhzA85vzC4ZlJlPHdxqGu_OzISyzrh-qHQdQ920nN8xrwJPB-zXhSSekuk29hYv4qI3QKZPzr8kgQnSe3-0cnuAN7MGQSV7DYPrgW68ZDkV5E0ifX2AKTxjLHtAb8aoO3czzreXkkmDRk36lkmP0KDzg2k-Fp5cmei7ZHgHJP8J_VLKpbt40dx4JBf3Hy3-juuZQoT-IRMfBSgJpfls5r7rh9GhYQJYRTmE2fFPvrgs5lbOLN6A4MFRYFxYfDdTlTHIm2yZcrreYCBJFX13mcxfjY'
                },
                success: function(data) {
                    // Isi form edit dengan data category
                    $('#editNamaUser').val(data.name);
                    $('#editEmail').val(data.email);

                    // Tampilkan modal edit
                    $('#editModal').modal('show');
                },
                error: function(error) {
                    // Handle error, tampilkan pesan atau tindakan yang sesuai
                    console.error('Error:', error);
                }
            });
        }

        function updateUser() {
            var id = selectedUserId; // Gunakan ID category yang telah disimpan
            var namaUser = $('#editNamaUser').val();
            var email = $('#editEmail').val();

            // Lakukan validasi form sesuai kebutuhan

            // Lakukan AJAX request untuk menyimpan perubahan pada category
            $.ajax({
                type: 'PUT',
                url: '/api/users/' + id,
                headers: {
                    'Authorization': 'Bearer ' +
                        'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI4IiwianRpIjoiOTEyNzAyYTQwNzZiM2Q2NmFjNjljZTc5YzhmMmRjYjgyMmJlNWU4NGI5ZDQ1M2ZiMTIwMzJhMGYzNjE3MjZmZDZhZmU1ZjJhMTQwZDk5M2YiLCJpYXQiOjE2OTYwOTA5NTMuNjkzMDM5LCJuYmYiOjE2OTYwOTA5NTMuNjkzMDU1LCJleHAiOjE3Mjc3MTMzNTMuMjA5MTc4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.QgInH2t273RPmhoEUrCOdub1eqfDwWRUhkhUoziR6VACEHT354tTO-W3NbDFK2rqa_lPo3J7ps6wR9ARBPUtqrDfhX5YeCSrB4zG_jDxsoUE86RFc3RmsHb2JepWkckykFwhnxJAECVdk0xT39_klB6r6WLmvXxz-cDb7EHdwCFhAby0LZoUoiNzoyHeQ5Bwrg9iDp_NkRP4JFSretnz1D0ZktIffJptrXVMv-695QyThkGeioyJhBYWijs5mZUydGW6QwLbNck91KNBKWPtZQCivKaONQnUYaJMJZPARt0eZE2G9E5k4sG-Jr4JkqDUi_ds3it0ehkw-apmlSNdPwX9OxfR3p3cfvvaavvxvov0M-Xz-g85p7Pv1PYADaqrxEtgxYpgNz7op4SWbrhhzA85vzC4ZlJlPHdxqGu_OzISyzrh-qHQdQ920nN8xrwJPB-zXhSSekuk29hYv4qI3QKZPzr8kgQnSe3-0cnuAN7MGQSV7DYPrgW68ZDkV5E0ifX2AKTxjLHtAb8aoO3czzreXkkmDRk36lkmP0KDzg2k-Fp5cmei7ZHgHJP8J_VLKpbt40dx4JBf3Hy3-juuZQoT-IRMfBSgJpfls5r7rh9GhYQJYRTmE2fFPvrgs5lbOLN6A4MFRYFxYfDdTlTHIm2yZcrreYCBJFX13mcxfjY'
                },
                data: {
                    'name': namaUser,
                    'email': email
                },
                success: function(data) {
                    // Handle kesuksesan, seperti menutup modal, membersihkan form, dll.
                    $('#editModal').modal('hide');
                    $('#editUserForm')[0].reset();
                    // Refresh data tabel jika diperlukan
                    $('#tabelUsers').DataTable().ajax.reload();
                },
                error: function(error) {
                    // Handle error, tampilkan pesan atau tindakan yang sesuai
                    console.error('Error:', error);
                    console.log('Server Response:', error.responseJSON);
                }
            });
        }
    </script>
@endsection
