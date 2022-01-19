@extends('layouts.lay_penulis')

@section('judul', 'Edit Kategori')
@section('menu_kategori', 'active')
@section('menu_sub_kategori', 'active')

@section('konten')
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form v-for="(data,index) in listKategori">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" class="form-control" placeholder="Masukkan Kategori"
                                v-model="data.kategori">
                            {{-- V-MODEL samakan dengan variable di bawah , V-model berguna untuk merubah data secara real ketika data berubah maka data di vue js juga akan berubah --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                        <button type="button" class="btn btn-primary float-right px-4" @click="editKategori">Submit</button>
                        {{-- pemanggilan fungsion dengan vue js pakai click --}}
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        const id_kategori = {{ $id }};
        const app = {
            data() {
                return {
                    listKategori: ''

                }
            },
            mounted() {
                this.getData();

            },
            endmounted() {

            },
            methods: {
                getData() {
                    axios.get('/semua-kategori/edit/get/' + id_kategori)
                        .then(r => {
                            this.listKategori = r.data;
                            console.log(this.listKategori);

                        });

                },
                editKategori() {
                    console.log("masuk edit");

                    let formData = new FormData();
                    formData.append('edit_kategori', JSON.stringify(this.listKategori));
                    axios.post('/editKategori/submit', formData)
                        .then(r => {
                            console.log("sukses");
                            console.log(r.data);

                        });
                }




            }
        }

        Vue.createApp(app).mount('#app');
    </script>
@endsection
