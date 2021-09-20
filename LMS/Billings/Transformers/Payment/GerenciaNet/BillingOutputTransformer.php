<?php

namespace LMS\Billings\Transformers\Payment\GerenciaNet;

use Carbon\Carbon;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class BillingOutputTransformer
{
    public function handle(array $payload)
    {
        $payload['created_at'] = Carbon::parse($payload['created_at']);
        $payload['price'] = $this->transformMoney($payload['value']);
        $payload['next_execution'] = Carbon::parse($payload['next_execution']);
        foreach($payload['history'] as $key => $history) {
            $payload['history'][$key]['created_at'] = $history['created_at'] = Carbon::parse($history['created_at']);
        }

        return $payload;
    }

    private function transformMoney(mixed $value)
    {
        $money = new Money($value, new Currency('BRL'));
        $currencies = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);
        return $moneyFormatter->format($money);
    }
}
