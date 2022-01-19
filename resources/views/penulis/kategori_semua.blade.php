@extends('layouts.lay_penulis')

@section('judul', 'Semua Kategori')
@section('menu_kategori', 'active')
@section('menu_semua_kategori', 'active')

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
                                <th>Kategori</th>
                                <th>gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data,index) in listKategori">
                                <td>@{{ index + 1 }}.</td>
                                <td>@{{ data.kategori }}</td>
                                <td>gambar</td>

                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">Action
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <button class="dropdown-item" @click="editKategori(data.id)">Edit</button>
                                            <button class="dropdown-item" @click="deleteKategori(data.id)">Delete</button>
                                        </div>
                                    </div>
                                </td>

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
                    listKategori: ''
                }
            },
            mounted() {

                this.getData()


            },
            endmounted() {

            },
            methods: {
                getData() {
                    axios.get('/semua-kategori/get/')
                        .then(r => {
                            console.log('sukses');
                            this.listKategori = r.data;
                            console.log(this.listKategori);

                        });

                },
                deleteKategori(item) {
                    axios.get('/semua-kategori/delete/' + item)
                        .then(r => {
                            console.log('sukses Delete');
                            this.getData();

                        });

                },
                editKategori(item) {
                    window.location.href = "/semua-kategori/edit/" + item;
                }



            }
        }

        Vue.createApp(app).mount('#app');
    </script>
@endsection
