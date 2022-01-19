@extends('layouts.lay_penulis')

@section('judul', 'Publish')
@section('menu_artikel', 'active')
@section('menu_draft', 'active')

@section('konten')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mantap</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Sumber</th>
                                <th>Isi</th>
                                <th>Status</th>
                                <th>Tanggal Terbit</th>
                                <th>View</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data,index) in draft">
                                <td>@{{ index + 1 }}.</td>
                                <td>@{{ data . judul }}</td>
                                <td>@{{ data . sumber }}</td>
                                <td>@{{ data . isi }}</td>
                                <td>@{{ data . status }}</td>
                                <td>@{{ data . tgl_terbit }}</td>
                                <td>@{{ data . view }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        const app = {
            data() {
                return {
                    draft: ''


                }
            },
            mounted() {
                this.getData();

            },
            endmounted() {

            },
            methods: {
                //fungsinon save di atas
                getData() {
                    axios.get('/draft/get')
                        .then(r => {
                            console.log('sukses');
                            this.draft = r.data;
                            console.log(this.draft);

                        });

                }


            }
        }

        Vue.createApp(app).mount('#app');
    </script>
@endsection
