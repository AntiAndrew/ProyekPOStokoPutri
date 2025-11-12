use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiItemsTable extends Migration
{
    public function up()
    {
Schema::create('transaksi_items', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('transaksi_id');
    $table->unsignedBigInteger('id_barang');
    $table->string('nama_barang');
    $table->integer('jumlah');
    $table->decimal('harga_satuan', 15, 2);
    $table->decimal('subtotal', 15, 2);
    $table->timestamps();

    $table->foreign('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade');
});

    }

    public function down()
    {
        Schema::dropIfExists('transaksi_items');
    }
}
