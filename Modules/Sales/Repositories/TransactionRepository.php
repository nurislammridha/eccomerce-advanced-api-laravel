<?php

namespace Modules\Sales\Repositories;

use Modules\Sales\Entities\Transaction;
use Modules\Sales\Entities\TransactionSellLine;

class TransactionRepository
{
    public function index()
    {
        return Transaction::with(['saleLines'])->paginate(20);
    }

    public function show($id)
    {
        return Transaction::with(['saleLines', 'business'])->find($id);
    }

    public function store($data)
    {
        $data['transaction_date'] = date('Y-m-d');
        $transaction = Transaction::create($data);
        if($transaction) {
            foreach($data['sale_lines'] as $key => $value) {
                $saleLine['business_id'] = $data['business_id'];
                $saleLine['created_by'] = $data['created_by'];
                $saleLine['transaction_id'] = $transaction->id;
                $saleLine['item_id'] = $value['item_id'];
                $saleLine['quantity'] = $value['quantity'];
                $saleLine['unit_price'] = $value['unit_price'];
                $saleLine['unit_price_inc_tax'] = $value['unit_price_inc_tax'];
                $saleLine['discount_amount'] = $value['discount_amount'];
                $saleLine['item_tax'] = $value['item_tax'];
                TransactionSellLine::create($saleLine);
            }
        }

        return $transaction;
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if($transaction) {
            $transaction->delete();
            return true;
        } else {
            return false;
        }
    }

    public function getTransactionByBusiness($businessId)
    {
        return Transaction::with(['saleLines', 'business'])->where('business_id', $businessId)->paginate(20);
    }
}
