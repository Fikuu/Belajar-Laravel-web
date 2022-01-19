@extends('layouts.lay_penulis')

@section('judul', 'Kategori')
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
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" class="form-control" placeholder="Masukkan Kategori"
                                v-model="listKategori.kategori">
                            {{-- V-MODEL samakan dengan variable di bawah , V-model berguna untuk merubah data secara real ketika data berubah maka data di vue js juga akan berubah --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                        <button type="button" class="btn btn-primary float-right px-4" @click="simpan">Submit</button>
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
                    listKategori: {
                        kategori: '',
                    },

                }
            },
            mounted() {

            },
            endmounted() {

            },
            methods: {
                simpan() {
                    console.log("ini simpan");
                    console.log(this.listKategori);

                    let formData = new FormData();
                    formData.append('list_kategori', JSON.stringify(this.listKategori));

                    console.log(formData);
                    axios.post('/saveKategori', formData)
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
