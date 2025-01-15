<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Skill;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Mitra;
// use Intervention\Image\Image;
use App\Models\Pendaftar;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    //All About Navigasi
    public function showHome() {
        $kegiatans = Kegiatan::withCount('pendaftars')->get()
         ->take(3) ;
         foreach ($kegiatans as $kegiatan) {
            // Menghitung sisa hari dengan penutupan dihitung sampai akhir hari (23:59:59)
            $kegiatan->sisa_hari = Carbon::now()->diffInDays(Carbon::parse($kegiatan->tgl_penutupan)->endOfDay(), false);
        }
        return view('user.layout.index', compact('kegiatans', 'kegiatan'));
    }

    public function showDaftarKegiatan() {
        $kegiatans = Kegiatan::withCount('pendaftars')->get();
        $totalKegiatan = $kegiatans->count();
        $kategori = Kategori::all();
        
        foreach ($kegiatans as $kegiatan) {
            // Menghitung sisa hari dengan penutupan dihitung sampai akhir hari (23:59:59)
            $kegiatan->sisa_hari = Carbon::now()->diffInDays(Carbon::parse($kegiatan->tgl_penutupan)->endOfDay(), false);
        }
        return view('user.layout.daftar-volunteer', compact('kegiatans', 'totalKegiatan', 'kategori'));
    }

    public function showDaftarKegiatanPage($id)
    {   
        $user = User::find($id);
        $kegiatans = Kegiatan::withCount('pendaftars')->get();
        
        $totalKegiatan = $kegiatans->count();
        $kategori = Kategori::all();

        foreach ($kegiatans as $kegiatan) {
            // Menghitung sisa hari dengan penutupan dihitung sampai akhir hari (23:59:59)
            $kegiatan->sisa_hari = Carbon::now()->diffInDays(Carbon::parse($kegiatan->tgl_penutupan)->endOfDay(), false);
        }        

        return view('user.layout.daftar-volunteer', compact( 'kegiatans', 'user', 'totalKegiatan', 'kategori'));
    }

    // All About Detail User
    public function showDetailUserPage($id)
    {
        $user = User::find($id);
        $gender = ['Perempuan', 'Laki-Laki'];
        $pendidikanTerakhir = ['SD', 'SMP', 'SMA/SMK', 'Diploma (D1 - D4)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)'];
        return view('user.layout.profile', compact('user', 'gender', 'pendidikanTerakhir'));
    }

    public function editUserAction(Request $request, $id)
    {
        $user = User::find($id);
        $gender = ['Perempuan', 'Laki-Laki'];
        $pendidikanTerakhir = ['SD', 'SMP', 'SMA/SMK', 'Diploma (D1 - D4)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)'];
        $user->nama_user = $request->nama_user;
        $user->bio = $request->bio;
        $user->usia = $request->usia;
        $user->domisili = $request->domisili;
        $user->gender = $request->gender;
        $user->pendidikan_terakhir = $request->pendidikan_terakhir;
        $user->deskripsi=$request->deskripsi;

        if ($request->hasFile('cv')) {
            if ($user->cv) {
                $oldCv = storage_path('app/public/cv/' . $user->cv);
                if (File::exists($oldCv)) {
                    File::delete($oldCv);
                }
            }

            $extension = $request->file('cv')->getClientOriginalExtension();
            $newName = $request->nama_user.'-'.'cv'.'-'.now()->timestamp.'.'.$extension;
            $request->file('cv')->storeAs('cv', $newName, 'public');
            
            // Update field 'cv' di tabel users
            $user->cv = $request['cv'] = $newName;
            $user->save();
        }

        $user->save();

        return redirect()->back()->with([
            'success' => 'User berhasil diupdate.',
            'gender' => $gender,
            'pendidikanTerakhir' => $pendidikanTerakhir
        ]);
    }
    
    public function editFotoProfileAction(Request $request, $id)
    {

        // Ambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Menghapus gambar lama jika ada
        if ($user->foto_profile) {
            $oldImage = storage_path('app/public/foto-profile/' . $user->foto_profile);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }

        // Proses file upload
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $newName = $user->nama_user . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension(); // Nama unik
            $path = $file->storeAs('public/foto-profile', $newName); // Simpan ke storage

            // Simpan nama file ke database
            $user->foto_profile = $newName;
            $user->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload foto.');
    }

    public function editContactAction(Request $request, $id) 
    {
        $user = User::find($id);
        $user->nomor_telephone = $request->nomor_telephone;
        $user->email_user = $request->email_user;
        $user->instagram = $request->instagram;
        $user->linkedIn = $request->linkedIn;

        $user->save();

        return redirect()->back();
    }

    public function editAkunAction(Request $request, $id) 
    {
        $user = User::find($id);
        $user->username = $request->username;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back();
    }

    public function addSkillAction(Request $request, $id)
    {
        // Temukan user
        $user = User::findOrFail($id);

        // Temukan atau buat skill baru
        $skill = Skill::firstOrCreate(['nama_skill' => $request->input('nama_skill')]);

        // Hubungkan skill dengan user
        $user->skills()->attach($skill->id_skill);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Kemampuan berhasil ditambahkan.');
    }

    public function removeSkill($id, $id_skill)
    {
        // Temukan user
        $user = User::find($id);

        // Hapus hubungan skill dengan user
        $user->skills()->detach($id_skill);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Kemampuan berhasil dihapus.');
    }

    public function addExperienceAction(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $experience = new Experience;

        $experience->id_user = $user->id;
        $experience->judul_kegiatan = $request->judul_kegiatan;
        $experience->lokasi_kegiatan = $request->lokasi_kegiatan;
        $experience->tgl_mulai = $request->tgl_mulai;
        $experience->tgl_selesai = $request->tgl_selesai;
        $experience->deskripsi = $request->deskripsi;
        $experience->mitra = $request->mitra;

        $experience->save();

        return redirect()->back();
    }

    public function editExperienceAction(Request $request, $id, $id_experience)
    {
        $user = User::find($id);
        $experience = Experience::findOrFail($id_experience);

        $experience->id_user = $user->id;
        $experience->judul_kegiatan = $request->judul_kegiatan;
        $experience->lokasi_kegiatan = $request->lokasi_kegiatan;
        $experience->tgl_mulai = $request->tgl_mulai;
        $experience->tgl_selesai = $request->tgl_selesai;
        $experience->deskripsi = $request->deskripsi;
        $experience->mitra = $request->mitra;

        $experience->save();

        // Untuk form biasa, lakukan redirect
        return redirect()->back();
    }

    public function removeExperienceAction($id, $id_experience)
    {
        // Temukan user
        $user = User::find($id);
        $experience = $user->experiences()->where('id_experience', $id_experience)->first();

        $experience->delete();

        return redirect()->back();
    }

    //All About Pendaftaran
    public function addPendaftaranAction(Request $request, $id, $id_kegiatan)
    {
        $user = User::findOrFail($id);
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        // Cek apakah user sudah mendaftar ke kegiatan ini sebelumnya
        $existingPendaftaran = Pendaftar::where('id_user', $user->id)
                                     ->where('id_kegiatan', $kegiatan->id_kegiatan)
                                     ->exists();

        if ($existingPendaftaran) {
            return redirect()->route('user.daftarKegiatan', $id)
                            ->with('error', 'Anda sudah mendaftar kegiatan ini.');
        }
        
        $user = User::findOrFail($id);
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $pendaftar = new Pendaftar;
        $pendaftar->motivasi = $request->motivasi;
        $pendaftar->status_applicant = 'In-review';
        $pendaftar->id_user= $user->id;
        $pendaftar->id_kegiatan = $kegiatan->id_kegiatan;
        
        if ($request->hasFile('cv')) {

            if ($user->cv) {
                $oldCv = storage_path('app/public/cv/' . $user->cv);
                if (File::exists($oldCv)) {
                    File::delete($oldCv);
                }
            }

            $extension = $request->file('cv')->getClientOriginalExtension();
            $newName = $request->nama_user.'-'.'cv'.'-'.now()->timestamp.'.'.$extension;
            $request->file('cv')->storeAs('cv', $newName, 'public');
            
            // Update field 'cv' di tabel users
            $user->cv = $request['cv'] = $newName;
            $user->save();
        }

        $pendaftar->save();

        return redirect()->route('user.daftarKegiatan', $id)->with('success', 'Pendaftaran Berhasil');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $kategori = $request->kategori;

        // Query pencarian
        $kegiatans = Kegiatan::with(['mitra', 'pendaftars', 'kategori'])
            ->withCount('pendaftars')
            ->when($kategori, function ($query) use ($kategori) {
                // Filter berdasarkan kategori
                $query->whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('id_kategori', $kategori);
                });
            })
            ->when($search, function ($query) use ($search, $kategori) {
                // Pencarian berdasarkan nama atau mitra, hanya jika kategori ada
                $query->where(function ($query) use ($search) {
                    $query->where('nama_kegiatan', 'like', "%$search%")
                        ->orWhereHas('mitra', function ($query) use ($search) {
                            $query->where('nama_mitra', 'like', "%$search%");
                        })
                        ->orWhere('sistem_kegiatan', 'like', "%$search%")
                        ->orWhere('lokasi_kegiatan', 'like', "%$search%");
                });
            })
            ->get();

        // Hitung sisa hari untuk setiap kegiatan
        foreach ($kegiatans as $kegiatan) {
            $kegiatan->sisa_hari = Carbon::now()->diffInDays(Carbon::parse($kegiatan->tgl_penutupan)->endOfDay(), false);
        }

        // Data untuk digunakan di view
        $totalKegiatan = $kegiatans->count();
        $kegiatanByKategori = $kategori ? Kegiatan::whereHas('kategori', function ($query) use ($kategori) {
            $query->where('id_kategori', $kategori);
        })->exists() : false;

        $kegiatanBySearch = $kategori
            ? Kegiatan::whereHas('kategori', function ($query) use ($kategori) {
                $query->where('id_kategori', $kategori);
            })->where('nama_kegiatan', 'like', "%$search%")->exists()
            : false;

        $kategori = Kategori::all();

        return view('user.layout.daftar-volunteer', compact('kegiatans', 'search', 'kegiatanByKategori', 'kegiatanBySearch', 'totalKegiatan', 'kategori'));
    }

    public function showDetailApplyInformation($id, $id_pen) {
        $user = User::find($id);
        $pendaftar = Pendaftar::with(['user'])->find($id_pen);

        return view('user.layout.profile', compact('user', 'pendaftar'));
    }

    // Partner page
    public function showAllPartnerPage () {
        $mitra = Mitra::withCount('kegiatans')->get();

        return view('user.layout.profile-partner', compact('mitra'));

    }

    public function showDetailPartnerPage ($id) {
        $mitra = Mitra::with('kegiatans')->findOrFail($id);
        return view('user.layout.detail-profile-employer', compact('mitra'));
    }
}
