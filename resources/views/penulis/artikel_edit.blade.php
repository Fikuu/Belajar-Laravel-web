@extends('layouts.lay_penulis')

@section('judul', 'Edit Artikel')
@section('menu_artikel', 'active')
@section('menu_tulis_artikel', 'active')

@section('konten')
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form v-for="(data,index) in list_berita">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" placeholder="Masukkan Judul" v-model="data.judul">
                            {{-- V-MODEL samakan dengan variable di bawah , V-model berguna untuk merubah data secara real ketika data berubah maka data di vue js juga akan berubah --}}
                        </div>

                        <div class="form-group">
                            <label>Katergori</label>
                            <select class="form-control" v-model="data.category_id">
                                <option value="">--Pilihan Kategori--</option>
                                <option v-for="(data,index) in kategori" value="1">
                                    @{{ data.kategori }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="input_gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                        file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Sumber</label>
                            <input type="text" class="form-control" placeholder="Sumber" v-model="data.sumber">
                        </div>

                        <div class="form-group">
                            <label>Isi</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="10"
                                v-model="data.isi"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" v-model="data.status">
                                <option value="">--Pilih Status--</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <input type="datetime" class="form-control" placeholder="Masukkan Tanggal"
                                v-model="data.tgl_terbit">
                        </div>


                    </div>


                    <!-- /.card-body -->


                    <div class="card-footer">

                        <button type="button" class="btn btn-primary float-right px-4" @click="editArtikel">Edit</button>
                        {{-- pemanggilan fungsion dengan vue js pakai click --}}
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        const id_artikel = {{ $id }};
        const app = {
            data() {
                return {
                    list_berita: '',
                    kategori: ''


                }

            },
            mounted() {
                this.getData();
                this.kategoriGet();

            },
            endmounted() {

            },
            methods: {
                getData() {
                    console.log("suskes get data");
                    axios.get('/semua-artikel/edit/get/' + id_artikel)
                        .then(r => {
                            this.list_berita = r.data;
                            console.log(this.list_berita);

                        });

                },
                editArtikel() {
                    console.log("masuk edit");

                    let formData = new FormData();
                    formData.append('edit_form', JSON.stringify(this.list_berita));
                    formData.append('gambar', document.getElementById('input_gambar').files[0]);
                    axios.post('/editArtikel/submit', formData)
                        .then(r => {
                            console.log("sukses edit artikel");
                            console.log(r.data);

                        });
                },
                kategoriGet() {
                    axios.get('/tulis-artikel/getKategori/')
                        .then(r => {
                            console.log('get kategori form database');
                            this.kategori = r.data;
                            console.log(this.kategori);

                        });
                }




            }
        }

        Vue.createApp(app).mount('#app');
    </script>
@endsection
