@extends('layouts.lay_penulis')

@section('judul', 'Tulis Artikel')
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
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" placeholder="Masukkan Judul" v-model="listform.judul">
                            {{-- V-MODEL samakan dengan variable di bawah , V-model berguna untuk merubah data secara real ketika data berubah maka data di vue js juga akan berubah --}}
                        </div>

                        <div class="form-group">
                            <label>Katergori</label>
                            <select class="form-control" v-model="listform.kategori">
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
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Sumber</label>
                            <input type="text" class="form-control" placeholder="Sumber" v-model="listform.sumber">
                        </div>

                        <div class="form-group">
                            <label>Isi</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="10"
                                v-model="listform.isi"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" v-model="listform.status">
                                <option value="">--Pilih Status--</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <input type="date" class="form-control" placeholder="Masukkan Tanggal"
                                v-model="listform.tgl_terbit">
                        </div>


                    </div>


                    <!-- /.card-body -->


                    <div class="card-footer">

                        <button type="button" class="btn btn-primary float-right px-4" @click="save">Submit</button>
                        {{-- pemanggilan fungsion dengan vue js pakai click --}}
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        const app = {
            data() {
                return {
                    listform: {
                        judul: '', //isi broo
                        kategori: '',
                        gambar: '',
                        sumber: '',
                        isi: '',
                        status: '',
                        tgl_terbit: '',
                    },

                    kategori: ''
                }
            },
            mounted() {
                // Pemanggilan di mounted pakai this
                // console.log("hello");
                // console.log(this.judul);
                this.kategoriGet();




            },
            endmounted() {

            },
            methods: {
                //fungsinon save di atas
                save() {
                    console.log("ini save");
                    console.log(this.listform);


                    let formData = new FormData();
                    formData.append('list_form_to_php', JSON.stringify(this.listform));
                    formData.append('gambar', document.getElementById('input_gambar').files[0]);

                    axios.post('/saveArtikel', formData)
                        .then(r => {
                            console.log("sukses");
                            console.log(r.data);

                        });

                },

                kategoriGet() {
                    axios.get('/tulis-artikel/getKategori/')
                        .then(r => {
                            console.log('sukses');
                            this.kategori = r.data;
                            console.log(this.kategori);

                        });
                },

                uploadGambar() {

                    let formData = new FormData();
                    formData.append('file', document.getElementById('file').files[0]);

                    axios.post('/Upload/File', formData).then(function(response) {
                        console.log(response.formData);
                    });
                }


            }
        }

        Vue.createApp(app).mount('#app');
    </script>
@endsection
