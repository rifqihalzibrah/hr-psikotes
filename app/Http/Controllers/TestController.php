<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Exception, DataTables, DB, Session, Hash;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = "Test";

            $table_header = [
                'Id',
                'Name',
                'Questions',
                'Durations (Minutes)',
                'View',
            ];

            $create_route = route('users.create');

            return view('pages.test.index', compact('table_header', 'title', 'create_route'));
        } catch (Exception $e) {
            report($e);

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function index_datatables(Request $request)
    {
        $model = Test::query();

        return DataTables::eloquent($model)
            ->addColumn('action', function ($row) {
                $actionBtn = '<td class="d-inline-flex align-items-center">
                          <a href="' . route('test.' . $row->key) . '" class="btn btn-sm btn-icon me-1"><i class="bx bx-show-alt"></i></a>
                      </td>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function test()
    {
        try {
            $title = "Test";

            return view('pages.test.test', compact('title'));
        } catch (Exception $e) {
            report($e);

            return redirect()->back();
        }
    }

    public function wpt()
    {
        try {
            $title = "Psikotest WPT";
            $questions = [
                [
                    'text' => 'Bulan lalu pada awal tahun ini adalah',
                    'img' => '',
                    'options' => ['Januari', 'Juli', 'Oktober', 'Maret', 'Desember',],
                    'input' => false,
                ],
                [
                    'text' => 'MENANGKAP adalah lawan kata dari',
                    'img' => '',
                    'options' => ['Meletakkan', 'Turun tingkat', 'Berusaha', 'Beresiko', 'Membebaskan',],
                    'input' => false,
                ],
                [
                    'text' => 'Sebagian besar hal dibawah ini serupa satu sama lain. Manakah salah satu diantaranya yang kurang serupa dengan yang lain?',
                    'img' => '',
                    'options' => ['Meletakkan', 'Beresiko', 'Turun tingkat', 'Membebaskan', 'Berusaha'],
                    'input' => false,
                ],
                [
                    'text' => 'Jawablah dengan menuliskan YA atau Tidak. Apakah RSVP berarti "jawablah yang tidak perlu"?',
                    'img' => '',
                    'options' => ['Ya', 'Tidak'],
                    'input' => false,
                ],
                [
                    'text' => 'Dalam kelompok kata berikut, manakah kata yang berbeda dari kata yang lain?',
                    'img' => '',
                    'options' => ['Januari', 'Agustus', 'Rabu', 'Okt0ber', 'Desember'],
                    'input' => false,
                ],
                [
                    'text' => 'BIASA adalah lawan kata dari',
                    'img' => '',
                    'options' => ['Jarang', 'Terbiasa', 'Tetap', 'Berhenti', 'Selalu'],
                    'input' => false,
                ],
                [
                    'text' => 'Gambar manakah yang terbuat dari dua gambar di dalam tanda kurung?',
                    'img' => '<img src="' . asset('storage/img/img_wpt/q7.png') . '">',
                    'options' => ['1', '2', '3', '4', '5'],
                    'input' => false,
                ],
                [
                    'text' => 'Perhatikan urutan angka berikut. 8, 4, 2, 1, ½, ¼. Angka berapa yang selanjutnya muncul?',
                    'img' => '',
                    'options' => ['1/6', '1/8', '1/12', '1/16', '1/32'],
                    'input' => false,
                ],
                [
                    'text' => 'Klien dan Pelanggan. Apakah kata-kata ini:',
                    'img' => '',
                    'options' => ['Memiliki arti yang sama', 'Memiliki arti berlawanan', 'Tidak memiliki arti sama atau berlainan'],
                    'input' => false,
                ],
                [
                    'text' => 'Manakah kata berikut ini yang berhubungan dengan aroma saat gigi mengunyah?',
                    'img' => '',
                    'options' => ['Manis', 'Bau tak sedap', 'Bau wangi', 'Hidung', 'Bersih'],
                    'input' => false,
                ],
                [
                    'text' => 'MUSIM GUGUR adalah lawan dari:',
                    'img' => '',
                    'options' => ['Liburan', 'Musim panas', 'Musim semi', 'Musim dingin', 'Musim gugur'],
                    'input' => false,
                ],
                [
                    'text' => 'Sebuah pesawat terbang 300 kaki dalam ½ detik. Pada kecepatan yang sama berapa kaki ia terbang dalam 10 detik?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Anak-anak lelaki ini adalah anak yang normal. Semua anak normal sifatnya aktif. Anak-anak lelaki ini aktif. Anggaplah dua pernyataan pertama adalah benar. Apakah yang terakhir :',
                    'img' => '',
                    'options' => ['Benar', 'Salah', 'Tidak tahu'],
                    'input' => false,
                ],
                [
                    'text' => 'JAUH adalah lawan kata dari',
                    'img' => '',
                    'options' => ['Terpencil', 'Dekat', 'Jauh', 'Terburu-buru', 'Pasti'],
                    'input' => false,
                ],
                [
                    'text' => '3 permen lemon seharga 10 rupiah. Berapa harga ½ lusin?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Berapa banyak jumlah pasangan angka yang sama dibawah ini?',
                    'img' => '<img src="' . asset('storage/img/img_wpt/q16.png') . '">',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Susunlah kata-kata berikut ini menjadi pernyataan yang benar. Lalu tuliskan huruf terakhir dari kata terakhir dari kalimat tersebut sebagai jawaban.<br/>Selalu - Sebuah - Kata - Kerja - Kalimat - Suatu - Memiliki',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Anak lelaki berumur 5 tahun dan saudara perempuannya dua kali lebih tua. Ketika anak lelaki itu berumur 8 tahun, berapa umur saudara perempuannya?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'IT \'S - ITS',
                    'img' => '',
                    'options' => ['Memiliki arti yang sama', 'Memiliki arti yang berlawanan', 'Tidak memiliki arti sama atau berlawanan'],
                    'input' => false,
                ],
                [
                    'text' => 'John seusia dengan Sally. Sally lebih muda dari Bill. John lebih muda dari Bill. Apakah pernyataan terakhir :',
                    'img' => '',
                    'options' => ['Benar', 'Salah', 'Tidak tahu'],
                    'input' => false,
                ],
                [
                    'text' => 'Seorang dealer membeli beberapa barrel seharga 4.000 rupiah. Ia menjual dengan harga 5.000 rupiah, mendapat untung 50 rupiah setiap barrel. Berapa banyak barel yang dijual?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Misalkan Anda menyusun kata-kata berikut sehingga menjadi kalimat lengkap. Jika kalimat itu benar, pilih lah ( B ). Jika salah, pilih lah ( S ). "telur menghasilkan semua ayam"',
                    'img' => '',
                    'options' => ['B', 'S'],
                    'input' => false,
                ],
                [
                    'text' => 'Perhatikan urutan angka berikut. 8 4 2 1 ½ ¼. Angka berapa yang selanjutnya muncul?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Klien dan Pelanggan. Apakah kata-kata ini:',
                    'img' => '',
                    'options' => ['Memiliki arti yang sama', 'Memiliki arti berlawanan', 'Tidak memiliki arti sama atau berlainan'],
                    'input' => false,
                ],
                [
                    'text' => 'Manakah kata berikut ini yang berhubungan dengan aroma saat gigi mengunyah?',
                    'img' => '',
                    'options' => ['Manis', 'Bau tak sedap', 'Bau wangi', 'Hidung', 'Bersih'],
                    'input' => false,
                ],
                [
                    'text' => 'Anggaplah dua pernyataan pertama adalah benar. Pernyataan terakhir: 1. benar 2. salah 3. tidak tahu<br> Semua siswa mengikuti ujian. Beberapa orang diruangan ini adalah siswa. Beberapa orang diruangan ini mengikuti ujian.',
                    'img' => '',
                    'options' => ['Benar', 'Salah', 'Tidak tahu'],
                    'input' => false,
                ],
                [
                    'text' => 'Dalam 30 hari seorang menabung 1 dolar. Berapa rata-rata tabungannya setiap harinya... (____)',
                    'img' => '',
                    'options' => ['1/30', '1/20', '1/15', '1/10', '1/5'],
                    'input' => false,
                ],
                [
                    'text' => 'INGENIOUS INGENUOUS Apakah kata-kata ini 1.Memiliki arti sama,2.Memiliki arti berlawanan,3. tidak memiliki arti sama atau berlawanan? (____)',
                    'img' => '',
                    'options' => ['Memiliki arti sama', 'Memiliki arti berlawanan', 'Tidak memiliki arti sama atau berlawanan'],
                    'input' => false,
                ],
                [
                    'text' => 'Dua orang menangkap 36 ikan. X menangkap 5 kali lebih banyak dari Y. Berapa ikan yang ditangkap Y? (____)',
                    'img' => '',
                    'options' => ['4', '6', '8', '10', '12'],
                    'input' => false,
                ],
                [
                    'text' => 'Sebuah kotak segi empat, yang terisi penuh, memuat 800 kubik kaki gandum. Jika satu kotak lebarnya 8 kaki dan panjangnya 10 kaki, berapa kedalaman kotak itu? (____)',
                    'img' => '',
                    'options' => ['5', '8', '10', '12', '20'],
                    'input' => false,
                ],
                [
                    'text' => 'Satu angka dari rangkaian berikut tidak cocok dengan pola angka yang lainnya. Angka berapakah itu? ½ ¼ 1/6 1/8 1/9 1/12 ?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Jawablah pertanyaan ini dengan menulis YA atau TIDAK. Apakah P.M. berarti “post merediem”? ',
                    'img' => '',
                    'options' => ['Ya', 'Tidak'],
                    'input' => false,
                ],
                [
                    'text' => 'DAPAT DIPERCAYA MUDAH PERCAYA Apakah kata-kata ini 1. memiliki arti sama 2. memiliki arti berlawanan 3. tidak memiliki arti sama atau berlawanan?',
                    'img' => '',
                    'options' => ['Memiliki arti sama', 'Memiliki arti berlawanan', 'Tidak memiliki arti sama atau berlawanan'],
                    'input' => false,
                ],
                [
                    'text' => 'Sebuah rok membutuhkan 2 ¼ meter kain. Berapa banyak potong yang dihasilkan dari 45 meter kain?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Sebuah jam menunjuk tepat pada pukul 12 siang hari pada hari Senin. Pada pukul 2 siang, hari Rabu, jam itu terlambat 26 detik. Pada rata-rata yang sama, berapa banyak jam itu terlambat dalam ½ jam?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Tim bisbol kami kalah 9 permainan dalam musim ini. Ini merupakan 3/8 bagian dari semua pertandingan mereka. Berapa banyak pertandingan yang mereka mainkan dalam musim kompetisi saat ini?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Apakah angka selanjutnya dari deret angka ini? 1 .5 .25 .125 ?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Bentuk geometris ini dapat dibagi oleh suatu garis lurus menjadi dua bagian yang dapat disatukan dengan suatu cara hingga membentuk bujur sangkar yang sempurna. Gambarlah garis yang menghubungkan dua dari angka-angka yang ada. Lalu tuliskan angka tersebut sebagai jawaban.',
                    'img' => '<img src="' . asset('storage/img/img_wpt/q38.png') . '">',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Apakah arti dari kalimat berikut: 1. sama 2 berlawanan 3. tidak sama atau berlawanan? Sebuah sapu yang baru menyapu dengan bersih. Sepatu yang sudah lama sifatnya makin lunak',
                    'img' => '',
                    'options' => ['Tidak sama atau berlawanan', 'Sama', 'Berlawanan'],
                    'input' => false,
                ],
                [
                    'text' => 'Berapa banyak jumlah pasangan kata-kata yang sama berikut ini?',
                    'img' => '<img src="' . asset('storage/img/img_wpt/q40.png') . '">',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Dua dari pribahasa ini memiliki makna yang serupa. Manakah itu?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Gambar geometris ini dapat dibagi dengan garis lurus menjadi dua bagian yang dapat disatukan untuk membentuk sebuah bujur sangkar yang sempurna. Gambarlah suatu garis dengan menghubungkan dua angka. Lalu tulislah angka itu sebagai jawaban.',
                    'img' => '<img src="' . asset('storage/img/img_wpt/q42.png') . '">',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Dalam kelompok angka berikut ini, manakah angka yang terkecil? 10 1 .999 .33 11 .',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Apakah makna dari kalimat berikut: 1. Sama 2. Berlawanan 3. Tidak sama atau berlawanan? Tidak ada orang jujur meminta maaf atas kejujurannya. Kejujuran dihormati dan lapar pujian.',
                    'img' => '',
                    'options' => ['Tidak sama atau berlawanan', 'Sama', 'Berlawanan'],
                    'input' => false,
                ],
                [
                    'text' => 'Dengan harga 1.80 dolar, seorang grosir membeli satu kardus buah yang berisi 12 lusin. Ia tahu dua lusin akan busuk sebelum dia menjualnya. Dengan harga berapa per lusin dia harus menjual jeruk itu untuk mendapat 1/3 hari harga seluruhnya?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Dalam rangkaian kata berikut ini, manakah kata yang berbeda dari yang lainnya?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Anggaplah dua pernyataan pertama ini benar. Apakah pertanyaan terakhir: 1. benar 2. salah 3. tidak tahu Orang besar dibodohi. Saya dibodohi. Saya adalah orang besar.',
                    'img' => '',
                    'options' => ['Benar', 'Salah', 'Tidak tahu'],
                    'input' => false,
                ],
                [
                    'text' => 'Tiga orang membentuk kemitraan dan setuju membagi keuntungan secara rata. X menginvestasi 4,500 dolar. Y sebesar 3.500 dolar dan Z sebesar 2.000 dolar. Jika keuntungan mencapai 1.500 dolar, lebih kurang berapa yang akan diperoleh X dibanding jika keuntungan dibagi berdasarkan besarnya investasi?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
                [
                    'text' => 'Empat dari 5 bagian ini dapat digabungkan untuk membuat segitiga. Manakah keempat gambar ini?',
                    'img' => '<img src="' . asset('storage/img/img_wpt/q49.png') . '">',
                    'options' => ['A', 'B', 'C', 'D', 'E'],
                    'input' => false,
                ],
                [
                    'text' => 'Untuk mencetak sebuah artikel berisi 30.000 kata, sebuah percetakan memutuskan untuk memakai dua ukuran jenis. Dengan menggunakan tipe yang lebih besar, sebuah halaman tercetak akan memuat 1.200 kata. Dengan tipe yang lebih kecil, sebuah halaman memuat 1.500 kata. Artikel ini dimasukkan dalam 22 halaman di majalah. Berapa banyak halaman yang dibutuhkan untuk tipe yang lebih kecil?',
                    'img' => '',
                    'options' => [], // No options provided, may need additional logic
                    'input' => true,
                ],
            ];

            return view('pages.test.wpt', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }


    public function ist()
    {
        try {
            $title = "Psikotest IST";
            $ist = [
                1 => [
                    'title' => 'IST 1',
                    'subtitle' => 'Soal Test IST 1',
                    'route' => route('test.ist1')
                ],
                2 => [
                    'title' => 'IST 2',
                    'subtitle' => 'Soal Test IST 2',
                    'route' => route('test.ist2')
                ],
                3 => [
                    'title' => 'IST 3',
                    'subtitle' => 'Soal Test IST 3',
                    'route' => route('test.ist3')
                ],
                // 4 => [
                //     'title' => 'IST 4',
                //     'subtitle' => 'Soal Test IST 4',
                //     'route' => route('test.ist4')
                // ],
                // 5 => [
                //     'title' => 'IST 5',
                //     'subtitle' => 'Soal Test IST 5',
                //     'route' => route('test.ist5')
                // ],
                // 6 => [
                //     'title' => 'IST 6',
                //     'subtitle' => 'Soal Test IST 6',
                //     'route' => route('test.ist6')
                // ],
            ];
            return view('pages.test.ist', compact('title', 'ist'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function ist1()
    {
        try {
            $title = "Psikotest IST 2";
            $questions = [
                [
                    'text' => 'Lawannya “harapan” ialah . . . . . . . . . . . .',
                    'options' => ['duka', 'putus asa', 'sengsara', 'cinta', 'benci',],
                ],
                [
                    'text' => '. . . . . . . . . . . . . . . . . . . tidak termasuk cuaca.',
                    'options' => ['angin puyuh', 'halilintar', 'salju', 'gempa bumi', 'kabut'],
                ],
                [
                    'text' => 'Lawannya “setia” ialaah . . . . . . . . . . . . . .',
                    'options' => ['cinta', 'benci', 'persahabatan', 'khianat', 'permusuhan'],
                ],
                [
                    'text' => 'Seekor kuda selalu mempunyai . . . . . . . . . . . . . . .',
                    'options' => ['kandang', 'ladam', 'pelana', 'kuku', 'surai'],
                ],
                [
                    'text' => 'Seorang paman . . . . . . . . . . . . . . . lebih tua dari kemenakannya',
                    'options' => ['jarang', 'biasanya', 'selalu', 'tak pernah', 'kadang-kadang'],
                ],
                [
                    'text' => 'Pada jumlah yang sama, nilai kalori yang tertinggi terdapat pada . . . . . . . . . . . . . . .',
                    'options' => ['ikan', 'daging', 'lemak', 'tahu', 'sayuran'],
                ],
                [
                    'text' => 'Pada suatu pertandingan selalu terdapat . . . . . . . . . . . . . . .',
                    'options' => ['lawan', 'wasit', 'penonton', 'sorak', 'kemenangan'],
                ],
                [
                    'text' => 'Suatu pernyataan yang belum dipastikan dkatakan sebagai pernyataan yang . . . . . . . . . . . . . . . . . . . .',
                    'options' => ['paradoks', 'tergesa-gesa', 'mempunyai arti rangkap', 'menyesatkan', 'hipotesis'],
                ],
                [
                    'text' => 'Pada sepatu selalu terdapat . . . . . . . . . . . .',
                    'options' => ['kulit', 'sol', 'tali sepatu', 'gesper', 'lidah'],
                ],
                [
                    'text' => 'Suatu . . . . . . . . . . . . . . . . tidak menyangkut persoalan pencegahan kecelakaan.',
                    'options' => ['lampu lalu lintas', 'kacamata pelindung', 'kotak PPPK', 'tanda peringatan', 'palang kereta api'],
                ],
                [
                    'text' => 'Mata uang dari Rp. 50,- garis tengahnya ialah . . . . . . . . . . . . . . .',
                    'options' => ['17', '29', '25', '24', '15'],
                ],
                [
                    'text' => 'Seseorang yang bersikap menyangsikan setiap kemajuan ialah seorang yang . . . . . . . . . . . . . .',
                    'options' => ['demokratis', 'radikal', 'liberal', 'konservatif', 'anarkis'],
                ],
                [
                    'text' => 'Lawannya “tidak pernah” ialah . . . . . . . . . . . . . .',
                    'options' => ['sering', 'kadang-kadang', 'jarang', 'kerapkali', 'selalu'],
                ],
                [
                    'text' => 'Jarak antara Jakarta – Surabaya ialah kira-kira . . . . . . . . . . . . km',
                    'options' => ['650', '1000', '800', '600', '950'],
                ],
                [
                    'text' => 'Seekor kuda mempunyai kesamaan terbanyak dengan seekor . . . . . . . . . . . . . . . . . . . .',
                    'options' => ['kucing', 'bajing', 'keledai', 'lembu', 'anjing'],
                ],
                [
                    'text' => 'Ayah . . . . . . . . . . . . . . lebih berpengalaman dari pada anaknya',
                    'options' => ['selalu', 'biasanya', 'jauh', 'jarang', 'pada dasarnya'],
                ],
                [
                    'text' => 'Di antara kota-kota yang berikut ini, maka kota . . . . . . . . . . . . letaknya paling selatan',
                    'options' => ['Jakarta', 'Bandung', 'Cirebon', 'Semarang', 'Surabaya'],
                ],
                [
                    'text' => 'Jika kita mengetahui jumlah persentase nomor-nomor lotre yang tidak menang, maka kita dapat menghitung . . . . . . . . . . . . . . .',
                    'options' => ['jumlah nomor yang menang', 'pajak lotre', 'kemungkinan menang', 'jumlah pengikut', 'tinggi keuntungan'],
                ],
                [
                    'text' => 'Seorang anak yang berumur 10 tahun tingginya rata-rata . . . . . . cm',
                    'options' => ['150', '130', '110', '105', '115'],
                ],
            ];

            return view('pages.test.ist1', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function ist2()
    {
        try {
            $title = "Psikotest IST 2";
            $questions = [
                [
                    'text' => '',
                    'options' => ['lingkaran', 'panah', 'elips', 'busur', 'lengkungan'],
                ],
                [
                    'text' => 'Apakah yang biasanya dilakukan dengan menggunakan palu?',
                    'options' => ['mengetuk', 'memaki', 'menjahit', 'menggergaji', 'memukul'],
                ],
                [
                    'text' => 'Ukuran dari sisi suatu objek disebut?',
                    'options' => ['lebar', 'keliling', 'luas', 'isi', 'panjang'],
                ],
                [
                    'text' => 'Tindakan menyambungkan dua benda menjadi satu disebut?',
                    'options' => ['mengikat', 'menyatukan', 'melepaskan', 'mengaitkan', 'melekatkan'],
                ],
                [
                    'text' => 'Apa yang digunakan untuk menunjukkan arah?',
                    'options' => ['arah', 'timur', 'perjalanan', 'tujuan', 'selatan'],
                ],
                [
                    'text' => 'Jarak antara dua titik disebut?',
                    'options' => ['jarak', 'perpisahan', 'tugas', 'batas', 'perceraian'],
                ],
                [
                    'text' => 'Alat yang digunakan untuk menyaring cairan adalah?',
                    'options' => ['saringan', 'kelambu', 'payung', 'tapisan', 'jala'],
                ],
                [
                    'text' => 'Warna yang merupakan campuran dari semua warna adalah?',
                    'options' => ['putih', 'pucat', 'buram', 'kasar', 'berkilauan'],
                ],
                [
                    'text' => 'Sarana transportasi yang berjalan di atas rel disebut?',
                    'options' => ['otobis', 'pesawat terbang', 'sepeda motor', 'sepeda', 'kapal api'],
                ],
                [
                    'text' => 'Alat musik yang dimainkan dengan cara digesek adalah?',
                    'options' => ['biola', 'seruling', 'klarinet', 'terompet', 'saxophon'],
                ],
                [
                    'text' => 'Permukaan yang tidak rata disebut?',
                    'options' => ['bergelombang', 'kasar', 'berduri', 'licin', 'lurus'],
                ],
                [
                    'text' => 'Alat yang digunakan untuk menunjukkan waktu adalah?',
                    'options' => ['jam', 'kompas', 'penunjuk jalan', 'bintang pari', 'arah'],
                ],
                [
                    'text' => 'Proses merencanakan kegiatan di masa mendatang disebut?',
                    'options' => ['kebijaksanaan', 'pendidikan', 'perencanaan', 'penempatan', 'pengerahan'],
                ],
                [
                    'text' => 'Naik sepeda motor menggunakan daya yang disebut?',
                    'options' => ['bermotor', 'berjalan', 'berlayar', 'bersepeda', 'berkuda'],
                ],
                [
                    'text' => 'Karya seni yang dibuat dengan pensil atau kuas pada kanvas adalah?',
                    'options' => ['gambar', 'lukisan', 'potret', 'patung', 'ukiran'],
                ],
            ];

            return view('pages.test.ist2', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function ist3()
    {
        try {
            $title = "Psikotest IST 3";
            $questions = [
                [
                    'text' => 'Hutan : pohon = tembok : ?',
                    'options' => ['batu bata', 'rumah', 'semen', 'putih', 'dinding'],
                ],
                [
                    'text' => 'bunga : jambangan = burung : ?',
                    'options' => ['sarang', 'langit', 'pagar', 'pohon', 'sangkar'],
                ],
                [
                    'text' => 'kereta api : rel = otobis : ?',
                    'options' => ['roda', 'poros', 'ban', 'jalan raya', 'kecepatan'],
                ],
                [
                    'text' => 'perak : emas = cincin : ?',
                    'options' => ['arloji', 'berlian', 'permata', 'gelang', 'platina'],
                ],
                [
                    'text' => 'lingkaran : bola = bujur sangkar : ?',
                    'options' => ['bentuk', 'gambar', 'segiempat', 'kubus', 'piramida'],
                ],
                [
                    'text' => 'saran : keputusan = merundingkan : ?',
                    'options' => ['menawarkan', 'menentukan', 'menilai', 'menimbang', 'merenungkan'],
                ],
                [
                    'text' => 'lidah : asam = hidung : ?',
                    'options' => ['mencium', 'bernapas', 'mengecap', 'tengik', 'asin'],
                ],
                [
                    'text' => 'darah : pembuluh = air : ?',
                    'options' => ['pintu air', 'sungai', 'talang', 'hujan', 'ember'],
                ],
                [
                    'text' => 'saraf : penyalur = pupil : ?',
                    'options' => ['penyinaran', 'mata', 'melihat', 'cahaya', 'pelindung'],
                ],
                [
                    'text' => 'pengantar surat : pengantar telegram = pandai besi : ?',
                    'options' => ['palu godam', 'pedagang besi', 'api', 'tukang emas', 'besi tempa'],
                ],
                [
                    'text' => 'buta : warna = tuli : ?',
                    'options' => ['pendengaran', 'mendengar', 'nada', 'kata', 'telinga'],
                ],
                [
                    'text' => 'makanan : bumbu = ceramah : ?',
                    'options' => ['penghinaan', 'pidato', 'kelakar', 'kesan', 'ayat'],
                ],
                [
                    'text' => 'marah : emosi = duka cita : ?',
                    'options' => ['suka cita', 'sakit hati', 'suasana hati', 'sedih', 'rindu'],
                ],
                [
                    'text' => 'mantel : jubah = wool : ?',
                    'options' => ['bahan sandang', 'domba', 'sutera', 'jas', 'tekstil'],
                ],
                [
                    'text' => 'ketinggian puncak : tekanan udara = ketinggian nada : ?',
                    'options' => ['garpu penala', 'sopran', 'nyanyian', 'panjang senar', 'tekstil'],
                ],
                [
                    'text' => 'negara : revolusi = hidup : ?',
                    'options' => ['biologi', 'keturunan', 'mutasi', 'seleksi', 'ilmu hewan'],
                ],
                [
                    'text' => 'kekurangan : penemuan = panas : ?',
                    'options' => ['haus', 'khatulistiwa', 'es', 'matahari', 'dingin'],
                ],
                [
                    'text' => 'kayu : diketam = besi : ?',
                    'options' => ['dipalu', 'digergaji', 'dituang', 'dikikir', 'ditempa'],
                ],
                [
                    'text' => 'olahragawan : lembing = cendekiawan : ?',
                    'options' => ['perpustakaan', 'digergaji', 'dituang', 'dikikir', 'ditempa'],
                ],
                [
                    'text' => 'keledai : kuda pacuan = pembakaran : ?',
                    'options' => ['pemadam api', 'obor', 'letupan', 'korek api', 'lautan api'],
                ],
            ];

            return view('pages.test.ist3', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function cfit()
    {
        try {
            $title = "Psikotest CFIT";
            $cfit = [
                1 => [
                    'title' => 'CFIT 1',
                    'subtitle' => 'Soal Test CFIT 1',
                    'route' => route('test.cfit1')
                ],
                2 => [
                    'title' => 'CFIT 2',
                    'subtitle' => 'Soal Test CFIT 2',
                    'route' => route('test.cfit2')
                ],
                3 => [
                    'title' => 'CFIT 3',
                    'subtitle' => 'Soal Test CFIT 3',
                    'route' => route('test.cfit3')
                ],
                4 => [
                    'title' => 'CFIT 4',
                    'subtitle' => 'Soal Test CFIT 4',
                    'route' => route('test.cfit4')
                ]
            ];
            return view('pages.test.cfit', compact('title', 'cfit'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function cfit1()
    {
        try {
            $title = "Psikotest CFIT 1";
            $questions = [
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor1_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor2_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor3_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor4_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor5_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor6_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor7_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor8_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor9_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor10_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor11_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor12_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_1/nomor13_choice6.png') . '">',
                    ]
                ],
                // ... and so on for the remaining questions
            ];

            return view('pages.test.cfit1', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function cfit2()
    {
        try {
            $title = "Psikotest CFIT 2";
            $questions = [
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor1_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor1_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor1_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor1_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor1_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor2_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor2_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor2_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor2_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor2_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor3_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor3_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor3_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor3_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor3_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor4_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor4_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor4_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor4_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor4_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor5_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor5_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor5_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor5_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor5_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor6_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor6_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor6_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor6_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor6_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor7_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor7_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor7_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor7_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor7_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor8_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor8_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor8_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor8_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor8_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor9_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor9_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor9_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor9_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor9_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor10_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor10_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor10_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor10_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor10_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor11_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor11_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor11_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor11_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor11_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor12_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor12_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor12_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor12_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor12_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor13_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor13_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor13_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor13_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor13_choice5.png') . '">',
                    ]
                ],
                [
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor14_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor14_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor14_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor14_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_2/nomor14_choice5.png') . '">',
                    ]
                ],
                // ... and so on for the remaining questions
            ];

            return view('pages.test.cfit2', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function cfit3()
    {
        try {
            $title = "Psikotest CFIT 3";
            $questions = [
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor1_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor2_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor3_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor4_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor5_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor6_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor7_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor8_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor9_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor10_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor11_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor12_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_3/nomor13_choice6.png') . '">',
                    ]
                ],
                // ... and so on for the remaining questions
            ];

            return view('pages.test.cfit3', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function cfit4()
    {
        try {
            $title = "Psikotest CFIT 4";
            $questions = [
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor1_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor2_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor3_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor4_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor5_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor6_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor7_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor8_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor9_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor10_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor11_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor12_choice6.png') . '">',
                    ]
                ],
                [
                    'text' => '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13.png') . '">',
                    'options' => [
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13_choice1.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13_choice2.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13_choice3.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13_choice4.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13_choice5.png') . '">',
                        '<img src="' . asset('storage/img/img_cfit/cfit_4/nomor13_choice6.png') . '">',
                    ]
                ],
                // ... and so on for the remaining questions
            ];

            return view('pages.test.cfit4', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }

    public function papikostik()
    {
        try {
            $title = "Psikotest Papikostik";
            $questions = [
                1 => [
                    'text' => 'Saya seorang pekerja "keras"',
                    'alternative' => 'Saya bukan seorang pemurung'
                ],
                2 => [
                    'text' => 'Saya suka bekerja lebih baik dari orang lain',
                    'alternative' => 'Saya suka mengerjakan apa yang sedang saya kerjakan, sampai selesai'
                ],
                3 => [
                    'text' => 'Saya suka menunjukkan caranya melaksanakan sesuatu hal',
                    'alternative' => 'Saya ingin bekerja sebaik mungkin'
                ],
                4 => [
                    'text' => 'Saya suka berkelakar',
                    'alternative' => 'Saya senang mengatakan kepada orang lain, apa yang harus dilakukannya'
                ],
                5 => [
                    'text' => 'Saya suka meggabungkan diri dengan kelompok-kelompok',
                    'alternative' => 'Saya suka diperhatikan oleh kelompok-kelompok'
                ],
                6 => [
                    'text' => 'Saya senang bersahabat intim dengan seseorang',
                    'alternative' => 'Saya senang bersahabat dengan sekelompok orang'
                ],
                7 => [
                    'text' => 'Saya cepat berubah bila hal itu diperlukan',
                    'alternative' => 'Saya berusaha untuk intim dengan teman-teman'
                ],
                8 => [
                    'text' => 'Saya suka membalas dendam bila saya benar-benar disakiti',
                    'alternative' => 'Saya suka melakukan hal-hal yang baru dan berbeda'
                ],
                9 => [
                    'text' => 'Saya ingin atasan saya menyukai saya',
                    'alternative' => 'Saya suka mengatakan kepada orang lain, bila mereka salah'
                ],
                10 => [
                    'text' => 'Saya suka mengikuti perintah-perintah yang diberikan kepada saya',
                    'alternative' => 'Saya suka menyenangkan hati orang yang memimpin saya'
                ],
                11 => [
                    'text' => 'Saya mencoba sekuat tenaga',
                    'alternative' => 'Saya seorang yang tertib, saya meletakkan segala sesuatu pada tempatnya'
                ],
                12 => [
                    'text' => 'Saya membuat orang lain melakukan apa yang saya inginkan',
                    'alternative' => 'Saya bukan orang yang cepat gusar'
                ],
                13 => [
                    'text' => 'Saya suka mengatakan kepada kelompok, apa yang harus dilakukan',
                    'alternative' => 'Saya menekuni satu pekerjaan sampai selesai'
                ],
                14 => [
                    'text' => 'Saya ingin tampak bersemangat dan menarik',
                    'alternative' => 'Saya ingin sangat sukses'
                ],
                15 => [
                    'text' => 'Saya suka menyelaraskan diri dengan kelompok',
                    'alternative' => 'Saya suka membantu orang lain menentukan pendapatnya'
                ],
                16 => [
                    'text' => 'Saya cemas kalau orang lain tidak menyukai saya',
                    'alternative' => 'Saya senang kalau orang-orang memperhatikan saya'
                ],
                17 => [
                    'text' => 'Saya suka mencoba sesuatu yang baru',
                    'alternative' => 'Saya lebih suka bekerja bersama orang-orang daripada bekerja sendiri'
                ],
                18 => [
                    'text' => 'Kadang-kadang saya menyalahkan orang lain bila terjadi sesuatu kesalahan',
                    'alternative' => 'Saya cemas bila seseorang tidak menyukai saya'
                ],
                19 => [
                    'text' => 'Saya suka menyenangkan hati orang yang memimpin saya',
                    'alternative' => 'Saya suka mencoba pekerjaan-pekerjaan yang baru dan berbeda'
                ],
                20 => [
                    'text' => 'Saya menyukai petunjuk yang terinci untuk melakukan sesuatu pekerjaan',
                    'alternative' => 'Saya suka mengatakan kepada orang lain bila mereka mengganggu saya'
                ],
                21 => [
                    'text' => 'Saya selalu mencoba sekuat tenaga',
                    'alternative' => 'Saya senang bekerja dengan sangat cermat dan hati-hati'
                ],
                22 => [
                    'text' => 'Saya adalah seorang pemimpin yang baik',
                    'alternative' => 'Saya mengorganisir tugas-tugas secara baik'
                ],
                23 => [
                    'text' => 'Saya mudah menjadi gusar',
                    'alternative' => 'Saya seorang yang lambat dalam membuat keputusan'
                ],
                24 => [
                    'text' => 'Saya senang mengerjakan beberapa pekerjaan pada waktu yang bersamaan',
                    'alternative' => 'Bila dalam kelompok, saya lebih suka diam'
                ],
                25 => [
                    'text' => 'Saya senang bila diundang',
                    'alternative' => 'Saya ingin melakukan sesuatu lebih baik dari orang lain'
                ],
                26 => [
                    'text' => 'Saya suka berteman intim dengan teman-teman saya',
                    'alternative' => 'Saya senang bersahabat dengan sejumlah orang'
                ],
                27 => [
                    'text' => 'Saya bisa merubah rencana saya dengan mudah',
                    'alternative' => 'Saya bersikap ramah dengan orang lain'
                ],
                28 => [
                    'text' => 'Saya suka membalas dendam bila saya merasa disakiti',
                    'alternative' => 'Saya suka mencoba hal-hal baru dan berbeda'
                ],
                29 => [
                    'text' => 'Saya ingin bos saya menyukai saya',
                    'alternative' => 'Saya suka memberitahu orang lain bila mereka salah'
                ],
                30 => [
                    'text' => 'Saya senang mengikuti perintah-perintah yang diberikan kepada saya',
                    'alternative' => 'Saya suka menyenangkan hati orang yang memimpin saya'
                ],
                31 => [
                    'text' => 'Saya bekerja keras',
                    'alternative' => 'Saya banyak berpikir dan berencana'
                ],
                32 => [
                    'text' => 'Saya memimpin kelompok',
                    'alternative' => 'Hal-hal yang kecil (detail) menarik hati saya'
                ],
                33 => [
                    'text' => 'Saya cepat dan mudah mengambil keputusan',
                    'alternative' => 'Saya meletakkan segala sesuatu secara rapih dan teratur'
                ],
                34 => [
                    'text' => 'Tugas-tugas saya kerjakan secara cepat',
                    'alternative' => 'Saya jarang marah atau sedih'
                ],
                35 => [
                    'text' => 'Saya ingin menjadi bagian dari kelompok',
                    'alternative' => 'Pada suatu waktu tertentu, saya hanya ingin mengerjakan satu tugas saja'
                ],
                36 => [
                    'text' => 'Saya berusaha untuk intim dengan teman-teman saya',
                    'alternative' => 'Saya berusaha keras untuk menjadi yang terbaik'
                ],
                37 => [
                    'text' => 'Saya menyukai mode baju baru dan tipe-tipe mobil baru',
                    'alternative' => 'Saya ingin menjadi penanggung jawab bagi orang-orang lain'
                ],
                38 => [
                    'text' => 'Saya suka berdebat',
                    'alternative' => 'Saya ingin diperhatikan'
                ],
                39 => [
                    'text' => 'Saya suka menyenangkan hati orang yang memimpin saya',
                    'alternative' => 'Saya tertarik menjadi anggota dari suatu kelompok'
                ],
                40 => [
                    'text' => 'Saya senang mengikuti aturan secara tertib',
                    'alternative' => 'Saya suka orang-orang mengenal saya benar-benar'
                ],
                41 => [
                    'text' => 'Saya mencoba sekuat tenaga',
                    'alternative' => 'Saya sangat menyenangkan'
                ],
                42 => [
                    'text' => 'Orang lain beranggapan bahwa saya adalah seorang pemimpin yang baik',
                    'alternative' => 'Saya berfikir jauh ke depan dan terinci'
                ],
                43 => [
                    'text' => 'Saringkali saya memanfaatkan peluang',
                    'alternative' => 'Saya senang memperhatikan hal-hal sampai sekecil-kecilnya'
                ],
                44 => [
                    'text' => 'Orang lain menganggap saya bekerja cepat',
                    'alternative' => 'Orang lain menganggap saya dapat melakukan penataan yang rapi dan teratur'
                ],
                45 => [
                    'text' => 'Saya menyukai permainan-permainan dan olahraga',
                    'alternative' => 'Saya sangat menyenangkan'
                ],
                46 => [
                    'text' => 'Saya senang bila orang-orang dapat intim dan bersahabat',
                    'alternative' => 'Saya selalu berusaha menyelesaikan apa yang telah saya mulai'
                ],
                47 => [
                    'text' => 'Saya suka bereksperimen dan mencoba sesuatu yang baru',
                    'alternative' => 'Saya suka mengerjakan pekerjaan-pekerjaan yang sulit dengan baik'
                ],
                48 => [
                    'text' => 'Saya senang diperlakukan secara adil',
                    'alternative' => 'Saya senang mengajari orang lain bagaimana caranya mengerjakan sesuatu'
                ],
                49 => [
                    'text' => 'Saya suka mengerjakan apa yang diharapkan dari saya',
                    'alternative' => 'Saya suka menarik perhatian'
                ],
                50 => [
                    'text' => 'Saya suka petunjuk-petunjuk terinci dalam melaksanakan pekerjaan',
                    'alternative' => 'Saya senang berada bersama dengan orang lain'
                ],
                51 => [
                    'text' => 'Saya selalu berusaha mengerjakan tugas secara sempurna',
                    'alternative' => 'Orang lain menganggap, saya tidak mengenal lelah, dalam kerja sehari-hari'
                ],
                52 => [
                    'text' => 'Saya tergolong tipe pemimpin',
                    'alternative' => 'Saya mudah berteman'
                ],
                53 => [
                    'text' => 'Saya memanfaatkan peluang-peluang',
                    'alternative' => 'Saya banyak berfikir'
                ],
                54 => [
                    'text' => 'Saya bekerja dengan kecepatan yang mantap dan cepat',
                    'alternative' => 'Saya senang mengerjakan hal-hal yang detail'
                ],
                55 => [
                    'text' => 'Saya memilki banyak energi untuk permainan-permainan dan olahraga',
                    'alternative' => 'Saya menempatkan segala sesuatunya secara rapih dan teratur'
                ],
                56 => [
                    'text' => 'Saya bergaul baik dengan semua orang',
                    'alternative' => 'Saya pandai mengendalikan diri'
                ],
                57 => [
                    'text' => 'Saya ingin berkenalan dengan orang-orang baru dan mengerjakan hal baru',
                    'alternative' => 'Saya selalu ingin menyelesaikan pekerjaan yang sudah saya mulai'
                ],
                58 => [
                    'text' => 'Biasanya saya bersikeras mengenai apa yang saya yakini',
                    'alternative' => 'Biasanya saya suka bekerja "keras"'
                ],
                59 => [
                    'text' => 'Saya menyukai saran-saran dari orang-orang yang saya kagumi',
                    'alternative' => 'Saya senang mengatur orang lain'
                ],
                60 => [
                    'text' => 'Saya biarkan orang-orang lain mempengaruhi saya',
                    'alternative' => 'Saya suka menerima banyak perhatian'
                ],
                61 => [
                    'text' => 'Biasanya saya bekerja sangat "keras"',
                    'alternative' => 'Biasanya saya bekerja cepat'
                ],
                62 => [
                    'text' => 'Bila saya berbicara, kelompok akan mendengarkan',
                    'alternative' => 'Saya terampil mempergunakan alat-alat kerja'
                ],
                63 => [
                    'text' => 'Saya lambat membina persahabatan',
                    'alternative' => 'Saya lambat dalam mengambil keputusan'
                ],
                64 => [
                    'text' => 'Biasanya saya makan secara cepat',
                    'alternative' => 'Saya suka membaca'
                ],
                65 => [
                    'text' => 'Saya menyukai pekerjaan yang memungkinkan saya berkeliling',
                    'alternative' => 'Saya menyukai pekerjaan yang harus dilakukan secara teliti'
                ],
                66 => [
                    'text' => 'Saya berteman sebanyak mungkin',
                    'alternative' => 'Saya dapat menemukan hal-hal yang telah saya pindahkan'
                ],
                67 => [
                    'text' => 'Perencanaan saya jauh ke masa depan',
                    'alternative' => 'Saya selalu menyenangkan'
                ],
                68 => [
                    'text' => 'Saya merasa bangga akan nama baik saya',
                    'alternative' => 'Saya tetap menekuni suatu permasalahan sampai ia terselesaikan'
                ],
                69 => [
                    'text' => 'Saya suka menyenangkan hati orang-orang yang saya kagumi',
                    'alternative' => 'Saya suka menjadi seorang yang berhasil'
                ],
                70 => [
                    'text' => 'Saya senang bila orang-orang lain mengambil keputusan untuk kelompok',
                    'alternative' => 'Saya suka mengambil keputusan untuk kelompok'
                ],
                71 => [
                    'text' => 'Saya selalu berusaha sangat keras',
                    'alternative' => 'Saya cepat dan mudah mengambil keputusan'
                ],
                72 => [
                    'text' => 'Biasanya kelompok saya mengerjakan hal-hal yang saya inginkan',
                    'alternative' => 'Biasanya saya tergesa-gesa'
                ],
                73 => [
                    'text' => 'Saya seringkali merasa lelah',
                    'alternative' => 'Saya lambat di dalam mengambil keputusan'
                ],
                74 => [
                    'text' => 'Saya bekerja secara cepat',
                    'alternative' => 'Saya mudah mendapat kawan'
                ],
                75 => [
                    'text' => 'Biasanya saya bersemangat atau gairah',
                    'alternative' => 'Sebagian besar waktu saya untuk berpikir'
                ],
                76 => [
                    'text' => 'Saya sangat hangat kepada orang-orang',
                    'alternative' => 'Saya menyukai pekerjaan yang menuntut ketepatan'
                ],
                77 => [
                    'text' => 'Saya banyak berpikir dan merencana',
                    'alternative' => 'Saya meletakkan segala sesuatu pada tempatnya'
                ],
                78 => [
                    'text' => 'Saya suka tugas yang perlu ditekuni sampai kepada hal sedetilnya',
                    'alternative' => 'Saya tidak cepat marah'
                ],
                79 => [
                    'text' => 'Saya senang mengikuti orang-orang yang saya kagumi',
                    'alternative' => 'Saya selalu menyelesaikan pekerjaan yang saya mulai'
                ],
                80 => [
                    'text' => 'Saya menyukai petunjuk-petunjuk yang jelas',
                    'alternative' => 'Saya suka bekerja keras'
                ],
                81 => [
                    'text' => 'Saya mengejar apa yang saya inginkan',
                    'alternative' => 'Saya adalah seorang pemimpin yang baik'
                ],
                82 => [
                    'text' => 'Saya membuat orang lain bekerja keras',
                    'alternative' => 'Saya adalah seorang yang gampangan (tak banyak pertimbangan)'
                ],
                83 => [
                    'text' => 'Saya membuat keputusan-keputusan secara cepat',
                    'alternative' => 'Bicara saya cepat'
                ],
                84 => [
                    'text' => 'Biasanya saya bekerja tergesa-gesa',
                    'alternative' => 'Secara teratur saya berolahraga'
                ],
                85 => [
                    'text' => 'Saya tidak suka bertemu dengan orang-orang',
                    'alternative' => 'Saya cepat Lelah'
                ],
                86 => [
                    'text' => 'Saya mempunyai banyak sekali teman',
                    'alternative' => 'Banyak waktu saya untuk berpikir'
                ],
                87 => [
                    'text' => 'Saya suka bekerja dengan teori',
                    'alternative' => 'Saya suka bekerja sedetil-detilnya'
                ],
                88 => [
                    'text' => 'Saya suka bekerja sampai sedetil-detilnya',
                    'alternative' => 'Saya suka mengorganisir pekerjaan saya'
                ],
                89 => [
                    'text' => 'Saya meletakkan segala sesuatu pada tempatnya',
                    'alternative' => 'Saya selalu menyenangkan'
                ],
                90 => [
                    'text' => 'Saya senang diberi petunjuk mengenai apa yang harus saya lakukan',
                    'alternative' => 'Saya harus menyelesaikan apa yang sudah saya mulai'
                ],
            ];

            return view('pages.test.papikostik', compact('title', 'questions'));
        } catch (Exception $e) {
            report($e);
            return redirect()->back();
        }
    }
}
