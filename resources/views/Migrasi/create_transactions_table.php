use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
Schema::create('transaksi', function (Blueprint $table) {
    $table->id();
    $table->string('no_transaksi')->unique();
    $table->date('tanggal');
    $table->string('pelanggan')->nullable();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->decimal('subtotal', 15, 2)->default(0);
    $table->decimal('diskon', 15, 2)->default(0);
    $table->decimal('total', 15, 2)->default(0);
    $table->string('status')->default('selesai');
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
