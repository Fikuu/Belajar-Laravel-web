<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\BeritaTerbaruMail;
use Illuminate\Support\Facades\Mail;

class PenulisController extends Controller
{


    ///ARTIKEL
    public function tulisArtikel()
    {
        return view('penulis.artikel_tulis');
    }
    public function semuaArtikel()
    {
        return view('penulis.artikel_semua');
    }

    public function semuaArtikel_edit($id)
    {

        return view('penulis\artikel_edit')->with(['id' => $id]);
    }

    public function saveArtikel(Request $r)
    {
        $data = json_decode($r->list_form_to_php, true);

        if ($r->hasFile('gambar')) {
            if (
                strtolower($r->gambar->getClientMimeType()) == 'image/jpeg' ||
                strtolower($r->gambar->getClientMimeType()) == 'image/jpg' ||
                strtolower($r->gambar->getClientMimeType()) == 'image/png'

            ) {
                if (strtolower($r->gambar->getClientMimeType()) == 'image/jpeg') {
                    $image = imagecreatefromjpeg($r->gambar);
                } elseif (strtolower($r->gambar->getClientMimeType()) == 'image/jpg') {
                    $image = imagecreatefromjpeg($r->gambar);
                } elseif (strtolower($r->gambar->getClientMimeType()) == 'image/png') {
                    $image = imagecreatefrompng($r->gambar);
                }

                $photo = time() . '.jpg';
                imagejpeg($image, public_path('assets/img/' . $photo));
                imagedestroy($image);
            }

            $berita =  Berita::create([
                'user_id' => 1,
                'category_id' => $data['kategori'],
                'judul' => $data['judul'],
                'gambar' => '/assets/img/' . $photo,
                'sumber' => $data['sumber'],
                'isi' => $data['isi'],
                'status' => $data['status'],
                'tgl_terbit' => $data['tgl_terbit']
            ]);

            $details = [
                'judul' => $berita->judul,
                'status' => $berita->status
            ];
        } else {
            $berita = Berita::create([
                'user_id' => 1,
                'category_id' => $data['kategori'],
                'judul' => $data['judul'],
                'sumber' => $data['sumber'],
                'isi' => $data['isi'],
                'status' => $data['status'],
                'tgl_terbit' => $data['tgl_terbit']
            ]);

            $details = [
                'judul' => $berita->judul,
                'status' => $berita->status
            ];
        }
        if (isset($details)) {

            Mail::to('belintex8@gmail.com')->send(new BeritaTerbaruMail($details));
        }


        return 'berhasil simpan data dan kirim email';
    }

    public function getKategori()
    {
        return Category::get();
    }
    public function semuaArtikel_get()
    {
        return Berita::get();
    }
    public function semuaArtikel_edit_get($id)
    {
        return Berita::where('id', $id)->get();
    }
    public function editArtikelSubmit(Request $r)
    {

        $data = json_decode($r->edit_form, true);
        if ($r->hasFile('gambar')) {
            if (
                strtolower($r->gambar->getClientMimeType()) == 'image/jpeg' ||
                strtolower($r->gambar->getClientMimeType()) == 'image/jpg' ||
                strtolower($r->gambar->getClientMimeType()) == 'image/png'

            ) {
                if (strtolower($r->gambar->getClientMimeType()) == 'image/jpeg') {
                    $image = imagecreatefromjpeg($r->gambar);
                } elseif (strtolower($r->gambar->getClientMimeType()) == 'image/jpg') {
                    $image = imagecreatefromjpeg($r->gambar);
                } elseif (strtolower($r->gambar->getClientMimeType()) == 'image/png') {
                    $image = imagecreatefrompng($r->gambar);
                }

                $photo = time() . '.jpg';
                imagejpeg($image, public_path('assets/img/' . $photo));
                imagedestroy($image);
            }

            Berita::where('id', $data[0]['id'])->update([
                'user_id' => 1,
                'category_id' => $data[0]['category_id'],
                'judul' => $data[0]['judul'],
                'gambar' => '/assets/img/' . $photo,
                'sumber' => $data[0]['sumber'],
                'isi' => $data[0]['isi'],
                'status' => $data[0]['status'],
                'tgl_terbit' => $data[0]['tgl_terbit']
            ]);
        }


        return "berhasil Edit";
    }

    public function semuaArtikel_delete($id)
    {
        $berita = Berita::get('id', $id)->first();
        Berita::where('id', $id)->delete();
        if (file_exists(public_path($berita->gambar))) {
            @unlink(public_path($berita->gambar));
        }
        return "berhasil hapus";
    }


    //KATEGORI
    public function kategoriArtikel()
    {
        return view('penulis.kategori_tulis');
    }

    public function semuaKategori()
    {
        return view('penulis\kategori_semua');
    }

    public function semuaKategori_edit($id)
    {
        return view('penulis\kategori_edit')->with(['id' => $id]);
    }

    public function saveKategori(Request $r)
    {

        $data = json_decode($r->list_kategori, true);
        Category::create([

            'kategori' => $data['kategori'],

        ]);

        return 'berhasil simpan data';
    }

    public function semuaKategori_get()
    {

        return Category::get();
    }

    public function semuaKategori_edit_get($id)
    {
        return Category::where('id', $id)->get();
    }

    public function editKategoriSubmit(Request $r)
    {
        $data = json_decode($r->edit_kategori, true);
        Category::where('id', $data[0]['id'])->update([
            'kategori' => $data[0]['kategori'],
        ]);

        return "berhasil Edit";
    }

    public function semuaKategori_detele($id)
    {
        Category::where('id', $id)->delete();
        return "berhasil hapus";
    }


    //PUBLISH
    public function publish()
    {
        return view('penulis.publish');
    }

    public function allDataPublish()
    {
        return Berita::where('status', 'publish')->get();
    }

    //DRAFT
    public function draft()
    {
        return view('penulis.draft');
    }

    public function allDataDraft()
    {
        return Berita::where('status', 'draft')->get();
    }
}
