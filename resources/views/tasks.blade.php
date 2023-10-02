@extends('template\tmpl')

@section('content')
    <div class="card mx-auto shadow" style="width:95%;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tasks Page</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Add</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <!-- Konten modal Anda akan ditampilkan di sini -->
                <table class="table table-bordered" id="tabelTasks" style="width: 100%;">
                    <thead>
                        <tr>
                            <th hidden>ID Task</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log('API Token:', '{{ Auth::user()->api_token }}');

            $('#tabelTasks').DataTable({
                ajax: {
                    url: '/api/tasks',
                    dataSrc: '',
                    headers: {
                        //'Authorization': 'Bearer ' + '{{ Auth::user()->api_token }}'
                        'Authorization': 'Bearer ' +
                            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI4IiwianRpIjoiOTEyNzAyYTQwNzZiM2Q2NmFjNjljZTc5YzhmMmRjYjgyMmJlNWU4NGI5ZDQ1M2ZiMTIwMzJhMGYzNjE3MjZmZDZhZmU1ZjJhMTQwZDk5M2YiLCJpYXQiOjE2OTYwOTA5NTMuNjkzMDM5LCJuYmYiOjE2OTYwOTA5NTMuNjkzMDU1LCJleHAiOjE3Mjc3MTMzNTMuMjA5MTc4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.QgInH2t273RPmhoEUrCOdub1eqfDwWRUhkhUoziR6VACEHT354tTO-W3NbDFK2rqa_lPo3J7ps6wR9ARBPUtqrDfhX5YeCSrB4zG_jDxsoUE86RFc3RmsHb2JepWkckykFwhnxJAECVdk0xT39_klB6r6WLmvXxz-cDb7EHdwCFhAby0LZoUoiNzoyHeQ5Bwrg9iDp_NkRP4JFSretnz1D0ZktIffJptrXVMv-695QyThkGeioyJhBYWijs5mZUydGW6QwLbNck91KNBKWPtZQCivKaONQnUYaJMJZPARt0eZE2G9E5k4sG-Jr4JkqDUi_ds3it0ehkw-apmlSNdPwX9OxfR3p3cfvvaavvxvov0M-Xz-g85p7Pv1PYADaqrxEtgxYpgNz7op4SWbrhhzA85vzC4ZlJlPHdxqGu_OzISyzrh-qHQdQ920nN8xrwJPB-zXhSSekuk29hYv4qI3QKZPzr8kgQnSe3-0cnuAN7MGQSV7DYPrgW68ZDkV5E0ifX2AKTxjLHtAb8aoO3czzreXkkmDRk36lkmP0KDzg2k-Fp5cmei7ZHgHJP8J_VLKpbt40dx4JBf3Hy3-juuZQoT-IRMfBSgJpfls5r7rh9GhYQJYRTmE2fFPvrgs5lbOLN6A4MFRYFxYfDdTlTHIm2yZcrreYCBJFX13mcxfjY'
                    },
                    error: function(error) {
                        // Handle error, tampilkan pesan atau tindakan yang sesuai
                        console.error('Error:', error);
                        console.log('Server Response:', error.responseJSON);
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
            })
        })
    </script>
@endsection
