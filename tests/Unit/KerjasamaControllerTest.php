<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Kerjasama;
use App\Models\Prodi;
use App\Models\Kategori;
use App\Models\User;

class KerjasamaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Menyiapkan data atau kondisi awal yang diperlukan untuk setiap tes
        // Misalnya, membuat user dan melakukan login jika diperlukan
    }

    /** @test */
    public function it_returns_kerjasama_index_view()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/data-kerjasama');
        $response->assertStatus(200);
        $response->assertViewIs('admin.kerjasama.lihatKerjasama');
    }

    /** @test */
    public function it_returns_tambah_data_kerjasama_view()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/tambah-kerja-sama');
        $response->assertStatus(200);
        $response->assertViewIs('admin.kerjasama.tambahKerjasama');
    }

    /** @test */
    public function it_stores_kerjasama()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->create('document.pdf');

        $response = $this->post('/store-kerjasama', [
            // Masukkan data yang diperlukan untuk menyimpan kerjasama
            'nama_instansi' => 'Nama Instansi',
            'nomor_mou' => '123/XYZ',
            'prodi' => [1, 2],
            'kategori' => 1,
            'mou' => $file,
            // Masukkan data lain yang diperlukan
        ]);

        $response->assertRedirect('/tambah-kerja-sama');
        $response->assertSessionHas('success', 'Berhasil Menambahkan Data Kerjasama');

        // Pastikan bahwa data telah disimpan di database
        $this->assertDatabaseHas('kerjasamas', [
            'nama_instansi' => 'Nama Instansi',
            'nomor_mou' => '123/XYZ',
            // Periksa data lain yang diperlukan
        ]);

        // Pastikan bahwa file telah disimpan di storage
        Storage::disk('public')->assertExists('file-mou/123-XYZ.pdf');
    }

    // Tambahkan tes lainnya sesuai kebutuhan
}

