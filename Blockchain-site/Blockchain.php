<?php
class Blockchain //тут происходит отправка запросов на сервер
{
    public function mine()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"localhost:5000/mine");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec ($ch);
        curl_close ($ch);
    }
    public function showChain()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"localhost:5000/chain");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);
        $result = explode(']},',$result);

        curl_close ($ch);
        return  $result;
    }

    public function addTransaction($data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"localhost:5000/transactions/new");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec ($ch);
        curl_close ($ch);
    }

}

