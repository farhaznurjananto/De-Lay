<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Order Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class OrderController dengan berbagai method 
| yang menghubungkan antara View dengan Model Order. 
|
*/

class OrderController extends Controller
{
    // ALL

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view data order keseluruhan
    |
    */

    public function index()
    {
        if (auth()->user()->actor_id == 1) {
            $value = auth()->user()->id;

            // kalau mau pakai riwayat ini coment
            $orders = Order::with(['product' => function ($q) use ($value) {
                $q->where('owner_id', '=', $value);
            }])->latest()->paginate(10);

            // kalau mau pakai riwayat ini uncoment
            // $orders = Order::with(['product' => function ($q) use ($value) {
            //     $q->where('owner_id', '=', $value);
            // }])->where('status', '<>', 'accepted')->latest()->paginate(10);
        } elseif (auth()->user()->actor_id == 2) {
            $orders = Order::with('product')->where([['customer_id', '=', auth()->user()->id], ['status', '<>', 'accepted']])->latest()->paginate(10);
        }

        return view('dashboard.order.index', [
            'title' => 'Pemesanan',
            'orders' => $orders
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | History
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view data history keseluruhan
    |
    */

    public function history()
    {
        // kalau mau pakai riwayat ini uncoment semua
        // if (auth()->user()->actor_id == 1) {
        // $value = auth()->user()->id;

        // $orders = Order::with(['product' => function ($q) use ($value) {
        //     $q->where('owner_id', '=', $value);
        // }])->where('status', '=', 'accepted')->latest()->paginate(10);
        // } elseif (auth()->user()->actor_id == 2) {
        $orders = Order::with('product')->where([['customer_id', '=', auth()->user()->id], ['status', '=', 'accepted']])->latest()->paginate(10);
        // }

        return view('dashboard.order.history', [
            'title' => 'Riwayat Pemesanan',
            'orders' => $orders,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view order secara spesifik
    | berdasarkan id
    |
    */

    public function show(Order $order)
    {
        // ADVERTISEMENT
        $advertisement1 = Advertisement::where([
            ['end_date', '>', now()],
            ['start_date', '<', now()],
            ['advertising_package', '=', 'I']
        ])->get();
        if ($advertisement1->count()) {
            $advertisement1->random(1);
        }

        $advertisement2 = Advertisement::where([
            ['end_date', '>', now()],
            ['start_date', '<', now()],
            ['advertising_package', '=', 'II']
        ])->get();
        if ($advertisement2->count()) {
            $advertisement2->random(1);
        }
        return view('dashboard.order.show', [
            'title' => 'Detail Pemesanan',
            'order' => $order->load(['user', 'product']),
            'advertisement1' => $advertisement1,
            'advertisement2' => $advertisement2,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan update data yang telah di 
    | edit untuk diupdate di database
    |
    */

    public function update(Request $request, Order $order)
    {
        if (auth()->user()->actor_id == 1) {
            $validatedData = $request->validate([
                'status' => 'required|max:255',
                'feedback' => 'max:255'
            ]);

            if ($request->status == 'accepted') {
                $validatedData['acc_date'] = now();
            }

            // return $validatedData;

            Order::where('id', $order->id)
                ->update($validatedData);

            // INI PRODUCTNYA BELUM NAMBAH KALAU DI REJECT

            if ($validatedData['status'] == 'rejected') {
                return redirect('/dashboard/order')->with('success', 'Order berhasil ditolak!');
            } else {
                return redirect('/dashboard/order')->with('success', 'Order berhasil diterima!');
            }
        } else if (auth()->user()->actor_id == 2) {
            $rules = [
                'quantity' => 'required|numeric|min:1',
                'proof_of_payment' => 'image|file|max:1024',
                'customer_address' => 'max:255'
            ];

            $validatedData = request()->validate($rules);

            // UPDATE STOCK PRODUCT
            $product = Product::where('id', $order->product_id)->get();
            $tmp_stock = ($product[0]['stock'] +  $order['quantity']) - $validatedData['quantity'];

            if ($tmp_stock < 0) {
                return back()->with('error', 'Inputkan data dengan benar!');
            } else {
                if ($request->file('proof_of_payment')) {
                    if ($request->oldImage) {
                        Storage::delete($request->oldImage);
                    }
                    $validatedData['proof_of_payment'] = $request->file('proof_of_payment')->store('proof-of-payment-images');
                }

                if ($request->metode_payment == 1) {
                    if ($order->proof_of_payment != null) {
                        Storage::delete($request->oldImage);
                        $validatedData['proof_of_payment'] = '';
                    }
                }

                if ($order->status == 'rejected') {
                    $validatedData['status'] = 'pending';
                }

                Order::where('id', $order->id)
                    ->update($validatedData);

                Product::where('id', $order->product_id)
                    ->update(['stock' => $tmp_stock]);

                return redirect('/dashboard/order')->with('success', 'Pemesanan berhasil diperbarui!');
            }
        }
    }

    // FARMER

    // PRODUSEN

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view create data order
    |
    */

    public function create(Product $product)
    {
        return view('dashboard.order.create', [
            'title' => 'Pemesanan',
            'product' => $product,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan data analysis baru ke database
    |
    */

    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'proof_of_payment' => 'image|file|max:1024',
            'customer_address' => 'max:255'
        ];

        $validatedData = request()->validate($rules);

        $validatedData['customer_id'] = auth()->user()->id;

        // UPDATE STOCK PRODUCT
        $product = Product::where('id', $request['product_id'])->get();
        $tmp_stock = $product[0]['stock'] - $validatedData['quantity'];

        if ($tmp_stock < 0) {
            return back()->with('error', 'Inputkan data dengan benar!');
        } else {
            if ($request->file('proof_of_payment')) {
                $validatedData['proof_of_payment'] = $request->file('proof_of_payment')->store('proof-of-payment-images');
            }

            Order::create($validatedData);
            Product::where('id', $request->product_id)
                ->update(['stock' => $tmp_stock]);

            return redirect('/dashboard/market')->with('success', 'Pemesanan baru berhasil ditambahkan. Menunggu konfirmasi dari penjual!');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view edit data order secara
    | spesifik berdasarkan id untuk diedit
    |
    */

    public function edit(Order $order)
    {
        return view('dashboard.order.edit', [
            'title' => 'Ubah Pemesanan',
            'order' => $order
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menghapus data order dari database
    |
    */

    public function destroy(Order $order)
    {
        $tmp_stock = $order->product->stock + $order['quantity'];

        // DELETE PROOF OF PAYMENT IMG
        if ($order->proof_of_payment) {
            Storage::delete($order->proof_of_payment);
        }

        // UPDATE PRODUCT STOCK
        Product::where('id', $order->product->id)
            ->update(['stock' => $tmp_stock]);

        Order::destroy($order->id);

        return redirect('/dashboard/order')->with('success', 'Pemesanan berhasil dibatalkan!');
    }
}
