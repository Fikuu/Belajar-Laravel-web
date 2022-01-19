@extends('layouts.lay_penulis')

@section('judul', 'Semua Artikel')
@section('menu_artikel', 'active')
@section('menu_semua_Artikel', 'active')

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
                                <th>Gambar</th>
                                <th>Sumber</th>
                                <th>Isi</th>
                                <th>Status</th>
                                <th>Tanggal Terbit</th>
                                <th>View</th>
                                <th>gambar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data,index) in list_berita">
                                <td>@{{ index + 1 }}.</td>
                                <td>@{{ data.judul }}</td>
                                <td><img :src="data.gambar" width="150"></td>
                                <td>@{{ data.sumber }}</td>
                                <td>@{{ data.isi }}</td>
                                <td>@{{ data.status }}</td>
                                <td>@{{ data.tgl_terbit }}</td>
                                <td>@{{ data.view }}</td>

                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">Action
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <button class="dropdown-item" @click="editArtikel(data.id)">Edit</button>
                                            <button class="dropdown-item" @click="deleteArtikel(data.id)">Delete</button>
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" @click="pindahPublish">Pulish</button>
                                            <button class="dropdown-item" @click="pindahDraft">Draft</button>

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
                    list_berita: ''


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
                    axios.get('/semua-artikel/get/')
                        .then(r => {
                            console.log('sukses');
                            this.list_berita = r.data;
                            console.log(this.list_berita);

                        });

                },
                deleteArtikel(item) {
                    axios.get('/semua-artikel/delete/' + item)
                        .then(r => {
                            console.log('sukses Delete');
                            this.getData();

                        });

                },
                editArtikel(item) {

                    window.location.href = "/semua-artikel/edit/" + item;
                },
                pindahPublish() {
                    window.location.href = "/publish";
                },
                pindahDraft() {
                    window.location.href = "/draft";
                }



            }
        }

        Vue.createApp(app).mount('#app');
    </script>
@endsection
