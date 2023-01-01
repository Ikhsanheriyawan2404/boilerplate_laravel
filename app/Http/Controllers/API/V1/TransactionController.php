<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function processDisbursement($userId)
    {
        DB::transaction(function () use ($userId) {
            $user = User::find($userId);
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'amount' => request('amount'),
                'payment_method' => request('payment_method'),
                'status' => 'success',
            ]);


            $user->decrement('saldo', (int)$transaction->amount);
            $user->save();
        });

        return new ApiResource(
            Response::HTTP_OK,
            Response::$statusTexts[200],
            'Berhasil melakukan pencairan dana',
            null,
        );
    }

    public function historyTransaction($userId)
    {
        $historyTransaction = Transaction::with('user')->where('user_id', $userId)->get();

        return new ApiResource(
            Response::HTTP_OK,
            Response::$statusTexts[200],
            'Histori Penarikan',
            $historyTransaction,
        );
    }
}
