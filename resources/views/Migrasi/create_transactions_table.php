// database/migrations/2025_xx_xx_create_transactions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // id numerik
            $table->string('no_transaksi')->unique();
            $table->date('tanggal');
            $table->string('pelanggan')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // penjual / kasir
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->string('status')->default('selesai'); // selesai / dibatalkan / pending
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
